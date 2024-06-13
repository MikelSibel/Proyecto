<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/registro.css">
    <title>Registro</title>
</head>
<body>
    <div class="contenedor">
        <form action="guardarRegAlu.php" method = "POST">
            <label for="correo">Correo Electronico:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="nombre">Primer Apellido:</label>
            <input type="text" id="apellido1" name="apellido1" required>

            <label for="nombre">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2"required>

            <label for="nombre">Telefono:</label>
            <input type="number" id="telefono" name="telefono" required>

            <label for="nombreUser">Nombre de Usuario:</label>
            <input type="text" id="nombreUser" name="nombreUser" required>

            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" required>

            <label for="estado">Estado del Alumno:</label>
            <select id="estado" name="estado">
                <option value="">Seleccione el estado</option>
                <?php
                include 'conexion.php';
                
                $result = mysqli_query($conexion, "SHOW COLUMNS FROM ALUMNOS LIKE 'Estado'");
                if ($result) 
                {
                    $row = mysqli_fetch_assoc($result);
                    
                    $enum_values = explode("','", substr($row['Type'], 6, -2));
                    
                    foreach ($enum_values as $value) 
                    {
                        echo "<option value='$value'>$value</option>";
                    }
                } 
                else 
                {
                    echo "Error al obtener valores del ENUM: ";
                }
                ?>
            </select>
            <input type="submit" value="confirmar" name="enviar">
            <input type="reset" value="borrar" name="borrar">
        </form>
    </div>
    
</body>
</html>