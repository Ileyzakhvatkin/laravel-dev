<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArticleCreationCompleted extends Notification
{
    use Queueable;

    private $article;
    protected $subject;

    public function __construct($article, $subject)
    {
        $this->article = $article;
        $this->subject = $subject;
    }

    public function via($notifiable)
    {
        return ['mail', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Создана статья "' . $this->article->title . '"')
            ->line('Вы создали статью "' . $this->article->title . '"')
            ->action('Посмотреть статью', url('/article/' . $this->article->slug ));
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'article' => $this->article,
            'subject' => $this->subject
        ]);
    }
}
