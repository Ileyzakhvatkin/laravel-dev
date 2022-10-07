<?php

namespace MyHelpers;

use App\Models\Tag;
use App\Services\Collection;
use App\Services\Model;

class TagsSynchronizer
{
    public function sync(Collection $tags, Model $model)
    {
        $modelTags = $model->tags->keyBy('name');
        $syncIds = $modelTags->intersectByKeys($tags)->pluck('id')->toArray();
        $tagsToAttach = $tags->diffKeys($modelTags);
        foreach ( $tagsToAttach as $tag ) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }
        $model->tags()->sync($syncIds);
    }

    public function syncSecond($tags, $model)
    {
        $articleTags = $model->tags->keyBy('name');
        $tagsToAttach = $tags->diffKeys($articleTags);
        $tagsToDetach = $articleTags->diffKeys($tags);
        foreach ( $tagsToAttach as $tag ) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $model->tags()->attach($tag);
        }
        foreach ( $tagsToDetach as $tag ) {
            $model->tags()->detach($tag);
        }
    }
}
