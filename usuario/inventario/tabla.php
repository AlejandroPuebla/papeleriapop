<?php

session_start();
include("../../conexion.php");

//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$alerta="";
$query="SELECT * FROM inventario ORDER BY id_producto";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['inventario']))
{
	$q=$conexion->real_escape_string($_POST['inventario']);
	$query="SELECT * FROM inventario WHERE 
		id_producto LIKE '%".$q."%' OR
		nombre_producto LIKE '%".$q."%' OR
		marca_producto LIKE '%".$q."%' OR
		descripcion_producto LIKE '%".$q."%'";
}

$buscarInventario=$conexion->query($query);
if ($buscarInventario->num_rows > 0)
{
	$tabla.= 
	'<table class="table" class="table-data>
		<tr class="data names">
            <th class="data-title">Producto</th>
            <th class="data-title">Marca</th>
            <th class="data-title">Descripcion</th>
            <th class="data-title">Cantidad</th>
            <th class="data-title">P/U</th>
			<th class="data-title">Estatus</th>
            <th class="data-title">Imagen</th>
            <th class="data-title">Acciones</th>
			<th class="data-title"></th>
			<th class="data-title"></th>
		</tr>';

		$i = 1;
	$alerta.='Los siguientes productos estan apunto de agotarse:';
	$alerta.='\n \n';
	

	while($filaInventario= $buscarInventario->fetch_assoc())
	{
		$tabla.=
		'<tr>
        
			<td class="data-list">'.$filaInventario['nombre_producto'].'</td>
			<td class="data-list">'.$filaInventario['marca_producto'].'</td>
			<td class="data-list">'.$filaInventario['descripcion_producto'].'</td>
			<td class="data-list">'.$filaInventario['cantidad_producto'].'</td>
            <td class="data-list">'.$filaInventario['precio_unitario'].'</td>';

		if($filaInventario['estatus']==1 && $filaInventario['cantidad_producto']>0){
			$tabla.='<td class="data-list">Disponible</td>
			<td class="data-list"><img src=../../imagenes/productos/'.$filaInventario['imagen'].'></td>
            <td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="btn_agregar/aumentar_inventario.php">
            <input type="number" name="cantidad" id="cantidad" placeholder="1-20" min="1" max="20" required>
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_producto'].'">Agregar</button>
            </form></td>
			<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="btn_editar/editar_inventario.php">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_producto'].'">Editar</button>
            </form></td>
			<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="btn_eliminar/eliminar_inventario.php">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_producto'].'">Deshabilitar</button>
            </form></td>';
		}elseif($filaInventario['estatus']==1 && $filaInventario['cantidad_producto']==0){
			$tabla.='<td class="data-list">Agotado</td>
			<td class="data-list"><img src=../../imagenes/productos/'.$filaInventario['imagen'].'></td>
            <td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="btn_agregar/aumentar_inventario.php">
            <input type="number" name="cantidad" id="cantidad" placeholder="1-20" min="1" max="20" required>
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_producto'].'">Agregar</button>
            </form></td>
			<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="btn_editar/editar_inventario.php">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_producto'].'">Editar</button>
            </form></td>
			<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="btn_eliminar/eliminar_inventario.php">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_producto'].'">Deshabilitar</button>
            </form></td>';
		}elseif($filaInventario['estatus']==2){
			$tabla.='<td class="data-list">Descontinuado</td>
			<td class="data-list"><img src=../../imagenes/productos/'.$filaInventario['imagen'].'></td>
            <td class="data-list"></td>
			<td class="data-list"></td>
			<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="btn_activar/activar_producto.php">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['id_producto'].'">Habilitar</button>
            </form></td>';
		}
		    $tabla.='
		 </tr>';
		if($filaInventario['cantidad_producto']<4){
		 $producto = $filaInventario['nombre_producto'];
		 $marca = $filaInventario['marca_producto'];
		 $cantidad = $filaInventario['cantidad_producto'];
		 $alerta.=$i.'.- '.$producto.' marca '.$marca.' ('.$cantidad.' unidades).\n';
		 $i=$i+1;
		}
		
	}

	

	$tabla.='</table>';
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $tabla;


?>
