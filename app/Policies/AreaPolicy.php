<?php

namespace App\Policies;

use App\User;
use App\Area;
use Illuminate\Auth\Access\HandlesAuthorization;

class AreaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create areas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_superuser == true;
    }

    /**
     * Determine whether the user can update the area.
     *
     * @param  \App\User  $user
     * @param  \App\Area  $area
     * @return mixed
     */
    public function update(User $user, Area $area)
    {
        return $user->is_superuser == true;
    }

    /**
     * Determine whether the user can delete the area.
     *
     * @param  \App\User  $user
     * @param  \App\Area  $area
     * @return mixed
     */
    public function delete(User $user, Area $area)
    {
        return $user->is_superuser == true;
    }
}
