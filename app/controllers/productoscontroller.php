<?php
include_once "app/models/productos.php";

class ProductosController extends Controller {
    private $producto;
    public function __construct($parametro) {
        $this->producto=new Productos();
        parent::__construct("productos",$parametro,true);
    }

    public function getAll() {
        $records=$this->producto->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        //Proceso para guardar el archivo 
        $img1="";
        $img2="";
        $img3="";
        if (isset($_FILES)) {
            //Primera imagen
            if (is_uploaded_file($_FILES["foto1"]["tmp_name"])) {
                if (($_FILES["foto1"]["type"]=="image/png") ||
                    ($_FILES["foto1"]["type"]=="image/jpeg")) {
                        copy($_FILES["foto1"]["tmp_name"],
                        __DIR__."/../../public_html/fotos/".$_FILES["foto1"]["name"])
                        or die("No se pudo copiar el archivo");
                        $img1=URL."public_html/fotos/".$_FILES["foto1"]["name"];
                    }
            }
            //Segunda imagen
            if (is_uploaded_file($_FILES["foto2"]["tmp_name"])) {
                if (($_FILES["foto2"]["type"]=="image/png") ||
                    ($_FILES["foto2"]["type"]=="image/jpeg")) {
                        copy($_FILES["foto2"]["tmp_name"],
                        __DIR__."/../../public_html/fotos/".$_FILES["foto2"]["name"])
                        or die("No se pudo copiar el archivo");
                        $img2=URL."public_html/fotos/".$_FILES["foto2"]["name"];
                    }
            }
            //Tercera imagen
            if (is_uploaded_file($_FILES["foto3"]["tmp_name"])) {
                if (($_FILES["foto3"]["type"]=="image/png") ||
                    ($_FILES["foto3"]["type"]=="image/jpeg")) {
                        copy($_FILES["foto3"]["tmp_name"],
                        __DIR__."/../../public_html/fotos/".$_FILES["foto3"]["name"])
                        or die("No se pudo copiar el archivo");
                        $img3=URL."public_html/fotos/".$_FILES["foto3"]["name"];
                    }
            }
        }

        if ($_POST["idproducto"]==0) {
            $datosProducto=$this->producto->getProductoByName($_POST["nombre"]);
            if (count($datosProducto)>0){
                $info=array('success'=>false, 'msg'=>"El producto ya existe.");
            } else {
                $records=$this->producto->save($_POST,$img1, $img2, $img3);
                $info=array('success'=>true, 'msg'=>"El producto se ha guardado con éxito.");
            }
        } else {
            $records=$this->producto->update($_POST,$img1, $img2, $img3);
            $info=array('success'=>true, 'msg'=>"El producto se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneProducto() {
        $records=$this->producto->getOneProducto($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El producto no existe.');
        }
        echo json_encode($info);
    }

    public function deleteProducto() {
        $records=$this->producto->deleteProducto($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado el producto con éxito.");
        echo json_encode($info);
    }
}