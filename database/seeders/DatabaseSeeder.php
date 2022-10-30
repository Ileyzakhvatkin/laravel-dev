<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory(rand(8,15))->create();
        User::factory(rand(5,15))->create()
            ->each(function (User $user) {
                $user->roles()->attach(2);
                Article::factory(rand(0,10))->create([ 'owner_id' => $user ])
                    ->each(function (Article $article) {
                        $article->tags()->saveMany(Tag::all()->random(rand(2,5)));
                        $article->comments()->saveMany(Comment::factory(rand(0,7))
                            ->make([
                                'article_id' => '',
                            ]));
                    });
            });
        News::factory(rand(20,30))->create();
    }
}
