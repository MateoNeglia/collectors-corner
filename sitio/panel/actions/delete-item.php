<?php
require_once __DIR__ . '/../../bootstrap/init.php';

use Collector\Auth\Authentication;
use Collector\Models\Product;
$authentication = new Authentication;

if(!$authentication->isAuthenticated()) {
    $_SESSION['error_msg'] = "You need to log in first.";
    header("Location: ../index.php?s=log-in");
    exit;   
}

$id = $_GET['id'];
$product = (new Product())->getById($id); 

if(!$product) {
    $_SESSION['error_msg'] = "The item that you are trying to delete doesn't exist.";
    header("Location: ../index.php?s=products");
    exit;
}

try {
    $product->deleteProduct();
    if(isset($imageLore) && !empty($product->getImg())) {
        if(file_exists(PATH_IMAGES . '/large-' . $product->getImg())) {            
            unlink(PATH_IMAGES . '/large-' . $product->getImg());
        }
        if(file_exists(PATH_IMAGES . '/' . $product->getImg())) {            
            unlink(PATH_IMAGES . '/' . $product->getImg());
        }
    }
    
    $_SESSION['success_msg'] = "'<b>" . $product->getName() . "</b>' was successfully deleted.";   
    header("Location: ./../index.php?s=products");
    exit;
} catch (\Exception $e) {
    $_SESSION['error_msg'] = "An unexpected error ocurred. The product was not deleted correctly, please try again latter.";
    header("Location: ./../index.php?s=products");
    exit;
}