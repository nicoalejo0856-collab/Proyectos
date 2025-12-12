<?php
session_start();
if(isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Procesar el formulario cuando se envía
$mensaje = '';
$tipo_mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/Database.php';
    require_once '../models/Usuario.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);
    
    // Validar que las contraseñas coincidan
    if($_POST['contraseña'] !== $_POST['confirmarContraseña']) {
        $mensaje = 'Las contraseñas no coinciden';
        $tipo_mensaje = 'error';
    } else {
        // Asignar datos
        $usuario->nombre = $_POST['nombre'];
        $usuario->apellido = $_POST['apellido'];
        $usuario->correo = $_POST['correo'];
        $usuario->contraseña = $_POST['contraseña'];
        $usuario->documentoIdentidad = $_POST['documento'];
        $usuario->nombreUsuario = $_POST['nombreUsuario'];
        $usuario->rolId = 2;
        
        // Verificar si ya existe
        if($usuario->verificarExistencia()) {
            $mensaje = 'El correo o nombre de usuario ya están registrados';
            $tipo_mensaje = 'error';
        } else {
            // Guardar usuario
            if($usuario->guardar()) {
                $mensaje = 'Usuario registrado exitosamente. Redirigiendo al login...';
                $tipo_mensaje = 'exito';
                header("refresh:2;url=login.php");
            } else {
                $mensaje = 'Error al registrar el usuario';
                $tipo_mensaje = 'error';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - AGROTECH</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* Lado izquierdo - Imagen */
        .lado-izquierdo {
            flex: 7;
            background-image: url('../assets/fondo.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        /* Lado derecho - Formulario */
           .lado-derecho {
            flex: 3;
            background: #1a1a1a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            position: relative;
        }

        .logo {
            position: absolute;
            top: 30px;
            right: 30px;
            text-align: right;
        }

        .icono-logo {
           width: 110px;   
           height: 110px;  
           display: flex;
           align-items: center;
           justify-content: center;
           margin-bottom: 10px;
           margin-left: auto;
        }

        .icono-logo img {
          width: 100%;
          height: 100%;
          object-fit: contain;
        }

        .contenedor-formulario {
            width: 100%;
            max-width: 500px;
            margin-top: 80px;
            margin-bottom: 40px;
        }

        .titulo-bienvenida {
            color: #4fd1c5;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitulo {
            color: #888;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .fila-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .grupo-input {
            margin-bottom: 20px;
        }

        .grupo-input.columna-completa {
            grid-column: 1 / -1;
        }

        .grupo-input label {
            display: block;
            color: white;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .grupo-input input {
            width: 100%;
            padding: 12px;
            background: #2a2a2a;
            border: 1px solid #3a3a3a;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            transition: all 0.3s;
        }

        .grupo-input input::placeholder {
            color: #666;
        }

        .grupo-input input:focus {
            outline: none;
            border-color: #4fd1c5;
            background: #333;
        }

        .grupo-contraseña {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 18px;
        }

        .toggle-password:hover {
            color: #4fd1c5;
        }

        .boton-registrar {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #4fd1c5 0%, #38b2ac 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-top: 10px;
        }

        .boton-registrar:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 209, 197, 0.3);
        }

        .separador {
            text-align: center;
            color: #666;
            margin: 25px 0;
            position: relative;
        }

        

        .botones-sociales {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .boton-social {
            flex: 1;
            padding: 12px;
            background: #2a2a2a;
            border: 1px solid #3a3a3a;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .boton-social:hover {
            background: #333;
            border-color: #4a4a4a;
        }

        .boton-social i {
            font-size: 18px;
        }

        .login-link {
            text-align: center;
            color: #888;
            font-size: 14px;
        }

        .login-link a {
            color: #4fd1c5;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .mensaje {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .mensaje.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }

        .mensaje.exito {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
        }

        @media (max-width: 968px) {
            body {
                flex-direction: column;
            }
            
            .lado-izquierdo {
                display: none;
            }
            
            .lado-derecho {
                flex: 1;
            }

            .fila-inputs {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Lado Izquierdo -->
    <div class="lado-izquierdo">
        <div class="fondo-animado"></div>
        <div class="luna"></div>
        <div class="silueta-granja">
            <div class="granero"></div>
            <div class="arbol"></div>
        </div>
        <div class="campo"></div>
    </div>

    <!-- Lado Derecho -->
    <div class="lado-derecho">
        <div class="logo">
            <div class="icono-logo">
                <img src="../assets/logo.png" alt="AGROTECH Logo">
            </div>
        </div>

        <div class="contenedor-formulario">
            <h2 class="titulo-bienvenida">Crear Cuenta</h2>
            <p class="subtitulo">Completa los siguientes datos para registrarte</p>

            <?php if($mensaje): ?>
                <div class="mensaje <?php echo $tipo_mensaje; ?>">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="fila-inputs">
                    <div class="grupo-input">
                        <label>Nombre</label>
                        <input type="text" name="nombre" placeholder="Tu nombre" required>
                    </div>

                    <div class="grupo-input">
                        <label>Apellido</label>
                        <input type="text" name="apellido" placeholder="Tu apellido" required>
                    </div>
                </div>

                <div class="grupo-input">
                    <label>Documento de Identidad</label>
                    <input type="text" name="documento" placeholder="Número de documento" required>
                </div>

                <div class="grupo-input">
                    <label>Nombre de Usuario</label>
                    <input type="text" name="nombreUsuario" placeholder="Elige un nombre de usuario" required>
                </div>

                <div class="grupo-input">
                    <label>Correo Electrónico</label>
                    <input type="email" name="correo" placeholder="tu@email.com" required>
                </div>

                <div class="fila-inputs">
                    <div class="grupo-input">
                        <label>Contraseña</label>
                        <div class="grupo-contraseña">
                            <input type="password" id="contraseña" name="contraseña" placeholder="Mínimo 6 caracteres" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('contraseña', 'iconoOjo1')">
                                <i class="fas fa-eye" id="iconoOjo1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="grupo-input">
                        <label>Confirmar Contraseña</label>
                        <div class="grupo-contraseña">
                            <input type="password" id="confirmarContraseña" name="confirmarContraseña" placeholder="Repite la contraseña" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('confirmarContraseña', 'iconoOjo2')">
                                <i class="fas fa-eye" id="iconoOjo2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="boton-registrar">Crear Cuenta</button>
            </form>

            <div class="separador">O registrate con:</div>

            <div class="botones-sociales">
                <button class="boton-social">
                    <i class="fab fa-google"></i>
                    Google
                </button>
                <button class="boton-social">
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </button>
            </div>

            <div class="login-link">
                ¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconoId) {
            const input = document.getElementById(inputId);
            const icono = document.getElementById(iconoId);
            
            if(input.type === 'password') {
                input.type = 'text';
                icono.classList.remove('fa-eye');
                icono.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icono.classList.remove('fa-eye-slash');
                icono.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>