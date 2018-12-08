<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeancePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role === User::ADMIN_ROLE;
    }
}
