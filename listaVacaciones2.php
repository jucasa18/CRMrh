<?php
include('header.php');
//include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Vacaciones.php'; 
$idempleado = $_REQUEST['idempleado'];
$lisVacaciones  = Vacaciones::listaVacacionesxempleado($idempleado);
$listEmpleado = Vacaciones::listaEmpleadobyId($idempleado);


/*$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
$instruccion_SQL = "SELECT * FROM empleados WHERE Estatus=1";
$resultado = mysqli_query($con, $instruccion_SQL);*/

/*$miFecha = "02-11-2021";
//echo fechaEs($miFecha);

function fechaEs($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
    }*/
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
      <h1>Vacaciones</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Incidencias</li>
          <li class="breadcrumb-item active">Vacaciones</li>
          <li class="breadcrumb-item active">Lista Vacaciones</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

  

  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Lista Vacaciones de: <?php echo $listEmpleado['Nombre'] ?> <?php echo $listEmpleado['ApellidoP']; ?> <?php echo $listEmpleado['ApellidoM']; ?></h5>
        </div>
    <!--Inicio-->
        <div class=""   style="  padding: 30px;" style="width:90%;" > 
        <div class="table-responsive-xxl">
        <table id="example" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <tr>
              
                <th>id</th>
                <th>Id DR-ENC </th>
                <th>Tipo</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Forma de Pago</th>
                <th>Dias Pedidos</th>
                <th>Dias Inc</th>
            
                <th>Formato</th>
                <th>Eliminar</th>
                
                
              <!--  <th>Editar</th>-->
              <!--  <th>Contratos</th>
                <th>Editar</th>
                <th>Eliminar</th>-->
                

            </tr>
        </thead>
        <tbody>
		<?php
		//foreach ($resultado as $a_ => $infoRec) {
            foreach ($lisVacaciones as $a_ => $infoRec) {
                $TipoVacacion = TipoVac($infoRec['TipoVacacion']);
                $FormaPago = FormaPago($infoRec['FormaPago']);
			?>
            <tr style="font-weight: lighter;">
               
                
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['id']; ?></th>     
                <th style="font-weight: 600; text-align: center; "><?php echo $listEmpleado['IdDRENC']; ?></th>    
                <th style="font-weight: 600; text-align: center; "><?php echo $TipoVacacion; ?></th>   
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['FechaInicio']; ?></th>   
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['FechaFin']; ?></th>   
                <th style="font-weight: 600; text-align: center; "><?php echo $FormaPago; ?></th>   
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['DiasPedidos']; ?></th>   
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['DiasIncapacidad']; ?></th>  
                                           
                <th style="text-align: center; "><a href="html2/FormatoVacaciones.php?IdDRENC=<?php echo $listEmpleado['IdDRENC']; ?>&id=<?php echo $infoRec['id']; ?>" target="_blank"  class="btn btn-secondary" ><i class='bi bi-file-earmark-pdf' ></i></a></th>
                <th style="text-align: center;"><button type="button" class="btn btn-danger" value='<?php echo $infoRec['id']; ?>' name="idelimina" id="idelimina" onclick="eliminaVacaciones('<?php echo $infoRec['id']; ?>');"><i class='bi bi-trash-fill'></i></button></th>
               
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

    
function TipoVac($tv){
	
	switch ($tv) {
		case 1:
			$tv = 'VAC. 1Año';
			break;
		case 2:
			$tv = 'VAC. 2Año';
			break;
		case 3:
			$tv = 'INCAP.';
			break;
		case 4:
			$tv = 'VAC. ESP';
			break;
		case 5:
			$tv = 'VAC.PRE';
			break;
	}
	return $tv;
}
function FormaPago($fp){
	
	switch ($fp) {
		case 1:
			$fp = 'VACACIONES DISFRUTADAS';
			break;
		case 2:
			$fp = 'VACACIONES PAGADAS';
			break;
		
	}
	return $fp;
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
</script>
