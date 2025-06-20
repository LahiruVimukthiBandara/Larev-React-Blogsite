<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Filament\Widgets\ChartWidget;

class CommentChartWidget extends ChartWidget {
    protected static ?string $heading = 'Comments Per Month';
    protected static ?int $sort = 2;

    protected function getData(): array {
        $year = now()->year;

        $commentCounts = Comment::selectRaw( 'MONTH(created_at) as month, COUNT(*) as count' )
        ->whereYear( 'created_at', $year )
        ->groupBy( 'month' )
        ->pluck( 'count', 'month' );

        $monthlyCommentData = collect( range( 1, 12 ) )->map( fn ( $m ) => $commentCounts[ $m ] ?? 0 );

        return [
            'datasets' => [
                [
                    'label' => 'Comments',
                    'data' => $monthlyCommentData,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.3)',
                ],
            ],
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
        ];
    }

    protected function getType(): string {
        return 'line';
    }
}
