<?php
require "db.php";
?>

<?php if ( isset($_SESSION['logged_user']) ) :?>
    <?php echo $_SESSION['logged_user']->login; ?>
    <hr>
    <a href="logout.php">Выйти</a>
<?php else : ?>
<a href="login.php">Авторизоваться</a><br>
<a href="signup.php">Зарегистрироваться</a>
<?php endif; ?>