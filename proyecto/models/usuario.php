<?php
class Usuario
{
  //CAMPOS DE LA TABLA USUARIO EN LA BASE DE DATOS
  //ENTIDADES DE PRUEBA NADA MÁS
  private $id;
  private $nombre;
  private $apellidos;
  private $email;
  private $password;
  private $rol;
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

  function getNombre() {
      return $this->nombre;
  }

  function getApellidos() {
      return $this->apellidos;
  }

  function getEmail() {
      return $this->email;
  }

  function getPassword() {
      //ENCRYPTACIÓN DE LA PASSWORD
      return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' =>4]); 
  }

  function getRol() {
      return $this->rol;
  }

  function getImagen() {
      return $this->imagen;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setNombre($nombre) {
      //Esta función se usa para crear una cadena SQL legal que se puede
      //usar en una sentencia SQL. La cadena dada es codificada a una cadena SQL 
      //escapada, tomando en cuenta el conjunto de caracters actual de la conexión.
      $this->nombre = $this->db->real_escape_string($nombre);
  }

  function setApellidos($apellidos) {
      $this->apellidos = $this->db->real_escape_string($apellidos);
  }

  function setEmail($email) {
      $this->email = $this->db->real_escape_string($email);
  }

  function setPassword($password) {
      $this->password = $password;
  }

  function setRol($rol) {
      $this->rol = $rol;
  }

  function setImagen($imagen) {
      $this->imagen = $imagen;
  }
  
  //Metodo para guardar datos
  public function save()
  {
      $sql = "INSERT INTO usuarios VALUES (NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user',NULL)";
      $save = $this->db->query($sql);
      $result = false;
      if($save)
      {
          $result = true;
      }
      return $result;
  }
  public function comprobarUsuario()
  {
    $sql = "SELECT * FROM usuarios WHERE email = '{$this->getEmail()}'";
      //consulta a la base de datos con la query guardada
      $login = $this->db->query($sql);
      //si loggin es true y las rows devueltas son 1
      if($login && $login->num_rows > 0)
      {
        return true;
      }
      return false;

  }
  
  public function login()
  {
      $result = false; //variable de control de estado para comprobar si la comprobación es correcta
      $email = $this->email;
      $password = $this->password;
      //comprobar si existe el usuario por el parámetro recibido
      //variable que guarda la instrucción sql
      $sql = "SELECT * FROM usuarios WHERE email = '$email'";
      //consulta a la base de datos con la query guardada
      $login = $this->db->query($sql);
      //si loggin es true y las rows devueltas son 1
      if($login && $login->num_rows == 1)
      {
          //guarda en usuario el objeto nos devolvió la base de datos
          $usuario = $login ->fetch_object();
          
          //comprueba si la contraseña que se envió por el formulario login es igual a la contraseña
          //que está cifrada en la base de datos
          $verify = password_verify($password, $usuario->password);
          
          if($verify)
            {
              $result = $usuario; //obten todos los datos del objeto $usuario
            }
      }
      return $result; //devuelve si las comprobaciones fueron correctas o no
  }
}
