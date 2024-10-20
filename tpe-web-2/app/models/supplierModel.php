<?php
require_once 'config/config.php';

class SupplierModel { 
    private $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", 
            MYSQL_USER, MYSQL_PASS
        );
    }
    function getSupplier() {
        $query = $this->db->prepare("SELECT id_proveedor, Nombre_proveedor FROM proveedor");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    

    public function getSupplierById($id_proveedor) {
        $query = $this->db->prepare("SELECT * FROM producto WHERE id_proveedor_fk = ?");
        $query->execute([$id_proveedor]);
        return $query->fetchAll(PDO::FETCH_OBJ); // Devuelve los productos del proveedor
    }
    public function listSuppliers() {
        $query = "SELECT id_proveedor, Nombre_proveedor, medio_de_pago, telefono FROM proveedor";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertSupplierModel($nombre_prov, $pago, $telefono) {
        $query = $this->db->prepare("INSERT INTO proveedor (Nombre_proveedor, medio_de_pago, telefono) 
                                     VALUES (?, ?, ?)");
        $query->execute([$nombre_prov, $pago, $telefono]);
    }
   
    function editSupplier($id){
        $query = $this->db->prepare("SELECT id_proveedor, nombre_proveedor, medio_de_pago, telefono FROM proveedor WHERE id_proveedor = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    function updateSupplier($id,$nombre_proveedor, $medio_de_pago, $telefono){
        $query = $this->db->prepare("UPDATE proveedor SET nombre_proveedor = ?, medio_de_pago = ?, telefono = ? WHERE id_proveedor=?" );
        $query->execute([$nombre_proveedor, $medio_de_pago, $telefono, $id]);
        }
    function deleteSupplier($id){
        $query = $this->db->prepare('DELETE FROM proveedor WHERE id_proveedor = ?');
        return $query->execute([$id]);
        }
}