<?php

namespace App\Broadcasting;

use App\Models\User;

class AdminChannel
{
    public $admin;

    public function __construct()
    {
        $this->admin = \auth();
    }

    public function join()
    {
        return $this->isAdmin();
    }
}
