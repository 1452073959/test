<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class RequestController extends Controller
{
    public function form(Request $request)
    {
        echo  $method = $request->method().'<hr/>'; // GET/POST
        dump($request->all());
//        dump($request->query());
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $photo = $request->file('file');
            //后缀
            $extension = $photo->extension();
            //保存,随机名
//            $store_result = $photo->store('file');
            //指定名称
            $store_result = $photo->storeAs('file', 'test.jpg');
            $output = [
                'extension' => $extension,
                'store_result' => $store_result
            ];
            print_r($output);exit();
        }
        return('未获取到上传文件或上传过程出错');
      dump($name = $request->except('url', 'password'))  ;
        $this->validate($request, [
            'title' => 'bail|required|string|between:2,32',
            'url' => 'sometimes|url|max:200',
        ], [
            'title.required' => '标题字段不能为空',
            'title.string' => '标题字段仅支持字符串',
            'title.between' => '标题长度必须介于2-32之间',
            'url.url' => 'URL格式不正确，请输入有效的URL',
            'url.max' => 'URL长度不能超过200',
        ]);
        return response('表单验证通过');
//        定向并使用闪存的 Session 数据
//        @if (session('status'))
//    <div class="alert alert-success">
//        {{ session('status') }}
//    </div>
//        @if (count($errors) > 0)
//    <div class="alert alert-danger">
//        <ul>
//    @foreach ($errors->all() as $error)
//                <li>{{ $error }}</li>
//    @endforeach
//        </ul>
//    </div>
//    @endif

//    @endif
//        return redirect('dashboard')->with('status', 'Profile updated!');
    }

    public function form1()
    {
        return view('request.form');
    }

    public function form2()
    {
        return view('request.user');
    }

    public function form3(Request $request)
    {
                $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);
        dump($user);
    }
    public function req(Request $request)
    {
          //请求路径
        var_dump($request->path());
          //请求完整URL
        var_dump($request->url());
        var_dump($request->fullUrl());
        //请求的方法
        echo  $method = $request->method().'<hr/>'; // GET/POST
        //获取所所有请求信息
        dump($input = $request->all()) ;
        //请求设置默认值
        dump($name = $request->input('name', '学院君.nin')) ;
        dump($name = $request->input('products.0.name'));
        //只获取值
        dump($name = $request->query('name', '学院君'));
        //不传参数类似all();
        dump($query = $request->query());
        //
        $name = $request->name;
        $input = $request->only(['username', 'password']);//只获取
        $input = $request->except('username', 'password');
        if ($request->has('name')) {
            //判断请求是否存在
        }
        if ($request->filled('name')) {
            //如果你想要判断参数存在且参数值不为空，可以使用 filled 方法：
        }
        //获取旧输入
//        return redirect('form')->withInput();
        //$username = $request->old('username');
//        session()->flash('warning', '123123123。');
        //<input type="text" name="username" value="{{ old('username') }}">
    }

    public function file(Request $request)
    {
        if ($request->hasFile('photo')) {
//            判断请求中是否有文件
        }
        if ($request->file('photo')->isValid()){
            //判断上传过程中是否出错
        }
        if (View::exists('emails.customer')) {
            //判断视图是否存在
        }
        //创建文件上传对象
        if ($request->hasFile('picture') == true) {
            $pic             = $request->file('picture');
            $temp_name       = time() + rand(10000, 99999);
            $hz              = $pic->getClientOriginalExtension();
            $filename        = $temp_name . '.' . $hz;
            $data['picture'] = $pic->move('./Admins/Uploads/', $filename); //执行上传

        }
        //


        //响应重定向
//        return redirect('home/dashboard');
//        download 方法用于生成强制用户浏览器下载给定路径文件的响应。download 方法接受文件名作为第二个参数，该参数决定用户下载文件的显示名称，你还可以将 HTTP 头信息作为第三个参数传递到该方法：
//        return response()->download($pathToFile, $name, $headers);
//        return response()->download(public_path('index.php'), '测试下载.php');
//        return response()->json([
//            'name' => 'Abigail',
//            'state' => 'CA'
//        ]);
        //响应文件
//        return response()->file('214449_1028547495_3_640_371.jpg');
        return response()->file(public_path('/214449_1028547495_3_640_371.jpg'));
    }
}
