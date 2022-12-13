$(obtener_registros());

function obtener_registros(inventario)
{
	$.ajax({
		url : 'tabla.php',
		type : 'POST',
		dataType : 'html',
		data : { inventario: inventario },
		})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
	})
}

$(document).on('keyup', '#busqueda', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros(valorBusqueda);
	}
	else
		{
			obtener_registros();
		}
});