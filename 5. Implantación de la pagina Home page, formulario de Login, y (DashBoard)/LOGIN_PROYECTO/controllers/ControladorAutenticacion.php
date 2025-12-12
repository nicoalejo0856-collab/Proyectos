<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Sesion.php';

class ControladorAutenticacion {
    private $db;
    private $usuario;
    private $sesion;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
        $this->sesion = new Sesion($this->db);
    }

    // Autenticar usuario
    public function autenticar($credencial, $contraseña) {
        $usuarioData = $this->usuario->validarCredenciales($credencial, $contraseña);

        if($usuarioData) {
            // Iniciar sesión
            if($this->sesion->iniciarSesion($usuarioData['id'])) {
                return [
                    'exito' => true,
                    'mensaje' => 'Inicio de sesión exitoso.',
                    'usuario' => [
                        'id' => $usuarioData['id'],
                        'nombre' => $usuarioData['nombre'],
                        'apellido' => $usuarioData['apellido'],
                        'correo' => $usuarioData['correo']
                    ]
                ];
            }
        }

        return [
            'exito' => false,
            'mensaje' => 'Credenciales incorrectas.'
        ];
    }

    // Cerrar sesión
    public function cerrarSesion() {
        $this->sesion->cerrarSesion();
        return [
            'exito' => true,
            'mensaje' => 'Sesión cerrada exitosamente.'
        ];
    }

    // Validar sesión activa
    public function validarSesionActiva() {
        return $this->sesion->validarSesionActiva();
    }
}
?>