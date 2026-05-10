<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Cache;

class PythonAnalyticsService
{
    public function getAnalytics()
    {
        return Cache::remember('python_analytics', 3600, function () {
            // Fetch relevant data
            $orders = Order::with(['details.product.category'])
                ->where('status', '!=', 'cancelled')
                ->get()
                ->map(function ($order) {
                    // Try to find the user by email if user_id is null
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
                                    'id' => $detail->product->id,
                                    'name' => $detail->product->name,
                                    'category' => [
                                        'name' => $detail->product->category->name ?? 'Unknown',
                                    ]
                                ]
                            ];
                        })
                    ];
                });

            $data = json_encode(['orders' => $orders]);
            
            $pythonScript = base_path('scripts/python/analytics.py');
            // Mở tiến trình Python
            $process = proc_open("python3 \"$pythonScript\"", [
                0 => ["pipe", "r"], // stdin
                1 => ["pipe", "w"], // stdout
                2 => ["pipe", "w"], // stderr
            ], $pipes);

            if (is_resource($process)) {
                // Gửi dữ liệu JSON qua stdin
                fwrite($pipes[0], $data);
                fclose($pipes[0]);

                // Đọc kết quả từ stdout
                $output = stream_get_contents($pipes[1]);
                fclose($pipes[1]);

                $errors = stream_get_contents($pipes[2]);
                fclose($pipes[2]);

                proc_close($process);

                if ($output) {
                    $decoded = json_decode($output, true);
                    if ($decoded && !isset($decoded['error'])) {
                        return $decoded;
                    }
                }
            }
            
            return null; // Return null if execution fails
        });
    }
}
