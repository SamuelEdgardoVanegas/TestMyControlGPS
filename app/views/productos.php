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
        <!-- Todos los elementos del encabezado -->
        <section id="encabezado">
            <?php include_once "app/views/sections/header.php"; ?>
        </section>
        <div class="main">
            <!-- Opciones de menú -->
            <section id="menu">
                <?php include_once "app/views/sections/menu.php"; ?>
            </section>
            <!-- Todos los elementos que varían -->
            <section id="contenido" class="container">
                <!-- Modal Content --> 
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1>Ingredientes</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- START MODAL BODY -->
                            <div class="modal-body">
                                <!-- Inicio de la tabla -->
                                <div class="contentT" id="contentTableC">
                                    <table class="table table-hover table-striped">
                                        <thead class="table-dark">
                                            <th>Id Ingrediente</th>
                                            <th>Producto</th>
                                            <th>Ingrediente</th>
                                            <th>Costo Adicional</th>
                                            <th>&nbsp;</th>
                                        </thead>
                                        <tbody>
                                            <td>1</td>
                                            <td>Prueba</td>
                                            <td>Prueba ingrediente</td>
                                            <td>Prueba costo</td>
                                            <td>
                                                <button type="button" class="btn btn-dark btncolor"><i class="fa-solid fa-pen-to-square"></i></button>
                                                <button type="button" class="btn btn-danger btncolor"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fin de la tabla -->
                                <!-- Paginación -->
                                
                                <!-- Fin de la paginación -->

                                <!--Incio de formulario de Ingredientes -->
                                <div id="contentFormIngre" class="mt-3 d-none">
                                    <h4>
                                    <i class="bi bi-cart-fill"></i>
                                        Actualizar Ingrediente
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

                                        <button type="button" class="btn btn-secondary" id="btnCancelarIngre"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="btnAgregarIngre"><i class="bi bi-hdd"></i> Guardar</button>
                                    </form>
                                    
                                </div>
                                <!--Fin de formulario de Ingredientes -->
                            </div>
                            <!-- END OF MODAL CONTENT -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btncolor" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Modal Content -->
                <!-- listado de Productos -->
                <div id="contentList" class="mt-3" >
                    <h4>
                        <i class="bi bi-cart-fill"></i>
                        Productos
                        <button type="button" class="btn btn-dark btncolor float-end" id="btnAgregar">
                            <i class="bi bi-plus-circle"></i>
                            Agregar Producto
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
                    <!-- Inicio de la tabla Productos-->
                        <div id="contentTable" >
                            <table class="table">
                                <thead class="table-dark">
                                    <th>Código</th>
                                    <th>Nombre Restaurante</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    <td>1</td>
                                    <td>Pollo Campestre</td>
                                    <td>Hamburguesa</td>
                                    <td>Las mejores hamburguesas</td>
                                    <td>$12</td>
                                    <td>
                                        <button type="button" class="btn btn-dark btncolor"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btncolor"><i class="fa-solid fa-trash"></i></button>
                                        <button type="button" class="btn btn-danger btncolor"><i class="fa-solid fa-plus"></i></button>
                                    </td>
                                </tbody>
                            </table>
            
                        </div>
                    <!-- Fin de la tabla Productos-->
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

                <!-- Fin del listado de Productos -->
                <!--Incio de formulario de Productos -->
                <div id="contentForm" class="mt-3 d-none">
                    <h4>
                    <i class="bi bi-cart-fill"></i>
                        Productos
                    </h4>
                    <hr>
                    <form id="formProductos" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="idrestaurante" class="col-sm-2 col-form-label">Restaurante:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="idrestaurante" id="idrestaurante">
                                
                            </select>
                            <input type="hidden" name="idproducto" id="idproducto" value="0">
                        </div>
                    </div>
                        <div class="row mb-3">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="descripcion" class="col-sm-2 col-form-label">Descripcion:</label>
                            <div class="col-sm-10">
                                <textarea name="descripcion" id="descripcion" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="foto1" class="col-sm-2 col-form-label">Foto:</label>
                            <div class="col-sm-10">
                                <div class="img-thumbnail" id="divfoto1" style="width:200px; height:200px">

                                </div>
                                <span>
                                    Haga click para seleccionar la foto.
                                </span>
                                <input type="file" name="foto1" id="foto1" class="d-none">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="foto2" class="col-sm-2 col-form-label">Foto:</label>
                            <div class="col-sm-10">
                                <div class="img-thumbnail" id="divfoto2" style="width:200px; height:200px">

                                </div>
                                <span>
                                    Haga click para seleccionar la foto.
                                </span>
                                <input type="file" name="foto2" id="foto2" class="d-none">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="foto3" class="col-sm-2 col-form-label">Foto:</label>
                            <div class="col-sm-10">
                                <div class="img-thumbnail" id="divfoto3" style="width:200px; height:200px">

                                </div>
                                <span>
                                    Haga click para seleccionar la foto.
                                </span>
                                <input type="file" name="foto3" id="foto3" class="d-none">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="precio" class="col-sm-2 col-form-label">Precio:</label>
                            <div class="col-sm-10">
                                <input type="float" class="form-control" id="precio" name="precio" required>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-hdd"></i> Guardar</button>
                    </form>
                    
                </div>
                <!--Fin de formulario de Productos -->
                
            </section>
        </div>
    <!--Todos los elementos del pie del sitio-->
        <section id="pie">
            <?php include_once "app/views/sections/footer.php"; ?>
        </section>
    </div>
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/productos.js"></script>
</body>
</html>