<?php
function comprobar_sesion(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['activa']) || empty($_SESSION['activa'])){
        header("Location: /Tienda/index.php");
        exit;
    }
}