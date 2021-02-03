<?php include "db.php"; ?>
<?php include "../admin/functions.php" ?>
<?php session_start(); ?>

<?php
if(isset($_POST['login'])){

    login_user($_POST['user_name'],$_POST['user_password']);




}
?>

