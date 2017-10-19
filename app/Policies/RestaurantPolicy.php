<?php

namespace App\Policies;

use App\User;
use App\Restaurant;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create restaurants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_superuser == true;
    }

    /**
     * Determine whether the user can update the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function update(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->manager_id || $user->is_superuser == true;
    }

    /**
     * Determine whether the user can delete the restaurant.
     *
     * @param  \App\User  $user
     * @param  \App\Restaurant  $restaurant
     * @return mixed
     */
    public function delete(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->manager_id || $user->is_superuser == true;
    }
}
