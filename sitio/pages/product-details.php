<?php
$product = (new Collector\Models\Product())->getById($_GET['id']);
$product->loadTags();
?>
<section class="p-3 mb-10 product-details">
    <article class="main-product">
        <div class="over-card d-flex flex-wrap">
            <div class="col-4 p-2">
                <picture>
                    <source srcset="<?= 'imgs/large-' . specialChatConv($product->getImg());?>" media="all and (min-width: 46.875em)">
                    <img class="card-img-top" src="imgs/large-<?= specialChatConv($product->getImg())?>" alt="<?= specialChatConv($product->getImgLore())?>">
                </picture>
            </div>
            <div class="card-body col-4 p-2">
                <h2><?= specialChatConv($product->getName());?></h2>
                <p class="card-text">
                    <span class="price-curr">$</span>
                    <span class="price"><?= specialChatConv($product->getPrice());?></span>
                </p>
                <p class="mb-1">
                    <span>Product Tags: </span>
                    <?php foreach ($product->getTags() as $tag): ?>
                        <span class="badge secondary-dark-bg p1"><?= $tag->getName();?></span>
                    <?php endforeach; ?>
                </p>
                <a class="btn main-dark-bg text-light" href="index.php?s=shopping-cart" onclick="addToCart(<?= $product->getProductId();?>, '<?= specialChatConv($product->getName());?>', <?= specialChatConv($product->getPrice());?>)">Buy Now</a>
                <button name="add_to_cart" class="btn main-light-bg text-light" onclick="addToCart(<?= $product->getProductId();?>, '<?= specialChatConv($product->getName());?>', <?= specialChatConv($product->getPrice());?>)">ADD TO CART</button>
            </div>
        </div>
        <div>
            <?= specialChatConv($product->getDescription());?>
        </div>
    </article>
</section>
