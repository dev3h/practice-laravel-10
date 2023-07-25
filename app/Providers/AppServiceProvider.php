<?php

namespace App\Providers;

use App\Http\Resources\ClassroomResource;
use App\View\Components\Shapes\Circle;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('circle', Circle::class);
        // ClassroomResource::withoutWrapping();

    }
}
