<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class categoriaController
{
    public function index()
    {
        Utils::isAdmin();
        //crea un objeto de la clase catogoria
        $categoria = new Categoria();
        //obtiene todo desde el método getAll de clase Categorias
        $categorias = $categoria-> getAll();
        require_once 'views/categoria/index.php';
    }
    //página de formulario para crear categorias
    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    //guardar categoria
    public function save()
    {
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nombre']))
        {
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }
    
                $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'categoria/index"'.';'
        . '</script>';
        echo $redi; 
    }
    
    //ir a formulario
    public function ver()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            
            //consigue la categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            
            //consigue los productos
            $producto = new Producto();
            $producto ->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        require_once 'views/categoria/ver.php'; 
    }
    
    //borrar categoria
    public function delete()
    {
        Utils::isAdmin();
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            $delete = $categoria->delete();
            if($delete)
            {
                $_SESSION['delete'] = 'complete';
            }
            else
                {
                    $_SESSION['delete'] = 'failed';
                }
        }
        else
            {
                $_SESSION['delete'] = 'failed';
            }
      
                $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'categoria/index"'.';'
        . '</script>';
        echo $redi; 
    }
}
