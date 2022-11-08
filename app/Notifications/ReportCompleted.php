<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportCompleted extends Notification
{
    use Queueable;

    public $reportData;

    public function __construct($reportData)
    {
        $this->reportData = $reportData;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail()
    {
        return (new MailMessage())
            ->markdown('mail.report', ['reportData' => $this->reportData])
            ->subject('Количество опубликованных на сайте материалов');
    }
}
