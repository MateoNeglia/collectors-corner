<?php
$products = (new Collector\Models\Product())->getAll();
?>
<section class="container">
    <div>
        <h2 class="mt-3 main-dark-color text-center text-uppercase">Our Products</h2>
        <p class="mt-3 main-dark-color text-center ">Check this out.</p>
    </div>
    <div class="d-flex flex-wrap justify-content-center">
<?php
foreach($products as $product):
?>
    
        <article class="product-item m-2">
            <div class="card" >
                <div>
                    <a href="index.php?s=product-details&id=<?= specialChatConv($product->getProductId());?>" class="product-link"> 
                        <picture class="">               
                            <source srcset="<?= 'imgs/' . specialChatConv($product->getImg());?>" media="all and (min-width: 46.875em)">
                            <img class="card-img-top"src="imgs/<?= specialChatConv($product->getImg())?>" alt="<?= specialChatConv($product->getImgLore())?>">
                        </picture>                    
                    </a>
                </div>
                <div class="card-body">
                <a href="index.php?s=product-details&id=<?= specialChatConv($product->getProductId());?>" class="product-link">
                    <h3><?= specialChatConv($product->getName())?></h3></a>
                <p class="card-text main-color-dark">
                    <span class="price-curr">$ </span>
                    <span class="price"><?= specialChatConv($product->getPrice());?></span>
                </p>
            </div>
            </div>

        </article>
    
<?php
endforeach;
?>
    </div>
</section>
