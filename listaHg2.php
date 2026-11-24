<?php
include('header.php');
include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Incidencias.php'; 
$idempleado = $_REQUEST['idempleado'];
$lisIncidencias  = Incidencias::listaIncidenciasxempleado($idempleado,12);
$listEmpleado = Incidencias::listaEmpleadobyId($idempleado);

?>
<style>
.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.375rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}


</style>
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Hombres Garantía (Horas Extas)</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Incidencias</li>
          <li class="breadcrumb-item active">Hombres Garantía (Horas Extas)</li>
         
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

  

  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Lista de: <?php echo $listEmpleado['Nombre'] ?> <?php echo $listEmpleado['ApellidoP']; ?></h5>
        </div>
    <!--Inicio-->
        <div class=""   style="  padding: 30px;" style="width:90%;" > 
        <div class="table-responsive-xxl">
        <table id="example" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <tr>
              
                <th>id</th>
                <th>Id DR-ENC </th>
                <th>Fecha</th>
                <th>Horas Extras</th>
                <th style="text-align: center;">Eliminar</th>
                
                
                           
            </tr>
        </thead>
        <tbody>
		<?php
		//foreach ($resultado as $a_ => $infoRec) {
            foreach ($lisIncidencias as $a_ => $infoRec) {
              //  $horario = horario($infoRec['Horario']);
              //  $motivo = motivo($infoRec['Motivo']);
			?>
            <tr style="font-weight: lighter;">
               
                
                <th style="font-weight: 600;"><?php echo $infoRec['id']; ?></th>     
                <th style="font-weight: 600;"><?php echo $listEmpleado['IdDRENC']; ?></th>    
                <th style="font-weight: 600;"><?php echo $infoRec['FechaIncidencia']; ?></th>   
                <th style="font-weight: 400;"><?php echo $infoRec['Cantidad']; ?></th> 
                <th style="text-align: center;"><button type="button" class="btn btn-danger" value='<?php echo $infoRec['id']; ?>' name="idelimina" id="idelimina" onclick="eliminaIncidencias('<?php echo $infoRec['id']; ?>');"><i class='bi bi-trash-fill'></i></button></th>
               
         
               
                
            </tr>
		<?php } ?>

        </tbody>
    </table>

        </div>

   

    <div class="modal fade" id="recomendaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Busca al empleado. </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  	  <div class="modal-body">

                <form class="needs-validation" novalidate id="editaRuta">
                    <div class="row">
                        <div class="card info-card customers-card">
                                <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
                                    <h5 class="card-title" style="color: #ffffff;">Recomendaciones</h5>
                                </div>
                                <!--Inicio-->
                                <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 8px;" > 
                                    <div class="input-group mb-1 ">
                                        <div class="col-md-12 mb-2 px-md-3">
                                           <!-- <input type="hidden" class="form-control" id="id" name="id" required>-->
                                            <input type="hidden" class="form-control" id="IdDRENC2"  name="IdDRENC2"  placeholder="IdDRENC2" value="">
                                           
                                            <!--fin-->
                                        </div>
                                    </div>
                                </div>
                                <div id="ajaxcont">



                                </div>
                       <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-dark" type="submit" id="botonenviar2">Guardar</button>
                        </div>-->
                    </div>
                       
                </form>

    </div>
  </div>
</div>
             
        </div>
        <!--fin-->
 
            </main>
<?php
    include('footer.php');

    
    function horario($h){
        switch ($h) {
            case 1:
                $h = 'Entrada';
                break;
            case 2:
                $h = 'Salida';
                break;
        }
        return $h;
    }

    function motivo($m){
        switch ($m) {
            case 1:
                $m = 'Omisión de Entrada';
                break;
            case 2:
                $m = 'Omisión de Salida';
                break;
            case 3:
                $m = 'Error en Tarjeta de Acceso';
                break;
        }
        return $m;
    }
?>

    <link href="css/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <script>

$(document).ready(function () {
    $('#example').DataTable({
        processing: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            order: [[0, 'desc']]
       // serverSide: true,
       // ajax: 'ajaxtabla.php',
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



function eliminaVacaciones(id){	
    var mensaje;
    var opcion = confirm("¿Deseas eliminar las vacaciones?");
    if (opcion == true) {
        var datos = 'id='+id;
        alert('acciones/ajax/eliminarVacaciones.php?' + datos);
           $.ajax({
                type: 'POST',
                url: 'acciones/ajax/eliminarVacaciones.php',
                data: datos,
                dataType: 'json',
                success:  function (datos){ 
                        console.log(datos);
                        alert(datos.mensaje);
                     //   window.location.href= 'rutas.php';
                     window.location.reload()
             }
            });
  
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

var exampleModal = document.getElementById('recomendaciones')
exampleModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-whatever')
  //alert(recipient);
        $.ajax({
            url: 'recomendadores.php',
            type: 'post',
          //  dataType: 'json',
            success:function(datos){
                // alert(datos.nombre);
             /*   exampleModal.querySelector('#id').value = datos.idr;
                exampleModal.querySelector('#nombrer').value = datos.nombre;
                if(datos.estatus = 1){
                        var text = 'Activo';
                }else{
                        var text = 'Inactivo';
                }
                $("#Estatus").append("<option value='"+datos.estatus+"' selected >"+ text +"</option>");*/
                exampleModal.querySelector('#IdDRENC2').value = recipient;

                $("#ajaxcont").html(datos);
            }
        });
    var modalTitle = exampleModal.querySelector('.modal-title')
    // var modalBodyInput = exampleModal.querySelector('.modal-body input')
    // modalTitle.textContent = 'Edita la Ruta. ' + recipient
    // modalBodyInput.value = recipient
})

function agregarecomendacion(idem,fingreso){
        var idnu = document.getElementById("IdDRENC2").value;
        var  dator = 'idnuevo='+ idem +'&idrenc=' + idnu +'&fingreso='+ fingreso ;
        console.log(dator);
       // alert(dator);

               $.ajax({
                     url:   'acciones/ajax/guardarNuevaRecomendacion.php',
                     type: 'post',
                     dataType: 'json',
                     data: dator,
                     success:  function (datos){ 
                          console.log(datos);
                         alert(datos.mensaje);
                          window.location.href= 'empleados.php';
                    }
              });


}


function Vacaciones(idem){
        var  datos = 'id=' + idem;
        console.log(dator);
       // alert(dator);

               $.ajax({
                     url:   'vacaciones.php',
                     type: 'post',
                     dataType: 'json',
                     data: datos,
                     success:  function (datos){ 
                          
                    }
              });


}
function listaVacaciones(id){	

window.location.href= 'listavacaciones2.php?idruta=' + id;

}
function eliminaIncidencias(id){	
    var mensaje;
    var opcion = confirm("¿Deseas eliminar la Incidencia?");
    if (opcion == true) {
        var datos = 'id='+id;
      // alert('acciones/ajax/eliminarIncidencias.php?' + datos);
           $.ajax({
                type: 'POST',
                url: 'acciones/ajax/eliminarIncidencias.php',
                data: datos,
                dataType: 'json',
                success:  function (datos){ 
                        console.log(datos);
                        alert(datos.mensaje);
                     //   window.location.href= 'rutas.php';
                     window.location.reload()
             }
            });
  
    }
}
</script>
