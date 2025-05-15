<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\UserRole;

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
        return $user->hasRole(UserRole::ADMIN); // Use enum value
    }

    public function isUser(User $user)
    {
        return $user->hasRole(UserRole::USER); // Use enum value
    }

    public function isVendor(User $user)
    {
        return $user->hasRole(UserRole::VENDOR); // Use enum value
    }
}
