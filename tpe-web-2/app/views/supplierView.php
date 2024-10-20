<?php
class SupplierView {
    // Detalle de productos de un proveedor
    public function suppierDetailView($products) {
        include 'Template/supplier/supplier_detail.phtml';
    }

    // Lista de proveedores
    public function listViewSuppliers($suppliers) {
        include 'Template/suppliersABM/listSupplier.phtml';
    }

    // Formulario para agregar proveedor
    public function formSupplier() {
        include 'Template/suppliersABM/formaddSupplier.phtml';
    }

    // Vista para agregar proveedor
    public function addSupplierView() {
        include 'Template/suppliersABM/formaddSupplier.phtml';
    }

    // Vista para editar proveedor
    public function editSupplierView($row) {
        include 'Template/suppliersABM/formEditSupplier.phtml';
    }
}
