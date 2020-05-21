<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Shop') - Laravel</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    <div class="container">
        @yield('content')
    </div>
    @include('layouts._footer')
</div>
<!-- JS 脚本 -->
@section('sidebar')
    @parent
{{--    //可以包含已有的内容--调用的时候}}{
{{--@section('sidebar')--}}
{{--    这里是侧边栏--}}
{{--@show--}}{{-- @yield('content')//替换--}}
{{--    <p>Laravel学院致力于提供优质Laravel中文学习资源</p>--}}

{{--    有时候你想要输出一个变量，但是不确定该变量是否被设置，我们可以通过如下 PHP 代码：--}}
{{--    {{ isset($name) ? $name : 'Default' }}--}}{{--{{ $name or 'Default' }}--}}
<script src="{{ mix('js/app.js') }}"></script>
@endsection
</body>
</html>