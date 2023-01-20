<!DOCTYPE html>
<html>

<head>
    <?php include_once "app/views/components/css.php" ?>
</head>

<body class="bg-dark">
    <div class="container-fluid">
        <section id="login">
            <?php include_once "app/views/components/login.php" ?>
        </section>
        <div class="row mx-2">
            <div class="col-2 list-group-item-dark">
                <section id="menu">
                    <?php include_once "app/views/components/menu.php" ?>
                </section>
            </div>
            <div class="col-10 overflow-auto" style="max-height: 780px;">
                <section id="contenido">
                    <!-- Panel Datos -->
                    <div id="panelDatosProductos" class="row bg-gray mx-auto content-panel">
                        <!-- Titulo -->
                        <div class="col-12 pt-4">
                            <h1 class="font-weight-bold"><i class="mr-3 fa-solid fa-cart-shopping"></i>Productos</h1>
                        </div>
                        <hr class="w-100" style="height: 2px; background: darkgrey">
                        <!-- Boton Agregar Restaurante -->
                        <div class="d-flex flex-column col-12 pb-3">
                            <button id="btnAgregar" type="button" class="btn btn-success align-self-end">
                                <i class="mr-2 fa-solid fa-cart-plus"></i>Agregar Producto</button>
                        </div>
                        <div class="alert alert-danger d-none" id="mensajeDatos"></div>
                        <!-- Tabla -->
                        <div id="contentTable" class="col-12">
                            <div class="input-group col-4 mb-1">

                                <span class="input-group-prepend">
                                    <button class="btn" type="button">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </span><input id="txtSearch" type="search" class="form-control" placeholder="Buscar">
                            </div>
                            <table class="table table-striped table-dark table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Restaurante</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!-- Paginacion -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Panel Formulario -->
                    <div id="panelFormularioProductos" class="row bg-gray mx-auto content-panel d-none">
                        <!-- Titulo -->
                        <div class="col-12 pt-4">
                            <h1 class="font-weight-bold"><i class="mr-3 fa-solid fa-cart-shopping"></i>Productos</h1>
                        </div>
                        <hr class="w-100" style="height: 2px; background: darkgrey">
                        <div class="col-8 mx-auto" style="width: 100%;">
                            <form id="form" class="form-horizontal" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="idproducto" id="idproducto" value="0">
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre Producto</label>
                                    <div class="col-sm-6 ">
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                                    <div class="col-sm-6 ">
                                        <input type="text" class="form-control" id="descripcion" name="descripcion"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nombreR" class="col-sm-2 col-form-label">Restaurante</label>
                                    <div class="col-sm-6">
                                        <select name="nombreR" id="nombreR" class="form-control" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                                    <div class="col-sm-6 ">
                                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="foto1" class="col-sm-2 col-form-label">Foto 1</label>
                                    <div class="col-sm-6">
                                        <div id="divFoto" class="img-thumbnail" style="width: 200px;height: 200px;">
                                        </div>
                                        <span id="spanClick">Haz click para seleccionar foto</span>
                                        <input type="file" class="form-control d-none" id="foto" name="foto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="foto2" class="col-sm-2 col-form-label">Foto 2</label>
                                    <div class="col-sm-6">
                                        <div id="divFoto2" class="img-thumbnail" style="width: 200px;height: 200px;">
                                        </div>
                                        <span id="spanClick2">Haz click para seleccionar foto</span>
                                        <input type="file" class="form-control d-none" id="foto2" name="foto2">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="foto3" class="col-sm-2 col-form-label">Foto 3</label>
                                    <div class="col-sm-6">
                                        <div id="divFoto3" class="img-thumbnail" style="width: 200px;height: 200px;">
                                        </div>
                                        <span id="spanClick3">Haz click para seleccionar foto</span>
                                        <input type="file" class="form-control d-none" id="foto3" name="foto3">
                                    </div>
                                </div>

                                <div class="alert alert-danger d-none" id="mensaje"></div>
                                <div class="form-group row">
                                    <div class="col-5 mx-auto" style="width: 100%;">
                                        <button type="button" class="btn btn-primary mr-3"
                                            id="btnCancelar">Cancelar</button>
                                        <button type="submit" class="btn btn-success mx-3"
                                            id="btnGuardar">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <section id="pie">
            <?php include_once "app/views/components/pie.php" ?>
        </section>
    </div>
</body>
<?php include_once "app/views/components/scripts.php" ?>
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/productos.js"></script>

</html>