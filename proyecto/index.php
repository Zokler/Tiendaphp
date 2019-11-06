<?php
session_start(); //iniciar la sesión
//Obtendrá parámetros por la URL y llamará al controlador correspondiente
require_once 'autoload.php'; //carga autoload para tener acceso a todos los controladores
//Imprime por pantalla  el header y sidebar
require_once 'config/db.php'; //conexión a la bd
require_once 'config/parameters.php'; //carga las variables estáticas
require_once 'helpers/utils.php'; //carga el fichero con archivos de ayuda 
require_once 'views/layouts/header.php'; //código cabecera
require_once 'views/layouts/sidebar.php';// ""    barra lateral

function show_error() //mostrar mensaje de error
{
    $error = new errorController();
    $error ->index();
}
//INICIO CONTENIDO CENTRAL
if(isset($_GET['controller'])) //si se obtiene controlador
{
    $nombre_controlador = $_GET['controller'].'Controller'; //sí? genera esta variable
}elseif(!isset( $_GET['controller']) && !isset($_GET['action']) )//si no existe el controlador y
{//no existe la acción pon el controlador por defecto definido en: config/parameters.php
    $nombre_controlador = controller_default; //controller_default = productoController
}
else
{
    show_error();
    exit();
}
if(class_exists($nombre_controlador)) //Existe controlador?
{
    $controlador = new $nombre_controlador;//crea objeto (ejemplo)'nombre'Controller
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action']))//Comprobar la ACCION por
            //url, si el MÉTODO existe en ese CONTROLADOR
    {
            $action = $_GET['action'];
            $controlador -> $action();
    }elseif(!isset( $_GET['controller']) && !isset($_GET['action']) )//si no existe el controlador y
    {//no existe la acción pon el controlador por defecto definido en: config/parameters.php
        $default = action_default; //$default = index
        $controlador -> $default();//productoController.index();
    }
else
{
     show_error();
}
}
else
{
    show_error();
}
//FIN CONTENIDO CENTRAL
require_once 'views/layouts/footer.php'; //código Pie de página
