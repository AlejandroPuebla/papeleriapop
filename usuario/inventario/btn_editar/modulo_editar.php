<?php
include("../../../conexion.php");
$id = $_POST['id_valor'];

$query = mysqli_query($conexion, "SELECT *
                                  FROM inventario
                                  WHERE id_producto='$id'");
while ($inv = mysqli_fetch_array($query)) {
$nom=$inv['1'];
$marc=$inv['2'];
$desc=$inv['3'];
$cant=$inv['4'];
$pu=$inv['5'];
$img=$inv['6'];
}

    echo '<div class="title">Editar Producto</div>
        <div class="content">
      <form action="act_producto.php" method="post" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nombre</span>
            <input type="text" name="nombre" value="'.$nom.'" required>
          </div>
          <div class="input-box">
            <span class="details">Marca</span>
            <input type="text" name="marca" value="'.$marc.'" required>
          </div>
          <div class="input-box">
            <span class="details">Descripcion</span>
            <input type="text" name="desc" value="'.$desc.'" required>
          </div>
          <div class="input-box">
            <span class="details">Cantidad</span>
            <input type="number" name="cantidad" id="cantidad" value="'.$cant.'" required>
          </div>
          <div class="input-box">
            <span class="details">Precio Unitario</span>
            <input type="number" name="pu" value="'.$pu.'" required>
          </div>
          <div class="input-box">
            <span class="details">Imagen</span>
            <input type="text" name="uploadfile" value="'.$img.'" disabled>
          </div>
        </div>
        <div class="button">
        <input type="hidden" name="id" value="'.$id.'">
        <input type="submit" name="reg" value="Registrar">
        </div>
    </form>
    </div>
</div>';



?>

