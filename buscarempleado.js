function buscarempleado(){
	var codigo = $("#codigoescaneado").val();
	$.ajax({
	  method:'GET',
	  url: "consultarempleado.php",
	  data:{codigo:codigo},
	  cache: false,
	  dataType:"json",
	  success: function(html){
		console.log(html);
		 if(html.data=='okay'){
			 var cadena = '';
			if(html.empleados!=''){
  

			cadena +='<tr id= "anclaregis'+html.empleados[0].id+'">';
  
			 
			 cadena += '<td>'+html.empleados[0].id+'</td>';
			 cadena += '<td>'+html.empleados[0].target+'</td>';
			 cadena += '<td>'+html.empleados[0].name+'</td>';
			 cadena += '<td>'+html.empleados[0].posit+'</td>';
			 cadena += '<td id= "anclabtn_'+html.empleados[0].id+'"><button type="button" data-id="'+html.empleados[0].id+'" class="btn btn-primary  addEmpleadoC" id="add">Agregar</button></td>';
             
		
			
  
			 cadena +='</tr>';
			
			 $('#empleado').html(cadena);
  
			}else{
				alert('Empleado No encontrado');
			}
  
		 }
	  }
	});
  }
$(document).on('click', '.addEmpleadoC', function () {
	var id = $(this).data('id');
	$('#idempleado').val(id);
	
	cierramodal();
	
});

function cierramodal(){
	$("#modalempleado"). modal('toggle');
}