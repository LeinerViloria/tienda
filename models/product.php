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
    private $imagen;
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

    public function getImagen(){
        return $this->imagen;
    }

    public function setimagen($imagen){
        $this->imagen=$imagen;
    }

    public function getDb(){
        return self::$db;
    }
    
    public function getAll(){
        $sql = "SELECT *
        FROM productos";

        $sentencia = self::$db->prepare($sql);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function save(){
        $op = 0;
        $id=$this->getId();
        $cat=$this->getCategoria();
        $nombre=$this->getNombre();
        $desc=$this->getDescripcion();
        $precio=$this->getPrecio();
        $stock=$this->getStock();
        $oferta=$this->getOferta();

        $sql = "CALL gestionar_producto(:operacion, :id, :categoria, :nombre, :descripcion, :precio, :stock, :oferta)";
        $sentencia=self::$db->prepare($sql);
        $sentencia->bindParam(":operacion", $op, PDO::PARAM_INT);
        $sentencia->bindParam(":id", $id, PDO::PARAM_STR);
        $sentencia->bindParam(":categoria", $cat, PDO::PARAM_INT);
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->bindParam(":descripcion", $desc, PDO::PARAM_STR);
        $sentencia->bindParam(":precio", $precio, PDO::PARAM_INT);
        $sentencia->bindParam(":stock", $stock, PDO::PARAM_INT);
        $sentencia->bindParam(":oferta", $oferta, PDO::PARAM_STR);

        return $sentencia->execute();
    }

    public function saveImage(){
        $op=0;
        $id = $this->getId();  
        $img = $this->getImagen();    
        $identificador = null;           
        
        $sql = "CALL gestionar_imagenes(:op, :id, :img, :identificador)";
        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(":op", $op, PDO::PARAM_INT);        
        $sentencia->bindParam(":id", $id, PDO::PARAM_STR);        
        $sentencia->bindParam(":img", $img, PDO::PARAM_LOB);        
        $sentencia->bindParam(":identificador", $identificador, PDO::PARAM_INT);  
        
        return $sentencia->execute();
    }
}