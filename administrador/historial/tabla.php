

<?php

/*SELECT i.nombre_producto,SUM(v.cantidad*i.precio_unitario) 
FROM ventas v, inventario i 
WHERE i.id_producto=v.id_producto;*/ 

    include("../../conexion.php");

//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT v.folio_venta,v.fecha,v.hora, SUM(v.cantidad*i.precio_unitario) as total
FROM ventas v, inventario i 
WHERE i.id_producto=v.id_producto
GROUP BY v.folio_venta";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['inventario']))
{
	$q=$conexion->real_escape_string($_POST['inventario']);
	$query="SELECT v.folio_venta,v.fecha,v.hora, SUM(v.cantidad*i.precio_unitario) as total 
	    FROM ventas v, inventario i WHERE 
		v.id_producto = i.id_producto AND
		v.fecha LIKE '%".$q."%'
		GROUP BY v.folio_venta";
}

$buscarInventario=$conexion->query($query);
if ($buscarInventario->num_rows > 0)
{
	$tabla.= 
	'<table class="table" class="table-data>
		<tr class="data names">
            <th class="data-title">Folio</th>
            <th class="data-title">Total</th>
            <th class="data-title">Fecha</th>
            <th class="data-title">Hora</th>
            <th class="data-title">Acciones</th>
			<th class="data-title"></th>
		</tr>';

	while($filaInventario= $buscarInventario->fetch_assoc())
	{
		$total=$filaInventario['total'];
		if($total>499 && $total<1000){
		$total=$total-($total/100)*4;
		$tabla.=
		'<tr>
        
			<td class="data-list">'.$filaInventario['folio_venta'].'</td>
			<td class="data-list">'.$total.'</td>
			<td class="data-list">'.$filaInventario['fecha'].'</td>
            <td class="data-list">'.$filaInventario['hora'].'</td>
			<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="ticket/ticket.php">
			<input type="hidden" id="fecha" name="fecha" value="'.$filaInventario['fecha'].'">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['folio_venta'].'">Ticket</button>
            </form></td>
			<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="pdf/pdf.php">
			<input type="hidden" id="fecha" name="fecha" value="'.$filaInventario['fecha'].'">
            <button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['folio_venta'].'">Ticket en PDF</button>
            </form></td>
                
		 </tr>';
		}elseif($total>999){
			$total=$filaInventario['total'];
			$total=$total-($total/100)*8;
			$tabla.=
			'<tr>
			
				<td class="data-list">'.$filaInventario['folio_venta'].'</td>
				<td class="data-list">'.$total.'</td>
				<td class="data-list">'.$filaInventario['fecha'].'</td>
				<td class="data-list">'.$filaInventario['hora'].'</td>
				<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="ticket/ticket.php">
				<input type="hidden" id="fecha" name="fecha" value="'.$filaInventario['fecha'].'">
				<button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['folio_venta'].'">Ticket</button>
				</form></td>
				<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="pdf/pdf.php">
				<input type="hidden" id="fecha" name="fecha" value="'.$filaInventario['fecha'].'">
				<button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['folio_venta'].'">Ticket en PDF</button>
				</form></td>
					
			 </tr>';
		}else{
			$total=$filaInventario['total'];
			$tabla.=
			'<tr>
			
				<td class="data-list">'.$filaInventario['folio_venta'].'</td>
				<td class="data-list">'.$total.'</td>
				<td class="data-list">'.$filaInventario['fecha'].'</td>
				<td class="data-list">'.$filaInventario['hora'].'</td>
				<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="ticket/ticket.php">
				<input type="hidden" id="fecha" name="fecha" value="'.$filaInventario['fecha'].'">
				<button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['folio_venta'].'">Ticket</button>
				</form></td>
				<td class="data-list"><form class="form-editar" id="form" name="form" method="post" action="pdf/pdf.php">
				<input type="hidden" id="fecha" name="fecha" value="'.$filaInventario['fecha'].'">
				<button type="submit" class="seguir" name="id_valor" id="id_valor" value="'.$filaInventario['folio_venta'].'">Ticket en PDF</button>
				</form></td>
					
			 </tr>';
		}

	}

	$tabla.='</table>';
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $tabla;

include("../../alerta.php");

?>
