<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArticleCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        \Mail::to($event->article->owner->email)->queue(
            new \App\Mail\ArticleCreated($event->article)
        );
    }
}
