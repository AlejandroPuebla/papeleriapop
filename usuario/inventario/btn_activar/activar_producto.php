<?php
include("../../../conexion.php");
$id = $_POST['id_valor'];

$query = "UPDATE inventario SET estatus = '1'
          WHERE id_producto = $id";

mysqli_query($conexion, $query);

echo "<script> alert('Producto activado.'); </script>";

?>

<html>
<head>
<meta http-equiv="refresh" content="0;url=../inventario.html" />
</head>
<body>

</body>
</html>