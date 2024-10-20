<?php
require_once 'app/views/loginView.php';
require_once 'app/models/userModel.php';
require_once 'app/middlewares/middleware.php';

class LoginController {
    private $view;
    private $model;

    public function __construct() {
        $this->view = new LoginView();
        $this->model = new UserModel();
    }

    // Mostrar formulario de login
    public function showLogin($error = null) {
        if ($error) {
            $this->showMsgLogin($error, 'error'); // Muestra el mensaje de error
        }
        $this->view->showLogin(); // Mostrar el formulario de login
    }

    // Manejar el proceso de login
    public function login() {
        // Validar campos de entrada
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $this->showLogin('Por favor, complete todos los campos');
            return;
        }

        $username = $this->sanitizeInput($_POST['username']);
        $password = $this->sanitizeInput($_POST['password']);

        // Verificar credenciales
        $userFromDB = $this->model->getUser($username);
        if (!$userFromDB || !password_verify($password, $userFromDB->password)) {
            $this->showLogin('Credenciales incorrectas');
            return; 
        }

        // Iniciar sesión
        $this->startSession($userFromDB);
        header('Location: ' . BASE_URL . '/listProduct'); // Redirigir después del login
    }

    private function startSession($userFromDB) {
        session_start(); // Iniciar la sesión
        $_SESSION['ID_USER'] = $userFromDB->id;
        $_SESSION['USER'] = $userFromDB->username;
        $_SESSION['is_admin'] = $userFromDB->is_admin; 
    }

    // Manejar el cierre de sesión
    public function logout() {
        session_start();
        session_destroy(); 
        header('Location: ' . BASE_URL);
    }

    // Función para sanitizar la entrada del usuario
    private function sanitizeInput($input) {
        return htmlspecialchars(trim($input));
    }

    // Función para mostrar mensajes
    function showMsgLogin($msg, $type = 'error') {
        $class = ($type === 'success') ? 'msg-success' : 'msg-error';
        echo "<div class='$class'>$msg</div>";
    }
}
