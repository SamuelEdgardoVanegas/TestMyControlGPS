<?php
include_once "app/models/db.class.php";
class Ingreform extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select idingrediente, productos.idproducto, productos.nombre, ingredientes.descripcion, costo_adicional FROM ingredientes INNER JOIN productos ON ingredientes.idproducto = productos.idproducto ORDER BY ingredientes.idingrediente");
    }

    public function save($data) {
        return $this->executeInsert("insert into ingredientes set idproducto='{$data["idproducto"]}', descripcion='{$data["descripcion"]}', costo_adicional='{$data["costo_adicional"]}'");
    }

    public function getOneIngreForms($id) {
        return $this->executeQuery("Select idingrediente, productos.idproducto, ingredientes.descripcion, costo_adicional FROM ingredientes INNER JOIN productos ON ingredientes.idproducto = productos.idproducto WHERE ingredientes.idingrediente =  '{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update ingredientes set idproducto='{$data["idproducto"]}', descripcion='{$data["descripcion"]}', costo_adicional = '{$data["costo_adicional"]}' where idingrediente={$data["idingrediente"]}");
    }

    public function deleteIngreForm($id) {
        return $this->executeInsert("delete from ingredientes where idingrediente='$id'");
    }

}