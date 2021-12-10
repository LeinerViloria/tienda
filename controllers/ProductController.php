<?php
require_once './models/product.php';
class ProductController{
    public function index(){
        //Se puede renderizar la vista
        require_once './views/products/Featured.php';
    }

    public function process(){
        Utils::isAdmin();

        $producto = new product();

        $productos = $producto->getAll();
                
        require_once './views/products/Process.php';
    }

    public function create(){
        Utils::isAdmin();
        
        $categories = Utils::showCategories();        

        require_once './views/products/Create.php';
    }

    public function save(){
        Utils::isAdmin();
        if($_SERVER['REQUEST_METHOD']=="POST"){           
            FB::info($_POST);
            FB::info($_FILES);
        }
    }
}