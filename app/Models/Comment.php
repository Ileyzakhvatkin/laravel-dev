<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = ['article_id', 'author_id', 'comment', 'active'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function getAuthorAttribute()
    {
        return User::find($this->author_id);
    }

}
