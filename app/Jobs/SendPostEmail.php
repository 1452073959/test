<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Post;

class SendPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        //
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $data= array(
            'title'=> $this->post->title,
            'body'=> $this->post->body,
        );
        // emails.post 对应的视图文件模板
//        Mail::send('emails.post', $data, function($message){
//            $message->from('************', 'Laravel Queues');
//            $message->to('************')->subject('There is a new post');
//        });

        $view = 'emails.post';
        $from = '1452073959@qq.com';
        $name = '心下雪';
        $to = '1452073959@qq.com';
        $subject = "买菜超级加倍";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
}