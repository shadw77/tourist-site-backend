<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
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
        
        Relation::enforceMorphMap([
            'Trip' => 'App\Models\Trip',
            'Hotel' => 'App\Models\Hotel',
            'Destination' => 'App\Models\Destination',
            'Restaurant' => 'App\Models\Restaurant',
            'Room' => 'App\Models\Room',
            'users' => 'App\Models\User',
        ]);
        Schema::defaultStringLength(191);
        
    }
}
