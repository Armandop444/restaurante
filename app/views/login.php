<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public_html/css/bootstrap.min.css">
    <title>Restaurante</title>
</head>
<body class="bg-dark">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>   
                    <div class="card-body">
                        <form id="loginform" action="">

                        <div class="input-group flex-nowrap mb-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Usuario" aria-label="Usuario" aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group flex-nowrap mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña" aria-label="Password" aria-describedby="addon-wrapping">
                        </div>
                        <div class="alert alert-danger d-none" role="alert" id="mensaje"> 
                        </div>
                        <div class="d-grid gap-2 mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>