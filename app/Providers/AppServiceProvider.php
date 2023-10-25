<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Relation::enforceMorphMap([
        //     'Trip' => 'App\Models\Trip',
        //     'Hotel' => 'App\Models\Hotel',
        //     'Destination' => 'App\Models\Destination',
        //     'Restaurant' => 'App\Models\Restaurant',
        //     'Room' => 'App\Models\Room',
        // ]);
        
    }
}
