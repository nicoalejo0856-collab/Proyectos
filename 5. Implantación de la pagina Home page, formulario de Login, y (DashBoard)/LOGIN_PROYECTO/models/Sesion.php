<?php
class Sesion {
    private $conn;
    private $table_name = "sesiones";

    public $id;
    public $usuarioId;
    public $token;
    public $fechaInicio;
    public $fechaExpiracion;
    public $activa;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Iniciar sesión
    public function iniciarSesion($usuarioId) {
        // Generar token único
        $this->token = bin2hex(random_bytes(32));
        $this->usuarioId = $usuarioId;
        $this->activa = 1;

        $query = "INSERT INTO " . $this->table_name . "
                SET usuarioId = :usuarioId,
                    token = :token,
                    fechaInicio = NOW(),
                    fechaExpiracion = DATE_ADD(NOW(), INTERVAL 24 HOUR),
                    activa = :activa";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuarioId", $this->usuarioId);
        $stmt->bindParam(":token", $this->token);
        $stmt->bindParam(":activa", $this->activa);

        if($stmt->execute()) {
            // Iniciar sesión PHP
            session_start();
            $_SESSION['usuario_id'] = $usuarioId;
            $_SESSION['token'] = $this->token;
            return true;
        }
        return false;
    }

    // Cerrar sesión
    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        return true;
    }

    // Validar sesión activa
    public function validarSesionActiva() {
        session_start();
        return isset($_SESSION['usuario_id']) && isset($_SESSION['token']);
    }
}
?>