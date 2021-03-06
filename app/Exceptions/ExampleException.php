<?php

namespace App\Exceptions;

use Exception;

class ExampleException extends Exception
{
    /**
     * 报告这个异常。
     *
     * @return void
     */
    public function report()
    {
    }

    /**
     * 将异常渲染至 HTTP 响应值中。
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
//        return response($this->getMessage() ?: '发生异常啦');
        return response()->view(
            'errors.custom',
            array(
                'exception' => $this
            )
        );
    }
}
