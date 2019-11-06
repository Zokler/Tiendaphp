<?php
//Conexión a la BASE DE DATOS
class Database
{  
    public static function connect()
    {
        $db = new mysqli('localhost', 'root', '', 'database');
        //Query para que SQL devuelva bien los caracteres como ñ o tildes, por ejemplo
        $db -> query("SET NAMES 'utf-8'");
        return $db;
    }
}