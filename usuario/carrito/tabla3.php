<?php
session_start();
    include("../conexion.php");

$tabla="";
$query="SELECT * FROM usuarios ORDER BY id_usuario";
if(isset($_POST['usuarios']))
{
	$q=$conexion->real_escape_string($_POST['usuarios']);
	$query="SELECT * FROM usuarios WHERE 
		id_usuario LIKE '%".$q."%' OR
		nombre_usuario LIKE '%".$q."%' OR
		usuario LIKE '%".$q."%' OR
		tipo_usuario LIKE '%".$q."%'";
}

$resp = mysqli_query($conexion, $query);

$buscarUsuarios=$conexion->query($query);
if ($buscarUsuarios->num_rows > 0)
{
	$tabla.= 
	'<table class="table" class="table-data>
		<tr class="data names">
			      <th class="data-title">Id</th>
            <th class="data-title">Nombre</th>
            <th class="data-title">Usuario</th>
            <th class="data-title">Contraseña</th>
            <th class="data-title">Tipo De Usuario</th>
            <th class="data-title">Acciones</th>
            <th class="data-title"></th>
		</tr>';

	while($filaInventario = mysqli_fetch_array($resp))
	{
   
		$tabla.=
		'
    <tr>
    
    
			<td class="data-list">'.$filaInventario['id_usuario'].'</td> 
			<td class="data-list">'.$filaInventario['nombre_usuario'].'</td>     
			<td class="data-list">'.$filaInventario['usuario'].'</td>          
			<td class="data-list">'.$filaInventario['contraseña'].'</td>';

            if($filaInventario['tipo_usuario']==1){
                $tabla.=
                '<td class="data-list">Administrador</td>';
            }else{
                $tabla.=
                '<td class="data-list">Trabajador</td>';
            }
            
            $tabla.=
                '
      <td class="data-list"><form class="form-editar" id="formato" name="formato" method="post" action="aumesnta.php">
            <input type="hidden" id="id_producto" name="id_producto" value="'.$filaInventario['id_usuario'].'">
            <input type="hidden" id="nombre_producto" name="nombre_producto" value="'.$filaInventario['nombre_usuario'].'">
            <input type="hidden" id="marca_producto" name="marca_producto" value="'.$filaInventario['usuario'].'">
            <input type="hidden" id="descripcion_producto" name="descripcion_producto" value="'.$filaInventario['contraseña'].'">
            <input type="hidden" id="cantidad_producto" name="cantidad_producto" value="'.$filaInventario['tipo_usuario'].'">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_usuario'].'">Editar</button>
            </form> </td>

            <td class="data-list"><form class="form-editar" id="formato" name="formato" method="post" action="eliminar_usuario.php">
            <input type="hidden" id="id_producto" name="id_producto" value="'.$filaInventario['id_usuario'].'">
            <input type="hidden" id="nombre_producto" name="nombre_producto" value="'.$filaInventario['nombre_usuario'].'">
            <input type="hidden" id="marca_producto" name="marca_producto" value="'.$filaInventario['usuario'].'">
            <input type="hidden" id="descripcion_producto" name="descripcion_producto" value="'.$filaInventario['contraseña'].'">
            <input type="hidden" id="cantidad_producto" name="cantidad_producto" value="'.$filaInventario['tipo_usuario'].'">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_usuario'].'">Eliminar</button>
            </form> </td>
               
		 </tr>     
     ';
	}

	$tabla.='</table>';
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}

//$file = fopen('C:/Users/manue/OneDrive/Escritorio/archivo.txt','w');
//echo fputs($file,$tabla);
//fclose($file);
echo $tabla;


?>
