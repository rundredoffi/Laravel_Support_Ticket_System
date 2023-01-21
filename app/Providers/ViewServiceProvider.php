<?php

namespace App\Providers;

use App\View\Composers\CategoryComposer;
use App\View\Composers\LabelComposer;
use App\View\Composers\PriorityComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['web.tickets.index', 'components.tickets.form'], CategoryComposer::class);
        View::composer(['components.tickets.form'], LabelComposer::class);
        View::composer(['web.tickets.index', 'components.tickets.form'], PriorityComposer::class);
    }
}
