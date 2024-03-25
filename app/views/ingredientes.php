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
                <!-- listado de Productos -->
                <div id="contentList" class="mt-3">
                    <h4>
                        <i class="bi bi-cart-fill"></i>
                        Ingredientes
                        <button type="button" class="btn btn-dark btncolor float-end" id="btnAgregar">
                            <i class="bi bi-plus-circle"></i>
                            Agregar Ingrediente
                        </button>

                        <button type="button" class="btn btn-dark btncolor float-end" id="btnAgregar">
                            <a style="text-decoration: none; color: white;" href="<?php echo URL;?>productos"><i class="bi bi-plus-circle"></i>Regresar</a>
                        </button>
                    </h4>
                    <div class="col-auto d-flex">
                        <label class="col-form-label mx-3" for="autoSizingInput">Productos</label>
                        <select name="idproducto" id="idproducto" class="form-select">
                            <option value="todos">Todos</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <button type="button" class="btn btn-dark btncolor" id="btnFiltrar">Filtrar</button>
                    </div>
                    <hr>
                    <!-- Cuadro de busqueda -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="search" class="form-control"  aria-describedby="basic-addon2" id="txtSearch">
                                <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de cuadro de busqueda -->
                    <!-- Inicio de la tabla Productos-->
                    <div id="contentTable">
                        <table class="table">
                            <thead class="table-dark">
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Descripción</th>
                                <th>Costo Adicional</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td>Hamburguesa</td>
                                <td>Carne para hamburgues</td>
                                <td>2</td>
                                <td>
                                    <button type="button" class="btn btn-dark btncolor"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button type="button" class="btn btn-danger btncolor"><i class="fa-solid fa-trash"></i></button>
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
                <!--Incio de formulario de Ingredientes -->
                <div id="contentForm" class="mt-3 d-none">
                    <h4>
                    <i class="bi bi-cart-fill"></i>
                        Ingredientes
                    </h4>
                    <hr>
                    <form id="formIngredientes" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="idproducto" class="col-sm-2 col-form-label">Producto:</label>
                            <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="idproducto" id="idproducto_select">
                                    
                                </select>
                                <input type="hidden" name="idingrediente" id="idingrediente" value="0">
                            </div>
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

                        <button type="button" class="btn btn-secondary" id="btnCancelar"><i class="bi bi-x-circle-fill"></i> Cancelar</button>
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
    <script src="<?php echo URL;?>public_html/customjs/ingredientes.js"></script>
</body>
</html>