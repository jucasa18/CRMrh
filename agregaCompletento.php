<?php
include('header.php');
//include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Empleados.php'; 
$idcomplemento = $_REQUEST['idcomplemento'];
$Depto= $_REQUEST['Depto'];

//exit();

$lisEmplAct  = Empleados::listaEmpleadosComplemento($Depto);
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
      <h1>Agrega Empleados</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Settings</li>
          <li class="breadcrumb-item active">Agrega Empleados</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

  

  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Lista de Empleados por Departamento</h5>
        </div>
    <!--Inicio-->
            <form id="retardos" name="retardos"  method="post">
                 <div class="col-md-3 mb-3 px-md-3"  style="padding-top: 30px;" >
                    <label >Departamento</label>
                    <select name="Depto" id="Depto" class="form-control">
                      <option value="0">Selecciona...</option>
                    </select> 
                    <input type="hidden" id="idcomplemento" name="idcomplemento" value="<?php echo $idcomplemento; ?>">
                    <div class="row" style="padding: 10px;">
                        <button class="btn btn-dark" type="submit" name="guardar" id="guardar">Enviar</button>
                    </div>
                 </div>

            </form>



    <div class=""   style="padding: 30px;" style="width:90%;" > 
        <div class="table-responsive-xxl">
        <form id="retardos2" name="retardos2" method="post">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
    <script type="text/javascript" src="jquery.min.js"></script>

	 <table id="example" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <input type="hidden" id="idcomp" name="idcomp" value="<?php echo $idcomplemento; ?>">
            
            <tr>
                <th style="text-align: center; ">Id</th>
                <th style="text-align: center; ">Planta</th>
                <th style="text-align: center; ">Departamento</th>
                <th>Nombre</th>
                <th style="text-align: center; ">Agregar</th>
                

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($lisEmplAct as $a_ => $infoRec) {
			?>
            <tr style="font-weight: lighter;">
               
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['Planta']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['dep']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP']; ?> <?php echo $infoRec['ApellidoM']; ?></th>
                <th style="text-align: center;"><input type="checkbox"  class="form-check-input" name="check_lista[]" value="<?php echo $infoRec['IdDRENC']; ?>"></th>
            </tr>
		<?php } ?>

        </tbody>
    </table>
 <div class="row" style="padding: 10px;">
                        <button class="btn btn-dark" type="submit" name="guardarRetardo" id="guardarRetardo">Guardar</button>
                    </div>

        </div>

        </form>
  









               
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
$(document).ready(function(){
        $("#example2").DataTable({
            ajax: "complementoTabla.php"
        });
    });*/

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


 $(document).ready(function(){

$('#retardos2').on('submit',function(e){
  
var  datose = $(this).serialize();
  

			$.ajax({
	          
	          url:  'acciones/ajax/guardarComplementos.php',
              type:'POST',
              data: datose,
      
              success:  function (datos){ 
                alert(datos);
                console.log(datos);
                location.reload()
             

           
	            }
	        });
    });
  });

$("#Depto").focus(function(){
var deptid = $(this).val();
//alert("select.php");
//alert(deptid);

$.ajax({
url: 'selectDL.php',
type: 'post',
//data: {depart:deptid},
dataType: 'json',
success:function(response){
   //alert(response);

var len = response.length;

$("#Depto").empty();
for( var i = 0; i<len; i++){
var id = response[i]['id'];
var name = response[i]['name'];

$("#Depto").append("<option value='"+id+"'>"+name+"</option>");

}
}
});
});

$(document).ready(function(){
$('#retardos').on('submit',function(e){
    var  datose = $(this).serialize();
    $.ajax({
                  url:   'complementoTabla.php',
                   type: 'POST',
                  // dataType: 'json',
                   data: datose,
                   dataType: 'html',
                   global: true,
                  ifModified: false,
                  processData:true,
                  contentType: "application/x-www-form-urlencoded",
        beforeSend: function () {
                        $("#ajaxcont").html("</br></br></br></br>Procesando, Espere por favor...");
                       // $("#ajaxcont").html(datos);
                },
        success:  function (datos) {
					$("#ajaxcont").html(datos);
                }  
              });
        });
  });
</script>
