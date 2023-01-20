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
                    <?php if ($_SESSION["id_usr"]=="1") {
                        include_once "app/views/components/menu.php";
                    } else {
                        include_once "app/views/components/menuuser.php";
                    }?>
                    
                </section>
            </div>
            <div class="col-10 overflow-auto" style="max-height: 780px;">
                <section id="contenido">
                    <div class="d-flex bg-gray" id="wrapper">
                        <div class="container-fluid">
                            <div class="content-panel mt-4 pb-3">
                                <div class="row mb-3 p3 m1">
                                    <div class="col-12">
                                        <h1 class="font-weight-bold"><i class="mr-3 fa-solid fa-file-signature"></i>Reportes</h1>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <div class="form-inline">
                                            <label for="restaurante">Restaurante:</label>
                                            <select class="form-control ml-2 mr-2" name="nombreR" id="nombreR"
                                                required></select>
                                            <label for="fecha">Fecha de Inicio</label>
                                            <input type="date" class="form-control ml-2 mr-2" id="fechaI" name="fechaI"
                                                required>
                                            <label for="fecha">Fecha de Fin</label>
                                            <input type="date" class="form-control ml-2 mr-2" id="fechaF" name="fechaF"
                                                required>
                                            <button type="button" class="btn btn-primary" id="btnReporte"
                                                name="btnReporte"><i class="fas fa-print"></i>Ver Reporte</button>

                                        </div>
                                    </div>
                                </div>
                                <iframe src="" width="100%" height="500" id="frameReporte"></iframe>
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
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/reportes.js"></script>

</html>