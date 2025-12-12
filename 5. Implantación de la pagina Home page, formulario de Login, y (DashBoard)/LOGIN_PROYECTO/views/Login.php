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
    require_once '../models/Sesion.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);
    $sesion = new Sesion($db);
    
    $credencial = $_POST['credencial'];
    $contraseña = $_POST['contraseña'];
    
    // Validar credenciales
    $usuarioData = $usuario->validarCredenciales($credencial, $contraseña);
    
    if($usuarioData) {
        // Iniciar sesión
        if($sesion->iniciarSesion($usuarioData['id'])) {
            header("Location: dashboard.php");
            exit();
        }
    } else {
        $mensaje = 'Credenciales incorrectas';
        $tipo_mensaje = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - AGROTECH</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* Lado izquierdo - Imagen de fondo */
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
            max-width: 420px;
        }

        .titulo-bienvenida {
            color: #4fd1c5;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .grupo-input {
            margin-bottom: 25px;
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
            padding: 15px;
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

        .opciones-extra {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        .link-recuperar {
            color: #4fd1c5;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }

        .link-recuperar:hover {
            color: #38b2ac;
        }

        .boton-iniciar {
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
        }

        .boton-iniciar:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 209, 197, 0.3);
        }

        .separador {
            text-align: center;
            color: #fbf6f6ff;
            margin: 30px 0;
            position: relative;
        }

       

        .botones-sociales {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
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

        .registro-link {
            text-align: center;
            color: #888;
            font-size: 14px;
        }

        .registro-link a {
            color: #4fd1c5;
            text-decoration: none;
            font-weight: bold;
        }

        .registro-link a:hover {
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
                min-height: 200px;
            }
            
            .lado-derecho {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <div class="lado-izquierdo">
        
    </div>

    <!-- Lado Derecho -->
    <div class="lado-derecho">
        <div class="logo">
            <div class="icono-logo">
                <img src="../assets/logo.png" alt="AGROTECH Logo">
            </div>
        </div>

        <div class="contenedor-formulario">
            <h2 class="titulo-bienvenida">Bienvenido</h2>

            <?php if($mensaje): ?>
                <div class="mensaje <?php echo $tipo_mensaje; ?>">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="grupo-input">
                    <label>Correo electronico</label>
                    <input type="text" name="credencial" placeholder="Ingresa tu correo" required>
                </div>

                <div class="grupo-input">
                    <label>Contraseña</label>
                    <div class="grupo-contraseña">
                        <input type="password" id="contraseña" name="contraseña" placeholder="Ingresa tu contraseña" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="iconoOjo"></i>
                        </button>
                    </div>
                </div>

                <div class="opciones-extra">
                    <a href="#" class="link-recuperar">¿Has olvidado tu contraseña?</a>
                </div>

                <button type="submit" class="boton-iniciar">Iniciar Sesion</button>
            </form>

            <div class="separador">O inicia sesion con:</div>

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

            <div class="registro-link">
                Aun no posees una cuenta? <a href="registro.php">Crear Cuenta</a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('contraseña');
            const icono = document.getElementById('iconoOjo');
            
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