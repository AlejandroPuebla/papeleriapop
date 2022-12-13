

<?php

date_default_timezone_set('America/Mexico_City');
$fecha=date('Y-m');

/*SELECT i.nombre_producto,SUM(v.cantidad*i.precio_unitario) 
FROM ventas v, inventario i 
WHERE i.id_producto=v.id_producto;*/ 

    include("../../conexion.php");

//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT i.id_producto,i.nombre_producto,i.precio_unitario,v.fecha,v.hora,v.cantidad,SUM(v.cantidad*i.precio_unitario) as total 
FROM ventas v, inventario i 
WHERE v.id_producto = i.id_producto 
AND v.fecha LIKE '%$fecha%' 
GROUP BY v.id_producto";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['inventario']))
{
	$q=$conexion->real_escape_string($_POST['inventario']);
	$query="SELECT i.id_producto,i.nombre_producto,v.cantidad,v.fecha,v.hora,i.precio_unitario,SUM(v.cantidad*i.precio_unitario) as total 
			FROM ventas v, inventario i 
			WHERE v.id_producto = i.id_producto 
			AND v.fecha LIKE '%".$q."%' 
			GROUP BY v.id_producto";

		/*SELECT i.id_producto,i.nombre_producto,v.cantidad, SUM(v.cantidad*i.precio_unitario) as total
FROM ventas v, inventario i 
WHERE i.id_producto=v.id_producto
AND v.fecha = '2022-03-02'
GROUP BY v.id_venta*/
}

$buscarInventario=$conexion->query($query);
if ($buscarInventario->num_rows > 0)
{
	$tabla.= 
	'<table class="table" class="table-data>
		<tr class="data names">
            <th class="data-title">Id</th>
            <th class="data-title">Producto</th>
			<th class="data-title">Fecha</th>
			<th class="data-title">Hora</th>
            <th class="data-title">Cantidad</th>
            <th class="data-title">Precio Unitario</th>
            <th class="data-title">Total</th>
		</tr>';

	$final="0";
	while($filaInventario= $buscarInventario->fetch_assoc())
	{

			$total=$filaInventario['precio_unitario']*$filaInventario['cantidad'];
			$final+=$total;

			$tabla.=
			'<tr>
			
				<td class="data-list">'.$filaInventario['id_producto'].'</td>
				<td class="data-list">'.$filaInventario['nombre_producto'].'</td>
				<td class="data-list">'.$filaInventario['fecha'].'</td>
				<td class="data-list">'.$filaInventario['hora'].'</td>
				<td class="data-list">'.$filaInventario['cantidad'].'</td>
				<td class="data-list">'.$filaInventario['precio_unitario'].'</td>
				<td class="data-list">'.$total.'</td>

					
			 </tr>';
		}

		$tabla.=
		'<tr class="data-listfin">
		
			<td class="data-list"></td>
			<td class="data-list"></td>
			<td class="data-list"></td>
			<td class="data-list"></td>
			<td class="data-list"></td>
			<td class="data-list">Precio Final</td>
			<td class="data-list">'.$final.'</td>

				
		 </tr>';

	$tabla.='</table>';
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $tabla;

include("../../alerta.php");


?>
