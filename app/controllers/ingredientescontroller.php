<?php
include_once "app/models/ingredientes.php";

class IngredientesController extends Controller {
    private $ingrediente;
    public function __construct($parametro) {
        $this->ingrediente=new Ingrediente();
        parent::__construct("ingredientes",$parametro,true);
    }

    public function getAll() {
        $records=$this->ingrediente->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }
    public function getAllId() {
        $records=$this->ingrediente->getAllId($_GET["id"]);
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
    public function getNameById() {
        $records=$this->ingrediente->getNameById();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
    public function save() {

        if ($_POST["idingrediente"]==0) {
            $datosIngrediente=$this->ingrediente->getIngredienteByName($_POST["descripcion"]);
            if (count($datosIngrediente)>0){
                $info=array('success'=>false, 'msg'=>"El ingrediente ya existe.");
            } else {
                $records=$this->ingrediente->save($_POST);
                $info=array('success'=>true, 'msg'=>"El ingrediente se ha guardado con éxito.");
            }
        } else {
            $records=$this->ingrediente->update($_POST);
            $info=array('success'=>true, 'msg'=>"El ingrediente se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneIngrediente() {
        $records=$this->ingrediente->getOneIngrediente($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El ingrediente no existe.');
        }
        echo json_encode($info);
    }

    public function deleteIngrediente() {
        $records=$this->ingrediente->deleteIngrediente($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado el ingrediente con éxito.");
        echo json_encode($info);
    }

    public function getByProducto() {
        $idProducto = $_GET["idproducto"];
        $records = $this->ingrediente->getByProducto($idProducto);
        if ($records) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'No se encontraron ingredientes para este producto');
        }
        echo json_encode($info);
    }
     // Render pagina desde la clase de Addingredientes de Controller de addingredientes
    public function AddIngredientes() {
        $this->view->render("addingredientes");
    }
    
}