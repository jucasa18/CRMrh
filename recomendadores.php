<?php

//include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Empleados.php'; 
$lisEmplAct  = Empleados::listaEmpleadosActivos();
?>
<style>

div.dataTables_wrapper div.dataTables_length label {
    display: none;
}
div.dataTables_wrapper div.dataTables_info {
    display: none;
}
</style>




    <!--Inicio-->
        <div class=""   style="width:90% " > 

        <table id="recomendadores" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <tr>
                <th>Id</th> 
                <th>Nombre</th>
                

            </tr>
        </thead>
        <tbody>
		<?php
		//foreach ($resultado as $a_ => $infoRec) {
            foreach ($lisEmplAct as $a_ => $infoRec) {
			?>
            <tr style="font-weight: lighter;" onclick="agregarecomendacion('<?php echo $infoRec['IdDRENC']; ?>','<?php echo $infoRec['FechaIngreso']; ?>')">
               
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP'] ?> <?php echo $infoRec['ApellidoM'] ?></th>
               </tr>
		<?php } ?>

        </tbody>
    </table>

              
        </div>
        <!--fin-->


        <!-- Modal -->
        <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>




    <link href="css/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <script>

$(document).ready(function () {
    $('#recomendadores').DataTable({
        processing: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            order: [[0, 'desc']]
       // serverSide: true,
       // ajax: 'ajaxtabla.php',
     /* "pageLength": 3,
  "pagingType": "simple"*/
    });
});

/*
$(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    } );
} );
*/

function eliminaEmpleado(id){	

    var mensaje;
    var opcion = confirm("¿Deseas eliminar al empleado?");
    if (opcion == true) {
        var datos = 'idempleado='+id;
      $.ajax({
      type: 'POST',
      url: 'dalete_empleado.php',
      data: datos,
      success: function(respuesta) {
        if(respuesta=='ok'){
            alert('Empleado eliminado');
            window.location.reload();
        }
        else {
            alert('Inténtalo Nuevamente');
        }
    }
    });
	} else {
	    //mensaje = "Has clickado Cancelar";
	}
  
}

function updateEmpleado(id){	
  var datos = 'idempleado='+id;
      $.ajax({
      type: 'POST',
      url: 'dalete_empleado.php',
      data: datos,
      success: function(respuesta) {
        if(respuesta=='ok'){
            alert('IEmpleado eliminado');
            window.location.reload();
        }
        else {
            alert('Inténtalo Nuevamente');
        }
    }
    });
}

function cambiaEstatus(id,estatus){	
   // alert (estatus);
  //  alert("entro");
 
    var estatus2 = document.getElementById(estatus).value;
   // alert (estatus2);
    var datos = 'id='+id+'&estatus='+estatus2;
    //alert(datos);
    $.ajax({
      type: 'POST',
      url: 'estatus.php',
      data: datos,
      success: function(respuesta) {
       // alert(respuesta);
        if(respuesta=='cam'){
            alert('El empleado ha cambiado de estatus.');
            window.location='empleados.php';
        }else{
            alert('inténtalo nuevamente.');
        }
    }
    });
}
</script>
