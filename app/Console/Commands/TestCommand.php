<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'study:first-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Post::create([
            'title' => 'command',
            'user_id' => 2,
            'content' => 'asd',
        ]);
    }
}
