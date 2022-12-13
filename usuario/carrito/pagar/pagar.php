<?php
include("../../../conexion.php");
session_start();
date_default_timezone_set('America/Mexico_City');
$fecha=date('Y-m-d');
$hora=date("H:i:s",time());
$pagado = $_POST['cantidad'];
$total = $_POST['pagar'];
$cambio = $pagado - $total;

$query = mysqli_query($conexion, "SELECT folio_venta 
FROM ventas
order by id_venta
desc limit 1");

while ($inv = mysqli_fetch_array($query)) {
$top=$inv['0'];
}

$fol=$top+1;

foreach ($_SESSION["carrito"] as $indice => $arreglo) {

    $cantidad = $arreglo["cantidad"];
    $id = $arreglo["id"];

    $query = "INSERT INTO ventas (id_venta, folio_venta, id_producto,cantidad,fecha,hora)
    VALUES ('', '$fol', '$id','$cantidad','$fecha','$hora')";

    mysqli_query($conexion, $query);

    $query = mysqli_query($conexion, "SELECT cantidad_producto 
              FROM inventario
              WHERE id_producto = '$id'");

    while ($inv = mysqli_fetch_array($query)) {
        $cant=$inv['0'];
    }

    $cantidad = $cant - $cantidad;

    $query = "UPDATE inventario 
              SET cantidad_producto = '$cantidad'
              WHERE id_producto = $id";

    mysqli_query($conexion, $query);

    
}

echo "<script> alert('Su cambio es de: $cambio pesos.'); </script>";
unset($_SESSION["carrito"]);


echo '<script>window.open("recibo.php", "_blank");
              window.location.href = "../../inventario/inventario.html";</script>';
?>

