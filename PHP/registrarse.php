<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/registro.css">
    <title>WikiOfertas</title>
</head>
<body>
    <div class="contenedor">
        <form action="guardarRegistrarseAlumno.php" method="POST" id="registroForm" class="container">
            <h2>Registro Usuario</h2>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}*$" title="Ingrese un correo válido">
            <span class="error" id="errorCorreo" aria-live="polite"></span>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required pattern="[A-ZÁÉÍÓÚÑ][a-záéíóúñ\s]*$" title="La primera letra debe ser mayúscula">
            <span class="error" id="errorNombre" aria-live="polite"></span>

            <label for="apellido1">Primer Apellido:</label>
            <input type="text" id="apellido1" name="apellido1" required pattern="[A-ZÁÉÍÓÚÑ][a-záéíóúñ\s]*$" title="La primera letra debe ser mayúscula">
            <span class="error" id="errorApellido1" aria-live="polite"></span>

            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" required pattern="[A-ZÁÉÍÓÚÑ][a-záéíóúñ\s]*$" title="La primera letra debe ser mayúscula">
            <span class="error" id="errorApellido2" aria-live="polite"></span>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required pattern="[0-9]{9}*$" title="Ingrese un teléfono válido (9 dígitos)">
            <span class="error" id="errorTelefono" aria-live="polite"></span>

            <label for="nombreUser">Nombre de Usuario:</label>
            <input type="text" id="nombreUser" name="nombreUser" required pattern="[a-zA-Z0-9]{5,}*$" title="Ingrese un nombre de usuario válido de al menos 5 caracteres">
            <span class="error" id="errorNombreUser" aria-live="polite"></span>

            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}[^'\s]*$" title="Debe contener al menos una letra minúscula, una letra mayúscula, un dígito, un carácter especial ($@$!%*?&), y tener entre 8 y 15 caracteres. No debe terminar con comillas simples ni contener espacios en blanco al final.">
            <span class="error" id="errorClave" aria-live="polite"></span>

            <label for="estado">Estado del Alumno:</label>
            <select id="estado" name="estado" required>
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
            <span class="error" id="errorEstado" aria-live="polite"></span>
            
            <button type="submit" name="enviar">Confirmar</button>
            <button type="reset" name="borrar">Borrar</button>
        </form>
    </div>

    <script src="../JS/validarRegistro.js"></script>
</body>
</html>
