<?php
class Ruta{
    public function ctrRuta(){
        $ip = $_SERVER['SERVER_NAME'];
        return "http://$ip/ProyDist/proyecto/";
    }
    public function ctrIp(){
        $ip = $_SERVER['SERVER_NAME'];
        return $ip;
    }

}