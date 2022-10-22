<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Carbon\Carbon;
use \App\Models\User;
use \App\Models\Article;

class SendArtList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send_art_list
        {startData? : Начало периода публикации - YYYY-MM-DD}
        {endData? : Конец периода публикации - YYYY-MM-DD}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправляет всем пользователям список опубликованных на сайте статей за указанный период';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        $startData = $this->argument('startData')
            ? Carbon::parse($this->argument('startData'))
            : Carbon::now()->subDays(1000000);
        $endData = $this->argument('endData')
            ? Carbon::parse($this->argument('endData'))
            : Carbon::now();
        $articles = Article::all()->filter(function ($article) use ($endData, $startData) {
            if ( $article->created_at >= $startData && $article->created_at <= $endData ) {
                return $article;
            }
        });
        $users->map->notify(new \App\Notifications\SendArtList($articles, $startData, $endData));
    }
}
