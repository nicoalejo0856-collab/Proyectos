<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nombre;
    public $apellido;
    public $correo;
    public $contraseña;
    public $documentoIdentidad;
    public $nombreUsuario;
    public $rolId;
    public $fechaRegistro;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Guardar nuevo usuario
    public function guardar() {
        $query = "INSERT INTO usuarios 
                (nombre, apellido, correo, contraseña, documentoIdentidad, nombreUsuario, rolId, fechaRegistro)
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $nombre = htmlspecialchars(strip_tags($this->nombre));
        $apellido = htmlspecialchars(strip_tags($this->apellido));
        $correo = htmlspecialchars(strip_tags($this->correo));
        $documento = htmlspecialchars(strip_tags($this->documentoIdentidad));
        $nombreUsuario = htmlspecialchars(strip_tags($this->nombreUsuario));
        
        // Hash de la contraseña
        $contraseñaHash = password_hash($this->contraseña, PASSWORD_BCRYPT);

        // Ejecutar con array de valores
        $resultado = $stmt->execute([
            $nombre,
            $apellido,
            $correo,
            $contraseñaHash,
            $documento,
            $nombreUsuario,
            $this->rolId
        ]);

        return $resultado;
    }

    // Verificar si el usuario existe
    public function verificarExistencia() {
        $query = "SELECT id FROM usuarios 
                WHERE correo = ? OR nombreUsuario = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->correo, $this->nombreUsuario]);

        return $stmt->rowCount() > 0;
    }

    // Buscar por nombre de usuario o correo
    public function buscarPorCredencial($credencial) {
        $query = "SELECT id, nombre, apellido, correo, contraseña, documentoIdentidad, 
                         nombreUsuario, rolId, fechaRegistro
                FROM usuarios 
                WHERE nombreUsuario = ? OR correo = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$credencial, $credencial]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Validar credenciales
    public function validarCredenciales($credencial, $contraseña) {
        $usuario = $this->buscarPorCredencial($credencial);
        
        if($usuario && password_verify($contraseña, $usuario['contraseña'])) {
            return $usuario;
        }
        return false;
    }
}
?>