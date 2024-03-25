<?php
include_once "app/models/db.class.php";
class Ingrediente extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select idingrediente, productos.idproducto, productos.nombre, ingredientes.descripcion, costo_adicional FROM ingredientes INNER JOIN productos ON ingredientes.idproducto = productos.idproducto ORDER BY ingredientes.idingrediente");
    }
    //Buscar todos por ID
    public function getAllId($id){
        return $this->executeQuery("Select idingrediente, productos.idproducto, productos.nombre, ingredientes.descripcion, costo_adicional FROM ingredientes INNER JOIN productos ON ingredientes.idproducto = productos.idproducto
        where productos.idproducto='$id'");
    }
    public function getNameById() {
        return $this->executeQuery("select idproducto,nombre from productos");
    }

    public function getIngredienteByName($nombre) {
        return $this->executeQuery("Select idingrediente, productos.idproducto, ingredientes.descripcion, costo_adicional FROM ingredientes INNER JOIN productos ON ingredientes.idproducto = productos.idproducto WHERE ingredientes.descripcion = '{$nombre}' ORDER BY ingredientes.idingrediente");
    }

    public function save($data) {
        return $this->executeInsert("insert into ingredientes set idproducto='{$data["idproducto"]}', descripcion='{$data["descripcion"]}', costo_adicional='{$data["costo_adicional"]}'");
    }

    public function getOneIngrediente($id) {
        return $this->executeQuery("Select idingrediente, productos.idproducto, ingredientes.descripcion, costo_adicional FROM ingredientes INNER JOIN productos ON ingredientes.idproducto = productos.idproducto WHERE ingredientes.idingrediente =  '{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update ingredientes set idproducto='{$data["idproducto"]}', descripcion='{$data["descripcion"]}', costo_adicional = '{$data["costo_adicional"]}' where idingrediente={$data["idingrediente"]}");
    }

    public function deleteIngrediente($id) {
        return $this->executeInsert("delete from ingredientes where idingrediente='$id'");
    }

    public function getByProducto($idProducto) {
        return $this->executeQuery("Select ingredientes.idingrediente, ingredientes.descripcion, ingredientes.costo_adicional, productos.nombre FROM ingredientes INNER JOIN productos ON ingredientes.idproducto = productos.idproducto WHERE ingredientes.idproducto = '{$idProducto}' ORDER BY ingredientes.idingrediente");
    }
}