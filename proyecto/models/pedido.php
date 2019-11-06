<?php
class Pedido
{
  //CAMPOS DE LA TABLA USUARIO EN LA BASE DE DATOS
  //ENTIDADES DE PRUEBA NADA MÁS
  private $id;
  private $usuario_id;
  private $estado;
  private $ciudad;
  private $direccion;
  private $coste;
  private $estadop;
  private $fecha;
  private $hora;
  
  ///////////////////////////////////////
  private $db;
  public function __construct()
  {
      $this->db = Database::connect();
  }
  ///////////////////////////////////////
  function getId() {
      return $this->id;
  }

  function getUsuario_id() {
      return $this->usuario_id;
  }

  function getEstado() {
      return $this->estado;
  }

  function getCiudad() {
      return $this->ciudad;
  }

  function getDireccion() {
      return $this->direccion;
  }

  function getCoste() {
      return $this->coste;
  }

  function getEstadop() {
      return $this->estadop;
  }

  function getFecha() {
      return $this->fecha;
  }

  function getHora() {
      return $this->hora;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setUsuario_id($usuario_id) {
      $this->usuario_id = $usuario_id;
  }

  function setEstado($estado) {
      $this->estado = $this->db->real_escape_string($estado);
  }

  function setCiudad($ciudad) {
      $this->ciudad = $this->db->real_escape_string($ciudad);
  }

  function setDireccion($direccion) {
      $this->direccion = $this->db->real_escape_string($direccion);
  }

  function setCoste($coste) {
      $this->coste = $coste;
  }

  function setEstadop($estadop) {
      $this->estadop = $estadop;
  }

  function setFecha($fecha) {
      $this->fecha = $fecha;
  }

  function setHora($hora) {
      $this->hora = $hora;
  }

    
  //obtiene todos los productos
  public function getAll()
  {
      $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
      return $productos;
  }
  //obtiene sólo un producto en concreto y lo devuelve como objeto
    public function getOne()
  {
      $productoo = $this->db->query("SELECT * FROM pedidos WHERE id = '{$this->id}';");
      return $productoo->fetch_object();
  }
  
  //obtiene los datos del pedido, cuando las id son del mismo usuario hacia el pedido que éste realizó
  public function getOneByUser()
  {
    $sql = "SELECT p.id, p.coste FROM pedidos p "
      . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1;";

      $pedido = $this->db->query($sql);
      return $pedido->fetch_object();
  }
  //obtiene todos los pedidos que ha realizado un usuario
  public function getAllByUser()
  {
    $sql = "SELECT p.*, p.coste FROM pedidos p "
      . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC;";

      $pedido = $this->db->query($sql);
      return $pedido;
  }
  
   public function getAllByCompra()
  {
    $sql = "SELECT p.* FROM pedidos p "
      . "WHERE p.usuario_id = {$this->getUsuario_id()} AND p.estadop= 'sended' ORDER BY id DESC;";

      $compras = $this->db->query($sql);
      return $compras;
  }
  
  // muestra todos los productos que existen dentro de productos el cual su id coincida con el producto_id(tabla lineas pedidos) de un id_pedido generado por el usuario dueño del pedido 
  public function getProductosByPedido($id)
  {
//      $sql = "SELECT * FROM productos WHERE id IN "
//              . "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id});";
      
      $sql = "SELECT pr.*, lp.unidades FROM productos pr "
              . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
              . "WHERE lp.pedido_id = {$id};";
              
      $productos = $this->db->query($sql);
      return $productos;
  }
  
  //guarda pedidos en la BD
  public function save()
  {
      $sql = "INSERT INTO pedidos VALUES (NULL,{$this->getUsuario_id()},'{$this->getEstado()}','{$this->getCiudad()}','{$this->getDireccion()}',{$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
      $save = $this->db->query($sql);
//      
//      echo $sql;
//      echo "</br>";
//      echo $this->db->error;
//      die();
      $result = false;
      if($save)
      {
          $result = true;
      }
      return $result;
  }
  
  //CONSULTAS QUE HARÁN RELACIÓN DE LOS PEDIDOS CON LOS PRODUCTOS
  public function save_linea()
  {
      //mostrar el último ID insertado (referencia al ID de los pedidos)
      $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
      $query = $this->db->query($sql);
      
      $pedido_id = $query->fetch_object()->pedido; //obtener como objeto la última ID insertada en el campo pedidos
      
      //hace un recorrido por todo el carrito (todos los productos dentro de él)
      foreach($_SESSION['carrito'] AS $elemento){
        $producto = $elemento['producto'];
        
        $insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id},{$producto->id}, {$elemento['unidades']});";
        $save = $this->db->query($insert);
        }
        
        $result = false;
        if($save)
        {
            $result = true;
        }
        return $result;
  }
  
  public function edit()
  {
            $sql = "UPDATE pedidos SET estadop='{$this->getEstadop()}' ";
            $sql .= "WHERE id={$this->getId()};";
            
            $save = $this->db->query($sql);
      //      
      //      echo $sql;
      //      echo "</br>";
      //      echo $this->db->error;
      //      die();
            $result = false;
            if($save)
            {
                $result = true;
            }
            return $result;
  }
  
  }