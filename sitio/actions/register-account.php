<?php
require_once __DIR__ . '/../bootstrap/init.php';
use Collector\Auth\Authentication;

$email      = $_POST['email'];
$password   = $_POST['password'];
$nick_name  = $_POST['nick_name'];
$name       = $_POST['name'];
$last_name  = $_POST['last_name'];
$user_role  = $_POST['user_role'];

$hashPass = password_hash($password, PASSWORD_DEFAULT);

$authentication = new Authentication;

try {
    $authentication->registerAccount([
        'email'      => $email,
        'password'   => $hashPass,
        'nick_name'  => $nick_name,
        'name'       => $name,
        'last_name'  => $last_name,
        'user_role'  => $user_role
    
    ]);

    $_SESSION['success_msg'] = "You Registered your account!";
    header("Location: ../index.php?s=home");
    exit;
} catch (\Throwable $th) {
    $_SESSION['error_msg'] = "Your credentials do not match with our registry.";    
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=register");
    exit;
}
