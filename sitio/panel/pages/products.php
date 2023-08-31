<?php
$products = (new Collector\Models\Product())->getAll();
?>
<section class="container">
    <h2 class="mb-1">Product Administration Page</h2>

    <p class="mb-1">
        <a href="index.php?s=new-product" class="btn text-light align-self-center main-dark-bg w-25 m-2">Add a new product</a>
    </p>

    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Publish Date</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Description</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
    <?php
    foreach($products as $product):
    ?>
        <tr>
            <td><?= $product->getProductId();?></td>
            <td><?= $product->getPublishDate();?></td>
            <td><?= specialChatConv($product->getName());?></td>
            <td><?= specialChatConv($product->getDescription());?></td>
            <td><?= specialChatConv($product->getPrice());?></td>
            <td><img src="<?= "../imgs/" . specialChatConv($product->getImg());?>" alt="<?= specialChatConv($product->getImgLore());?>"></td>
            <td>
                <a href="index.php?s=edit-product&id=<?=$product->getProductId()?>" class="btn text-light align-self-center main-dark-bg m-1">Edit</a>
                <a href="index.php?s=delete-product&id=<?=$product->getProductId()?>" class="btn text-light align-self-center bg-danger m-1">Delete</a>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
        </tbody>
    </table>
</section>
