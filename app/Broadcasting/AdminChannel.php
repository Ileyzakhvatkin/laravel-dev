<?php

namespace App\Broadcasting;

use App\Models\User;

class AdminChannel
{
    public function __construct()
    {
        //
    }

    public function join(User $user)
    {
        return $user->isAdmin();
    }
}
