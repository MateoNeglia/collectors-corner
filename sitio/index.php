<?php

require_once __DIR__ . '/bootstrap/init.php';
require_once __DIR__ . '/libraries/helpers.php';
//require_once __DIR__ . '/classes/Auth/Authentication.php';

use Collector\Session\Session;

$routes = [
    'home' => [
        'title' => 'Main Page',
    ],
    'product-list' => [
        'title' => 'Products',
    ],
    'contact-us' => [
        'title' => 'Contact Us!',
    ],
    'product-details' => [
        'title' => 'Product Details!',
    ],
    'search-results' => [
        'title' => 'Search Results',
    ],
    'user-page' => [
        'title' => 'User Page',
    ],
    'register' => [
        'title' => 'Register a New Account',
    ],
    'log-in' => [
        'title' => 'Log in!',
    ],
    'register' => [
        'title' => 'Create a new Account',
    ],
    'shopping-cart' => [
        'title' => 'Shopping Cart',
    ],
    'confirm' => [
        'title' => 'Purchase Confirmation',
    ],
    'thank-you' => [
        'title' => 'Thank You',
    ],
    '404' => [
        'title' => 'Page not found',
    ],
];

$page = $_GET['s'] ?? 'home';

if(!isset($routes[$page])) {
    $page = '404';
}
$authentication = new Collector\Auth\Authentication();
$rutaConfig = $routes[$page];
$successMsg = $_SESSION['success_msg'] ?? null;
$errorMsg = $_SESSION['error_msg'] ?? null;
unset($_SESSION['success_msg'], $_SESSION['error_msg']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"/>
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="styles/styles.css"/>
    <title>Collector's Corner | <?= $rutaConfig['title'];?></title>
    
</head>
<body>
    <div id="page-container">
        <header>
            <div class="main-light-bg">
                <div class="container-lg nav-container main-light-bg">                      
                    <nav id="main-nav" class="navbar navbar-expand-lg navbar-light">
                        <a href="index.php?s=home" id="home-link" class="navbar-brand"> 
                            <div id="logo-container">
                                <h1 id="page-title">Collector's Corner</h1>                                                 
                            </div> 
                        </a> 
                        <button class="navbar-toggler" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#barra-de-navegacion" 
                                aria-controls="barra-de-navegacion" 
                                aria-expanded="false" 
                                aria-label="botón hamburguesa">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse m-auto" id="barra-de-navegacion">
                            <ul class="navbar-nav text-center ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="index.php?s=home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="index.php?s=product-list">Products</a>
                                </li>                        
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="index.php?s=contact-us">Contact Us</a>
                                </li>
                                <?php
                                if($authentication->isAuthenticated()):
                                ?>
                                <?php
                                if($authentication->isAdmin()):
                                ?>                                
                                <li class="nav-item my-1 mx-1">
                                    <form action="panel/index.php?log-in" method="post">
                                        <button type="submit" class="btn text-light align-self-center main-dark-bg">Administration</button>
                                    </form>
                                </li>    
                                <?php
                                endif;
                                ?>               
                                <li class="nav-item my-1 mx-1">
                                    <a class="nav-link custom-nav-link" href="index.php?s=user-page">                                        
                                        <svg fill="#4e598c" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                            width="15px" height="15px" viewBox="0 0 45.958 45.958"
                                            xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M39.287,41.955l-1.626-12.76c-0.556-4.375-4.278-7.61-8.688-7.61H16.985c-4.41,0-8.133,3.235-8.688,7.61L6.67,41.979
                                                    c-0.112,0.894,0.163,2.018,0.758,2.692c0.596,0.675,1.453,1.287,2.353,1.287h26.395c0.9,0,1.757-0.624,2.354-1.299
                                                    C39.125,43.982,39.4,42.85,39.287,41.955z"/>
                                                <circle cx="22.978" cy="9.33" r="9.33"/>
                                            </g>
                                        </g>
                                        </svg>                                    
                                    <?= $authentication->getUser()->getName() ?></a>
                                </li>                                                                
                                <?php
                                else:
                                ?>                                                               
                                <li class="nav-item">
                                    <form action="panel/index.php?log-in" method="post">
                                        <button type="submit" class="btn text-light align-self-center main-dark-bg">Log in</button>
                                    </form>
                                </li>
                                <li class="nav-item mx-2">
                                    <form action="index.php?s=register" method="post">
                                        <button type="submit" class="btn text-light align-self-center main-dark-bg">Register</button>
                                    </form>
                                </li>
                                <?php
                                endif;
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="index.php?s=shopping-cart">
                                        <span aria-hidden="true">                                            
                                            <svg fill="#4e598c" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 902.86 902.86" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z
                                                        M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"/>
                                                    <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717
                                                        c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744
                                                        c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742
                                                        C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744
                                                        c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z
                                                        M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742
                                                        S619.162,694.432,619.162,716.897z"/>
                                                </g>
                                            </g>
                                            </svg>
                                        </span>
                                        <span class="sr-only">Shopping Cart</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>  
                </div>
            </div>        
        </header>
        
        <main class="main-content container-lg pb-2" id="main-page">
            <?php
                if($successMsg !== null):
            ?> 
                <div id="successContainer" class="p-3 mb-2 bg-success text-white"> <?= $successMsg ?> </div>
            <?php
                endif;
            ?> 
            <?php
                if($errorMsg !== null):
            ?> 
                <div id="errorContainer" class="p-3 mb-2 bg-danger text-white"> <?= $errorMsg ?> </div>
            <?php
                endif;
            ?> 
            <div id="content-wrap">
            <form action="index.php?s=search-results" method="POST" class="container search-form">
                <input type="text" name="query" placeholder="Search..." id="search-input">
                <button type="submit" class="btn text-light align-self-center main-dark-bg" id="search-button">Search</button>
            </form>

                <?php
                
                $filename = __DIR__ . '/pages/' . $page . '.php';
                if(file_exists($filename)) {
                    require $filename;
                } else {
                    require __DIR__ . '/pages/404.php';
                }
                ?>
            </div>            
        </main>
        <footer id="main-footer" class="bg-dark">
            <div class="container-lg text-center" >
                <p>&copy; Collector's Corner</p>
            </div>        
        </footer>
    </div>    
    <script src="js/bootstrap.bundle.min.js"></script>    
    <script src="js/cart.js"></script>
    <script src="js/helper.js"></script>
</body>
</html>
