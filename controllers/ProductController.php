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
            //Se capturan ños datos del producto
            $id = !empty($_POST['id']) ? trim($_POST['id']) : null;
            $category = !empty($_POST['category']) ? trim($_POST['category']) : null;
            $nombre = !empty($_POST['nombre']) ? trim($_POST['nombre']) : null;
            $price = !empty($_POST['price']) ? trim($_POST['price']) : null;
            $stock = !empty($_POST['stock']) ? trim($_POST['stock']) : null;
            $descripcion = !empty($_POST['descripcion']) ? trim($_POST['descripcion']) : null;
            
            $errores = array();

            if(is_null($id) || is_null($category) || is_null($nombre) || is_null($price) || is_null($stock) || is_null($descripcion)){
                $errores['nulo']="Lo unico que puede ir nulo es la oferta y las imagenes";
            }else{  
                //Verificamos los datos y sus tipos              
                $id = intval($id);
                $price = intval($price);
                $stock = intval($stock);

                if($id==0 || $price==0 || $stock==0){
                    $errores['numero']="El id, el precio y el stock deben ser enteros";
                }elseif($id<0 || $price<0 || $stock<0){
                    $errores['numero']="El id, el precio y el stock deben ser mayores a cero";
                }                
            }

            $nombreVerificado = Utils::ctype__alpha($nombre, " ", "El nombre solo contiene letras");

            if(!is_null($nombreVerificado)){
                $errores['nombre'] = $nombreVerificado;
            }            

            if(!is_string($descripcion)){
                $errores['descripcion']="La descripcion debe ser solo texto";
            }            

            if(count($errores)==0){
                $producto = new product();
                $producto->setId($id);
                $producto->setCategoria($category);
                $producto->setNombre($nombre);       
                $producto->setPrecio($price);
                $producto->setStock($stock);
                $producto->setDescripcion($descripcion);
                
                $save = $producto->save();  
                
                if($save){
                    $_SESSION['productSave']="Completed";
                }else{
                    $_SESSION['productSave']="Failed";
                }

                if(isset($_FILES['image']['tmp_name']) && $save){
                    $imagenes = $_FILES['image']['tmp_name'];

                    foreach($imagenes as $imagen){
                        $producto->setImagen($imagen);
                        $saveImage = $producto->saveImage();
                        if($saveImage){
                            $_SESSION['saveImage']="Imagenes guardadas";
                        }else{
                            $_SESSION['saveImage']="Las imagenes no se guardaron";
                        }
                    }                                                                            

                }
            }else{
                $_SESSION['productSave']="Failed";
            }

        }else{
            $_SESSION['productSave']="Failed";
        }

        header("Location:".base_url."product/process");
    }
}