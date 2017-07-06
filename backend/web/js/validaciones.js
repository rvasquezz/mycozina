//Funcion para bloquear numeros uso con la funcion onKeyPress

function soloLetras(event)
{
	e=event;
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
	especiales = "8-37-39-46";
	tecla_especial = false

	for(var i in especiales)
	{
		if(key == especiales[i])
		{
			tecla_especial = true;
			break;
		}
	}

	if(letras.indexOf(tecla)==-1 && !tecla_especial)
	{
		return false;
	}
}

    //Funcion para bloquear letras uso con la funcion onKeyPress

function soloNumeros(event)
{
	var key = event.keyCode ? event.keyCode : event.which ;
	return (key <= 40 || (key >= 48 && key <= 57) || (key >=44 && key<=46));
}

//funcion para limpiar el input uso con la funcion onblur
function limpia() 
{
	var val = document.getElementById("miInput").value;
	var tam = val.length;
	for(i = 0; i < tam; i++) 
	{
		if(!isNaN(val[i]))
		document.getElementById("miInput").value = '';
	}
}