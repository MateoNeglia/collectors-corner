<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cartData'])) {
    $cartData = json_decode($_POST['cartData'], true);
    $totalCost = 0;
    
    foreach ($cartData as $productId => $productDetails) {
        $quantity = intval($productDetails['quantity']);
        $productPrice = floatval($productDetails['productPrice']);
        $totalCost += $productPrice * $quantity;
    }
} else {
    header("Location: shopping_cart.php");
    exit();
}
?>
<section>
<h2>Checkout - You are about to buy the following items:</h2>
    <ul>
        <?php foreach ($cartData as $productId => $productDetails) : ?>
            <?php
            $productName = $productDetails['productName'];
            $quantity = intval($productDetails['quantity']);
            $productPrice = floatval($productDetails['productPrice']);
            $total = $productPrice * $quantity;
            ?>
            <li><?php echo "$productName - Quantity: $quantity - Total: $total"; ?></li>
        <?php endforeach; ?>
    </ul>
    <hr>
    <p>Total Cost: <?php echo $totalCost; ?></p>

    <form action="shopping_cart.php" method="get">
        <button type="submit" class="btn text-light align-self-center main-dark-bg my-2">Back to Shopping Cart</button>
    </form>
    <form action="actions/purchase-products.php" method="post">
        <input type="hidden" name="cartData" value="<?php echo htmlentities(json_encode($cartData)); ?>">
        <button type="submit" class="btn text-light align-self-center main-dark-bg">Confirm Purchase</button>
    </form>

</section>
