<?php

// Function to add a product to the cart
function addToCart($productName, $productPrice) {
    // Check if the cart exists in the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    $existingItemKey = array_search($productName, array_column($_SESSION['cart'], 'name'));
    if ($existingItemKey !== false) {
        $_SESSION['cart'][$existingItemKey]['quantity']++;
    } else {
        // Add the product to the cart
        $_SESSION['cart'][] = array(
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1
        );
    }
    header("Location: ./../index.php?s=shopping-cart");
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    addToCart($_POST['name'], $_POST['price']);
}
?>