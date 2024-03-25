<?php
include_once "app/models/db.class.php";
class Productos extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select productos.idproducto, restaurantes.idrestaurante, nombre, restaurantes.nombre_restaurante, nombre, productos.descripcion, precio FROM productos INNER JOIN restaurantes ON productos.idrestaurante = restaurantes.idrestaurante ORDER BY nombre");
    }

    public function getProductoByName($nombre) {
        return $this->executeQuery("Select idproducto, restaurantes.idrestaurante, nombre, restaurantes.nombre_restaurante, nombre, descripcion, precio FROM productos INNER JOIN restaurantes ON productos.idrestaurante = restaurantes.idrestaurante where nombre='{$nombre}' ORDER BY nombre");
    }

    public function save($data, $img1, $img2, $img3) {
        return $this->executeInsert("insert into productos set idrestaurante='{$data["idrestaurante"]}', nombre='{$data["nombre"]}', descripcion='{$data["descripcion"]}', foto1='{$img1}', foto2='{$img2}', foto3='{$img3}', precio='{$data["precio"]}'");
    }

    public function getOneProducto($id) {
        return $this->executeQuery("Select idproducto, idrestaurante, nombre, descripcion, foto1, foto2, foto3, precio from productos where idproducto='{$id}'");
    }

    public function update($data, $img1, $img2, $img3) {
        return $this->executeInsert("update productos set idrestaurante='{$data["idrestaurante"]}', nombre='{$data["nombre"]}', descripcion='{$data["descripcion"]}', foto1='{$img1}', foto2='{$img2}', foto3='{$img3}', precio='{$data["precio"]}' where idproducto={$data["idproducto"]}");

    }

    public function deleteProducto($id) {
        return $this->executeInsert("delete from productos where idproducto='$id'");
    }

}