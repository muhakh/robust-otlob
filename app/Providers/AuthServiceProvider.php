<?php

namespace App\Providers;

use Laravel\Passport\Passport;
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
        'App\Model'       => 'App\Policies\ModelPolicy',
        'App\Order'       => 'App\Policies\OrderPolicy',
        'App\Cart'        => 'App\Policies\CartPolicy',
        'App\Restaurant'  => 'App\Policies\RestaurantPolicy',
        'App\MenuItem'    => 'App\Policies\MenuItemPolicy',
        'App\Area'    => 'App\Policies\AreaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
