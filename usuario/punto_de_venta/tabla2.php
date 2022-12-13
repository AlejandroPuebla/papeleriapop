<?php
session_start();
    include("../../conexion.php");

$tabla="";
$query="SELECT * FROM inventario WHERE estatus='0' ORDER BY id_producto";
if(isset($_POST['inventario']))
{
	$q=$conexion->real_escape_string($_POST['inventario']);
	$query="SELECT * FROM inventario WHERE 
		id_producto LIKE '%".$q."%' OR
		nombre_producto LIKE '%".$q."%' OR
		marca_producto LIKE '%".$q."%' OR
		descripcion_producto LIKE '%".$q."%'";
}

$resp = mysqli_query($conexion, $query);

$buscarInventario=$conexion->query($query);
if ($buscarInventario->num_rows > 0)
{
	$tabla.= 
	'<table class="table" class="table-data>
		<tr class="data names">
			      <th class="data-title">Id</th>
            <th class="data-title">Nombre</th>
            <th class="data-title">Marca</th>
            <th class="data-title">Descripcion</th>
            <th class="data-title">Cantidad</th>
            <th class="data-title">P/U</th>
            <th class="data-title">Imagen</th>
            <th class="data-title">Acciones</th>
		</tr>';

	while($filaInventario = mysqli_fetch_array($resp))
	{
   
   	if ($filaInventario['cantidad_producto']!=0) {
   		$tabla.=
		'
    <tr>
    
    
			<td class="data-list">'.$filaInventario['id_producto'].'</td> 
			<td class="data-list">'.$filaInventario['nombre_producto'].'</td>     
			<td class="data-list">'.$filaInventario['marca_producto'].'</td>          
			<td class="data-list">'.$filaInventario['descripcion_producto'].'</td>
			<td class="data-list">'.$filaInventario['cantidad_producto'].'</td>
      <td class="data-list">'.$filaInventario['precio_unitario'].'</td>
      <td class="data-list"><img src=../../imagenes/productos/'.$filaInventario['imagen'].'></td>
      <td class="data-list"><form class="form-editar" id="formato" name="formato" method="post" action="btn_agregar/aumenta.php">
            <input type="hidden" id="id_producto" name="id_producto" value="'.$filaInventario['id_producto'].'">
            <input type="hidden" id="nombre_producto" name="nombre_producto" value="'.$filaInventario['nombre_producto'].'">
            <input type="hidden" id="marca_producto" name="marca_producto" value="'.$filaInventario['marca_producto'].'">
            <input type="hidden" id="descripcion_producto" name="descripcion_producto" value="'.$filaInventario['descripcion_producto'].'">
            <input type="hidden" id="cantidad_producto" name="cantidad_producto" value="'.$filaInventario['cantidad_producto'].'">
            <input type="hidden" id="precio_unitario" name="precio_unitario" value="'.$filaInventario['precio_unitario'].'">
            <input type="hidden" id="imagen" name="imagen" value="'.$filaInventario['imagen'].'">
            <input type="number" name="cantidad" id="cantidad" placeholder="1-'.$filaInventario['cantidad_producto'].'" min="1" max="'.$filaInventario['cantidad_producto'].'" required >
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_producto'].'">Agregar Al Carrito</button>
            </form> </td>
               
		 </tr>     
     ';
   	}
		
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
