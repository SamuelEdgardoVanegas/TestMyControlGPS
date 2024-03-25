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
            <section id="contenido" style="background-image: url(<?php echo URL;?>public_html/images/background.jpg); margin-left: 110px; background-blend-mode: multiply; background-color: rgba(0, 0, 0, 0.8); background-size: cover; background-position: center; width: 100%; height: 100vh;">
                <h1 style="color: white; font-size: 5rem; text-align: end;"><img src="<?php echo URL;?>public_html/images/mycontrolgps_cover.jpg" style="width: 40%;"></h1>
                <h1 style="color: white; font-size: 3rem; margin-top: -8%; margin-left: 5%; font-style: sans-serif;">Website to add Restaurants</h1>
            </section>
        </div>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer_user.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts_user.php"; ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
</body>
</html>