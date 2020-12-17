<?php

namespace App\Listeners;

use App\Mail\PostCreatedMail;
use Illuminate\Support\Facades\Mail;

class PostEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handlePostComment($event) {
        $post = $event->post->toArray();
        return Mail::send(new PostCreatedMail($event->post));
        // Mail::queue(new PostCreatedMail($event->post));

        // Mail::send('welcome', $post, function ($message) use ($post) {
        //     $message
        //         ->to('alaaragab34@gmail.com')
        //         ->subject('Post created');
        // });
    }

    /**
     * Handle user logout events.
     */
    public function handleCreateComment($event) {
        $comment = $event->comment->toArray();

        Mail::send('welcome2', $comment, function ($message) use ($comment) {
            $message
                ->to('alaaragab34@gmail.com')
                ->subject('Comment created');
        });
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\PostCreated',
            'App\Listeners\PostEventSubscriber@handlePostComment'
        );

        $events->listen(
            'App\Events\CommentCreated',
            'App\Listeners\PostEventSubscriber@handleCreateComment'
        );
    }
}
