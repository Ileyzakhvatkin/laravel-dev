<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::created( function () {
            \Cache::tags(['tags'])->flush();
        });

        static::updated( function () {
            \Cache::tags(['tags'])->flush();
        });

        static::deleted( function () {
            \Cache::tags(['tags'])->flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public static function tagsCloud()
    {
        return (new static)->has('news')->get();
    }
}
