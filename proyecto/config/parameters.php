<?php
require_once "rutas.php";
$url=Ruta::ctrRuta();

define("base_url","$url"); //cambiar la ruta
define("controller_default", "productoController"); //controlador por defecto
define("action_default", "index"); //action por defecto