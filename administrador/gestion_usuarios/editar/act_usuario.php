<?php

include("../../../conexion.php");
header('Content-Type: text/html; charset=UTF-8');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$nombre = ucwords(mb_strtolower("$nombre"));
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$tipo = $_POST['tipo_user'];

$query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre_usuario='$nombre' AND usuario='$usuario'");
    $nr = mysqli_num_rows($query);

    if ($nr>=1) {
      echo "<script> alert('Ya existe un usuario con con los mismos datos, favor de verificarlo.'); </script>";
      echo "<meta http-equiv='refresh' content='0;url=editar_usuario.php' />";
    } else{

    $passband = strlen("$pass");

    if ($passband!=32){
    $pass=md5($pass);
    } 

$query = "UPDATE usuarios SET nombre_usuario = '$nombre', usuario = '$usuario' , contraseña = '$pass', tipo_usuario = '$tipo'
          WHERE id_usuario = $id";

mysqli_query($conexion, $query);

echo "<script> alert('Usuario actualizado.'); </script>";


}

?>

<html>
<head>
<meta http-equiv="refresh" content="0;url=../gestion_usuarios.html" />
</head>
<body>

</body>
</html>