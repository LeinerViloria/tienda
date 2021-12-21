<?php

class order{
    private $id;
    private $usuario_id;
    private $ciudad_id;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $detalles_pedido;
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

    public function getUsuario_id(){
        return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id){
        $this->usuario_id=$usuario_id;
    }

    public function getCiudad_id(){
        return $this->ciudad_id;
    }

    public function setCiudad_id($ciudad_id){
        $this->ciudad_id=$ciudad_id;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion=ucfirst($direccion);
    }

    public function getCoste(){
        return $this->coste;
    }

    public function setCoste($coste){
        $this->coste=$coste;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado=ucfirst($estado);
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
    }

    public function getHora(){
        return $this->hora;
    }

    public function setHora($hora){
        $this->hora=$hora;
    }

    public function getDetalles_pedido(){
        return $this->detalles_pedido;
    }

    public function setDetalles_pedido($detalles_pedido){
        $this->detalles_pedido=$detalles_pedido;
    }

    public function getDb(){
        return self::$db;
    }    

    public function getOne(){
        $id = $this->getId();
        $sql = "SELECT p.id, c.nombre, p.direccion, p.coste, p.estado, p.fecha, p.hora
                FROM pedidos p, ciudades c
                WHERE p.ciudad_id=c.id AND p.id = :id";

        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllByUser(){
        $id = $this->getUsuario_id();
        $sql = "SELECT p.id, c.nombre, p.direccion, p.coste, p.estado, p.fecha, p.hora
                FROM pedidos p, ciudades c
                WHERE p.ciudad_id=c.id AND usuario_id = :id
                ORDER BY id DESC";

        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getOneByUser(){
        $id = $this->getUsuario_id();
        $sql = "SELECT p.id Id, p.coste Coste, p.fecha Fecha, p.hora Hora
                FROM pedidos p
                WHERE  usuario_id = :id
                ORDER BY id DESC LIMIT 1";

        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getProductsByOrder(){
        $id = $this->getId();

        $sql = "SELECT dp.id_pedido, dp.id_producto, pr.nombre, pr.precio, dp.unidades
                FROM detalles_pedidos dp, pedidos p, productos pr
                WHERE p.id=:id AND p.id=dp.id_pedido AND dp.id_producto=pr.id;";

        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAll(){
        $sql = "SELECT p.id, c.nombre, p.direccion, p.coste, p.estado, p.fecha, p.hora
                FROM pedidos p, ciudades c
                WHERE p.ciudad_id=c.id
                ORDER BY p.id DESC";

        $sentencia = self::$db->prepare($sql);
        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function save(){
        $op = 0;
        $usuario_id = $this->getUsuario_id();
        $ciudad = $this->getCiudad_id();
        $direccion = $this->getDireccion();
        $coste = $this->getCoste();
        $estado = $this->getEstado();
        $datos = $this->getDetalles_pedido();
        $id = $this->getId();

        $sql = 'CALL gestionar_pedido(:op, :usuario_id, :ciudad, :direccion, :coste, :estado, :datos, :id)';
        $sentencia = self::$db->prepare($sql);
        $sentencia->bindParam(':op', $op, PDO::PARAM_INT);
        $sentencia->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
        $sentencia->bindParam(':ciudad', $ciudad, PDO::PARAM_INT);
        $sentencia->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $sentencia->bindParam(':coste', $coste, PDO::PARAM_INT);
        $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
        $sentencia->bindParam(':datos', $datos, PDO::PARAM_STR);
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
                
        return $sentencia->execute();        
    }

}