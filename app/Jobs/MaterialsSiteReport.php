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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
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
            if ( array_key_exists($key, \request()->all() ) ) {
                $reportData[$table] = \DB::table($key)->count();
            }
        }

        User::first()->notify(new ReportCompleted($reportData));

        return $reportData;
    }
}
