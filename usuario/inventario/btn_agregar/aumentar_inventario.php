<?php
include("../../../conexion.php");
$id = $_POST['id_valor'];
$cantidad = $_POST['cantidad'];

$query = mysqli_query($conexion, "SELECT cantidad_producto,nombre_producto,marca_producto
                                  FROM inventario
                                  WHERE id_producto='$id'");
while ($inv = mysqli_fetch_array($query)) {
$cant_insert=$inv['0'];
$nombre=$inv['1'];
$marca=$inv['2'];
}

$total = $cant_insert + $cantidad;


$query = "UPDATE inventario SET cantidad_producto = $total 
          WHERE id_producto = $id";

mysqli_query($conexion, $query);

echo "<script> alert('Se han agregado $cantidad unidades del producto'); </script>";

?>

<html>
<head>
<meta http-equiv="refresh" content="0;url=../inventario.html" />
</head>
<body>

</body>
</html>