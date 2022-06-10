<?php
    require "db.php";

    $data = $_POST;
    if( isset($data['do_login']))
    {
        $errors = array();
        $user = R::findone('users', 'login = ?', array($data['login']));
        if( $user) {
            if (password_verify($data['password'], $user->password))
            {
                //tut login up
                $_SESSION['logged_user'] = $user;
                echo '<div style="color: green">вы успешно авторизовались</div><hr>';
            }else{
                $errors[] = 'неверно введен пароль';
            }
        } else
        {
            $errors[] = 'Пользователь с таким именем не найден';
        }
}
if ( ! empty($errors))
{
    echo '<div style="color: red">'.array_shift($errors).'</div><hr>';
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма авторизации</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-4">
    <h1>Авторизация</h1>
    <form action="login.php" method="post">
        <p>
            <input type="text" class="form-control" name="login" id ="login" placeholder="Введите логин"
                   value="<?php echo @$data['login']; ?>"><br></p>
            <input type="password" class="form-control" name="password" id ="password" placeholder="Введите пароль"
                   value="<?php echo @$data['password']; ?>"><br></p>
        <p><button name="do_login" class="btn btn-success" type="submit">Войти</button></p>
        <a href="forgot.php">Забыли пароль?</a>
    </form>
</div>

</body>
</html>
