<?php

require_once '../config/config.php';
echo '<pre>';

$page = new core\Page;

$page
    ->configure(['styles', ['bootstrap.min', 'main']])
    ->configure(['scripts', ['bootstrap.min']]);

//$teste = str_replace('=@LINK=@', 'teste', $page->getStrCss());



print_r($page);
echo '<br>';
$page->mount(($page->getConfig())['styles']);
$page->mount(($page->getConfig())['scripts']);

/*
$app->get('/', function(){
    $page = new core\Page;
    
    $headerConfig = [

    ];

    $page
        ->configureStyles($headerConfig)
        ->configureScripts($footerConfig);

    $page->setBody('home');
    $page->render();

    require_once 'pages/header.php';
    require_once 'pages/home.html';
    require_once 'pages/footer.php';
});

$app->get('products', function(){
    $page = new core\Page;

    $page
        ->setBody('products_show')
        ->add()


    $products = (new app\Product)->tableList();

    require_once 'pages/header.php';
    require_once 'pages/products_show.php';
    require_once 'pages/footer.php';
});

$app->get('products', function(){
    $products = (new app\Product)->tableList();

    require_once 'pages/header.php';
    require_once 'pages/products_show.php';
    require_once 'pages/footer.php';
});

$app->get('products/update/:ID', function($id){
    $product = (new app\Product)->find($id);
    $allCategories = (new app\Category)->all();

    $categories = '';

    foreach ($allCategories as $category) {
        $categories .= "<option value='".$category->id."'";        
        $categories .= ($product->categoria_id == $category->id) ? " selected>" : ">";
        $categories .= $category->nome;
        $categories .= "</option>";
    }

    require_once 'pages/header.php';
    require_once 'pages/product_update.php';
    require_once 'pages/footer.php';
});

$app->get('products/store', function(){
    $nextId = 1 + (new app\Product)->max();

    $allCategories = (new app\Category)->all();
    $categories = '';

    foreach ($allCategories as $category) {
        $categories .= "<option value='".$category->id."'>";
        $categories .= $category->nome;
        $categories .= "</option>";
    }

    require_once 'pages/header.php';
    require_once 'pages/products_store.php';
    require_once 'pages/footer.php';
});

$app->post('products/store', function(){

    $uri = core\Path::find('pages_path').'products';
    header("Location: {$uri}");
});

$app->post('products/delete', function(){


    die();
});

$app->dispatch();
