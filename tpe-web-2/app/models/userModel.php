<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
                              "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", 
                               MYSQL_USER, MYSQL_PASS
        );
    }

    // Busca en la tabla usuario un usuario con el nombre especificado
    public function getUser($username) {
        $username = $this->sanitizeInputProduct($username); 
        $query = $this->db->prepare('SELECT id, username, password, is_admin FROM usuario WHERE username = ?');
        $query->execute([$username]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // Función para sanitizar la entrada del usuario
    private function sanitizeInputProduct($input) {
        return htmlspecialchars(trim($input));
    }
}
