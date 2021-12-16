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
    private $idImage;
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

    public function getIdImage(){
        return $this->idImage;
    }

    public function setIdImage(String $idImage){
        $this->idImage=$idImage;
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

    public function getAllCategory(){
        $cat_id = $this->getCategoria();
        $sql = "SELECT p.*, c.nombre 'Nombre de categoria'
        FROM productos p, categorias c 
        WHERE p.categoria_id = c.id AND p.categoria_id = :cat_id";

        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getOne(){
        $id = $this->getId();
        $sql = "SELECT *
        FROM productos WHERE id = :id";

        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getImages(){
        $id = $this->getId();
        $sql = "SELECT i.id, imagen
        FROM imagenes i, productos p WHERE i.producto_id=p.id AND producto_id = :id";

        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getOneImage(){
        $id = $this->getId();
        $sql = "SELECT imagen
        FROM imagenes i, productos p 
        WHERE i.producto_id=p.id AND producto_id = :id
        LIMIT 1";

        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
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
        $imagen = fopen($img, 'r'); 
        $identificador = null;           
        
        $sql = "CALL gestionar_imagenes(:op, :id, :img, :identificador)";
        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(":op", $op, PDO::PARAM_INT);        
        $sentencia->bindParam(":id", $id, PDO::PARAM_STR);        
        $sentencia->bindParam(":img", $imagen, PDO::PARAM_LOB);        
        $sentencia->bindParam(":identificador", $identificador, PDO::PARAM_INT);  
        
        return $sentencia->execute();
    }

    public function delete(){
        $op = 1;
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

    public function deleteImage(){
        $op=1;
        $id = $this->getId();  
        $img = $this->getImagen();           
        $identificador = $this->getIdImage();           
        
        $sql = "CALL gestionar_imagenes(:op, :id, :img, :identificador)";
        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(":op", $op, PDO::PARAM_INT);        
        $sentencia->bindParam(":id", $id, PDO::PARAM_STR);        
        $sentencia->bindParam(":img", $img, PDO::PARAM_LOB);        
        $sentencia->bindParam(":identificador", $identificador, PDO::PARAM_INT);  
            
        return $sentencia->execute();        
    }

    public function getRandow(int $limit){
        $sql = 'SELECT * FROM productos  
                ORDER BY RAND() 
                LIMIT :limite';
        $productos = self::$db->prepare($sql);
        $productos->bindParam(':limite', $limit, PDO::PARAM_INT);
        $productos->execute();
        $result = $productos->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}