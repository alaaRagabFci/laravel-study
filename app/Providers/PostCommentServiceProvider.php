<?php

namespace App\Providers;

use App\Models\PostComment;
use App\Repositories\PostComment\IPostCommentRepository;
use App\Repositories\PostComment\PostCommentRepository;
use Illuminate\Support\ServiceProvider;

class PostCommentServiceProvider extends ServiceProvider
{
     /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    // public $bindings = [
    //     ServerProvider::class => DigitalOceanServerProvider::class,
    // ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IPostCommentRepository::class, function ($app) {
            return new PostCommentRepository(PostComment::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
