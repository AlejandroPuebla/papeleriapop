<?php

include("../../../conexion.php");

$msg = "";

  if (isset($_POST['reg'])) {

    $nombre = $_POST['nombre'];
    $nombre = ucwords(strtolower("$nombre"));
    $marca = $_POST['marca'];
    $marca = ucwords(strtolower("$marca"));
    $desc = $_POST['desc'];
    $desc = ucfirst(strtolower("$desc"));
    $cantidad = $_POST['cantidad'];
    $pu = $_POST['pu'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];   
        $folder = "../../../imagenes/productos/".$filename;
          
        $query = "INSERT INTO inventario (id_producto, nombre_producto, marca_producto,descripcion_producto,cantidad_producto,precio_unitario,imagen)
                                VALUES ('', '$nombre', '$marca','$desc','$cantidad','$pu','$filename')";

    
        mysqli_query($conexion, $query);
          
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
      
  }

  echo "<script> alert('El producto: $nombre se ha agregado.'); </script>";

?>

<html>
<head>
<meta http-equiv="refresh" content="0;url=../inventario.html" />
</head>
<body>

</body>
</html>