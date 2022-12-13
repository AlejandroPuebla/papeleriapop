<?php

    session_start();
    include("../../../conexion.php");

    if (isset($_POST['id_valor'])) {
        $id = $_REQUEST["id_producto"];
        $nombre = $_REQUEST["nombre_producto"];
        $marca = $_REQUEST["marca_producto"];
        $desc = $_REQUEST["descripcion_producto"];
        $existencias = $_REQUEST["cantidad_producto"];
        $pu = $_REQUEST["precio_unitario"];
        $img = $_REQUEST["imagen"];
        $img = '<img src=../../imagenes/productos/'.$img.'>';
        $cantidad = $_REQUEST["cantidad"];

    
      if (!isset($_SESSION["carrito"][$nombre]["id"])) {
        if ($cantidad<=$existencias) {
            $_SESSION["carrito"][$nombre]["id"] = $id;
            $_SESSION["carrito"][$nombre]["nombre"] = $nombre;
            $_SESSION["carrito"][$nombre]["marca"] = $marca;
            $_SESSION["carrito"][$nombre]["descripcion"] = $desc;
            $_SESSION["carrito"][$nombre]["precio_uni"] = $pu;
            $_SESSION["carrito"][$nombre]["cantidad"] = $cantidad;
            $_SESSION["carrito"][$nombre]["imagen"] = $img;

          echo "<script>alert('Agregado $cantidad $nombre al carrito.');</script>";
            }else {
              echo "<script>alert('Superó el limite de este productoaaaaaaaaaa');</script>";
            }
                }else {
                    if ($_SESSION["carrito"][$nombre]["cantidad"]<$existencias) {
                            $_SESSION["carrito"][$nombre]["id"] = $id;
                            $_SESSION["carrito"][$nombre]["nombre"] = $nombre;
                            $_SESSION["carrito"][$nombre]["marca"] = $marca;
                            $_SESSION["carrito"][$nombre]["descripcion"] = $desc;
                            $_SESSION["carrito"][$nombre]["precio_uni"] = $pu;
                            $_SESSION["carrito"][$nombre]["cantidad"] += $cantidad;
                            $_SESSION["carrito"][$nombre]["imagen"] = $img;
                          echo "<script>alert('Agregado $cantidad $nombre al carrito.');</script>";
                      }else {
                            echo "<script>alert('Superó el limite de este producto');</script>";
                        }
                }
    
            }

      ?>

<html>
<head>
<meta http-equiv="refresh" content="0;url=../punto_venta.html" />
</head>
<body>

</body>
</html>