<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Ticket' => 'App\Policies\Ticket\TicketPolicy',
        'App\Models\TicketComment' => 'App\Policies\Ticket\TicketCommentPolicy',
        'App\Models\Priority' => 'App\Policies\PriorityPolicy',
        'App\Models\Label' => 'App\Policies\LabelPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* Determine whether the user can view the dashboard. */
        Gate::define('access-dashboard', function ($user) {
            return $user->isAdmin();
        });

        /* Determine whether the user can view the activity logs. */
        Gate::define('access-activities', function ($user) {
            return $user->isAdmin();
        });
    }
}
