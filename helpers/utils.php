<?php

class Utils{

    public static function deleteSession($name){        
        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function ctype__alpha($array, $separador, $mensaje){
        $result = null;
        
        $arrayVar = explode($separador, $array);

        foreach($arrayVar as $variable){ 

            if(!ctype_alpha($variable)){
                $result=$mensaje;
                break;
            }

        }

        return $result;
    }

    public static function showCategories(){
        require_once './models/category.php';
        $categoria = new category();
        $all = $categoria->getAll();
        return $all;
    }

    public static function statsCarrito(){
        $stats = array(
            'count'=>0,
            'total'=>0
        );
        if(isset($_SESSION['carrito'])){
            $stats['count']=count($_SESSION['carrito']);
            foreach($_SESSION['carrito'] as $producto){                
                $stats['total']+= $producto['precio']*$producto['unidades'];
            }
        }

        return $stats;
    }

    public static function convertedAmPm($tiempo){
        return date('g:i a', strtotime($tiempo));
    }

    public static function getMonthName($fecha){
        setlocale(LC_ALL, 'es_Es');          

        $mes=explode('-', $fecha);
        $dateObj = DateTime::createFromFormat('!m', $mes[1]);
        $nombreMes = strftime('%B', $dateObj->getTimestamp());

        $mes[1]=ucfirst($nombreMes);

        $mes = array_reverse($mes, false);

        $spanishDate = implode(' - ', $mes);
        
        return $spanishDate;
    }

    public static function showstatus($status){
        $message='Pendiente';
        
        if($status=="Confirmado"){
            $message="Pendiente";
        }elseif($status == "Preparation"){
            $message="En preparacion";
        }elseif($status == "Ready_to_send"){
            $message="Preparado para enviar";
        }elseif($status == "Sent"){
            $message="Enviado";
        }

        return $message;
    }

    public static function getStocks(){
        $producto = new product();

        $productos = $producto->getAllStocks();

        return $productos;
    }

}