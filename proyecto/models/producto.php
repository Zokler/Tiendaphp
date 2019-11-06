<?php
class Producto
{
  //CAMPOS DE LA TABLA USUARIO EN LA BASE DE DATOS
  //ENTIDADES DE PRUEBA NADA MÁS
  private $id;
  private $categoria_id;
  private $nombre;
  private $descripcion;
  private $precio;
  private $stock;
  private $oferta;
  private $fecha;
  private $imagen;
  
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

  function getCategoria_id() {
      return $this->categoria_id;
  }

  function getNombre() {
      return $this->nombre;
  }

  function getDescripcion() {
      return $this->descripcion;
  }

  function getPrecio() {
      return $this->precio;
  }

  function getStock() {
      return $this->stock;
  }

  function getOferta() {
      return $this->oferta;
  }

  function getFecha() {
      return $this->fecha;
  }

  function getImagen() {
      return $this->imagen;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setCategoria_id($categoria_id) {
      $this->categoria_id = $categoria_id;
  }

  function setNombre($nombre) {
      $this->nombre = $this->db->real_escape_string($nombre);
  }

  function setDescripcion($descripcion) {
      $this->descripcion = $this->db->real_escape_string($descripcion);
  }

  function setPrecio($precio) {
      $this->precio = $this->db->real_escape_string($precio);
  }

  function setStock($stock) {
      $this->stock = $this->db->real_escape_string($stock);
  }

  function setOferta($oferta) {
      $this->oferta = $this->db->real_escape_string($oferta);
  }

  function setFecha($fecha) {
      $this->fecha = $fecha;
  }

  function setImagen($imagen) {
      $this->imagen = $imagen;
  }
  //obtiene todos los productos
  public function getAll()
  {
      $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
      return $productos;
  }
  //obtiene todos los productos de una categoria concreta
    public function getAllCategory()
  {
      $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
              . "INNER JOIN categorias c ON c.id = p.categoria_id "
              . "WHERE p.categoria_id = '{$this->categoria_id}' "
              . "ORDER BY id DESC;";
      $productoss = $this->db->query($sql);
      return $productoss;
  }
  //obtiene todos los productos de forma aleatoria
  public function getRandom($limit)
  {
      $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
      return $productos;  
  }
  //obtiene sólo un producto en concreto y lo devuelve como objeto
    public function getOne()
  {
      $productoo = $this->db->query("SELECT * FROM productos WHERE id = '{$this->id}';");
      return $productoo->fetch_object();
  }
  //guarda productos en la BD
  public function save()
  {
      $sql = "INSERT INTO productos VALUES (NULL,{$this->getCategoria_id()},'{$this->getNombre()}','{$this->getDescripcion()}','{$this->getPrecio()}',{$this->getStock()}, null, CURDATE(), '{$this->getImagen()}');";
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
  //Borra productos de la BD
      public function delete()
  {
      $sql = "DELETE FROM productos WHERE id='{$this->id}';";
      $delete= $this->db->query($sql);
      $result = false;
      if($delete)
      {
          $delete = true;
      }
      return $result;
  }
  //Edita productos de la BD
  public function edit()
  {
      $sql = "UPDATE productos SET categoria_id={$this->getCategoria_id()},nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}',precio='{$this->getPrecio()}',stock={$this->getStock()} ";
      if($this->getImagen() != null){
      $sql .= ",imagen='{$this->getImagen()}' ";
      }
      $sql .= "WHERE id='{$this->id}'";
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

  public function compra($pedidos)
    {
        $sql = "SELECT stock FROM productos WHERE id = '{$this->getId()}';";
        $cantidad = $this->db->query($sql);
        $objeto = $cantidad->fetch_object();
        $objeto = intval($objeto->stock);
        $nStock = $objeto - $pedidos ;
        if($objeto >= 0)
        {
            $actualizar = $this->db->query("UPDATE productos SET stock = $nStock WHERE id = '{$this->getId()}'");
        }
    }
  }
