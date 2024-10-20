<?php
function sessionAuthMiddleware($res) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Iniciar la sesión solo si no está activa
    }
    if (isset($_SESSION['ID_USER'])) {
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->username = $_SESSION['USER'];
        $res->user->is_admin = $_SESSION['is_admin'] ?? false; 
    } else {
        $res->user = null; 
    }
}
function verifyAuthMiddleware($res) {
    if (!$res->user) {
        header('Location: ' . BASE_URL . '/Login'); 
        exit; 
    }
}   