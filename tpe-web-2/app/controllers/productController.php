<?php
require_once 'app/models/productModel.php';
require_once 'app/models/supplierModel.php'; 
require_once 'app/views/productView.php';
class ProductController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new ProductModel();
        $this->view = new ProductView();
    }

    function showHome() { 
        // Obtiene los productos
        $products = $this->model->getProducts(); 
        
        // Obtiene los proveedores
        $supplierModel = new SupplierModel();
        $suppliers = $supplierModel->getSupplier(); 
        
        // Pasa los productos y proveedores a la vista
        $this->view->HomeViews($products, $suppliers);
    }

    function detailProduct($id) {
        $product = $this->model->getProductById($id);
        if ($product) {
            $this->view->ProductDetailView($product);
        } else {
            $this->showMsg('Producto no encontrado');
        }
    }

    public function listProductController() {
        $productos = $this->model->listarProductos();
        $this->view->listView($productos);
    }

    public function viewFormController() {
        $this->view->formView();
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_prod = $this->sanitizeInputProduct($_POST['Nombre_producto'] ?? null);
            $id_prov = $this->sanitizeInputProduct($_POST['id_proveedor_fk'] ?? null);
            if (empty($id_prov)) {
                $this->showMsg("Error: Proveedor no seleccionado");
                return;
            }
            $categoria = $this->sanitizeInputProduct($_POST['categoria'] ?? null);
            $cantidad = $this->sanitizeInputProduct($_POST['cantidad'] ?? null);
            $talle = $this->sanitizeInputProduct($_POST['talle'] ?? null);
            $valor = $this->sanitizeInputProduct($_POST['valor'] ?? null);

            // Manejo de imagen
            $imagenPath = '';
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $imagenTmpPath = $_FILES['imagen']['tmp_name'];
                $imagenNombre = basename($_FILES['imagen']['name']);
                $imagenPath = 'img/' . $imagenNombre;
                move_uploaded_file($imagenTmpPath, $imagenPath);
            }else {
                echo "Error al subir la imagen.";
            }

            $result = $this->model->insertProductsModel($nombre_prod, $id_prov, $categoria, $cantidad, $talle, $valor, $imagenPath);
            if ($result) {
                $this->showMsg("Producto agregado correctamente", 'success');
                header('Location: ' . BASE_URL . '/listProduct');
                exit();
            } else {
                $this->showMsg("Error al agregar el producto.");
            }
        }
    }

    function editProduct($id) {
        $row = $this->model->editProductos($id);
        if ($row) {
            $this->view->editProductView($row);
        } else {
            header('Location: ' . BASE_URL . 'listProduct');
        }
    }

    function updateProduct() {
        $id = $this->sanitizeInputProduct($_POST['id_producto']);
        $nombre_producto = $this->sanitizeInputProduct($_POST['Nombre_producto']);
        $id_proveedor_fk = $this->sanitizeInputProduct($_POST['id_proveedor_fk']);
        $categoria = $this->sanitizeInputProduct($_POST['categoria']);
        $cantidad = $this->sanitizeInputProduct($_POST['cantidad']);
        $talle = $this->sanitizeInputProduct($_POST['talle']);
        $valor = $this->sanitizeInputProduct($_POST['valor']);
        
        // Manejo de imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $rutaImagen = $this->subirImagen($_FILES['imagen']);
        } else {
            $rutaImagen = null;
        }

        // Actualizar producto
        $this->model->updateProduct($id, $nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor, $rutaImagen);
        header('Location: ' . BASE_URL . 'listProduct');
    }

    function removeProduct($id) {
        $result = $this->model->deleteProduct($id);
        if ($result) {
            $this->showMsg("Producto eliminado correctamente", 'success');
        } else {
            $this->showMsg("Error al eliminar el producto");
        }
        header('Location: ' . BASE_URL . 'listProduct');
    }

    private function subirImagen($imagen) {
        $directorio = 'img/';
        $rutaArchivo = $directorio . uniqid() . "." . strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));
        if (move_uploaded_file($imagen['tmp_name'], $rutaArchivo)) {
            return $rutaArchivo;
        } else {
            throw new Exception("Error al subir la imagen.");
        }
    }
    
    private function sanitizeInputProduct($input) {
        return htmlspecialchars(trim($input));
    }

    // Función para mostrar mensajes
    function showMsg($msg, $type = 'error') {
        $class = ($type === 'success') ? 'msg-success' : 'msg-error';
        echo "<div class='$class'>$msg</div>";
    }
}
