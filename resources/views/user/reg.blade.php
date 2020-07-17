<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/api/reg_do')}}" method="post">
        用户名:<input type="text" name="name"><br><br>
        邮箱:<input type="text" name="email"><br><br>
        密码:<input type="password" name="pwd"><br><br>
        确认密码:<input type="password" name="pwd1"><br><br>
        <button type="submit">注册</button>
    </form>
</body>
</html>