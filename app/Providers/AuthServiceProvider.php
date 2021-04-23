<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {
            return $user->role == 'ADMIN';
        });

        Gate::define('isStaff', function($user) {
            return $user->role == 'STAFF';
        });

        Gate::define('isLogin', function($user) {
            return $user->role == 'ADMIN';
        });

        // Gate::define('manage-categories', function($user){
        //     return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        // });

        // Gate::define('manage-customers', function($user){
        //     return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        // });

        // Gate::define('manage-products', function($user){
        //     return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        // });

        // Gate::define('manage-suppliers', function($user){
        //     return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        // });

        // Gate::define('manage-transactions', function($user){
        //     return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        // });

        // Gate::define('manage-units', function($user){
        //     return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        // });

        // Gate::define('manage-users', function($user){
        //     return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        // });
  
    }
}
