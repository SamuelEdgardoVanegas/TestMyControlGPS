<?php
include_once "app/models/db.class.php";
class Restaurante extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select * FROM restaurantes;");
    }

    public function getRestauranteByName($nombre) {
        return $this->executeQuery("Select idrestaurante, nombre_restaurante, direccion, telefono, contacto, foto, fecha_ingreso, latitud, longitud from restaurantes where nombre_restaurante='{$nombre}'");
    }

    public function save($data, $img) {
        return $this->executeInsert("insert into restaurantes set nombre_restaurante='{$data["nombre_restaurante"]}', direccion='{$data["direccion"]}', telefono='{$data["telefono"]}', contacto='{$data["contacto"]}', fecha_ingreso='{$data["fecha_ingreso"]}', foto='{$img}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}'");
    }

    public function getOneRestaurante($id) {
        return $this->executeQuery("Select idrestaurante, nombre_restaurante, direccion, telefono, contacto, fecha_ingreso, foto, latitud, longitud from restaurantes where idrestaurante='{$id}'");
    }

    public function update($data, $img) {
        return $this->executeInsert("update restaurantes set nombre_restaurante='{$data["nombre_restaurante"]}', direccion='{$data["direccion"]}', telefono='{$data["telefono"]}', contacto='{$data["contacto"]}', fecha_ingreso='{$data["fecha_ingreso"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', foto= if('{$img}'='',foto,'{$img}') where idrestaurante={$data["idrestaurante"]}");
    }

    public function deleteRestaurante($id) {
        return $this->executeInsert("delete from restaurantes where idrestaurante='$id'");
    }

    /*public function getReportesRestaurantes($data) {
        $condicion="";
        if ($data["idproducto"]!="0") {
            $condicion.=" and a.idproducto='{$data["idproducto"]}'";
        }
        if ($data["idrestaurante"]!="0") {
            $condicion.=" and idrestaurante='{$data["idrestaurante"]}'";
        }
        return $this->executeQuery("Select idrestaurante, date_format(fecha_ingreso,'%d-%M-%Y') as fecha_ingreso, 
        nombre_restaurante, direccion, telefono, contacto, a.idproducto, a.nombre, a.descripcion, a.precio 
        from restaurantes inner join productos a using(idrestaurante)
        where 1=1 $condicion
        order by fecha");
    }*/
    // Obtener fechas
    public function getFechas() {
        return $this->executeQuery("SELECT DISTINCT DATE_FORMAT(fecha_ingreso, '%m %M %Y') as fecha_ingreso FROM restaurantes");
    }
    //Funcion para el reporte
    public function getReportesRestaurantes($data){
        $condicion="";
        if ($data["idproducto"]!="0") {
            $condicion.=" and b.idproducto='{$data["idproducto"]}'";
        }
        if ($data["idrestaurante"]!="0"){
            $condicion.=" and a.idrestaurante='{$data["idrestaurante"]}'";
        }
        if (!empty($data["rango_fechas"])) {
            list($fechaInicio, $fechaFin) = $data["rango_fechas"];
            $condicion .= " and a.fecha_ingreso BETWEEN '$fechaInicio' AND '$fechaFin'";
        }
        return $this->executeQuery("Select a.idrestaurante, date_format(a.fecha_ingreso,'%d-%m-%Y') as fecha_ingreso, 
        a.nombre_restaurante, a.direccion, a.telefono, a.contacto, b.idproducto, b.nombre, b.descripcion, b.precio 
        from restaurantes a inner join productos b using(idrestaurante) WHERE  1=1 $condicion");
    }
}