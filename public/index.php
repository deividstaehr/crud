<?php

require_once '../config/config.php';

$app->get('/', function(){
    require_once 'pages/header.php';
    require_once 'pages/home.html';
    require_once 'pages/footer.php';
});

$app->get('products', function(){
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
    $product = new app\Product;
    
    $product->nome         = $_POST['proName'];
    $product->preco        = $_POST['proPreco'];
    $product->descricao    = $_POST['proDesc'];
    $product->categoria_id = $_POST['proCat'];
    
    $product->store();
    
    $uri = core\Path::find('pages_path').'products';
    
    header("Location: {$uri}");
});

$app->post('products/update', function(){
    $product = new app\Product;
    
    $product->id           = $_POST['proId'];
    $product->nome         = $_POST['proName'];
    $product->preco        = $_POST['proPreco'];
    $product->descricao    = $_POST['proDesc'];
    $product->categoria_id = $_POST['proCat'];

    $product->update();
    
    $uri = core\Path::find('pages_path').'products';
    
    header("Location: {$uri}");
});

$app->post('products/delete', function(){
    $product = new app\Product;
    
    $product->id = $_POST['proId'];
    
    $product->delete();
    
    $uri = core\Path::find('pages_path').'products';
    
    header("Location: {$uri}");
});

$app->dispatch();
