<?php

namespace App\Models;

//use Barryvdh\Reflection\DocBlock\Type\Collection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ArticleCreated;

class Article extends Model
{
    use HasFactory;

    public $fillable = ['slug', 'owner_id', 'title', 'brief', 'fulltext', 'active'];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
    ] ;

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
