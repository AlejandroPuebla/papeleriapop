<?php
include("../../../conexion.php");
$id = $_POST['id_valor'];

$query = "UPDATE usuarios SET estatus = '1'
          WHERE id_usuario = $id";

mysqli_query($conexion, $query);

echo "<script> alert('Usuario Activo'); </script>";

?>

<html>
<head>
<meta http-equiv="refresh" content="0;url=../gestion_usuarios.html" />
</head>
<body>

</body>
</html>