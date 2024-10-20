<?php
class ProductView {
    // Mostrar la lista de productos y proveedores
    function HomeViews($products, $suppliers) {

        include 'Template/product/product_list.phtml';   
    }
    // Mostrar detalle de producto
    function ProductDetailView($product) {
        include 'Template/product/product_detail.phtml'; 
    }
    function formView(){
        $supplierModel = new SupplierModel();
        $suppliers = $supplierModel->getSupplier(); 
        include 'Template/productABM/formadd.phtml';
    }
    function addProductView() {
        include 'Template/productABM/listABM.phtml';
     }
    
     public function listView($productos) {
        include 'Template/productABM/listABM.phtml';
    }
    function editProductView($row){
       include 'Template/productABM/formEdit.phtml';
    }
}
?>