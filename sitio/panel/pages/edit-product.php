<?php
use Collector\Models\Product;
use Collector\Session\Session;

if (!isset($_GET['id'])) { 
    header("Location: ./../index.php?s=products");
    exit;
}
$errors = (new Session)->flash('errors', []);
$formData = (new Session)->flash('data_form', []);
$product = (new Product())->getById($_GET['id']);
$tags = (new \Collector\Models\Tag())->getAll();
$product->loadTags();

?>
<section class="container">
    <h2 class="mb-3">Update the information of the following fields</h2>
    <p class="mb-3">Please complete this form with your item's new data. Then click on the "Update" button to finish this process.</p>
    <form action="actions/edit-product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?=$product->getProductId()?>">
        <div class="m-3">
            <label for="name">What do you wanna sell?</label>
            <input type="text" id="name" name="name" placeholder="Write here the name of what do you want to sell, for example: 'Darth Vader Helmet' " class="form-control" value="<?= specialChatConv($formData['name'] ?? $product->getName());?>"
                   aria-describedby="<?= isset($errors['name']) ? 'name-error' : ''?> name-help"
            >
            <div class="form-help" id="name-help">The name of the product must have at least 10 characters.</div>
            <?php
            if(isset($errors['name'])):
            ?>
                <div class="text-danger fw-bold" id="name-error"><span class="visually-hidden">Error: </span>X <?= $errors['name'];?></div>
            <?php
            endif;
            ?>
        </div>
        <div class="m-3">
            <label for="description">Please, describe what is what you are selling </label>
            <textarea id="description" name="description" class="form-control" placeholder="A Collector's edition Darth Vader Mask used in the filming of Revenge of the Sith."
                <?php if(isset($errors['description'])): ?> aria-describedby="description-error" <?php endif; ?>
            ><?= specialChatConv($formData['description'] ?? $product->getDescription());?></textarea>
            <?php
            if(isset($errors['description'])):
            ?>
                <div class="text-danger fw-bold" id="description-error"><span class="visually-hidden">Error: </span>X <?= $errors['description'];?></div>
            <?php
            endif;
            ?>
        </div>
        <div class="m-3">
            <label for="price">Enter here the price of the item you are selling:</label>
            <input id="price" name="price" class="form-control" placeholder="25.34" value="<?= specialChatConv($formData['price'] ?? $product->getPrice());?>"
                <?php if(isset($errors['price'])): ?> aria-describedby="price-error" <?php endif; ?>
            ><?= $formData['price'] ?? null; ?>
            <?php
            if(isset($errors['price'])):
            ?>
                <div class="text-danger fw-bold" id="price-error"><span class="visually-hidden">Error: </span>X <?= $errors['price'];?></div>
            <?php
            endif;
            ?>
        </div>
        <div class="m-3">
            <label for="image">Upload here an image of the product you are selling<span class="fst-italic">(Optional)</span></label>
            <input type="file" id="img" name="img" class="form-control">
        </div>        
        <?php
        if(!empty($product->getImg()) && file_exists(__DIR__ . '/../../imgs/' . $product->getImg())):
        ?>
        <div class="m-3">
            <p>Actual Image</p>
            <img src="<?= './../imgs/' . $product->getImg();?>" alt="">
        </div>
        <?php
        endif;
        ?>
        <div class="m-3">
            <label for="img_lore">Describe that image here<span class="fst-italic">(Optional)</span></label>
            <input type="text" id="img_lore" name="img_lore" class="form-control" value="<?= specialChatConv($formData['img_lore'] ?? $product->getImgLore());?>"
            >
        </div>
        <div class="m-3">
            <fieldset>
                <legend>Tags</legend>
                <div>                
                <?php
                foreach($tags as $tag):
                ?>
                    <label class="mx-1">
                        <input
                            type="checkbox"
                            name="tag_id[]"
                            value="<?= $tag->getTagId();?>"
                            <?= in_array($tag->getTagId(), $formData['tag_id'] ?? $product->getTagsFk()) ? 'checked' : ''; ?>                        >
                        <?= $tag->getName();?>
                    </label>
                <?php
                endforeach;
                ?>
                </div>
            </fieldset>
        </div>

        <button type="submit" class="btn text-light align-self-center main-dark-bg m-3">Update</button>
    </form>
</section>
