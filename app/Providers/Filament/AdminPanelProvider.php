<?php

namespace App\Providers\Filament;

use App\Enums\RolesEnum;
use App\Filament\Widgets\CommentChartWidget;
use App\Filament\Widgets\SecondLine;
use App\Filament\Widgets\StartEidgets;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider {
    public function panel( Panel $panel ): Panel {
        return $panel
        ->default()
        ->id( 'admin' )
        ->path( 'admin' )
        ->sidebarCollapsibleOnDesktop()
        ->login()
        ->font('poppins')
        ->sidebarWidth('64')
        ->darkMode(true)
        ->colors( [
            'primary' => Color::Sky,
            'secondary' => Color::Blue,
        ] )
        ->discoverResources( in: app_path( 'Filament/Resources' ), for: 'App\\Filament\\Resources' )
        ->discoverPages( in: app_path( 'Filament/Pages' ), for: 'App\\Filament\\Pages' )
        ->pages( [
            Pages\Dashboard::class,
        ] )
        ->discoverWidgets( in: app_path( 'Filament/Widgets' ), for: 'App\\Filament\\Widgets' )
        ->widgets( [
            // Widgets\AccountWidget::class,
            CommentChartWidget::class

        ] )
        ->middleware( [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
            'auth',
            sprintf('role:%s|%s',
                    RolesEnum::Admin->value,
                    RolesEnum::Writer->value,
            ),
        ] );
        // ->authMiddleware( [
        //     Authenticate::class,
        // ] );
    }
}
