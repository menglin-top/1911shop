<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<form action="{{url('/api/login_do')}}" method="post">
    用户名:<input type="text" name="name"><br>
    密码:<input type="password" name="pwd"><br>
    <button type="submit">登陆</button>
</form>
</body>
</html>