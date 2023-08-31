<?php
use Collector\Models\Product;
$product = (new Product())->getById($_GET['id']);
?>

<section class="container">
    <h2 class="mb-1">You are deleting this product</h2>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>Product Name</b></li>
        <li class="list-group-item"><?= specialChatConv($product->getName());?></li>
        <li class="list-group-item"><b>Product Price</b></li>
        <li class="list-group-item"><?= specialChatConv($product->getPrice());?></li>
        <li class="list-group-item"><b>Product description</b></li>
        <li class="list-group-item"><?= specialChatConv($product->getDescription());?></li>
        <li class="list-group-item"><b>Product Date of Upload</b></li>
        <li class="list-group-item"><?= specialChatConv($product->getPublishDate());?></li>
    </ul>
    <form action="actions/delete-item.php?id=<?=$product->getProductId()?>" method="post">
        <button type="submit" class="btn text-light align-self-center bg-danger m-1">Confirm Deletion</button>
    </form>
</section>
