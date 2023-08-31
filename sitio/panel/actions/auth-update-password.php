<?php
require_once __DIR__ . '/../../bootstrap/init.php';
use \Collector\Auth\RetrievePassword;

$id                 = $_POST['id'];
$token              = $_POST['token'];
$password           = $_POST['password'];
$password_confirm   = $_POST['password_confirm'];

$resetPassword = new \Collector\Auth\RetrievePassword();
$resetPassword->setUserById($id);
$resetPassword->setToken($token);

if (!$resetPassword->isValid()) {
    $_SESSION['error_msg'] = "This token does not match this user.";
    header("Location: ../index.php?s=update-password&token=" . $token . "&user=" . $id);
    exit;
}

if ($resetPassword->checkExpiration()) {
    $_SESSION['error_msg'] = "This link has expired. If needed, you can request a new one.";
    header("Location: ../index.php?s=retrieve-password");
    exit;
}

try {
    $resetPassword->updatePassword(password_hash($password, PASSWORD_DEFAULT));

    $_SESSION['success_msg'] = "The password has been successfully updated.";
    header("Location: ../index.php?s=log-in");
    exit;
} catch (\Exception $e) {
    $_SESSION['error_msg'] = "An unexpected error occurred, the password could not be updated.";
    header("Location: ../index.php?s=update-password&token=" . $token . "&user=" . $id);
    exit;
}
