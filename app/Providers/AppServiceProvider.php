<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;

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
        $path = base_path('forms');

        if (!is_dir($path)) {
            return;
        }

        foreach (Finder::create()->files()->name('*.php')->in($path) as $file) {
            require $file->getRealPath();
        }
    }
}
