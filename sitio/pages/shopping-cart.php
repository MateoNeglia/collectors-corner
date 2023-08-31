<?php
$cartData = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

if (!is_array($cartData)) {
    $cartData = [];
}
?>
<section class="container-lg p-0">
    <h2>Your Shopping Cart:</h2>
    <div>
        <table class="table shopping-cart-table table-striped table-dark" id="shopping-cart-table">
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th> 
            </tr>
            <?php
            $totalPrice = 0;
            foreach ($cartData as $productId => $productDetails) {
                $productName = $productDetails['productName'];
                $quantity = intval($productDetails['quantity']);
                $productPrice = floatval($productDetails['productPrice']);
                $total = $productPrice * $quantity;
                $totalPrice += $total;

                echo "<tr>";
                echo "<td>$productId</td>";
                echo "<td>$productName</td>";
                echo "<td>$quantity</td>";
                echo "<td>$productPrice</td>";
                echo "<td>$total</td>";
                echo "<td><button class='btn btn-danger btn-sm' onclick='removeFromCart($productId)'>Remove</button></td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "<td colspan='4'>Total Price:</td>";
            echo "<td>$totalPrice</td>";
            echo "<td></td>"; 
            echo "</tr>";
            ?>
        </table>
        <form action="index.php?s=confirm" method="post">
            <input type="hidden" name="cartData" value="<?php echo htmlentities(json_encode($cartData)); ?>">
            <button type="submit" class="btn text-light align-self-center main-dark-bg">Confirm Purchase</button>
        </form>
    </div>
</section>
