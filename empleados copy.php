<?php
include('header.php');
//include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Empleados.php'; 
$lisEmplAct  = Empleados::listaEmpleadosActivos();
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
      <h1>Empleados</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Empleados</li>
          <li class="breadcrumb-item active">Lista Empleados</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

  

  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Lista de Empleados</h5>
        </div>
    <!--Inicio-->
        <div class=""   style="  padding: 30px;" style="width:90%;" > 
        <div class="table-responsive-xxl">
        <table id="example" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <tr>
                <th>Id</th>
                <th>Planta</th>
                <th>Nombre</th>
                <th>CURP</th>
               <!-- <th>Puesto</th>
                <th>Departamento</th>-->
                <th>Tipo Nomina</th>
                <th>Estatus</th>
               <!-- <th>Recomendación</th>-->
                <th>Contratos</th>
                <th>Editar</th>
                <th>Ubicación</th>
                <th>Eliminar</th>
                

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
                <th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP']; ?> <?php echo $infoRec['ApellidoM']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Curp']; ?></th>
                <!-- <th style="font-weight: lighter;"><?php echo $infoRec['Puesto']; ?></th>
               <th style="font-weight: lighter;"><?php echo $infoRec['Depto']; ?></th>-->
               
                <th style="font-weight: 600;"><?php echo $infoRec['Nomina']; ?></th>
                <th style="text-align: center; " class="form-control">
                    <select style="text-align: center; " name="estatus<?php echo $infoRec['IdDRENC']; ?>" id="estatus<?php echo $infoRec['IdDRENC']; ?>" class="form-control" onchange="cambiaEstatus('<?php echo $infoRec['IdDRENC']; ?>','estatus<?php echo $infoRec['IdDRENC']; ?>');">
                        <option <?php $op3= 0; if($infoRec['Estatus'] == '1'){ $op3 = 1; $opt3 = 'Activo'; }else{$op3 = 2; $opt3 = 'Baja';} ?> value='<?php echo $op3;?>'><?php echo $opt3;?></option>
                        <option value="1">Activo</option>
                        <option value="0">Baja</option>
                    </select>
                </th>
               <!-- <th style="text-align: center; "><button type="button" class="btn btn-secondary" name="recomendacion" id="recomendacion" value="recomendacion"  data-bs-target="#recomendaciones" data-bs-toggle="modal" data-bs-whatever="<?php echo $infoRec['IdDRENC']; ?>" ><i class='bi bi-person-plus-fill' style="font-size: 18px;"></i></button></th>-->
                <th style="text-align: center; color:red;"> <a href="html2/contrato.php?idempleado=<?php echo $infoRec['IdDRENC']; ?>" class="btn btn-secondary"  target="_blank" ><i class='bi bi-file-earmark-pdf-fill' style="font-size: 18px;"></i></a></th>
                <th> <a href="edit_employee.php?idempleado=<?php echo $infoRec['IdDRENC']; ?>" class="btn btn-secondary" ><i class='bi bi-pencil-fill' ></i></a></th>
                
                <!-- VER UBICACIÓN EN GOOGLE MAPS -->
                            <th style="text-align: center;">
                            <?php if (
    isset($infoRec['Latitud'], $infoRec['Longitud']) &&
    is_numeric($infoRec['Latitud']) &&
    is_numeric($infoRec['Longitud'])
): ?>

    <button type="button"
        class="btn btn-primary"
        onclick="abrirMapaEmpleado(
            <?php echo (float)$infoRec['Latitud']; ?>,
            <?php echo (float)$infoRec['Longitud']; ?>
        )"
        title="Ver ubicación del empleado">

        <i class="bi bi-geo-alt-fill"></i>
    </button>

<?php else: ?>

    <button type="button"
        class="btn btn-secondary"
        disabled
        title="Ubicación no registrada">

        <i class="bi bi-geo-alt"></i>
    </button>

<?php endif; ?>
                            </th>
                
                <th><button type="button" class="btn btn-danger" value='<?php echo $infoRec['IdDRENC']; ?>' name="idelimina" id="idelimina" onclick="eliminaEmpleado('<?php echo $infoRec['IdDRENC']; ?>');"><i class='bi bi-trash-fill'></i></button></th>
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

 <!--Modal para mostrar el mapa-->

          
<!-- Modal para mostrar la ubicación del empleado -->
<div class="modal fade" id="modalMapa" tabindex="-1"
     aria-labelledby="tituloMapa" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="tituloMapa">
                    <i class="bi bi-geo-alt-fill"></i>
                    Ubicación del empleado en México
                </h5>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div id="mapaMexico"
                     style="width:100%; height:550px;"></div>
            </div>

        </div>
    </div>
</div>
  


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
            "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
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
    var button = event.relatedTarget;

if (!button) {
    return;
}

var recipient = button.getAttribute('data-bs-whatever');
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
</script>
<style>

#modalMapa .modal-dialog {
    width: 90%;
    max-width: 1100px;
    margin: 1.75rem auto;
}

#modalMapa .modal-content {
    width: 100%;
    min-height: 600px;
}

#modalMapa .modal-body {
    width: 100%;
    min-height: 550px;
}

#mapaMexico {
    width: 100% !important;
    height: 550px !important;
    min-height: 550px !important;
}
</style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log('Leaflet:', typeof L);
    console.log('Bootstrap:', typeof bootstrap);
    console.log('Contenedor:', document.getElementById('mapaMexico'));

});
</script>

<script>

let mapaMexico = null;
let marcadorEmpleado = null;

function abrirMapaEmpleado(latitud, longitud) {

    const lat = parseFloat(latitud);
    const lng = parseFloat(longitud);

    const modalElemento = document.getElementById('modalMapa');

    if (!modalElemento) {
        console.error('No existe el modal del mapa');
        return;
    }

    if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
        alert('Coordenadas incorrectas');
        return;
    }

    document.body.appendChild(modalElemento);

    const modal = bootstrap.Modal.getOrCreateInstance(modalElemento);

    const iniciarMapa = function () {

        const contenedor = document.getElementById('mapaMexico');

        if (!mapaMexico) {

            mapaMexico = L.map(contenedor).setView(
                [23.6345, -102.5528], 5
            );

            L.tileLayer(
                'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19
                }
            ).addTo(mapaMexico);

            marcadorEmpleado = L.marker([lat, lng])
                .addTo(mapaMexico)
                .bindPopup('Ubicación del empleado');

        } else {

            mapaMexico.invalidateSize(true);

            mapaMexico.setView([lat, lng], 12);

            marcadorEmpleado.setLatLng([lat, lng]);

        }

        setTimeout(function () {
            mapaMexico.invalidateSize(true);
            mapaMexico.setView([lat, lng], 12);
            marcadorEmpleado.openPopup();
        }, 300);
    };

    modalElemento.addEventListener(
        'shown.bs.modal',
        iniciarMapa,
        { once: true }
    );

    modal.show();
}

</script>