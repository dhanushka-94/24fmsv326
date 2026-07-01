<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Support\Frames;
use Illuminate\Support\Facades\Schema;
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
    }

    private function applyBrandingFromDatabase(): void
    {
        try {
            if (! Schema::hasTable('site_settings')) {
                return;
            }

            foreach (['logo_white', 'logo_red', 'favicon'] as $key) {
                $stored = SiteSetting::get($key);

                if (! $stored) {
                    continue;
                }

                config(["frames.{$key}" => SiteSetting::normalizeStoredPath($stored)]);
            }

            config(['frames.logo' => config('frames.logo_white')]);
        } catch (\Throwable) {
            //
        }
    }
}
