<?php
include("../../../conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$nombre = ucwords(strtolower("$nombre"));
$marca = $_POST['marca'];
$marca = ucwords(strtolower("$marca"));
$desc = $_POST['desc'];
$desc = ucfirst(strtolower("$desc"));
$cantidad = $_POST['cantidad'];
$pu = $_POST['pu'];


$query = "UPDATE inventario SET nombre_producto = '$nombre', marca_producto = '$marca' , descripcion_producto = '$desc', cantidad_producto = '$cantidad', precio_unitario = '$pu'
          WHERE id_producto = $id";

mysqli_query($conexion, $query);

echo "<script> alert('Producto Actualizado Correctamente'); </script>";

?>

<html>
<head>
<meta http-equiv="refresh" content="0;url=../inventario.html" />
</head>
<body>

</body>
</html>