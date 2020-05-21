<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendPostEmail;
use App\Post;
use App\Jobs\BaseJob;
class PostController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:2',
            'body'=> 'required|min:2',
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
            dispatch(new SendPostEmail($post));
    
        return redirect()->back()->with('status', 'Your post has been submitted successfully');
    }
  
  public function queue() {
dd(BaseJob::dispatch(['name' => 'Max Sky', 'gender' => 1])
	->onQueue('MyQueue'));;
}
}