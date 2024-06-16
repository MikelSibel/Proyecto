<?php
include 'conexion.php';
include 'sesion.php';
comprobar_sesion();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $codOf = isset($_POST['id_oferta']) ? intval($_POST['id_oferta']) : 0;
    $username = isset($_SESSION['usuario']['nombre_usuario']) ? $_SESSION['usuario']['nombre_usuario'] : '';

    if ($codOf > 0 && !empty($username)) 
    {
        $verificarAlumno = $conexion->prepare("SELECT * FROM OFERTAS_FAVORITAS WHERE CodOf = ? AND Nombre_User_Alumno = ?");
        $verificarAlumno->bind_param("is", $codOf, $username);
        $verificarAlumno->execute();
        $verificarResultado = $verificarAlumno->get_result();

        if ($verificarResultado->num_rows == 0) 
        {
            $insertarConsulta = $conexion->prepare("INSERT INTO OFERTAS_FAVORITAS (CodOf, Nombre_User_Alumno) VALUES (?, ?)");
            $insertarConsulta->bind_param("is", $codOf, $username);
            if ($insertarConsulta->execute()) {
                echo "Oferta añadida a favoritos correctamente.";
            } 
            else 
            {
                echo "Error al añadir la oferta a favoritos: " . $insertarConsulta->error;
            }
        } 
        else 
        {
            echo "La oferta ya está en su lista de favoritos.";
        }
    } 
    else 
    {
        echo "Datos inválidos.";
    }
} 
else 
{
    echo "Solicitud inválida.";
}
?>
