<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'C:\xampp\composer\vendor\autoload.php';

if(filter_has_var(INPUT_POST, "email")){
  $email = $_POST['email'];
  $emailLimpio = filter_var($email,
  FILTER_SANITIZE_EMAIL);

  echo $emailLimpio;
}


include("../conexion.php");
header('Content-Type: text/html; charset=UTF-8');
session_start();
if(isset($_SESSION['contraseña'])){
  unset($_SESSION['contraseña']);
}

  if (isset($_POST['Ingresar'])) {
    $nombre = $_POST['nombre'];
    $nombre = ucwords(mb_strtolower("$nombre"));
    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $intentos ='0';

    
    
    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre_usuario='$nombre' AND usuario='$user'");
    $nr = mysqli_num_rows($query);

    //AQUI EMÍEZA LO DE LA VERIFICACION DE CONTRASEÑA y mas abajo en el contest="0" lo cambie a 0 porque se quedaba la pagina estatica esperando
    if ($nr>=1) {
      echo "<script> alert('Ya existe un usuario con con los mismos datos, favor de verificarlo.'); </script>";
      echo "<meta http-equiv='refresh' content='0;url=formulario.html' />";
    }elseif(!preg_match('`[@]`',$email)){
      echo "<script> alert('El email no contiene un @'); </script>"; "window.location='formulario.html' </script>";
    }else{
      $pass = substr(number_format(time() * rand(), 0, '', ''), 0, 8);
      $_SESSION['contraseña'] = $pass;
      $pass = md5($pass);
      $query = "INSERT INTO usuarios (id_usuario, nombre_usuario, usuario, email,contraseña,tipo_usuario,estatus,intentos,codigo,primera_vez)
      VALUES ('', '$nombre', '$user', '$email','$pass','$tipo','2','0',NULL,'1')";
      mysqli_query($conexion, $query);
      echo "<script> alert('Usuario registrado'); window.location='generacion_contraseña.php' </script>";
    }

    }
          
  

?>

<html>
<head>
<meta http-equiv="refresh" content="0;url=formulario.html" />
</head>
<body>

</body>
</html>