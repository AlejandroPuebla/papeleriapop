<?php

include("../conexion.php");

session_start();
$pass=$_SESSION['contraseña'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style20.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="formulario.html" method="POST">
                    <h2 class="text-center">Contraseña</h2>
                    <p class="text-center">Se genero una contraseña aleatoria</p>
                    <div class="form-group">
                        <input class="form-control" type="code" name="code" placeholder="<?php echo $pass; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Finalizar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>

</html>