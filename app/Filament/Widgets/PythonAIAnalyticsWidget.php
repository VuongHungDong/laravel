<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Services\PythonAnalyticsService;

class PythonAIAnalyticsWidget extends Widget
{
    protected static string $view = 'filament.widgets.python-a-i-analytics-widget';
    protected int | string | array $columnSpan = 'full';

    public ?array $analyticsData = null;

    public function mount()
    {
        $service = new PythonAnalyticsService();
        $this->analyticsData = $service->getAnalytics();
    }
}
