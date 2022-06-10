<?php
require "db.php";
$data = $_POST;
if( isset($data['do_send'])) {
    $user = R::findOne('users', 'email = ?', array($data['email']));
    if($user){
        $key = md5($user->login.rand(1000, 9999));
        $user->change_key = $key;
        R::store($user);

        $site_url = 'regred/';
        $url = $site_url.'newpass.php?key='.$key;
        $message = $user->login.", был выполнен запрос на изменения вашего пароля. \n\n\ для изменения передите по ссылке: ".$url."\n если это были не вы, то советуем изменить пароль!";

        mail($data['email'], 'подтвердите действие', $message);
        header('location: /');
    }else{
        echo "Данный email не зарегистрирован";
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
    <h1>Востановление пароля</h1>
    <form action="forgot.php" method="post">
        <p>
            <input type="email" class="form-control" name="email" id ="email" placeholder="Введите почту"
                   value="<?php echo @$data['email']; ?>"><br></p><p>
        <p><button name="do_send" class="btn btn-success" type="submit">отправить</button></p>
    </form>
</div>

</body>
</html>