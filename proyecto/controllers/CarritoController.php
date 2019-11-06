<?php
require_once 'models/producto.php';
class CarritoController
{  
    public function index()
    {
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>= 1){
            $carrito = $_SESSION['carrito'];
        }
        else
        {
            $carrito = array();
        }
        require_once 'views/carrito/index.php'; 
    }
    public function add() //agregar productos al carrito
    {
        if(isset($_GET['id']))
            {
                $producto_id = $_GET['id'];
            }
            else
                {
                    $redi = '<script type='
                    .'"text/javascript">'
                    .'window.location='
                    .'"'.base_url.'"'.';'
                    . '</script>';
                    echo $redi;
                }
       
       //si no existe la sesión carrito, la crea.
       if(isset($_SESSION['carrito']))
        {
           $counter = 0;
           foreach($_SESSION['carrito'] as $indice => $elemento)
            {
               if($elemento['id_producto'] == $producto_id)//si lo que ya tengo en mi carrito coincide con el nuevo producto
               {
                   $_SESSION['carrito'][$indice]['unidades']++;
                   $counter++;
               }
            }
        }
        if(!isset($counter) || $counter==0)//crear el carrito si no está hecho uno ya
        {
                //conseguir producto
                $producto = new Producto();
                $producto->setId($producto_id);
                $producto = $producto->getOne();
                //añadir al carrito
                if(is_object($producto))
                {
                    $_SESSION['carrito'][] = array(
                        "id_producto" => $producto->id,
                        "precio" => $producto->precio,
                        "unidades" => 1,
                        "producto" => $producto
                                                    );
                }
        }
        $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'carrito/index"'.';'
        . '</script>';
        echo $redi;
    }
    //quitar elementos del carrito
    public function delete()
    {
        if(isset($_GET['index']))
        {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'carrito/index"'.';'
        . '</script>';
        echo $redi;  
    }
    
    //borrar todo el carrito
    public function delete_all()
    {
        unset($_SESSION['carrito']);
         //header('Location:'.base_url."carrito/index");
            
        $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'"'.';'
        . '</script>';
        echo $redi;
    }
    //aumentar cantidad de unidades
    public function up()
    {
        if(isset($_GET['index']))
        {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        //header('Location:'.base_url."carrito/index");
        $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'carrito/index"'.';'
        . '</script>';
        echo $redi;
    }
    //disminuir cantidad de unidades
    public function down()
    {
        if(isset($_GET['index']))
        {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if($_SESSION['carrito'][$index]['unidades'] == 0)
            {
               unset($_SESSION['carrito'][$index]);
            }
        }
        //header('Location:'.base_url."carrito/index");
        $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'carrito/index"'.';'
        . '</script>';
        echo $redi;
    }
    
}