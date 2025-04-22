<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function isAdmin(User $user)
    {
        return $user->hasRole('admin'); // Check if the user is an admin
    }

    public function isUser(User $user)
    {
        return $user->hasRole('user'); // Check if the user is a regular user
    }

    public function isVendor(User $user)
    {
        return $user->hasRole('vendor'); // Check if the user is a vendor
    }
}
