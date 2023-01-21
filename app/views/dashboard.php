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
            <div class="col-10 overflow-auto" style="max-height: 780px">
                <section id="contenido">
                    <div class="row ">
                        <div class="col-12">
                            <div class="card bg-gray" style="min-height: 350px; max-height: 350px;">
                                <canvas id="barras" class="mx-auto"
                                    style="min-height: 330px; max-height: 330px;"></canvas>
                            </div>
                        </div>

                        <!-- cards -->
                        <div class="row row-cols-1 row-cols-md-2 my-4 mx-auto w-100">
                            <div class="col">
                                <div class="card bg-gray" style="min-height: 350px">
                                    <canvas id="pie" class="mx-auto my-3"></canvas>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card bg-gray" style="min-height: 350px">
                                    <canvas id="donut" class="mx-auto my-3"></canvas>
                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/dashboard.js"></script>


</html>