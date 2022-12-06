<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class ArticlesCollection extends Collection
{

    public function allActive()
    {
        return $this->filter->isActive();
    }
    public function allNotActive()
    {
        return $this->filter->isNotActive();
    }
}
