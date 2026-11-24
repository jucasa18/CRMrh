<?php
include('header.php');
//include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Empleados.php'; 
$fecha = $_REQUEST['FechaRetardo'];
//echo $fecha;
//exit();

$lisEmplAct  = Empleados::listaEmpleadosActivosRetardos($fecha);
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
      <h1>Retardos de Ruta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Incidencias</li>
          <li class="breadcrumb-item active">Retardos de Ruta</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

  

  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Lista de Retardos de Ruta</h5>
        </div>
    <!--Inicio-->
            <form id="retardos" name="retardos" action="retardos.php" method="post">
                 <div class="col-md-3 mb-3 px-md-3"  style="padding-top: 30px;" >
                    <label >Fecha de Retrasos</label>
                    <input type="date" class="form-control" id="FechaRetardo"   name="FechaRetardo" value="<?php echo date('Y-m-d'); ?>">
                    <div class="row" style="padding: 10px;">
                        <button class="btn btn-dark" type="submit" name="guardar" id="guardar">Enviar</button>
                    </div>
                 </div>

            </form>




        <div class=""   style="padding: 30px;" style="width:90%;" > 
        <div class="table-responsive-xxl">
        <form id="retardos2" name="retardos2" method="post">
        <table id="example" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <tr>
                <th>Id</th>
                <th>Planta</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th style="text-align: center; ">Ruta</th>
              
                <th style="text-align: center; ">Entrada</th>
                <th style="text-align: center; ">Retardo</th>
                

            </tr>
        </thead>
        <tbody>
		<?php
		//foreach ($resultado as $a_ => $infoRec) {
            foreach ($lisEmplAct as $a_ => $infoRec) {
			?>
            <tr style="font-weight: lighter;">
               
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdPlanta']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['Fecha']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP']; ?> <?php echo $infoRec['ApellidoM']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['nombre']; ?></th>
              
                <th style="font-weight: 600; text-align: center;"><?php echo $infoRec['Entrada']; ?></th>
                <th style="text-align: center;"><input type="checkbox"  class="form-check-input" name="check_lista[]" value="<?php echo $infoRec['id']; ?>"></th>
            </tr>
		<?php } ?>

        </tbody>
    </table>
   

    <div class="row" style="padding: 10px;">
                        <button class="btn btn-dark" type="submit" name="guardarRetardo" id="guardarRetardo">Guardar</button>
                    </div>

        </div>

        </form>

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


/*function guardaretardos(){

    
        var  datose = $("#retardos2").serialize();
    console.log('acciones/ajax/guardarRetardos.php?'+datose);
                 alert('acciones/ajax/guardarRetardos.php?'+datose);

			$.ajax({
	          //  data:  datos,
	            url:  'acciones/ajax/guardarRetardos.php',
              type:'POST',
              data: datose,
              dataType: 'json',
              success:  function (datos){ 
                console.log(datos);
                //alert(datos.id);
               // alert(datos.id);
              //   window.location.href= 'empleados.php';
             alert('Datos actualizados');
           //  window.location.href= 'edit_employee.php?idempleado='+ datos.id;
           location.reload()
             

           
	            }
	        });
 
        }*/




 $(document).ready(function(){

$('#retardos2').on('submit',function(e){
  
var  datose = $(this).serialize();
  

			$.ajax({
	          
	            url:  'acciones/ajax/guardarRetardos.php',
              type:'POST',
              data: datose,
      
              success:  function (datos){ 
                console.log(datos);
                location.reload()
             

           
	            }
	        });
    });
  });
</script>
