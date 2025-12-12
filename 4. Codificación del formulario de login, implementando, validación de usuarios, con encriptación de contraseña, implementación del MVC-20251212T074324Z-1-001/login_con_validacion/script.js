// Validación de formulario simple y robusta
const form = document.getElementById('registroForm');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    const nombre = document.getElementById('nombre').value.trim();
    const apellido = document.getElementById('apellido').value.trim();
    const email = document.getElementById('email').value.trim();
    const contrasena = document.getElementById('contraseña').value;

    const errores = [];

    if (nombre.length < 3) errores.push('El nombre debe tener al menos 3 caracteres.');
    if (apellido.length < 3) errores.push('El apellido debe tener al menos 3 caracteres.');

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) errores.push('Correo electrónico no válido.');

    if (contrasena.length < 6) errores.push('La contraseña debe tener al menos 6 caracteres.');
    if (!/\d/.test(contrasena)) errores.push('La contraseña debe contener al menos un número.');
    if (!/[A-Z]/.test(contrasena)) errores.push('La contraseña debe contener al menos una mayúscula.');

    const salida = document.getElementById('respuesta');

    if (errores.length) {
        // mostrar errores en pantalla y en consola
        const mensaje = errores.join('\n');
        alert('Errores:\n' + mensaje);
        if (salida) salida.textContent = errores.join(' | ');
        console.log('Errores de validación:', errores);
        return;
    }

    // si todo es válido, enviar el formulario (o manejar con fetch/XHR)
    if (salida) salida.textContent = 'Formulario válido. Enviando...';
    form.submit();
});
