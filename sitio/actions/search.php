<?php
require_once __DIR__ . '/../bootstrap/init.php';
use Collector\Models\Product;

if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    $product = new Product;
    $searchResults = $product->searchProduct($searchQuery);
}