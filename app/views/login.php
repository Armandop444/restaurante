<!DOCTYPE html>
<html>
<head>
    <?php include_once "app/views/components/css.php" ?>
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
                            <input type="text" name="user" class="form-control" placeholder="Usuario" aria-label="Usuario" aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group flex-nowrap mb-4">
                            <input type="password" name="pass" class="form-control" placeholder="Contraseña" aria-label="Password" aria-describedby="addon-wrapping">
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
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/api.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/login.js"></script>
</html>