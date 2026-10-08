<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\CompanySetting;

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
        try {
            if (Schema::hasTable('company_settings')) {
                $companySettings = CompanySetting::pluck('value', 'key')->toArray();
                View::share('companySettings', $companySettings);
            }
        } catch (\Exception $e) {
            // Ignore if DB connection not established yet
        }
    }
}
