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
    <div class="restaurantes">
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
                <!-- listado de Restaurantes -->
                <div id="contentList" class="mt-3">
                    <h4>
                        <i class="bi bi-cart-fill"></i>
                        Restaurantes
                        <button type="button" class="btn btn-dark btncolor float-end" id="btnAgregar">
                            <i class="bi bi-plus-circle"></i>
                            Agregar Restaurante
                        </button>
                    </h4>
                    <hr>
                    <!-- Cuadro de busqueda -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="search" class="form-control"  aria-describedby="basic-addon2" id="txtSearch">
                                <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de cuadro de busqueda -->
                    <!-- Inicio de la tabla-->
                        <div id="contentTable">
                            <table class="table">
                                <thead class="table-dark">
                                    <th>Código</th>
                                    <th>Restaurante</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Contacto</th>
                                    <th>Foto</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Latitud</th>
                                    <th>Longitud</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    <td>1</td>
                                    <td>Charly Boys Pizza</td>
                                    <td>Santa Ana</td>
                                    <td>2488 9630</td>
                                    <td>7455 8920</td>
                                    <td>img</td>
                                    <td>20/03/2024</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>
                                        <button type="button" class="btn btn-dark btncolor"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn btn-danger btncolor"><i class="bi bi-trash"></i></button>
                                    </td>
                                    
                                </tbody>
                                <td colspan="10">
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <div class="map-thumbnail" id="map2" style="width: 1000px; height: 350px;">

                                        
                                    </div>
                                </div>
                                </td>
                                
                            </table>
                            
                        </div>
                    <!-- Fin de la tabla Restaurantes-->
                    <!--Paginacion -->
                    <div class="row">
                        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Fin de paginacion -->
                </div>
                <!-- Fin del listado de Restaurante -->
                <!--Incio de formulario de Restaurantes -->
                <div id="contentForm" class="mt-3 d-none">
                    <h4>
                    <i class="bi bi-cart-fill"></i>
                        Restaurantes
                    </h4>
                    <hr>
                    <form id="formRestaurante" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="nombre_restaurante" class="col-sm-2 col-form-label">Restaurante:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_restaurante" name="nombre_restaurante" required>
                                <input type="hidden" name="idrestaurante" id="idrestaurante" value="0">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="direccion" class="col-sm-2 col-form-label">Dirección:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telefono" class="col-sm-2 col-form-label">Teléfono:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="contacto" class="col-sm-2 col-form-label">Contacto:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contacto" name="contacto" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="foto" class="col-sm-2 col-form-label">Foto:</label>
                            <div class="col-sm-10">
                                <div class="img-thumbnail" id="divfoto" style="width:200px; height:200px">

                                </div>
                                <span>
                                    Haga click para seleccionar la foto.
                                </span>
                                <input type="file" name="foto" id="foto" class="d-none">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="fecha_ingreso" class="col-sm-2 col-form-label">Fecha de Ingreso:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="latitud" class="col-sm-2 col-form-label">Latitud:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="latitud" name="latitud" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="longitud" class="col-sm-2 col-form-label">Longitud:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="longitud" name="longitud" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="map" class="col-sm-2 col-form-label">Mapa:</label>
                            <div class="col-sm-10">
                                <div class="map-thumbnail" id="map" style="width:600px; height:300px;">

                                
                            </div>
                            <!-- <input id="search" type="text" class="input" placeholder="Buscar en el mapa"> -->
                        </div>

                        <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-hdd"></i> Guardar</button>
                    </form>
                    
                </div>
                <!--Fin de formulario de Restaurantes -->
                
            </section>
        </div>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/restaurantes.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPKvPHu2qiRwMbrwzolMEjzLP7RIRnU0I&libraries=places&callback=initMap" defer>
    </script>
</body>
</html>