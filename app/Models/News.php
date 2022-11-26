<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public $fillable = ['slug', 'owner_id', 'title', 'brief', 'fulltext', 'active'];

    protected static function boot()
    {
        parent::boot();

        static::created( function () {
            \Cache::tags(['news', 'news_more'])->flush();
        });

        static::updated( function () {
            \Cache::tags(['news', 'news_more'])->flush();
        });

        static::deleted( function () {
            \Cache::tags(['news', 'news_more'])->flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
