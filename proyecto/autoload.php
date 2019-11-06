<?php //Cargar los controladores

function controllers_autoload($classname)
{
    include 'controllers/' . $classname . '.php'; //entra a carpeta controladores y los incluye
}

spl_autoload_register('controllers_autoload');

?>
