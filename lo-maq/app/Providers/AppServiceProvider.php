<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Intercepta todas as views e injeta a variável $layout
        View::composer('*', function ($view) {
            $layout = (auth()->check() && auth()->user()->access === 'ADM')
                ? 'layouts.admin'
                : 'layouts.default';

            $view->with('layout', $layout);
        });
    }
}