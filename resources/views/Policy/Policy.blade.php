<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@can('update', $post)
    <!-- 当前用户可以更新博客 -->
@elsecan('create', $post)
    <!-- 当前用户可以新建博客 -->
@endcan

@cannot('update', $post)
    <!-- 当前用户不可以更新博客 -->
@elsecannot('create', $post)
    <!-- 当前用户不可以新建博客 -->
@endcannot
</body>
</html>