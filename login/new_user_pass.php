<?php

include("../conexion.php");
session_start();
if(isset($_SESSION['new_user'])){
    unset($_SESSION['new_user']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style20.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="new_user_pass2.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Cambiar contraseña</h2>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Nueva contraseña" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Vuelve a escribir la contraseña" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Cambiar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
