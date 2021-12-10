<?php
class product{
    private $id;
    private $nombre;
    private $categoria;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private static $db;

    public function __construct()
    {
        self::$db=connection::getConexion();
    }

    public function getId(){
        return $this->id;
    }

    public function setId(String $id){
        $this->id=$id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre(String $nombre){
        $this->nombre=ucfirst($nombre);
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria=$categoria;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion(String $descripcion){
        $this->descripcion=ucfirst($descripcion);
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio(int $precio){
        $this->precio=$precio;
    }   
    
    public function getStock(){
        return $this->stock;
    }

    public function setStock(int $stock){
        $this->stock=$stock;
    }

    public function getOferta(){
        return $this->nombre;
    }

    public function setOferta(String $oferta){
        $this->oferta=ucfirst($oferta);
    } 

    public function getFecha(){
        return $this->fecha;
    }
    
    public function getAll(){
        $sql = "SELECT *
        FROM productos";

        $sentencia = self::$db->prepare($sql);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}