<?php
require_once './models/product.php';
class ProductController{
    public function index(){
        $producto = new product();
        $productos=$producto->getRandow(6);  
        
        $imagen_productos = array();

        foreach($productos as $item){
            $producto->setId($item['id']);
            $image = $producto->getOneImage();

            $imagen_productos[$item['id']] = !empty($image) ? $image[0] : null;

        }                    

        //Se puede renderizar la vista
        require_once './views/products/Featured.php';
    }

    public function look_at(){
        if(!empty($_GET['id'])){

            $id = trim($_GET['id']);

            $producto = new product();
            $producto->setId($id);
            $thisProduct = $producto->getOne();
            $thisProduct = $thisProduct[0];

            if(!is_null($thisProduct)){
                $images = $producto->getImages();
            }  
            
        } 

        require_once './views/products/look_at.php';

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

    public function edit(){
        Utils::isAdmin();

        if(!empty($_GET['id'])){
            $edit=true;

            $id = trim($_GET['id']);

            $producto = new product();
            $producto->setId($id);
            $thisProduct = $producto->getOne();
            $thisProduct = $thisProduct[0];

            if(is_null($thisProduct)){
                $edit=false;
            }else{
                $images = $producto->getImages();
            }          
        }        


        
        $categories = Utils::showCategories();        

        require_once './views/products/Create.php';
    }

    public function delete(){
        Utils::isAdmin();
        
        if(!empty($_GET['id'])){
            $id = trim($_GET['id']);
            $producto = new product();
            $producto->setId($id);
            
            $delete = $producto->delete();        
            
            if($delete){
                $_SESSION['productDelete']="Completed";
            }else{
                $_SESSION['productDelete']="Failed";
            }

        }else{
            $_SESSION['productDelete']="Failed";
        }      

        header("Location:".base_url."product/process");
    }

    public function deleteImage(){
        Utils::isAdmin();
        
        if(!empty($_GET['id'])){
            $id = trim($_GET['id']);

            $producto = new product();
            $producto->setIdImage($id);            
            
            $delete = $producto->deleteImage();        
            
            if($delete){
                $_SESSION['DeleteImage']="Completed";
            }else{
                $_SESSION['DeleteImage']="Failed";
            }

        }else{
            $_SESSION['productDelete']="Failed";
        }      

        header("Location:".base_url."product/process");
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

                if(!empty($_FILES['image']['tmp_name'][0]) && $save){
                    $imagenes = $_FILES['image'];
                    $pase = true;

                    foreach($imagenes['type'] as $formato){
                        if($formato!="image/jpeg" && $formato!="image/jpg" && $formato!="image/png"){
                            $pase=false;
                            break;
                        }
                    }

                    if($pase){
                        foreach($imagenes['tmp_name'] as $imagen){
                            $producto->setImagen($imagen);
                            $saveImage = $producto->saveImage();
                            if($saveImage){
                                $_SESSION['saveImage']="Imagenes guardadas";
                            }else{
                                $_SESSION['saveImage']="Las imagenes no se guardaron";
                            }
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