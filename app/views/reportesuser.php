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
            <?php include_once "app/views/sections/header_user.php"; ?>
        </section>
        <div class="main">
            <!--Opciones de menu-->
            <section id="menu">
                <?php include_once "app/views/sections/menu_user.php"; ?>
            </section>
            <!-- Todos los elementos que varian-->
            <section id="contenido" class="container">
            <form class="row gy-2 gx-3 align-items-center">

                <label class="labelReportes" for="autoSizingInput">Desde el día:</label>
                <div>
                    <input class="dateinput" type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                </div>

                <label class="HDiatxt" for="autoSizingInput">Hasta el día:</label>
                <div>
                    <input class="dateinput" type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                </div>

                <div class="col-auto d-flex">
                    <label class="col-form-label" for="autoSizingInput">Restaurantes</label>
                    <select name="idrestaurante" id="idrestaurante" class="form-select">

                    </select>
                </div>
                <div class="col-auto d-flex">
                    <label class="col-form-label" for="autoSizingInput">Productos</label>
                    <select name="idproducto" id="idproducto" class="form-select">

                    </select>
                </div>
                
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" id="btnViewReport">Ver Reporte</button>
                </div>
                </form>
                <div class="row">
                    <iframe src="" frameborder="0" width="100%" height="400" id="framereporte"></iframe>
                </div>    
            </section>
        </div> 
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer_user.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts_user.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/reportesuser.js"></script>
</body>
</html>