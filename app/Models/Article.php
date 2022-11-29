<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ArticleCreated;
use Illuminate\Support\Arr;
use App\Services\ArticlesCollection;

class Article extends Model
{
    use HasFactory;

    public $fillable = ['slug', 'owner_id', 'title', 'brief', 'fulltext', 'active'];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Article $article) {
            $after = $article->getDirty();
            $article->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($article->fresh()->toArray(), array_keys($after)), JSON_UNESCAPED_UNICODE),
                'after' => json_encode($after, JSON_UNESCAPED_UNICODE),
            ]);
        });

        static::created( function () {
            \Cache::tags(['articles'])->flush();
        });

        static::updated( function () {
            \Cache::tags(['articles'])->flush();
        });

        static::deleted( function () {
            \Cache::tags(['articles'])->flush();
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

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories')
            ->withPivot(['before', 'after'])->withTimestamps();
    }

    public function isActive()
    {
        return $this->active;
    }

    public function isNotActive()
    {
        return ! $this->isActive();
    }

    public function setLengthTextAttribute ()
    {
        return $this->attributes['length_text'] = mb_strlen($this->fulltext);
    }

    public function newCollection(array $models = [])
    {
        return new ArticlesCollection($models);
    }
}
