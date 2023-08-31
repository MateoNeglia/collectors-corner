<?php
require_once __DIR__ . '/../../bootstrap/init.php';
use Collector\Auth\Authentication;

$authentication = new Authentication;

$authentication->logOut();

$_SESSION['error_msg'] = "You logged out from your account.";  
header("Location: ../index.php?s=log-in");