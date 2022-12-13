
<?php

include("../conexion.php");
session_start();
$id=$_SESSION['usuario'];

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
                <form action="" method="POST">
                    <h2 class="text-center">Verificar Codigo</h2>
                    <p class="text-center">Introduce el código que te enviamos a tu correo electronico</p>
                    <div class="form-group">
                        <input class="form-control" type="code" name="code" placeholder="Introduce el codigo" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Confirmar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>


<?php

if(isset($_POST['check-email'])){
    $code = $_POST['code'];
    

    $query = mysqli_query($conexion, "SELECT * FROM usuarios where id_usuario = '$id' AND codigo='$code'");
    $nr = mysqli_num_rows($query);

    if ($nr==1) {
        echo "<script> alert('Cuenta verificada exitosamente, restablece tu contraseña'); window.location='rest_pass.php' </script>";
    }else{
        echo "<script> alert('Codigo incorrecto'); window.location='recuperar.php' </script>";
    }
}

?>

