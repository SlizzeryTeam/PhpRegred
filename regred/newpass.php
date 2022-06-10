<?php
require "db.php";
error_reporting(0);
ini_set('display_errors', 0);
$data = $_GET;
if($_SESSION['user'] != NULL) header('location: /');
if($data['key'] == NULL) header('location: /');

$user = R::findOne('users', 'change_key = ?', array($data['key']));
if(!$user) header('location: /');

if( isset($data['do_change'])) {
        $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
        $user->change_key = NULL;
        R::store($user);
        header('location: /login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Изменение пароля</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-4">
    <h1>Изменение пароля</h1>
    <form action="newpass.php" method="get" class="sign_form">
        <input type="hidden" name="key" value="<?php echo $data['key'];?>">
        <p>
        <input type="password" name="password" placeholder="Пароль">
        <p><button name="do_change" class="btn btn-success" type="submit">Изменить</button></p>
    </form>
</div>

</body>
</html>