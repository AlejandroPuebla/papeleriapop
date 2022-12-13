<?php
include("../conexion.php");
session_start();
$id=$_SESSION['usuario'];

  if (isset($_POST['change-password'])) {
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($cpassword != $password){
        echo "<script> alert('Las contraseñas no coinciden'); window.location='rest_pass.php' </script>";
    } else{
            if(strlen($password) < 6){
            echo "<script> alert('La contraseña debe tener 6 caracteres'); window.location='rest_pass.php' </script>";
            }elseif(!preg_match('`[A-Z]`',$password)){
            echo "<script> alert('La contraseña debe tener al menos 1 mayuscula'); window.location='rest_pass.php' </script>";
            }elseif(!preg_match('`[0-9]`',$password)){
            echo "<script> alert('La contraseña debe tener al menos 1 número'); window.location='rest_pass.php' </script>";
            }else{
            $password = md5($_POST['password']);
            $query = "UPDATE usuarios SET contraseña='$password', primera_vez='0' WHERE id_usuario='$id'";
            mysqli_query($conexion, $query);
            echo "<script> alert('Contraseña actualizada correctamente'); window.location='formulario.html' </script>";
            }
    }

    
    
    
}