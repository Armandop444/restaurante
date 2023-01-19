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
                    <div id="panelDatosUser" class="row bg-gray mx-auto content-panel">
                        <!-- Titulo -->
                        <div class="col-12 pt-4">
                            <h1 class="font-weight-bold"><i class="mr-3 fa-solid fa-user-tie"></i>Usuarios</h1>
                        </div>
                        <hr class="w-100" style="height: 2px; background: darkgrey">
                        <!-- Boton Agregar Restaurante -->
                        <div class="d-flex flex-column col-12 pb-3">
                            <button id="btnAgregar" type="button" class="btn btn-success align-self-end"><i
                                    class="fa-solid fa-user-plus mr-2"></i>Agregar Usuario</button>
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
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Tipo</th>
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
                    <div id="panelFormularioUser" class="row bg-gray mx-auto content-panel d-none">
                        <!-- Titulo -->
                        <div class="col-12 pt-4">
                        <h1 class="font-weight-bold"><i class="mr-3 fa-solid fa-user-tie"></i>Usuarios</h1>
                        </div>
                        <hr class="w-100" style="height: 2px; background: darkgrey">
                        <div class="col-8 mx-auto" style="width: 100%;">
                            <form id="form" class="form-horizontal" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="id_usr" id="id_usr" value="0">
                                <div class="form-group row">
                                    <label for="user" class="col-sm-2 col-form-label">Nombre Usuario</label>
                                    <div class="col-sm-6 ">
                                        <input type="text" class="form-control" id="user" name="user" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pass" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-6 ">
                                        <input type="password" class="form-control" id="pass" name="pass" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tipo" class="col-sm-2 col-form-label">Tipo de Usuario</label>
                                    <div class="col-sm-6">
                                        <select name="tipo" id="tipo" class="form-control">
                                            <option value="1" selected>Administrador</option>
                                            <option value="2">Usuario</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>

                                    <div class="col-sm-6">
                                        <div id="divFoto" class="img-thumbnail" style="width: 200px;height: 200px;">
                                        </div>
                                        <span id="spanClick">Haz click para selccionar foto</span>
                                        <input type="file" class="form-control d-none" id="foto" name="foto">
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
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/usuarios.js"></script>

</html>