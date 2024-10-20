<?php
require_once 'config/config.php';

class ProductModel { 
    private $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", 
            MYSQL_USER, MYSQL_PASS
        );
    }

    function getProducts() {
        $query = $this->db->prepare("SELECT * FROM producto");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ); 
      return  $productos;
    }

    function getProductById($id) {
        $query = $this->db->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    public function insertProductsModel($nombre_prod, $id_prov, $categoria, $cantidad, $talle, $valor, $imagen) {
        try {
            $query = $this->db->prepare("INSERT INTO producto (Nombre_producto, id_proveedor_fk, categoria, cantidad, talle, valor, imagen) 
                                         VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->execute([$nombre_prod, $id_prov, $categoria, $cantidad, $talle, $valor, $imagen]);
            return true;
        } catch (PDOException $e) {
            echo "Error al insertar el producto: " . $e->getMessage();
            return false;
        }
    }
    
    public function listarProductos() {
        $query = "SELECT id_producto, Nombre_producto, id_proveedor_fk, categoria, cantidad, talle, valor FROM producto";
        $query = $this->db->query($query);
        
        // Retorna todos los productos
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener los datos del producto para editar
    function editProductos($id) {
        $query = $this->db->prepare("SELECT id_producto, Nombre_producto, id_proveedor_fk, categoria, cantidad, talle, valor FROM producto WHERE id_producto = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC); 
    }

    // Actualizar el producto en la base de datos
    function updateProduct($id, $Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor, $imagen = null) {
       if ($imagen){
        $query = $this->db->prepare("UPDATE producto SET Nombre_producto = ?, id_proveedor_fk = ?, categoria = ?, cantidad = ?, talle = ?, valor = ?, imagen = ? WHERE id_producto = ?");
        $query->execute([$Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor, $imagen, $id]);
       } else {
        $query = $this->db->prepare("UPDATE producto SET Nombre_producto = ?, id_proveedor_fk = ?, categoria = ?, cantidad = ?, talle = ?, valor = ? WHERE id_producto = ?");
        $query->execute([$Nombre_producto, $id_proveedor_fk, $categoria, $cantidad, $talle, $valor, $id]);
       }
    }

    public function deleteProduct($id) {
        $query = $this->db->prepare('DELETE FROM producto WHERE id_producto = ?');
        return $query->execute([$id]); // Devuelve true si se eliminó correctamente
    }
}
