# TPE_Web2
Grupo 18 - Proyecto de control de compras

Integrantes: Maite Kuhn - Josefina Socobehere

Este proyecto consiste en realizar una base de datos que sirva para registrar las compras de mercaderia que se van a llevar a cabo para un local de indumentaria e identificar los proveedores de las mismas.

Para que se cumpla la relacion de 1 a N, cada producto podra conseguirse solo en un proveedor, mientras que los proveedores podran tener mas de un producto. Las tablas estan relacionadas mediante la clave foranea id_proveedor_fk que se encuentra en la tabla productos y la clave primaria id_proveedor que se encuentra en la tabla proveedores.

La tabla que se refiere a los productos ademas, llevara el control de cantidad, talle y valor de la prenda comprada, por unidad. La tabla del proveedor registra sus datos.