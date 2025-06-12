<?php
function comprobar_sesion(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['Email']) || empty($_SESSION['Email'])){
        header("Location: /Tienda/PHP/inicioSesion.php");
        exit;
    }
}