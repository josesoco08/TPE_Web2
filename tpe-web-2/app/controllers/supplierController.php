<?php
require_once 'app/models/supplierModel.php';
require_once 'app/views/supplierView.php';

class SupplierController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new SupplierModel();
        $this->view = new SupplierView();
    }

    public function detailSupplier($id) {
            $products = $this->model->getSupplierById($id);
            if ($products) {
                $this->view->suppierDetailView($products);
            } else {
                $this->showMsgSupplier("Proveedor no encontrado o no tiene productos.", 'error');
            }
        }
        public function listSupplierController() {
            $suppliers = $this->model->listSuppliers();
            $this->view->listViewSuppliers($suppliers);
        }
    
    //ver form proveedores
     public function formViewSupplier() {
        $this->view->formSupplier();
    }


    public function addSupplier() {
        // Verifica si los datos han sido enviados
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre_prov = $this->sanitizeInputSupplier($_POST["Nombre_proveedor"] ?? null);
            $pago = $this->sanitizeInputSupplier($_POST["medio_de_pago"] ?? null);
            $telefono = $this->sanitizeInputSupplier($_POST["telefono"] ?? null);

            // Verificar que todos los campos están completos
            if (!empty($nombre_prov) && !empty($pago) && !empty($telefono)) {
                // Llamar al modelo para insertar el proveedor
                $this->model->insertSupplierModel($nombre_prov, $pago, $telefono);
                $this->showMsgSupplier("Proveedor agregado exitosamente", 'success');
            } else {
                $this->showMsgSupplier("Todos los campos son obligatorios.", 'error');
            }
        }
        header('Location: ' . BASE_URL . 'listSupplier');
        exit;
    }
    function editSupplierController($id) {
        $row = $this->model->editSupplier($id);
        if ($row) {
            $this->view->editSupplierView($row);
        } else {
            $this->showMsgSupplier("Proveedor no encontrado.", 'error');
            header('Location: ' . BASE_URL . 'listSupplier');
        }
    }
    function updateSupplier() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_proveedor'];
            $nombre_proveedor = $this->sanitizeInputSupplier($_POST['nombre_proveedor']);
            $medio_de_pago = $this->sanitizeInputSupplier($_POST['medio_de_pago']);
            $telefono = $this->sanitizeInputSupplier($_POST['telefono']);

            $this->model->updateSupplier($id, $nombre_proveedor, $medio_de_pago, $telefono);
            $this->showMsgSupplier("Proveedor actualizado exitosamente", 'success');
        }
        header('Location: ' . BASE_URL . 'listSupplier');
    }
    function removeSupplier($id) {
        if ($this->model->deleteSupplier($id)) {
            $this->showMsgSupplier("Proveedor eliminado exitosamente", 'success');
        } else {
            $this->showMsgSupplier("Error al eliminar el proveedor.", 'error');
        }
        header('Location: ' . BASE_URL . 'listSupplier');
    }

function sanitizeInputSupplier($input) {
    return htmlspecialchars(trim($input));
}

// Función para mostrar mensajes
function showMsgSupplier($msg, $type = 'error') {
    $class = ($type === 'success') ? 'msg-success' : 'msg-error';
    echo "<div class='$class'>$msg</div>";
}
}

