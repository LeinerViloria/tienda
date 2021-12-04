<?php
    $error = !empty($_GET['error']) ? trim($_GET['error']) : null;
    $message = "";

    if(!empty($error)){
        if($error=="page" || $error=="method" || $error=="class"){

            if($error=="page"){
                $message = "La página que buscas no existe";
            }elseif($error="method"){
                $message = "El metodo que buscas no existe";
            }else{
                $message = "La clase que buscas no existe";
            }

        }else{
            $message = "No se encontró lo que solicitó";
        }

    }else{
        $message = "No se encontró lo que solicitó";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de camisetas</title>
    <link rel="shortcut icon" href="./assets/img/camiseta.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <div class="container">
        <div id="error">
            <img src="./assets/img/camiseta.png" alt="Logo camiseta">
            <h2><?=$message?></h2>
        </div>
    </div>
</body>

</html>