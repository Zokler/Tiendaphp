<?php
class Categoria
{
  //CAMPOS DE LA TABLA USUARIO EN LA BASE DE DATOS
  //ENTIDADES DE PRUEBA NADA MÁS
  private $id;
  private $nombre;

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

  function getNombre() {
      return $this->nombre;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setNombre($nombre) {
      $this->nombre = $this->db->real_escape_string($nombre);
  }

    //Función para devolver todas las categorias
  public function getAll()
  {
      $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC");
      return $categorias;
  }
  
    public function getOne()
  {
      $categoria = $this->db->query("SELECT * FROM categorias WHERE id = '{$this->getId()}'");
      return $categoria->fetch_object();
  }
  
  public function save()
  {
      $sql = "INSERT INTO categorias VALUES (NULL, '{$this->getNombre()}');";
      $save = $this->db->query($sql);
      $result = false;
      if($save)
      {
          $result = true;
      }
      return $result;
  }

    public function delete()
  {
      $sql = "DELETE FROM categorias WHERE id='{$this->id}';";
      $delete= $this->db->query($sql);
      $result = false;
      if($delete)
      {
          $delete = true;
      }
      return $result;
  }
  
}//fin clase