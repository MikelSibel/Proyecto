<?php
function leerConfiguracion($nombre, $esquema)
{
    $config = new DOMDocument();
    $config ->load($nombre);
    $res = $config ->schmaVilidate($esquema);
    if($res === false)
    {
        throw new IncalidArgumentException("Revise fichero de configuración");
    }
    $datos = simplexml_load_file($nombre);
    $ip = $datos -> xpath("//ip");
    $nombre = $datos->xpath("//nombre");
	$usu = $datos->xpath("//usuario");
	$clave = $datos->xpath("//clave");	
	$cad = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);
	$resul = [];
	$resul[] = $cad;
	$resul[] = $usu[0];
	$resul[] = $clave[0];
	return $resul;
}
function comprobarUsuario($usuario, $clave)
{
    $res = leerConfiguracion(dirname(__FILE__)."/configuracion.xml", dirname(__FILE__)."/configuracion.xsd");
    $bd = new POD($res[0], $res[1], $res[2]);
    $ins = "select codigo, nombre, rol from usuarios where nombre = '$nombre' 
			and Clave = '$clave'";
	$resul = $bd->query($ins);	
	if($resul->rowCount() === 1){		
		return $resul->fetch();		
	}else{
		return FALSE;
	}
}



?>