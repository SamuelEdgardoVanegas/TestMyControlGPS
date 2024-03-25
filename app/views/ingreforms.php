<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "app/views/sections/css.php"; ?>
    <title>My ControlGPS</title>
</head>
<body>
    <div class="dashboard">
        <!--Todos los elementos del encabezado-->
        <section id="encabezado">
            <?php include_once "app/views/sections/header.php"; ?>
        </section>
        <div class="main">
        <!--Opciones de menu-->
            <section id="menu">
                <?php include_once "app/views/sections/menu.php"; ?>
            </section>
            <!-- Todos los elementos que varian-->
            <section id="contenido" class="container">
                <!--Incio de formulario de Productos -->
                <div id="contentForm" class="mt-3">
                    <h4>
                    <i class="bi bi-cart-fill"></i>
                        Agregar un Ingrediente
                    </h4>
                    <hr>
                    <form id="formIngredientes" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <input type="hidden" name="idingrediente" id="idingrediente" value="0">
                            <label for="idproducto" class="col-sm-2 col-form-label">Producto:</label>
                            <input type="number" name="idproducto" id="idproducto" class="form-select">
                        </div>
                        <div class="row mb-3">
                            <label for="descripcion" class="col-sm-2 col-form-label">Descripcion:</label>
                            <div class="col-sm-10">
                                <textarea name="descripcion" id="descripcion" rows="3" class="form-control"></textarea>
                            </div>
                        </div>                       
                        <div class="row mb-3">
                            <label for="costo_adicional" class="col-sm-2 col-form-label">Costo adicional:</label>
                            <div class="col-sm-10">
                                <input type="float" class="form-control" id="costo_adicional" name="costo_adicional" required>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary" id="btnCancelar" onclick="cancelarAgregarIngre"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-hdd"></i> Guardar</button>
                    </form>
                    
                </div>
                <!--Fin de formulario de Ingredientes -->
                
            </section>
        </div>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script>
        const idproducto=<?php echo $_GET["id"];?>;
        const idingrediente=<?php echo $_GET["id"];?>;
        const modoEditar=<?php echo isset($_GET['editar']) ? 'true' : 'false'; ?>
    </script>
    <script src="<?php echo URL;?>public_html/customjs/ingreforms.js"></script>
</body>
</html>