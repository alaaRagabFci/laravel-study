<?php

namespace App\Providers;

use App\Models\Post;
use App\Repositories\Post\IPostRepository;
use App\Repositories\Post\PostRepository;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
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
        $this->app->bind(IPostRepository::class, function ($app) {
            return new PostRepository(Post::class);
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
