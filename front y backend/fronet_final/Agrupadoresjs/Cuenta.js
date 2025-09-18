document.getElementById('formCambioLogin').addEventListener('submit', function(e) {
    e.preventDefault();

    const usuario = document.getElementById('nuevoUsuario').value;
    const contrasena = document.getElementById('nuevaContrasena').value;

    if (usuario && contrasena) {
        alert('Los datos de inicio de sesión se han actualizado correctamente.');
        document.getElementById('formCambioLogin').reset();
    } else {
        alert('Por favor completa todos los campos.');
    }
});

document.getElementById('volverInicio').addEventListener('click', function() {
    window.location.href = 'inicio.html'; 
});

document.getElementById('enviarCodigo').addEventListener('click', function() {
    const contacto = document.getElementById('correoTelefono').value;
    const codigoSection = document.getElementById('codigoSection');

    if (!codigoSection.classList.contains('d-none')) {
        // Ya se mostraron los cuadros, ahora verificamos el código
        const codigoIngresado = 
            document.getElementById('dig1').value +
            document.getElementById('dig2').value +
            document.getElementById('dig3').value +
            document.getElementById('dig4').value +
            document.getElementById('dig5').value +
            document.getElementById('dig6').value;

        if (codigoIngresado.length === 6) {
            alert('Cambio con éxito.');
            // Cerrar modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalRecuperar'));
            modal.hide();
            // Limpiar campos
            document.getElementById('correoTelefono').value = '';
            document.querySelectorAll('#codigoSection input').forEach(input => input.value = '');
            codigoSection.classList.add('d-none');
        } else {
            alert('Por favor ingresa el código completo de 6 dígitos.');
        }

    } else {
        if (contacto) {
            alert(`Se ha enviado un código de verificación a: ${contacto}`);
            codigoSection.classList.remove('d-none');
        } else {
            alert('Por favor ingresa tu correo electrónico o número de teléfono.');
        }
    }
});
