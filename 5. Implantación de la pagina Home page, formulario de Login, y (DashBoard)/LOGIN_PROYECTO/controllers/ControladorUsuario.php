<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Usuario.php';

class ControladorUsuario {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    // Registrar usuario
    public function registrarUsuario($datos) {
        // Validar datos
        if(!$this->validarDatosRegistro($datos)) {
            return [
                'exito' => false,
                'mensaje' => 'Datos inválidos. Todos los campos son requeridos.'
            ];
        }

        // Asignar datos al modelo
        $this->usuario->nombre = $datos['nombre'];
        $this->usuario->apellido = $datos['apellido'];
        $this->usuario->correo = $datos['correo'];
        $this->usuario->contraseña = $datos['contraseña'];
        $this->usuario->documentoIdentidad = $datos['documento'];
        $this->usuario->nombreUsuario = $datos['nombreUsuario'];
        $this->usuario->rolId = 2; // Rol por defecto: usuario normal

        // Verificar si el usuario ya existe
        if($this->verificarUsuarioExistente()) {
            return [
                'exito' => false,
                'mensaje' => 'El correo o nombre de usuario ya están registrados.'
            ];
        }

        // Guardar usuario
        if($this->usuario->guardar()) {
            return [
                'exito' => true,
                'mensaje' => 'Usuario registrado exitosamente.'
            ];
        }

        return [
            'exito' => false,
            'mensaje' => 'Error al registrar el usuario.'
        ];
    }

    // Validar datos de registro
    private function validarDatosRegistro($datos) {
        return !empty($datos['nombre']) &&
               !empty($datos['apellido']) &&
               !empty($datos['correo']) &&
               !empty($datos['contraseña']) &&
               !empty($datos['documento']) &&
               !empty($datos['nombreUsuario']) &&
               filter_var($datos['correo'], FILTER_VALIDATE_EMAIL);
    }

    // Verificar usuario existente
    private function verificarUsuarioExistente() {
        return $this->usuario->verificarExistencia();
    }
}
?>