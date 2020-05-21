<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    //

    public function isValid($value)
    {
        try {
            $a = null;
            dump($a->toArray());
        } catch (FatalThrowableError $e) {
            dump($e->getMessage());
        }
    }

    public function example()
    {
//            abort('403错误','404');
            throw new \App\Exceptions\ExampleException('我是一个异常啦');

    }
}
