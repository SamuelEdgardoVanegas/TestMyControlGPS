<?php
include_once "app/models/ingreforms.php";

class IngreformsController extends Controller {
    private $ingreform;
    public function __construct($parametro) {
        $this->ingreform=new Ingreform();
        parent::__construct("ingreforms",$parametro,true);
    }

    public function getAll() {
        $records=$this->ingreform->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }

    public function save() {

        if ($_POST["idingrediente"]==0) {
            $datosIngrediente=$this->ingreform->getOneIngreForms($_POST["descripcion"]);
            if (count($datosIngrediente)>0){
                $info=array('success'=>false, 'msg'=>"El ingrediente ya existe.");
            } else {
                $records=$this->ingreform->save($_POST);
                $info=array('success'=>true, 'msg'=>"El ingrediente se ha guardado con éxito.");
            }
        } else {
            $records=$this->ingreform->update($_POST);
            $info=array('success'=>true, 'msg'=>"El ingrediente se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneIngreForms() {
        $id = $_GET["id"];
        $record = $this->ingreform->getOneIngreForms($id);
        if ($record) {
            $info = array('success' => true, 'record' => $record);
        } else {
            $info = array('success' => false, 'msg' => "No se encontró el ingrediente.");
        }
        echo json_encode($info);
    }

    public function deleteIngreForm() {
        $records=$this->ingreform->deleteIngreForm($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado el ingrediente con éxito.");
        echo json_encode($info);
    }
    
}