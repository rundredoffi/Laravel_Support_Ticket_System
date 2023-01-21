<?php

namespace App\Providers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
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
        /* Use bootstrap pagination. */
        Paginator::useBootstrap();

        /* Macro for returning response with success message */
        RedirectResponse::macro('withSuccess', function ($message) {
            return $this->with('', flasher($message));
        });

        /* Macro for returning response with fail message */
        RedirectResponse::macro('withFail', function ($message) {
            return $this->with('', flasher($message, 'danger'));
        });
    }
}
