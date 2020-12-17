<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = [];
        foreach($user->roles as $role) {
            foreach($role->permissions as $permission) {
                $permissions[] = $permission->permission;
            }
        }

        return in_array('Create-post', $permissions);
    }

}
