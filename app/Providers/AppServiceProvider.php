<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Support\Frames;
use App\Support\SiteContent;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->applyBrandingFromDatabase();
        SiteSetting::ensureBrandingDefaults();
        $this->applyBrandingFromDatabase();
        $this->registerViewComposers();
    }

    private function registerViewComposers(): void
    {
        View::composer(['layouts.site', 'components.page-shell'], function ($view): void {
            $clients = SiteContent::publishedClients();

            $view->with('siteClients', $clients);
            $view->with(
                'showClientCarousel',
                $clients->isNotEmpty() && ! request()->routeIs('services', 'team', 'contact'),
            );
        });
    }

    private function applyBrandingFromDatabase(): void
    {
        try {
            if (! Schema::hasTable('site_settings')) {
                return;
            }

            foreach (['logo', 'logo_white', 'logo_red', 'favicon'] as $key) {
                $stored = SiteSetting::get($key);

                if (! $stored) {
                    continue;
                }

                config(["frames.{$key}" => SiteSetting::normalizeStoredPath($stored)]);
            }
        } catch (\Throwable) {
            //
        }
    }
}
