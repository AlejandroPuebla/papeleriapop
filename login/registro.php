
<!--Esta clase se encarga de decidir si el usuario existe o no y que tipo de usuario es (administrador o usuario), 
para posteriormente dejarlo acceder al sistema-->

<?php

include("../conexion.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'C:\xampp\composer\vendor\autoload.php';

if(isset($_SESSION['usuario'])){
    unset($_SESSION['usuario']);
}

	if(isset($_POST['Ingresar'])){
			$usuario = $_POST['usuario'];
			$_SESSION['usuario']=$usuario;
			$contraseña = md5($_POST['contraseña']);
      $query = mysqli_query($conexion, "SELECT * FROM usuarios where usuario = '$usuario' AND contraseña='$contraseña'");
      $nr = mysqli_num_rows($query);
      

      if ($nr==1) {
        while ($tipo = mysqli_fetch_array($query)) {
            $id=$tipo['0'];
            $nombre=$tipo['1'];
            $usuario=$tipo['2'];
            $contra_band=$tipo['4'];
            $email=$tipo['3'];
            $t_user=$tipo['5'];
            $estatus=$tipo['6'];
            $intentos=$tipo['7'];
            $primera=$tipo['9'];
            $_SESSION['usuario']=$id;
        }

        

        if($primera==1){
          $_SESSION['new_user']=$id;
          echo "<script> window.location='new_user_pass.php' </script>";
        }elseif($t_user==2 && $estatus==1){
             $query = "UPDATE usuarios SET intentos ='0' WHERE id_usuario='$id'";
             mysqli_query($conexion, $query);
            echo "<script> alert('Bienvenido $nombre'); window.location='../usuario/inventario/inventario.html' </script>";
        }elseif($t_user==2 && $estatus==2){
          echo "<script> alert('Acceso denegado. Usuario inactivo.'); window.location='formulario.html' </script>";
        }elseif($t_user==1 && $estatus==1){
           $query = "UPDATE usuarios SET intentos ='0' WHERE id_usuario='$id'";
           mysqli_query($conexion, $query);
           
          echo "<script> alert('Bienvenid@ $nombre '); window.location='../administrador/gestion_usuarios/gestion_usuarios.html' </script>";
        }elseif($t_user==1 && $estatus==2){

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
      //Enable verbose debug output
      $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

      //Send using SMTP
      $mail->isSMTP();

      //Set the SMTP server to send through
      $mail->Host = 'smtp-mail.outlook.com';

      //Enable SMTP authentication
      $mail->SMTPSecure = 'tls';

      //Enable SMTP authentication
      $mail->SMTPAuth = true;

      //SMTP username
      $mail->Username = 'papeleriapopfake@hotmail.com';
      
      //SMTP password
      $mail->Password = 'Chihuas1409';

      //Enable TLS encryption;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

      //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
      $mail->Port = 587;

      //Recipients
      $mail->setFrom('papeleriapopfake@hotmail.com', 'Papeleria Pop');

      //Add a recipient
      $mail->addAddress($email, $nombre);

      //Set email format to HTML
      $mail->isHTML(true);

      $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

      $mail->Subject = 'Email verification';
      $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

      $mail->send();

      $query = "UPDATE usuarios SET codigo ='$verification_code' WHERE id_usuario='$id'";
      mysqli_query($conexion, $query);
      echo "<script> alert('Credenciales no validas, verifica tu identidad.'); window.location='recuperar.php' </script>";

      exit();
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }







          
        }
      }else {
        $query = mysqli_query($conexion, "SELECT * FROM usuarios where usuario = '$usuario'");
        $ni = mysqli_num_rows($query);

        if ($ni==1) {
          while ($tipo = mysqli_fetch_array($query)) {
            $id=$tipo['0'];
            $nombre=$tipo['1'];
            $usuario=$tipo['1'];
            $t_user=$tipo['5'];
            $estatus=$tipo['6'];
            $intentos=$tipo['7'];
            $_SESSION['usuario']=$id;
        }
        
        if($intentos=='3'){
          $query = "UPDATE usuarios SET estatus ='2' WHERE id_usuario='$id'";
          mysqli_query($conexion, $query);
          
          
          echo "<script> alert('Acceso denegado, usuario inactivo.'); window.location='formulario.html' </script>";
        }elseif($t_user==1 && $estatus=='2'){
          $query = "UPDATE usuarios SET estatus ='2' WHERE id_usuario='$id'";
          mysqli_query($conexion, $query);
          echo "<script> alert('Acceso denegado, usuario inactivo.'); window.location='formulario.html' </script>";
        }else{
        if($t_user==2 || $t_user==1){
          $intentos = $intentos+1;
          $query = "UPDATE usuarios SET intentos ='$intentos' WHERE id_usuario='$id'";
          mysqli_query($conexion, $query);
          echo "<script> alert('Usuario incorrecto, llevas $intentos intento(s).'); window.location='formulario.html' </script>";
        
      }else {
        echo "<script> alert('Usuario no registrado.'); window.location='formulario.html' </script>";
      }
        }
      }
    }
  }

 ?>
