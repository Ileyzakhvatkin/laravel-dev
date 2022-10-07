<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $fillable = ['slug', 'title', 'brief', 'fulltext', 'active'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
