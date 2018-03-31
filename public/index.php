<?php

require_once '../config/config.php';

$app->get('/', function(){
    require_once 'pages/header.html';
    require_once 'pages/home.html';
    require_once 'pages/footer.html';
});

$app->get('/home', function(){
    require_once 'pages/header.html';
    require_once 'pages/home.html';
    require_once 'pages/footer.html';
});

$app->get('products', function(){
    require_once 'pages/header.html';
    require_once 'pages/products_show.php';
    require_once 'pages/footer.html';
});

$app->get('products/store/', function(){
    require_once 'pages/header.html';
    require_once 'pages/products_store.php';
    require_once 'pages/footer.html';
});

$app->dispatch();