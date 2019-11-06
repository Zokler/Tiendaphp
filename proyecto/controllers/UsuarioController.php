<?php
require_once 'models/usuario.php';
class usuarioController
{
    public function index()
    {
        echo 'Controlador Usuarios, accion index';
    }
    public function registro()
    {
        require_once 'views/usuario/registro.php'; //ve al formulario
    }
    public function save()
    {
        if(isset($_POST))
        {
            //Parámetros recibidos por POST enviados a models/usuario.php
            //SI EXISTE EL VALOR EN POST, ENTONCES SE GUARDA EN $_variable SI NO COLOCA UN FALSE 
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            //SI EXISTE EL VALOR EN POST, ENTONCES SE GUARDA EN $_variable SI NO COLOCA UN FALSE 
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            //SI EXISTE EL VALOR EN POST, ENTONCES SE GUARDA EN $_variable SI NO COLOCA UN FALSE 
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            //SI EXISTE EL VALOR EN POST, ENTONCES SE GUARDA EN $_variable SI NO COLOCA UN FALSE 
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if($nombre && $apellidos && $email && $password)
            {    
                $usuario = new Usuario();
                $usuario ->setNombre($nombre);
                $usuario ->setApellidos($apellidos);
                $usuario ->setEmail($email);
                $usuario ->setPassword($password);
                $comprobarUsuario = $usuario ->comprobarUsuario();
                 if(!$comprobarUsuario)
                 {   
                    $save = $usuario->save(); //método que inserta en la base de datos/Retorna si se guardó
                    // o no en la base de datos (true ó false)
                    if($save) //si save regresa true
                        {
                            $_SESSION['register'] = "complete"; //creamos una sesión que guarde complete
                        }
                    else
                        {
                            $_SESSION['register'] = "failed"; //creamos una sesión que guarde failed
                        }
                        $identity = $usuario ->login();
           
                        //si existe y es un objeto
                     if($identity && is_object($identity))
                     {
                         //guarda el objeto entero con la información del usuario identificado
                         $_SESSION['identity'] = $identity;
                         //cuando se identifique un admin, crea una sesión especial de ADMINISTRADOR
                         if($identity->rol == 'admin')
                         {
                             $_SESSION['admin'] = true;
                         }
                     }
                     else
                     {
                         $_SESSION['error_login'] = "Identificación fallida";
                     }
                     
                     //luego crear una sesión
                         
                     $redi = '<script type='
                             .'"text/javascript">'
                             .'window.location='
                             .'"'.base_url.'"'.';'
                             . '</script>';
                     echo $redi;
                }
                else
                {
                    require_once 'views/usuario/mexicanada1.php';
                }
            }
            else
            {
                $_SESSION['register'] = "failed";
            }

        }
        else
        {
            $_SESSION['register'] = "failed";  //si no hay parametros por POST crea sesión que guarda failed
        }

        die();
        require_once 'views/usuario/registro.php'; //ve al formulario
    }
    
    public function login()
    {
        if(isset($_POST))
        {
           //identificar si llegó una variable por POST, en esta función se comprobará el usuario
           //consulta a la base de datos
           $usuario = new Usuario();
           $usuario->setEmail($_POST['email']);
           $usuario->setPassword($_POST['password']);
           
           $identity = $usuario ->login();
           
           //si existe y es un objeto
           if($identity && is_object($identity))
            {
               //guarda el objeto entero con la información del usuario identificado
               $_SESSION['identity'] = $identity;
               //cuando se identifique un admin, crea una sesión especial de ADMINISTRADOR
               if($identity->rol == 'admin')
                {
                   $_SESSION['admin'] = true;
                }
            }
           else
            {
               $_SESSION['error_login'] = "Identificación fallida";
            }
            
          //luego crear una sesión
              
            $redi = '<script type='
                    .'"text/javascript">'
                    .'window.location='
                    .'"'.base_url.'"'.';'
                    . '</script>';
            echo $redi;
        }
    }
    
    public function logout()
    {

        //Cerrar sesión de una cuenta normal
        if(isset($_SESSION['identity']))
            {
                 unset($_SESSION['identity']);
            }
        //Cerrar sesión de una cuenta administrador
        if(isset($_SESSION['admin']))
            {
                 unset($_SESSION['admin']);
            }
        //header("Location:".base_url);
    
    $redi = '<script type='
            .'"text/javascript">'
            .'window.location='
            .'"'.base_url.'"'.';'
            . '</script>';
          
 //   var_dump($hola);
 //   die();
    echo $redi;
    }
}//fin clase
?>