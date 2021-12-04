<?php

require_once './autoload.php';
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';

$get_controller = !empty($_GET['controller']) ? trim($_GET['controller']) : null;


//Si existe el controlador
if(!is_null($get_controller)){
    $controller_name = $get_controller.'Controller';
}else{    
    //header("location: error.php?error=page");
    $controller_name = "ProductController";
}

//Si existe el la clase de ese controlador
if(class_exists($controller_name)){    

    $controller = new $controller_name();

    $get_action = !empty($_GET['action']) ? trim($_GET['action']) : null;

    //Si existe el metodo
    if(!is_null($get_action) && method_exists($controller_name, $get_action)){
        $action = $get_action;
        $controller->$action();        
    }else if(is_null($get_action)){
        $action = "index";
        $controller->$action();
    }else{                
        require_once 'error.php';
    }
}else{    
    //header("location: error.php?error=class");
    require_once 'error.php';    
}

require_once './views/layouts/footer.php';