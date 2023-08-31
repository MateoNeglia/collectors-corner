<?php
require_once __DIR__ . '/../../bootstrap/init.php';
use Collector\Auth\Authentication;

$email      = $_POST['email'];
$password   = $_POST['password'];

$authentication = new Authentication;

if($authentication->logIn($email, $password)) {
    $_SESSION['success_msg'] = "You Logged in!";
    header("Location: ../../index.php");
    exit;
} else {
    $_SESSION['error_msg'] = "Your credentials do not match with our registry.";    
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=log-in");
    exit;
}
