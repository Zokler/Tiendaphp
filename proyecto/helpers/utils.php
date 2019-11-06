<?php

class Utils
{
    public static function deleteSession($name)
    {
        //Si existe una sesión, con el nombre del parámetro recibido ($name)
        if( isset($_SESSION[$name]) )
        {
            //colócalo en null
            $_SESSION[$name] = null;
            //borra los elementos dentro del array
            unset($_SESSION[$name]);
        }
        //retorna el parámetro con su valor modificado a null
        return $name;
    }
    
    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) 
        {
            //si el usuario no es administrador, redirecciona a la página principal
            header("Location:" . base_url);
        } 
        else 
            {
                //verificación de que usuario es administrador
                return true;
            }
    }
    
    //método para comprobar que está logeado
     public static function isIdentity()
    {
        if (!isset($_SESSION['identity'])) 
        {
            //si el usuario no está logeado, redirecciona a la página principal
            header("Location:" . base_url);
        } 
        else 
            {
                //verificación de que usuario está logeado
                return true;
            }
    }
    
    
    
    public static function showCategorias()
    {
        require_once 'models/categoria.php';
        //crea un objeto de la clase catogoria
        $categoria = new Categoria();
        //obtiene todo desde el método getAll de clase Categorias
        $categorias = $categoria-> getAll();
        
        return $categorias;
    }
    //mostrar propiedades del carrito actual
    public static function statsCarrito()
    {
        $contador = 0;
        $stats = array (
            'count' => 0,
            'total' => 0
        );
        if(isset($_SESSION['carrito']))
        {
            //$stats['count'] = count($_SESSION['carrito']); Productos diferentes
            
            //Todos los productos en total del carrito
            foreach($_SESSION['carrito'] as $producto)
            {
                $stats['count'] += $producto['unidades'];
            }
            
            //precio a pagar en el carrito
            foreach($_SESSION['carrito'] as $producto)
                {
                    $stats['total'] += $producto['precio']*$producto['unidades'];
                }
            
        }
        return $stats;
    }
    public static function showEstatus($status)
    {
        $value = "pendiente";
        if($status == "confirm")
        {
           $value = "pendiente"; 
        }
        elseif($status == "preparation")
            {
                $value = "En preparación";
            }
            elseif($status == "ready")
                {
                    $value = "Preparado";
                }elseif($status == "sended")
                    {
                         $value = "Enviado";
                    }
        return $value;
    }
}
