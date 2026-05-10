<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PythonAnalyticsService
{
    public function getAnalytics()
    {
        return Cache::remember('python_analytics', 3600, function () {
            try {
                return $this->runPythonAnalysis();
            } catch (\Throwable $e) {
                Log::warning('Python analytics failed, using PHP fallback: ' . $e->getMessage());
                return $this->phpFallbackAnalysis();
            }
        });
    }

    private function runPythonAnalysis()
    {
        $orders = $this->getOrderData();
        $data = json_encode(['orders' => $orders]);
        
        $pythonScript = base_path('scripts/python/analytics.py');
        
        // Thử chạy python3 trước, nếu không có thì thử python
        $pythonCmd = 'python3';
        $testProcess = @proc_open("$pythonCmd --version", [1 => ["pipe","w"], 2 => ["pipe","w"]], $testPipes);
        if (!is_resource($testProcess)) {
            $pythonCmd = 'python';
            $testProcess2 = @proc_open("$pythonCmd --version", [1 => ["pipe","w"], 2 => ["pipe","w"]], $testPipes2);
            if (!is_resource($testProcess2)) {
                throw new \RuntimeException('Python not available');
            }
            fclose($testPipes2[1]); fclose($testPipes2[2]); proc_close($testProcess2);
        } else {
            fclose($testPipes[1]); fclose($testPipes[2]); proc_close($testProcess);
        }

        $process = proc_open("$pythonCmd \"$pythonScript\"", [
            0 => ["pipe", "r"],
            1 => ["pipe", "w"],
            2 => ["pipe", "w"],
        ], $pipes);

        if (!is_resource($process)) {
            throw new \RuntimeException('Cannot open Python process');
        }

        fwrite($pipes[0], $data);
        fclose($pipes[0]);

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($process);

        if ($output) {
            $decoded = json_decode($output, true);
            if ($decoded && !isset($decoded['error'])) {
                return $decoded;
            }
        }

        throw new \RuntimeException('Python returned no valid output');
    }

    /**
     * PHP fallback: phân tích trực tiếp bằng PHP nếu Python không khả dụng
     */
    private function phpFallbackAnalysis()
    {
        $orders = $this->getOrderData();
        
        $genderPrefs = [];
        $agePrefs = [];

        foreach ($orders as $order) {
            $user = $order['user'] ?? null;
            $gender = $user['gender'] ?? 'other';
            $birthday = $user['birthday'] ?? null;
            $ageGroup = $this->getAgeGroup($birthday);

            foreach ($order['details'] as $detail) {
                $catName = $detail['product']['category']['name'] ?? 'Unknown';
                $qty = $detail['quantity'] ?? 0;

                if (!isset($genderPrefs[$gender])) $genderPrefs[$gender] = [];
                $genderPrefs[$gender][$catName] = ($genderPrefs[$gender][$catName] ?? 0) + $qty;

                if (!isset($agePrefs[$ageGroup])) $agePrefs[$ageGroup] = [];
                $agePrefs[$ageGroup][$catName] = ($agePrefs[$ageGroup][$catName] ?? 0) + $qty;
            }
        }

        $result = [
            'gender_insights' => [],
            'age_insights' => [],
            'total_analyzed_orders' => count($orders),
        ];

        foreach ($genderPrefs as $g => $prefs) {
            if (!empty($prefs)) {
                arsort($prefs);
                $result['gender_insights'][$g] = [
                    'top_category' => array_key_first($prefs),
                    'stats' => $prefs,
                ];
            }
        }

        foreach ($agePrefs as $ag => $prefs) {
            if (!empty($prefs)) {
                arsort($prefs);
                $result['age_insights'][$ag] = [
                    'top_category' => array_key_first($prefs),
                    'stats' => $prefs,
                ];
            }
        }

        return $result;
    }

    private function getAgeGroup(?string $birthday): string
    {
        if (!$birthday) return 'Unknown';
        try {
            $age = \Carbon\Carbon::parse($birthday)->age;
            if ($age < 18) return '<18';
            if ($age <= 25) return '18-25';
            if ($age <= 35) return '26-35';
            if ($age <= 50) return '36-50';
            return '>50';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }

    private function getOrderData(): array
    {
        return Order::with(['details.product.category'])
            ->where('status', '!=', 'cancelled')
            ->get()
            ->map(function ($order) {
                $user = \App\Models\User::where('email', $order->email)->first();
                return [
                    'id' => $order->id,
                    'user' => $user ? [
                        'gender' => $user->gender,
                        'birthday' => $user->birthday ? $user->birthday->format('Y-m-d') : null,
                    ] : null,
                    'details' => $order->details->map(function ($detail) {
                        return [
                            'quantity' => $detail->quantity,
                            'price' => $detail->price,
                            'product' => [
                                'id' => $detail->product->id ?? 0,
                                'name' => $detail->product->name ?? 'Unknown',
                                'category' => [
                                    'name' => $detail->product->category->name ?? 'Unknown',
                                ]
                            ]
                        ];
                    })->toArray()
                ];
            })->toArray();
    }
}
