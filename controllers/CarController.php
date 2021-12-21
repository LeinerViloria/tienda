<?php
require_once './models/product.php';
class CarController
{

    public function index()
    {
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
        }
        require_once './views/car/index.php';
    }   

    public function add()
    {
        $pase = true;
        if(isset($_GET['id_producto'])){
			$producto_id = trim($_GET['id_producto']);
		}else{
			header('Location:'.base_url);
		}
		
		if(isset($_SESSION['carrito'])){
			$counter = 0;
			foreach($_SESSION['carrito'] as $indice => $elemento){                
				if($elemento['id'] == $producto_id){
					$_SESSION['carrito'][$indice]['unidades']++;
					$counter++;
                    $pase=false;
				}
			}	
		}
		
		if((!isset($counter) || $counter == 0) && $pase){
			// Conseguir producto
			$producto = new Product();
			$producto->setId($producto_id);
			$producto_pedido = $producto->getOne();

			// Añadir al carrito
            if (!empty($producto_pedido)) {
                $informacion = array(
                    'id' => $producto_pedido[0]['id'],
                    'precio' => $producto_pedido[0]['precio'],
                    'unidades' => 1,
                    'producto' => $producto_pedido
                );    
                
                $_SESSION['carrito'][] = $informacion;
            }
		}                       
        
        header("Location:".base_url."car/index");

    }

    public function remove()
    {
        if(isset($_GET['id'])){
            $id = trim($_GET['id']);
            
            unset($_SESSION['carrito'][$id]);

            header("Location:" . base_url . "car/index");
        }
    }

    public function delete_all()
    {
        unset($_SESSION['carrito']);
        header("Location:" . base_url . "car/index");
    }

    public function up()
    {
        if(isset($_GET['item'])){
            $item=trim($_GET['item']);
            
            if(isset($_SESSION['carrito'][$item])){                
                                
                $_SESSION['carrito'][$item]['unidades']++;
            }


        }
        header("Location:".base_url."car/index");
    }

    public function down()
    {
        if(isset($_GET['item'])){
            $item=trim($_GET['item']);
            
            if(isset($_SESSION['carrito'][$item])){
                $producto_en_carro = $_SESSION['carrito'][$item];
                
                                
                if($producto_en_carro['unidades']==1){
                    unset($_SESSION['carrito'][$item]);
                }else{
                    $_SESSION['carrito'][$item]['unidades']--;
                }
            }


        }

        header("Location:".base_url."car/index");
    }
}
