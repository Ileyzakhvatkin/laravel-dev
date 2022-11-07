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

    public $reportData;
    public $user;

    public function __construct($reportData, $user)
    {
        $this->reportData = $reportData;
        $this->user = $user;
    }

    public function handle()
    {
        $this->user->notify(new ReportCompleted($this->reportData));
    }
}
