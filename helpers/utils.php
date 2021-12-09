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

}