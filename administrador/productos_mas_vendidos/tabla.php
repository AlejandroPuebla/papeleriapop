

<?php

date_default_timezone_set('America/Mexico_City');
$fecha=date('Y-m');

/*SELECT i.nombre_producto,SUM(v.cantidad*i.precio_unitario) 
FROM ventas v, inventario i 
WHERE i.id_producto=v.id_producto;*/ 

    include("../../conexion.php");

//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT i.id_producto,i.nombre_producto,i.precio_unitario,v.cantidad,SUM(v.cantidad*i.precio_unitario) as total 
FROM ventas v, inventario i 
WHERE v.id_producto = i.id_producto 
AND v.fecha LIKE '%$fecha%' 
GROUP BY v.id_producto";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['inventario']))
{
	$q=$conexion->real_escape_string($_POST['inventario']);
	$query="SELECT i.id_producto,i.nombre_producto,v.cantidad,i.precio_unitario,SUM(v.cantidad*i.precio_unitario) as total 
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
	
	$id ="";

	echo "<script>
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	
	function drawChart() {
	var data = google.visualization.arrayToDataTable([
		['Producto', 'Cantidad'],";

		while($filaInventario= $buscarInventario->fetch_assoc())
		{
			echo "['".$filaInventario['nombre_producto']."',".$filaInventario['cantidad']."],";	
		
		}

		echo"

	  ]);
	
	var options = {
		backgroundColor: {
		  fill: '#FFF',
		  fillOpacity: 0
		},
      hAxis: {title: '#', titleTextStyle: {color: 'black'}},
      colors: ['#695CFE'],
      is3D:true
	  };
	
	var chart = new google.visualization.BarChart(document.getElementById('myChart'));
	  chart.draw(data, options);
	}
	</script>";
/*
	echo"<script type='text/javascript'>
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {

	  var data = google.visualization.arrayToDataTable([
		['Producto', 'Cantidad'],";

		while($filaInventario= $buscarInventario->fetch_assoc())
		{
			echo "['".$filaInventario['nombre_producto']."',".$filaInventario['cantidad']."],";	
		
		}

		echo"

	  ]);

	  var options = {
		backgroundColor: {
		  fill: '#FFF',
		  fillOpacity: 0
		},
	  };

	  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	  chart.draw(data, options);
	}
  </script>";
	*/
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $tabla;

include("../../alerta.php");


?>
<div id="piechart" style="width: 1000px; height: 600px; margin-left:300px; margin-top:-180px; "></div>
<div id="myChart" style="width:1000px; height: 600px; margin-left:220px; margin-top:-580px;"></div>