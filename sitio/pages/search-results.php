<?php
use Collector\Models\Product;
$searchQuery = $_POST['query'];
$searchResults = (new Collector\Models\Product())->searchProduct($searchQuery);
?>
<section class="container">
    <div>
        <h2 class="mt-3 main-dark-color text-center text-uppercase">You Searched:</h2>        
    </div>
    <?php if (isset($searchResults) && count($searchResults) > 0): ?>
        <div class="d-flex flex-wrap justify-content-center">
<?php
foreach($searchResults as $product):
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
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</section>