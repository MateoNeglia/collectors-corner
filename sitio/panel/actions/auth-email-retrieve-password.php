<?php
require_once __DIR__ . '/../../bootstrap/init.php';
use Collector\Models\User;

$email = $_POST['email'];

$retrieve = new \Collector\Auth\RetrievePassword();

$user = (new User())->getByEmail($email);

if(!$user) {
    $_SESSION['error_msg'] = "There is no user for this email.";
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=retrieve-password");
    exit;
}

try {
    $retrieve->sendRecoveryEmail($user);

    $_SESSION['success_msg'] = "An email with instructions was sent to <b>" . $user->getEmail() . "</b>. Please check your box, including 'Spam' and 'Spam' just in case.";
    header("Location: ../index.php?log-in");
} catch(\Exception $e) {
    $_SESSION['error_msg'] = "An unexpected error ocurred, the mail couldn't be sent. " . $e->getMessage();
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=retrieve-password");
}
