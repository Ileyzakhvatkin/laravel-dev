<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ArticleCreated;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    public $fillable = ['slug', 'owner_id', 'title', 'brief', 'fulltext', 'active'];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
    ] ;

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
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
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

    public function newCollection(array $models = [])
    {
        return new class($models) extends Collection {
            public function allActive()
            {
                return $this->filter->isActive();
            }
            public function allNotActive()
            {
                return $this->filter->isNotActive();
            }
        };
    }
}
