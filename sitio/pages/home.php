<?php
$products = (new Collector\Models\Product())->getByAmount(2);
?>
<div class="container-lg p-0">
    <div class="main-baner">
      <picture>                    
          <source media="(min-width:768px)" srcset="imgs/baner/digimon-kizuna-box-set-desktop.jpg">
          <source media="(min-width:576px)" srcset="imgs/baner/digimon-kizuna-box-set-tablet.jpg">
          <img src="imgs/baner/digimon-kizuna-box-set-mobile.jpg" class="d-block w-100 baner-image" alt="The entire box ser of Digimon Adventure Kizuna, all blu ray, art and pictures."/>                
      </picture>                
    </div>
</div>
<section class="container">
    <div class="p-3 mt-3 main-dark-color text-center">
        <h2>Check out this CRAZY deals</h2>        
        <p>At Collector's Corner you can buy any box set, blu ray, dvd, and rare collection bundles of your favourite movies, shows or anything! One click to happiness at your door.</p>
    </div>
    <div class="d-flex flex-wrap justify-content-center">
<?php
foreach($products as $product):
?>
<div class="card p-3 m-3">
  <div class="main-page-product">  
    <a href="index.php?s=product-details&id=<?= specialChatConv($product->getProductId());?>">
      <picture class="">               
            <source srcset="<?= 'imgs/large-' . specialChatConv($product->getImg());?>" media="all and (min-width: 46.875em)">
            <img class="card-img-top"src="imgs/large-<?= specialChatConv($product->getImg())?>" alt="<?= specialChatConv($product->getImgLore())?>">
      </picture>                    
    </a>      
  </div>
</div>
<?php
endforeach;
?>
  </div>
</section>
