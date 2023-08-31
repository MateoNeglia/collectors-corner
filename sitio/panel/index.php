<?php
require_once __DIR__ . '/../bootstrap/init.php';
require_once __DIR__ . '/../libraries/helpers.php';
use Collector\Session\Session;

$routes = [
    'log-in' => [
        'title' => 'Log in Page',        
    ],
    'dashboard' => [
        'title' => 'Main Dashboard',
        'requireAuth' => true,
    ],
    'products' => [
        'title' => 'Products Administration',
        'requireAuth' => true,
    ],    
    'retrieve-password' => [
        'title' => 'Request Password Reset',
    ],
    'update-password' => [
        'title' => 'Update your Password',
    ],
    'new-product' => [
        'title' => 'Publish a new product',
        'requireAuth' => true,
    ],
    'edit-product' => [
        'title' => 'Editing this product',
        'requireAuth' => true,
    ],
    'delete-product' => [
        'title' => 'Deleting this product',
        'requireAuth' => true,
    ],
    '404' => [
        'title' => 'Page not found',
        
    ],
];
$page = $_GET['s'] ?? 'dashboard';

if(!isset($routes[$page])) {
    $page = '404';
}

$ruoteConf = $routes[$page];
$authentication = new Collector\Auth\Authentication();
$requireAuth = $ruoteConf['requireAuth'] ?? false;
if($requireAuth &&  (!$authentication->isAuthenticated() || !$authentication->isAdmin())) {
    $_SESSION['error_msg'] = "You need to log in first.";
    header("Location: index.php?s=log-in");
    exit;   
}
$successMsg = $_SESSION['success_msg'] ?? null;
$errorMsg = $_SESSION['error_msg'] ?? null;
unset($_SESSION['success_msg'], $_SESSION['error_msg']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"/>
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../styles/styles.css"/>
    <title>Administration | <?= $ruoteConf['title'];?></title>
    
</head>
<body>
    <div id="page-container">
        <header>
            <div class="main-light-bg">
                <div class="container-lg nav-container main-light-bg">                      
                    <nav id="main-nav" class="navbar navbar-expand-lg navbar-light">
                        <a href="../index.php?s=home" id="home-link" class="navbar-brand"> 
                            <div id="logo-container">
                                <h1 id="page-title">Collector's Corner Admin Panel</h1>                                                 
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
                            <?php
                                if($authentication->isAuthenticated() && $authentication->isAdmin()):
                            ?>
                            <ul class="navbar-nav text-center ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="index.php?s=dashboard">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="index.php?s=products">Products</a>
                                </li>                        
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="index.php?s=new-product">New Product</a>
                                </li>
                                <li class="nav-item">
                                    <form action="../index.php?s=home" method="post">
                                        <button type="submit" class="btn text-light align-self-center main-dark-bg">Go Back</button>
                                    </form>
                                </li>
                                
                            </ul>
                            <?php
                            endif;
                            ?>
                        </div>
                    </nav>  
                </div>
            </div>        
        </header>
        
        <main class="main-content container-lg pb-2">
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
    <script src="../js/bootstrap.bundle.min.js"></script>    
    <script src="../js/helper.js"></script>    
</body>
</html>

