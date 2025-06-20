<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StartEidgets extends BaseWidget {
    protected function getStats(): array {
        // posts
        $totalPostCount = Post::count();
        $todayPostCount = Post::whereDate( 'created_at', Carbon::today() )->count();

        // comment
        $totalCommentCount = Comment::count();
        $todayCommentCount = Comment::whereDate( 'created_at', Carbon::today() )->count();
        $toApproveCount = Comment::where( 'status', 0 )->count();

        // categories
        $totalCategoryCount = Category::count();

        // users
        $totalUserCount = User::Count();

        return [
            Stat::make( 'Posts', $totalPostCount )
            ->description( "{$todayPostCount} new today" )
            ->descriptionIcon( 'heroicon-m-arrow-trending-up' )
            ->color( 'success' )
            ->chart( [ 4, 6, 8, 3, 7, 5, $todayPostCount ] ),

            Stat::make( 'Comments', $totalCommentCount )
            ->description( "{$todayCommentCount} new today, {$toApproveCount} pending approve" )
            ->descriptionIcon( 'heroicon-m-arrow-trending-up' )
            ->color( 'info' )
            ->chart( [ 4, 6, 8, 3, 7, 5, $todayCommentCount ] ),

            Stat::make( 'Categories', $totalCategoryCount )
            ->description( "{$totalCategoryCount} categories" )
            ->descriptionIcon( 'heroicon-m-arrow-trending-up' )
            ->color( 'warning' )
            ->chart( [ 4, 6, 8, 3, 7, 5, $totalCategoryCount ] ),

            Stat::make( 'Users', $totalUserCount )
            ->description( "{$totalUserCount} users" )
            ->descriptionIcon( 'heroicon-m-arrow-trending-up' )
            ->color( 'danger' )
            ->chart( [ 4, 6, 8, 3, 7, 5, $totalUserCount ] ),
        ];
    }
}
