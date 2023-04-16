<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Components\Form\Input;
use ProtoneMedia\Splade\Components\Form\Textarea;

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
        Input::defaultDateFormat('d/m/Y');
        Input::defaultTimeFormat('H:i');
        Input::defaultDatetimeFormat('d/m/Y H:i');
        Textarea::defaultAutosize();
    }
}
