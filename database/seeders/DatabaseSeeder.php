<?php

namespace Database\Seeders;

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
        \App\Models\Tag::factory(rand(10,15))->create();
        \App\Models\User::factory(rand(2,3))->create()
            ->each(function (\App\Models\User $user) {
                $user->roles()->attach(2);
                \App\Models\Article::factory(rand(10,12))->create([ 'owner_id' => $user ])
                    ->each(function (\App\Models\Article $article) {
                        $randomTag = \App\Models\Tag::all()->random(rand(1,5));
                        $article->tags()->saveMany($randomTag);
                    });
            });
    }
}
