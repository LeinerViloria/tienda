<?php

require_once './models/category.php';
require_once './models/product.php';

class CategoryController{
    public function index(){                
        Utils::isAdmin();
        $categoria = new category();
        $all = $categoria->getAll();

        require_once './views/categories/index.php';

    }

    public function look_at(){
        if(!empty($_GET['id'])){
            $id = trim($_GET['id']);
            $categoria = new category();
            $categoria->setId($id);
            $this_category = $categoria->getOne();

            $producto = new product();
            $producto->setCategoria($id);
            $productos = $producto->getAllCategory();

            if(!empty($productos)){
                $imagen_productos = array();

                foreach($productos as $item){
                    $producto->setId($item['id']);
                    $image = $producto->getOneImage();

                    $imagen_productos[$item['id']] = !empty($image) ? $image[0] : null;

                }
            }
            
        }

        require_once './views/categories/look_at.php';
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