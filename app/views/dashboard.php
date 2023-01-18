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
            <div class="col-10" style="max-height: 780px;overflow-y: scroll;">
                <section id="contenido">
                    <div class="row ">
                        <!-- Carousel -->
                        <div class="col-12">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="<?php echo URL; ?>public_html/img/polloalhorno.jpg" class="w-100"
                                            alt="..." style="height: 400px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?php echo URL; ?>public_html/img/tacos.png" class="w-100" alt="..."
                                            style="height: 400px;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?php echo URL; ?>public_html/img/carne.jpg" class="w-100" alt="..."
                                            style="height: 400px;">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>

                        <!-- cards -->
                        <div class="row row-cols-1 row-cols-md-2 my-4 mx-auto">
                            <div class="col mb-4">
                                <div class="card bg-gray" style="min-height: 500px; max-height: 500px;">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">Onigiri</h5>
                                        <p class="card-text">Onigiri también conocido como Omusubi es un plato japonés
                                            que consiste en una bola de arroz rellena o mezclada con otros ingredientes.
                                            Suele tener forma triangular u oval, y a veces está envuelta en una pequeña
                                            tira de alga nori.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Actualizado hace 3 mins</small>
                                    </div>
                                    <img src="<?php echo URL; ?>public_html/img/onigiri.jpg" class="card-img-top"
                                        alt="..." style="height: 300px;">
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="card bg-gray" style="min-height: 500px; max-height: 500px;">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">Falafel</h5>
                                        <p class="card-text">Faláfel o falafel es una croqueta de garbanzos o habas.
                                            Suele consumirse en Oriente Medio, y en los últimos años se ha dado a
                                            conocer en occidente gracias a los restaurantes especializados en comida
                                            oriental y vegetariana. Tradicionalmente se sirve con salsa de yogur o de
                                            tahini, en pan de pita o bien como entrada.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Actualizado hace 10 mins</small>
                                    </div>
                                    <img src="<?php echo URL; ?>public_html/img/falafel.jpg" class="card-img-top"
                                        alt="..." style="height: 300px;">
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="card bg-gray" style="min-height: 500px; max-height: 500px;">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">Hamburguesa</h5>
                                        <p class="card-text">Una hamburguesa es un sándwich hecho a base de carne molida
                                            o de origen vegetal, ​ aglutinada en forma de filete cocinado a la parrilla
                                            o a la plancha, aunque también puede freírse u hornearse. Fuera del ámbito
                                            de habla hispana, es más común encontrar la denominación estadounidense
                                            burger, acortamiento de hamburger.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Actualizado hace 1 hrs</small>
                                    </div>
                                    <img src="<?php echo URL; ?>public_html/img/hamburguesa.jpg" class="card-img-top"
                                        alt="..." style="height: 300px;">
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="card bg-gray" style="min-height: 500px; max-height: 500px;">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">Filete de pescado con verduras al horno
                                        </h5>
                                        <p class="card-text">El pescado es una de las proteínas con mayor contenido de
                                            Omega 3. Atrévete a preparar esta deliciosa variante para compartir con toda
                                            tu familia.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Actualizado hace 2 hrs</small>
                                    </div>
                                    <img src="<?php echo URL; ?>public_html/img/pescadoalhorno.jpg" class="card-img-top"
                                        alt="..." style="height: 300px;">
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

</html>