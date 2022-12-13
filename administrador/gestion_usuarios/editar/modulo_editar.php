<?php
include("../../../conexion.php");
$id = $_POST['id_valor'];

$query = mysqli_query($conexion, "SELECT *
                                  FROM usuarios
                                  WHERE id_usuario='$id'");
while ($inv = mysqli_fetch_array($query)) {
$nom=$inv['1'];
$user=$inv['2'];
$pass=$inv['3'];
$cant=$inv['4'];
}

    echo '<div class="title">Editar Usuario</div>
        <div class="content">
      <form action="act_usuario.php" method="post" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nombre</span>
            <input type="text" name="nombre" value="'.$nom.'" required>
          </div>
          <div class="input-box">
            <span class="details">Usuario</span>
            <input type="text" name="usuario" value="'.$user.'" required>
          </div>
          <div class="input-box">
            <span class="details">Contraseña</span>
            <input type="password" name="pass" value="'.$pass.'" required>
          </div>
          <div class="input-box">
            <span class="details">Tipo De Usuario</span>';

      if($cant==1){
        echo '<select id="tipo_user" name="tipo_user" required>
                  <option value="1" selected>Administrador</option>
                  <option value="2">Trabajador</option>
              </select>';
      }else{
        echo '<select id="tipo_user" name="tipo_user" required>
                  <option value="1">Administrador</option>
                  <option value="2" selected>Trabajador</option>
              </select>';
      }
      echo '
          </div>
        </div>
        <div class="button">
        <input type="hidden" name="id" value="'.$id.'">
        <input type="submit" name="reg" value="Actualizar">
        </div>
    </form>
    </div>
</div>';



?>

