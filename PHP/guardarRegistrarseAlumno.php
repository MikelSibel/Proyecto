<?php
require_once 'conexion.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $telefono = $_POST['telefono'];
    $nombreUser = $_POST['nombreUser'];
    $clave = $_POST['clave'];
    $estado = $_POST['estado'];

    
    if ($correo && $nombre && $apellido1 && $apellido2 && $telefono && $nombreUser && $clave && $estado) 
    {
       
        $consulta = $conexion->prepare("INSERT INTO ALUMNOS (correo, nombre, apellido1, apellido2, telefono, nombreUser, clave, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($consulta) 
        {
            
            $consulta->bind_param("ssssisss", $correo, $nombre, $apellido1, $apellido2, $telefono, $nombreUser, $clave, $estado);
            
            if ($consulta->execute()) 
            {
                echo "<h1>Registro guardado exitosamente.</h1>";
            } else {
                echo "<h1>Error al ejecutar la consulta: " . $consulta->error . "</h1>";
            }

            $consulta->close();

        }
         else 
        {
            echo "<h1>Error al preparar la consulta: " . $conexion->error . "</h1>";
        }
    } 
    else 
    {
        echo "<h1>Todos los campos son obligatorios.</h1>";
    }

    $conexion->close();
}
?>
