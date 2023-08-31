<?php
require_once __DIR__ . '/../bootstrap/init.php';
require_once __DIR__ . '/../libraries/helpers.php';

use Collector\Auth\Authentication;
use Collector\Models\Purchase;

$authentication = new Authentication;

if(!$authentication->isAuthenticated()) {
    $_SESSION['error_msg'] = "You need to log in first.";
    header("Location: ../index.php?s=log-in");
    exit;   
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cartData'])) {
    $cartData = json_decode($_POST['cartData'], true);
    $totalCost = 0;

    // Calculate the total cost of the items in the cart and build the insert query
    $insertQuery = "INSERT INTO purchases (product_name, product_quantity, product_price, user_fk) VALUES ";
    $values = [];

    try {

        foreach ($cartData as $productId => $productDetails) {
            $productName = $productDetails['productName'];
            $quantity = intval($productDetails['quantity']);
            $productPrice = floatval($productDetails['productPrice']);
            (new Purchase())->createNew([
                'user_fk'                   => $authentication->getId(),             
                'product_name'              => $productName,
                'product_quantity'          => $quantity,
                'product_price'             => $productPrice,
            ]);
        }
    
        $_SESSION['success_msg'] = "'<b>" . $productName . "</b>' was successfully published.";
    

        header("Location: ./../index.php");
        exit;

    } catch(\Exception $e) {
        $_SESSION['error_msg'] = "An unexpected error ocurred. The product was not published correctly, please try again latter.";        
        header("Location: ./../index.php");  
        exit;
    }

    // Combine the values and execute the insert query
    if (!empty($values)) {
        $insertQuery .= implode(', ', $values);
        mysqli_query($connection, $insertQuery);
    }


} else {    
    $_SESSION['error_msg'] = "An unexpected error ocurred. The product was not published correctly, please try again latter.";        
    header("Location: ./../index.php");
    exit();
}
?>
