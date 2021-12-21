<?php

require_once './models/order.php';
require_once './models/city.php';
class OrderController{
    public function make(){            
        $city = new city();
        $cities = $city->getCities();
        
        require_once './views/orders/make.php';
    }

    public function add(){        
        if(isset($_SESSION['identity'])){
            //Se guarda                       
            $ciudad = !empty($_POST['ciudad']) && is_numeric($_POST['ciudad']) ? trim($_POST['ciudad']) : null;
            $direccion = !empty($_POST['direccion']) && is_string($_POST['direccion']) ? trim($_POST['direccion']) : null;

            if(!empty($ciudad) && !empty($direccion)){

                $user_id = $_SESSION['identity']['id']; 
                $stats = Utils::statsCarrito();
                $total = $stats['total'];
                $estado = 'confirmado';

                $carrito = $_SESSION['carrito'];

                $cadenaCompra = "";

                foreach($carrito as $detalle){                
                    $cadenaCompra.="-, '".$detalle['id']."', ".$detalle['unidades']."@";
                }                

                $order = new order();
                $order->setUsuario_id($user_id);
                $order->setCiudad_id($ciudad);
                $order->setDireccion($direccion);
                $order->setCoste($total);
                $order->setEstado($estado);
                $order->setDetalles_pedido($cadenaCompra);

                $result = $order->save();

                if($result){
                    $_SESSION['pedido']="Completed";
                }else{
                    $_SESSION['pedido']="Failed";
                }

            }else{
                $_SESSION['pedido']="Failed";
            }

           header("Location:".base_url."order/confirmed");

        }else{
            //Redirigir
            header('Location:'.base_url);
        }        
    }

    public function confirmed(){
        if($_SESSION['identity']){
            $identity = $_SESSION['identity'];

            Utils::deleteSession('carrito');

            $pedido = new order();
            $pedido->setUsuario_id($identity['id']);

            $order=$pedido->getOneByUser();
            
            if(!empty($order)){
                $order=$order[0];

                $pedido_productos = new order();
                $pedido_productos->setId($order['Id']);                
                
                $productos = $pedido_productos->getProductsByOrder();
                
            }
            
        }
        require_once './views/orders/confirmed.php';
    }

    public function myOrders(){
        Utils::isIdentity();

        $pedido = new order();
        $pedido->setUsuario_id($_SESSION['identity']['id']);

        $pedidos = $pedido->getAllByUser();                

        require_once './views/orders/myOrders.php';
    }

    public function detail(){
        Utils::isIdentity();

        if(!empty($_GET['id'])){
            $id = trim($_GET['id']);

            $pedido = new order();
            $pedido->setId($id);

            $order = $pedido->getOne();

            if(!empty($order)){
                $order=$order[0];
                $products = $pedido->getProductsByOrder();
            }            

            require_once './views/orders/detail.php';
        }else{
            header("Location:".base_url."order/myOrders");
        }

    }

    public function gestion(){
        Utils::isIdentity();

        $gestion = true;

        $pedido = new order();
        $pedido->setUsuario_id($_SESSION['identity']['id']);

        $pedidos = $pedido->getAll();   

        require_once './views/orders/myOrders.php';
    }

    public function status(){
        Utils::isAdmin();

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $id = !empty($_POST['orderId']) ? trim($_POST['orderId']) : null;
            $state = !empty($_POST['estado']) ? trim($_POST['estado']) : null;

            if(!is_null($id) && !is_null($state)){

                $pedido = new order();
                $pedido->setId($id);
                $pedido->setEstado($state);

                $update = $pedido->save();

                header("Location:".base_url."order/detail&id=".$id);

            }

        }else{
            header("Location:".base_url);
        }

    }

}