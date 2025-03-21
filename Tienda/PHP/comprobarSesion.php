<?php
function comprobar_sesion(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])){
        header("Location: /Tienda/PHP/inicarSesion.php");
        exit;
    }
}