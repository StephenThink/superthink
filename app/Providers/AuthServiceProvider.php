<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gates
        Gate::define('logged-in', function($user){
            return $user;
        });

        Gate::define('is-admin', function($user){
            return $user->hasAnyRoles([
                'admin',
                'super'
            ]);
        });

        Gate::define('is-user-manager', function($user){
            return $user->hasAnyRoles([
                'user manager',
                'super'
                ]);
        });

        Gate::define('is-client-manager', function($user){
            return $user->hasAnyRoles([
                'client manager',
                'super'
            ]);
        });

        Gate::define('is-frontend-manager', function($user){
            return $user->hasAnyRoles([
                'frontend manager',
                'super'
            ]);
        });

        Gate::define('is-holiday-manager', function($user){
            return $user->hasAnyRoles([
                'holiday manager',
                'super'
            ]);
        });

        Gate::define('is-vault-manager', function($user){
            return $user->hasAnyRoles([
                'vault manager',
                'super'
            ]);
        });

        Gate::define('is-super', function($user){
            return $user->hasAnyRole('super');
        });

        Gate::define('is-staff-editor', function($user){
            return $user->hasAnyRoles([
                'staff editor',
                'super'
            ]);
        });

    }
}
