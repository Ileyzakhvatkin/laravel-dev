<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ReportCompleted;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MaterialsSiteReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $allTables = [
            'news' => 'Новостей',
            'articles' => 'Статей',
            'comments'=> 'Комментариев',
            'tags' => 'Тегов',
            'users' => 'Пользователей',
        ];

        $reportData = [];
        foreach ( $allTables as $key => $table ) {
            if ( array_key_exists($key, \request()->all()) ) {
                $reportData[$table] = \DB::table($key)->count();
            }
        }

        $this->user->notify(new ReportCompleted($reportData));
    }
}
