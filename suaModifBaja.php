<?php
include('header.php');
include 'acciones/ins/Empleados.php'; 
$lisEmplAct  = Empleados::listaEmpleadosActivos();
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
      <h1>Bajas / Modificaciones SUA</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Empleados</li>
          <li class="breadcrumb-item active">Bajas / Modificaciones SUA</li>
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
                <th>Fecha de Ingreso</th>
                <th>Tipo Nomina</th>
                <th>Modificación</th>
                <th>Baja</th>
            </tr>
        </thead>
        <tbody>
		<?php
		   foreach ($lisEmplAct as $a_ => $infoRec) {
			?>
            <tr style="font-weight: lighter;">
               
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdPlanta']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP']; ?> <?php echo $infoRec['ApellidoM']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['FechaIngreso']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nomina']; ?></th>
                <th style="text-align: center; color:red;"> <a href="acciones/funciones/altasSua.php?idempleado=<?php echo $infoRec['IdDRENC']; ?>&tipo=2" class="btn btn-secondary"  target="_blank" ><i class='bi bi-file-text' style="font-size: 18px;"></i></a></th>
                <th style="text-align: center; color:red;"> <a href="acciones/funciones/altasSua.php?idempleado=<?php echo $infoRec['IdDRENC']; ?>&tipo=3" class="btn btn-danger"  target="_blank" ><i class='bi bi-file-text' style="font-size: 18px;"></i></a></th>
                
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
    var estatus2 = document.getElementById(estatus).value;
    var datos = 'id='+id+'&estatus='+estatus2;
     $.ajax({
      type: 'POST',
      url: 'estatus.php',
      data: datos,
      success: function(respuesta) {
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
        $.ajax({
            url: 'recomendadores.php',
            type: 'post',
                success:function(datos){
                exampleModal.querySelector('#IdDRENC2').value = recipient;
                $("#ajaxcont").html(datos);
            }
        });
    var modalTitle = exampleModal.querySelector('.modal-title')
})
function agregarecomendacion(idem,fingreso){
        var idnu = document.getElementById("IdDRENC2").value;
        var  dator = 'idnuevo='+ idem +'&idrenc=' + idnu +'&fingreso='+ fingreso ;
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
