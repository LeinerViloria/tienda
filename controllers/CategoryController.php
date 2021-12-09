<?php

require_once './models/category.php';

class CategoryController{
    public function index(){                
        Utils::isAdmin();
        $categoria = new category();
        $all = $categoria->getAll();

        require_once './views/categories/index.php';

    }

    public function create(){
        Utils::isAdmin();
        require_once './views/categories/create.php';
    }

    public function save(){  
        Utils::isAdmin(); 

        if($_SERVER['REQUEST_METHOD']=="POST"){            
            $nombre = !empty($_POST['nombre']) ? ucfirst(trim($_POST['nombre'])) : null;
            
            if(!is_null($nombre)){                
                $nombreValidado = Utils::ctype__alpha($nombre, " ", "El nombre solo contiene letras");
                
                if(is_null($nombreValidado)){
                    $categoria = new category();
                    $categoria->setNombre($nombre);
                    $save = $categoria->save();
                    var_dump($save);
                }
            }
        }
        header("Location:".base_url."/category/index");
    }
}