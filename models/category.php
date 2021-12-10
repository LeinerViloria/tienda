<?php

class category{
    private $id;
    private $nombre;
    private static $db;

    public function __construct()
    {
        self::$db=connection::getConexion();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getDb(){
        return self::$db;
    }

    public function getAll(){
        $sql = "SELECT * FROM categorias ORDER BY nombre";
        $sentencia = self::$db->prepare($sql);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_KEY_PAIR);

        return $result;
    }

    public function save(){
        $op = 0;
        $nombre = $this->getNombre();
        $sql = "CALL gestionar_categoria(:operacion, :nombre)";
        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(":operacion", $op, PDO::PARAM_INT);
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $result = $sentencia->execute();        

        return $result;
    }
}