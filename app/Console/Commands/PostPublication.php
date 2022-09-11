<?php

namespace App\Console\Commands;

use App\Models\Backend\Post;
use Illuminate\Console\Command;

class PostPublication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:publication';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publication posts where status equal true';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::whereStatus(false)->get();

        foreach ($posts as $post){

                $post->update([
                    'status' => true
                ]);
            }


    }
}
