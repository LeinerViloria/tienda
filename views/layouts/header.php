<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de camisetas</title>
    <link rel="shortcut icon" href="<?=base_url?>assets/img/camiseta.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=base_url?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <!--Cabecera-->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta logo">
                <a href="<?=base_url?>">
                    Tienda de camisetas
                </a>
            </div>
        </header>
        <!--Menu-->
        <?php $categories = Utils::showCategories(); ?>
        <nav id="menu">
            <ul>
                <li><a href="<?=base_url?>">Inicio</a></li>
                <?php foreach($categories as $index => $category): ?>
                <li><a href="<?=base_url?>category/look_at&id=<?=$index?>"><?=$category?></a></li>  
                <?php endforeach; ?>              
            </ul>
        </nav>
        <!--Barra lateral-->
        <div id="content">