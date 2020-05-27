<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendPostEmail;
use App\Post;
use App\Jobs\BaseJob;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function paginate()
    {
        $arr=[1,2,8,6,6,3];
        return  $this->maopao($arr);
    }

    function maopao($arr)
    {
        $len = count($arr);
        $n = count($arr) - 1;
        for ($i = 0; $i < $len; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    $tmp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $tmp;
                }
            }
        }
        return $arr;
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