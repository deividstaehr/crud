<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?=core\Path::find('pages_path')?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=core\Path::find('pages_path')?>css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
    <title>Minha Loja</title>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?=core\Path::find('pages_path')?>"><strong>Minha Loja</strong><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="<?=core\Path::find('pages_path')?>products">Produtos</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=core\Path::find('pages_path')?>products/store">Cadastrar Produto</a></li>
            <li class="nav-item"><a class="nav-link" href="">Sobre</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="main">
            