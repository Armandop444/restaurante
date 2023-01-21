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
                    <div id="panelDatosRestaurante" class="row bg-gray mx-auto content-panel">
                        <!-- Titulo -->
                        <div class="col-12 pt-4">
                            <h1 class="font-weight-bold"><i class="mr-3 fa-solid fa-utensils"></i>Restaurantes</h1>
                        </div>
                        <hr class="w-100" style="height: 2px; background: darkgrey">
                        <!-- Boton Agregar Restaurante -->
                        <div class="d-flex flex-column col-12 pb-3">
                            <button id="btnAgregar" type="button" class="btn btn-success align-self-end"><i
                                    class="fa-solid fa-house-medical mr-2"></i>Agregar Restaurante</button>
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
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Direccion</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Contacto</th>
                                        <th scope="col">Fecha Ingreso</th>
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
                        <div class="col-10 w-100 mx-auto mb-5" id="mapTabla" style="height: 500px; "></div>
                    </div>
                    <!-- Panel Formulario -->
                    <div id="panelFormularioRestaurante" class="row bg-gray mx-auto content-panel d-none">
                        <!-- Titulo -->
                        <div class="col-12 pt-4">
                            <h1 class="font-weight-bold"><i class="mr-3 fa-solid fa-utensils"></i>Restaurantes
                            </h1>
                        </div>
                        <hr class="w-100" style="height: 2px; background: darkgrey">
                        <div class="col-6 col-md-5 d-flex flex-column ">
                            <form id="form" class="form-horizontal align-self-end" role="form"
                                enctype="multipart/form-data">
                                <input type="hidden" name="idrestaurante" id="idrestaurante" value="0">
                                <div class="form-group row row-cols-2">
                                    <div class="col-1 mx-auto" style="width: 100%;">
                                        <button type="button" class="btn btn-primary"
                                            id="btnCancelar">Cancelar</button>
                                    </div>
                                    <div class="col-1 mx-auto" style="width: 100%;">
                                        <button type="submit" class="btn btn-success "
                                            id="btnGuardar">Guardar</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre Restaurante</label>
                                    <div class="col-sm-10 ">
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="direccion" name="direccion"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contacto" class="col-sm-2 col-form-label">Contacto</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="contacto" name="contacto" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fechaI" class="col-sm-2 col-form-label">Fecha Ingreso</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="fechaI" name="fechaI" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lat" class="col-sm-2 col-form-label">Latitud</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="lat" name="lat" required>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="lon" class="col-sm-2 col-form-label">Longitud</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="lon" name="lon" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fechaI" class="col-sm-2 col-form-label">Foto</label>

                                    <div class="col-sm-10">
                                        <div id="divFoto" class="img-thumbnail" style="width: 200px;height: 140px;">
                                        </div>
                                        <span id="spanClick">Haz click para seleccionar foto</span>
                                        <input type="file" class="form-control d-none" id="foto" name="foto">
                                    </div>
                                </div>

                                <div class="alert alert-danger d-none" id="mensaje"></div>

                            </form>

                        </div>
                        <div class="col-md-4 col-lg-5 mx-5">
                            <div class="row">
                                <div class="col-12 w-100" id="mapForm" style="height: 400px; "></div>
                            </div>
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
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/restaurantes.js"></script>

</html>