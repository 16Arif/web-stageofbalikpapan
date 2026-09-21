<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Http\Middleware\AuthenticateApplicant;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PelayananPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('pelayanan')
            ->path('pelayanan/portal')
            ->authGuard('applicant')
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->brandName('Portal Layanan Data Stasiun Geofisika Balikpapan')
            ->favicon(asset('images/logo-bmkg2.png'))
            ->userMenuItems([
                'website' => MenuItem::make()
                    ->label('Website Utama')
                    ->url(fn (): string => route('home_page'))
                    ->icon('heroicon-o-globe-alt'),
                'katalog' => MenuItem::make()
                    ->label('Katalog Layanan Data')
                    ->url(fn (): string => route('pelayanan'))
                    ->icon('heroicon-o-book-open'),
            ])
            ->discoverResources(in: app_path('Filament/Pelayanan/Resources'), for: 'App\\Filament\\Pelayanan\\Resources')
            ->discoverPages(in: app_path('Filament/Pelayanan/Pages'), for: 'App\\Filament\\Pelayanan\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Pelayanan/Widgets'), for: 'App\\Filament\\Pelayanan\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                AuthenticateApplicant::class,
            ]);
    }
}
