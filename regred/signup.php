<?php
    require "db.php";

    $data = $_POST;
    if( isset($data['do_signup'])) {
        $errors = array();
        if (trim($data['login']) == '')
        {
            $errors[] ='Введите логин';
        } 
        if (trim($data['email']) == '')
        {
            $errors[] ='Введите почту';
        }
        if ($data['password'] == '')
        {
            $errors[] ='Введите пароль';
        }
        if ($data['password'] != $data['password2'])
        {
            $errors[] ='Повторный пароль введен не верно';
        }
        if(R::count('users', "login = ?", array($data['login'])) > 0)
        {
            $errors[] ='Пользователь с таким именем уже существует';
        };
        if(R::count('users', "email = ?", array($data['email'])) > 0)
        {
            $errors[] ='Пользователь с такой почтой уже существует';
        };
        if (empty($errors))
        {
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
            R::store($user);
            echo '<div style="color: green">вы успешно зарегистрировались</div><hr>';
        }else
        {
            echo '<div style="color: red">'.array_shift($errors).'</div><hr>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма регистрации</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-4">
    <h1>Форма регистрации</h1>
    <form action="signup.php" method="post">
        <p>
        <input type="text" class="form-control" name="login" id ="login" placeholder="Введите логин"
               value="<?php echo @$data['login']; ?>"><br></p><p>
        <input type="email" class="form-control" name="email" id ="email" placeholder="Введите почту"
               value="<?php echo @$data['email']; ?>"><br></p><p>
        <input type="password" class="form-control" name="password" id ="password" placeholder="Введите пароль"
               value="<?php echo @$data['password']; ?>"><br></p><p>
        <input type="password" class="form-control" name="password2" id ="password2" placeholder="Введите пароль еще раз"
               value="<?php echo @$data['password2']; ?>"><br></p>
        <p><button name="do_signup" class="btn btn-success" type="submit">зарегистрировать</button></p>
    </form>
</div>

</body>
</html>