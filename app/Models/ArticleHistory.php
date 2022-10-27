<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function article()
    {
        return $this->belongsToMany(Article::class);
    }
}
