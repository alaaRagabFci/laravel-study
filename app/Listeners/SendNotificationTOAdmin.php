<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationTOAdmin implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $post = $event->post->toArray();

        Mail::send('welcome', $post, function ($message) use ($post) {
            $message
                ->to('alaaragab34@gmail.com')
                ->subject('Post created');
        });
    }

    /**
     * Determine whether the listener should be queued.
     *
     * @param  \App\Events\PostCreated  $event
     * @return bool
     */
    public function shouldQueue(PostCreated $event)
    {
        return $event->order->subtotal >= 5000;
    }
}
