<?php

class city{
    private $id;
    private $nombre;
    private static $db;

    public function __construct()
    {
        self::$db=connection::getConexion();
    }

    public function getDb(){
        return self::$db;
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

    public function getCities(){
        $sql = 'SELECT * FROM ciudades ORDER BY nombre';
        $sentencia = self::$db->prepare($sql);
        $sentencia->execute();
        $cities = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $cities;
    }

    /*
    public function saveCity(){
        $op = 0 ;
        $id=$this->getId();
        $name=$this->getNombre();

        $sql = 'CALL gestionar_ciudad(:op, :id, :name)';
        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':op', $op, PDO::PARAM_INT);
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
        $sentencia->bindParam(':name', $name, PDO::PARAM_STR);

        return $sentencia->execute();
    }
    */
}