document.addEventListener('DOMContentLoaded', function() 
{
    const form = document.getElementById('registroForm');

    if (form) 
    {
        form.addEventListener('submit', function(evento) 
        {
            const campos = form.elements;
            let hayErrores = false;

            for (let i = 0; i < campos.length; i++) 
            {
                if (!campos[i].checkValidity()) 
                {
                    mostrarError(campos[i]);
                    hayErrores = true;
                }
            }

            if (hayErrores) 
            {
                evento.preventDefault();
                console.log("Por favor, complete todos los campos correctamente.");
            }
        });

        const inputs = form.querySelectorAll('input, select');

        inputs.forEach(input => 
            {
            input.addEventListener('input', validarCampo);
        });

        function validarCampo(evento) 
        {
            const campo = evento.target;
            if (campo.checkValidity()) 
            {
                mostrarError(campo, false);
            } 
            else 
            {
                mostrarError(campo, true);
            }
        }

        function mostrarError(campo, esErrorInput) 
        {
            const errorElement = document.getElementById(`error${campo.id.charAt(0).toUpperCase() + campo.id.slice(1)}`);

            if (esErrorInput) 
            {
                if (campo.id === 'clave') 
                {
                    errorElement.textContent = "Debe contener al menos una letra minúscula, una letra mayúscula, un dígito, un carácter especial ($@$!%*?&), y tener entre 8 y 15 caracteres. No debe terminar con comillas simples ni contener espacios en blanco al final.";
                } 
                else if (campo.id === 'nombre' || campo.id === 'apellido1' || campo.id === 'apellido2') 
                {
                    errorElement.textContent = "La primera letra debe ser mayúscula.";
                } 
                else if (campo.id === 'nombreUser') 
                {
                    errorElement.textContent = "Ingrese un nombre de usuario válido de al menos 5 caracteres .";
                } 
                else 
                {
                    errorElement.textContent = campo.validationMessage;
                }
                errorElement.style.display = 'block';
            } 
            else 
            {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        }
    } 
    else 
    {
        console.error('El formulario "registroForm" no se encontró en el documento.');
    }
});
