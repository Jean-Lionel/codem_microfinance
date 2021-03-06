<?php

namespace App\Providers;

use App\Models\User;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
         Gate::define('edit-user', function ($user) {
           return $user->isAdmin();
        });

         // Gate::define('destroy-user', function($user){
         //     return $user->isRetraitUser();

         // });

         Gate::define('is-admin',function($user){
            return $user->isAdmin();
        });

         Gate::define('is-retrait-user', function($user){
            return $user->isRetraitUser();
         });

         Gate::define('is-versement-user', function($user){
            return $user->isVersementUser();
         });

        Gate::define('is-register-client', function($user){
            return $user->isRegisterClient();
         });
         Gate::define('manager-user', function($user){
            return $user->isAdmin();
         });
         Gate::define('placement-manager', function($user){
            return $user->isRetraitInteretPlacement();
         });

         Gate::define('decouvert-manager', function($user){
            return $user->isDecouvert();

         });

         Gate::define('is-placement', function($user){
            return $user->isPlacement();
         });
         Gate::define('is-delete-decouvert', function($user){
            return $user->isDeleteDecouvert();
         });
         
         Gate::define('super-admin', function($user){
            return $user->superAdmin();
         });
    }
}
