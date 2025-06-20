<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SecondLine extends ChartWidget
{
    protected static ?string $heading = 'Posts Created Per Month';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        // Get current year
        $year = now()->year;

        // Get post count per month
        $posts = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Initialize data for all 12 months with 0
        $monthlyCounts = collect(range(1, 12))->map(function ($month) use ($posts) {
            return $posts[$month] ?? 0;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Posts Created',
                    'data' => $monthlyCounts,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16,185,129,0.3)',
                ],
            ],
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
