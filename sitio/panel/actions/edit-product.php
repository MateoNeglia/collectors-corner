<?php
require_once __DIR__ . '/../../bootstrap/init.php';
require_once __DIR__ . '/../../libraries/helpers.php';

use Collector\Models\Product;
use Collector\Auth\Authentication;
use Collector\Validation\ProductValidation;
use Collector\Uploaders\ImageUploader;

$imageUploader = new ImageUploader;
$authentication = new Authentication;

if(!$authentication->isAuthenticated()) {
    $_SESSION['error_msg'] = "You need to log in first.";
    header("Location: ../index.php?s=log-in");
    exit;   
}

$id =                   $_POST['id'];
$productName =          $_POST['name'];
$productDescription =   $_POST['description'];
$price =                $_POST['price'];
$image =                $_FILES['img'];
$tags =                 $_POST['tag_id'] ?? []; 
$imageLore =            $_POST['img_lore'];

$product = (new Product())->getById($id);

if(!$product) {
    $_SESSION['error_msg'] = "The item that you are trying to edit doesn't exist.";
    header("Location: ../index.php?s=products");
    exit;
}

$validator = new ProductValidation([
    'name' => $productName,
    'description' => $productDescription,
    'price' => $price,
    'img' => $image,    
    'img_lore' => $imageLore,
]);

if($validator->hasErrors()) {
    $_SESSION['errors'] = $validator->getErrors();    
    $_SESSION['data_form'] = $_POST;    
    header("Location: ./../index.php?s=edit-product");    
    exit;

}
if(!empty($image['tmp_name'])) {    
    $newImageName = date('YmdHis_') . sluggify($image['name']);
    $imageUploader::upload($image, $newImageName);    
}

try {
    $product->editExisting([
        'user_fk'            => $authentication->getId(), 
        'name'               => $productName,
        'description'        => $productDescription,
        'price'              => $price,
        'img'                => $newImageName  ?? $product->getImg(),
        'img_lore'           => $imageLore,
        'tags'               => $tags,
    ]);

    if(isset($imageLore) && !empty($product->getImg())) {
        if(file_exists(PATH_IMAGES . '/large-' . $product->getImg())) {            
            unlink(PATH_IMAGES . '/large-' . $product->getImg());
        }
        if(file_exists(PATH_IMAGES . '/' . $product->getImg())) {            
            unlink(PATH_IMAGES . '/' . $product->getImg());
        }
    }

    $_SESSION['success_msg'] = "'<b>" . $productName . "</b>' was successfully edited.";

    header("Location: ./../index.php?s=products");
    exit;
} catch(\Exception $e) {
    $_SESSION['error_msg'] = "An unexpected error ocurred. The product was not edited correctly, please try again latter.";
    $_SESSION['data_form'] = $_POST;
    header("Location: ./../index.php?s=edit-product&id=" . $id);    
    exit;
}
