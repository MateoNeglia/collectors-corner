<?php
require_once __DIR__ . '/../../bootstrap/init.php';
require_once __DIR__ . '/../../libraries/helpers.php';

use Collector\Auth\Authentication;
use Collector\Models\Product;
use Collector\Validation\ProductValidation;
use Collector\Uploaders\ImageUploader;

$imageUploader = new ImageUploader;
$authentication = new Authentication;

if(!$authentication->isAuthenticated()) {
    $_SESSION['error_msg'] = "You need to log in first.";
    header("Location: ../index.php?s=log-in");
    exit;   
}

$productName = $_POST['name'];
$productDescription = $_POST['description'];
$price = $_POST['price'];
$image = $_FILES['img'];
$imageLore = $_POST['img_lore'];
$tags = $_POST['tag_id'] ?? []; 
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
    header("Location: ./../index.php?s=new-product");    
    exit;
}

if(!empty($image['tmp_name'])) {    
    $newImageName = date('YmdHis_') . sluggify($image['name']);
    $imageUploader::upload($image, $newImageName);
    //move_uploaded_file($image['catch_name'], __DIR__ . '/../../imgs/large-' . $newImageName);
}

try {
    (new Product())->createNew([
        'user_fk'            => $authentication->getId(), 
        'publish_datetime'   => date('Y-m-d H:i:s'),
        'name'               => $productName,
        'description'        => $productDescription,
        'price'              => $price,
        'img'                => $newImageName ?? null,        
        'img_lore'           => $imageLore,
        'tags'               => $tags,
    ]);

    $_SESSION['success_msg'] = "'<b>" . $productName . "</b>' was successfully published.";

    header("Location: ./../index.php?s=products");
    exit;
} catch(\Exception $e) {
    $_SESSION['error_msg'] = "An unexpected error ocurred. The product was not published correctly, please try again latter.";
    $_SESSION['data_form'] = $_POST;
    header("Location: ./../index.php?s=products");    
    exit;
}
