<?php
require_once 'libs/response.php';
require_once 'app/controllers/productController.php';
require_once 'app/controllers/supplierController.php';
require_once 'app/controllers/loginController.php';
require_once 'app/middlewares/middleware.php';
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// Crear una instancia de respuesta
$res = new stdClass();

// Ejecutar el middleware para gestionar sesiones
sessionAuthMiddleware($res);

// Acciones
$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

$controller = new ProductController();
$controllerSupplier = new SupplierController();
// Controlador de acción
switch ($params[0]) {
    case 'home':
        $controller->showHome();
        break;
    case 'productDetail':
        $controller->detailProduct($params[1]);
        break;
    case 'supplierDetail':
        $controllerSupplier->detailSupplier($params[1]);
        break;
    case 'Login':
        $controller = new LoginController();
        $controller->login();
        break;

    case 'showLogin':
        $controller = new LoginController();
        $controller->showLogin();
        break;

    case 'Logout':
        $controller = new LoginController();
        $controller->logout();
        break;

    // Acciones restringidas a administradores
    //productos
        case 'listProduct': 
            sessionAuthMiddleware($res); 
            verifyAuthMiddleware($res); 
        $controller->listProductController(); 
        break;
        case 'listSupplier':
            sessionAuthMiddleware($res); 
            verifyAuthMiddleware($res); 
            $controllerSupplier->listSupplierController();
            break;
        case 'viewForm':
            sessionAuthMiddleware($res); 
            verifyAuthMiddleware($res);
            $controller->viewFormController();
            break;
        case 'add':
            sessionAuthMiddleware($res); 
            verifyAuthMiddleware($res);
            $controller->addProduct();
            break;
        case 'editProduct':
            sessionAuthMiddleware($res); 
            verifyAuthMiddleware($res);
            if (isset($params[1])) {
                $controller->editProduct($params[1]);
            } else {
                echo "ID del producto no especificado";
            }
            break;
        case 'updateProduct':
            sessionAuthMiddleware($res); 
            verifyAuthMiddleware($res);
            $controller->updateProduct();
            break;
        case 'deleteProduct':
            sessionAuthMiddleware($res); 
            verifyAuthMiddleware($res);
            if (isset($params[1])) {
                $controller->removeProduct($params[1]);
            } else {
                echo "ID del producto no especificado";
            }
            break;
        //proveedor
         case 'viewFormSupplier':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controllerSupplier->formViewSupplier(); 
        break;
    
    case 'addSupplier':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controllerSupplier->addSupplier();
        break;

    case 'editSupplier':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        if (isset($params[1])) {
            $controllerSupplier->editSupplierController($params[1]);
        } else {
            echo "ID no encontrado";
        }
        break;

    case 'updateSupplier':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        $controllerSupplier->updateSupplier(); 
        break;

    case 'deleteSupplier':
        sessionAuthMiddleware($res); 
        verifyAuthMiddleware($res);
        if (isset($params[1])) {
            $controllerSupplier->removeSupplier($params[1]); 
        } else {
            echo "ID del proveedor no especificado";
        }
        break;
    default:
        echo "404 not found"; 
        break;
}