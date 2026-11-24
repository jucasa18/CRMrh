<?php
include('header.php');
//include('conexion.php');
include 'acciones/ins/Empleados.php'; 
include 'acciones/funciones/vacaciones.php'; 
$id = $_REQUEST['idempleado'];
$lisEmp  = Empleados::listaEmpleadobyId($id);
 
?>
    <script>
        function previewImage(nb) {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById('uploadImage' + nb).files[0]);
            reader.onload = function(e) {
                document.getElementById('uploadPreview' + nb).src = e.target.result;
            };
        }
    </script>
<script>

	
</script>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Pase de Entrada</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item">Incidencias</li>
      <li class="breadcrumb-item active">Pase de Entrada</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


                <!-- Customers Card -->
           
                                
 <!--<form class="needs-validation" novalidate method="POST" action="action/addUser.php" >-->
  <!--<form class="needs-validation" novalidate    action="update_employee.php" name="update_register2" id="update_register2" method="post" enctype="multipart/form-data" >-->


 
 
  <div class="card info-card customers-card">
  <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Datos Empleado</h5>
        </div>
    <!--Inicio-->
  
           
          <!--fin-->
          <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
            <div class="input-group mb-2">
            <div class="col-md-3 mb-3 px-md-3 ">

           
              <form   name="update_register2" id="update_register2" method="post" >
                <label>Id DRENC</label>
                <input type="text" class="form-control" id="IdDRENC"  name="IdDRENC"  placeholder="IdDRENC" value="<?php echo $lisEmp['IdDRENC']; ?>" readonly="readonly">
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-3 mb-3 px-md-3" >
                <label >Planta</label>
                <input type="text" class="form-control" id="IdPlanta"  name="IdPlanta"   value="Planta <?php echo $lisEmp['IdPlanta'];?>" readonly="readonly">
               
              </div>  
              <div class="col-md-3 mb-3 px-md-3" >
                <label >Fecha de Ingreso</label>
                <input type="date" class="form-control" id="FechaIngreso"  name="FechaIngreso"   required value="<?php echo $lisEmp['FechaIngreso'];?>"  readonly="readonly" >
                
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>

              <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Nomina</label>
                <input type="text" class="form-control" id="Nomina"  name="Nomina"   value="<?php echo $lisEmp['Nom'];?>" readonly="readonly">
               
              </div>
            
            </div>
          <!--fin-->
  <!--Inicio-->
  <div class="input-group mb-2">
  <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom01">Departamento</label>
                <input type="text" class="form-control" id="Depto"  name="Depto"   value="<?php echo $lisEmp['departamento'];?>" readonly="readonly">
               
              </div>
              <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Linea</label>
                <input type="text" class="form-control" id="Linea"  name="Linea"   value="<?php echo $lisEmp['linea'];?>" readonly="readonly">

                <input type="hidden" class="form-control" id="Nombre"  name="Nombre"   value="<?php echo $lisEmp['Nombre'];?> <?php echo $lisEmp['ApellidoP'];?> <?php echo $lisEmp['ApellidoM'];?>" readonly="readonly">
               
              </div>
             
              <div class="col-md-3 mb-3 px-md-3">
              <label for="validationCustom02">Puesto</label>
              <input type="text" class="form-control" id="Puesto"  name="Puesto"   value="<?php echo $lisEmp['nompuesto'];?>" readonly="readonly">
                     
              </div>
  <!--fin-->
  </div>


     
  <!--fin-->
  </div>


  <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Datos  Pase de Entrada</h5>
      
      </div>
      <!--Inicio-->

<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >       
  <div class="input-group mb-2 ">
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Fecha día Omisión</label>
     <!-- <input type="date" class="form-control" id="FechaInicio"   name="FechaInicio" value="<?php echo date('Y-m-d'); ?>"   min="<?php echo date('Y-m-d') ?>" required >-->
     <input type="date" class="form-control" id="FechaIncidencia"   name="FechaIncidencia" value="<?php echo date('Y-m-d'); ?>" required >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
        <label for="validationCustom02">Hora Entrada</label>
        <input type="time" class="form-control" id="Hora" name="Hora" required>  
        
         
     </div>


     
     <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Motivo</label>
      <input type="text" class="form-control" id="Motivo" name="Motivo"  required>
      <input type="hidden" class="form-control" id="TipoIncidencia" name="TipoIncidencia" value="3" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
   
   
<!--fin-->

</div>
</div>

  <div class="row" style="padding: 50px;">

  <button class="btn btn-dark" type="submit" name="guardar" id="guardar">Guardar Datos</button>


</div>
  
</form>
      

                        </div>
                    </div>

                </div><!-- End Customers Card -->


                <!-- Button trigger modal -->

<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="123">da click</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reagendando citax...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <!-<form id="frm-gurdarPoP"  action="../citas/ajax/editarCita.php" method ="post" class="row mb-5 mx-0"> ->
	  <form id="frm-gurdarPoP"   method ="post" class="row mb-5 mx-0">
		  <div id="ajaxcont" class="modal-body">






		  </div>
	  </form> 
      
    </div>
  </div>
</div>-->

<!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-whatever="@mdo"  data-bs-target="#exampleModal">
  Launch static backdrop modal
</button>-->







            </div>

            <!-- Right side columns -->
            <div class="col-lg-4">

            </div>
        </div>
    </div>
</section>


</main>

    <script>
      /*  $.fn.delayPasteKeyUp = function(fn, ms) {
            var timer = 0;
            $(this).on("propertychange input", function() {
                clearTimeout(timer);
                timer = setTimeout(fn, ms);
            });
        };

        //la utilizamos
        $(document).ready(function() {
            $("#clave").delayPasteKeyUp(function() {
                $("#respuesta").append("Producto registrado: " + $("#clave").val() + "");
                $("#clave").val("");
            }, 200);
        });*/
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
                if (e.keyCode == 13) {
                    e.preventDefault();
                }
            }))
        });
    </script>
    <script src=" https://code.jquery.com/jquery-3.6.0.js " integridad="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anónimo"></script>
    <script src="https://kit.fontawesome.com/3bfb8be62d.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
   


    <script>
/*(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
          /*enviar2();
         
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();*/


function enviar2(){

$("document").ready(function () {
	 
		$('#formdata').on('submit',function(e){
			e.preventDefault();
      names = $(this).serialize();
			console.log(names);
			// si activa tambien por sms verficar que exista un numero de telefono
	
			$('#botonenviar').prop('disabled',true);
			$.ajax({
	            data:  names,
              url:   'insert_empledado.php',
	            type:  'POST', 
	            dataType: "json",  
				success:  function (datos){ 
	                console.log(datos);
	               // window.location.href= '../';
	               // $('#botonenviar').prop('disabled',false);
                  //$("#exampleModal").modal("show");
                /*  $('#exampleModal').modal({ show:true });
                  $("#ajaxcont").html(' <p>'+ datos.mensaje +'"</p>' );*/
       
                 
					
	            }
	        });
		})
		
	
	}); 

}

    function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}




function enviar_ajax(){	
  alert("entro");

    $.ajax({
      type: 'POST',
      url: 'add_empledado',
      data: $('#formdata').serialize(),
      success: function(respuesta) {
        alert("respuesta");
        if(respuesta=='ok'){
        alert('enviado');
        }
        else {
        alert('error');
        }
    }
    });
}





</script>

<script>
  function validaCurp(curp){
     
      var curp = curp;
      if(curp.match(/^([a-z]{4})([0-9]{6})([a-z]{6})([0-9]{2})$/i)){//AAAA######AAAAAA##
      alert('curp válida!');
      }else{
      alert('curp incorrecta!');
}
  }

  function validaRfc(rfc){
     
     var rfc = rfc;
     if(rfc.match(/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/)){//AAAA######AAAAAA##
     alert('curp válida!');
     }else{
     alert('curp incorrecta!');
}
 }


 $('.decimales').on('change', function () {
  this.value = unmaskDinero(this.value);
});

function unmaskDinero(numeroString) {
    return +(numeroString.replace(/[^0-9.-]+/g,""));
}
function maskDinero(numeroInt) {
    return "$" + parseFloat(numeroInt).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}

function recargar () {
  location.reload();
 }

 $(document).ready(function(){

$("#Ruta").focus(function(){
var deptid = $(this).val();

$.ajax({
url: 'select.php',
type: 'post',
//data: {depart:deptid},
dataType: 'json',
success:function(response){
  //alert(response);

var len = response.length;

$("#Ruta").empty();
for( var i = 0; i<len; i++){
var id = response[i]['id'];
var name = response[i]['name'];

$("#Ruta").append("<option value='"+id+"'>"+name+"</option>");

}
}
});
});

});

$("#Ruta").change(function(){
var deptid = $("#Ruta").val();
$.ajax({
url: 'select.php',
type: 'post',
data: {depart:deptid},
dataType: 'json',
success:function(response){
  //alert(response);

var len = response.length;
$("#Parada").empty();
for( var i = 0; i<len; i++){
var id = response[i]['id'];
var name = response[i]['name'];

$("#Parada").append("<option value='"+id+"'>"+name+"</option>");

}
}
});
});
$(document).ready(function(){
$('#update_register2').on('submit',function(e){
  //  $("#update_register").validate();

 //   $("#save").focus(function(){

//  $('#inputnombre').addClass('is-valid')
/*data = $(this).serializeArray();
console.log(data);
                  alert(data);*/
//alert("entro");
var  datose = $(this).serialize();
   //console.log('acciones/ajax/guardarIncidencias.php?'+datose);
                //alert('acciones/ajax/guardarIncidencias.php?'+datose);
			$.ajax({
	          //  data:  datos,
	            url:  'acciones/ajax/guardarIncidencias.php',
              type:'POST',
              data: datose,
              dataType: 'json',
              success:  function (datos){ 
	               console.log(datos);
                  alert(datos);
                  alert('Datos actualizados');
                 // window.location.href= 'edit_employee.php?idempleado='+ datos;
                 location.reload();
                 
	            }
	        });
    });
  });
$(document).ready(function(){
$('#update_register').on('submit',function(e){
  //  $("#update_register").validate();
 //   $("#save").focus(function(){
//  $('#inputnombre').addClass('is-valid')
//alert("entro");
var x = new FormData(this);
console.log(x );
alert(x);
			$.ajax({
	            url:  'editaFoto.php',
              type:'POST',
              data: new FormData(this),
              //ContenType: false; ya que estamos cargando archivos
              contentType:false,
              //No queremos guardar la cache en el navegador
              cache:false,
              processData:false,
	            success:  function (datos){ 
	               console.log(datos);
                  alert(datos);
                  alert('Datos actualizados');
                 // window.location.href= 'edit_employee.php?idempleado='+ datos;
                 location.reload();
                 
	            }
	        });
    });
  });
/*

  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
 //var parametros="?idCita="+recipient;
  $.ajax({
				//data:  parametros,
			    //url:   _global_ruta+'modulos/clinica/citas/editar/?idCita='+recipient,
				url:   'acciones/ajax/editaEmpleado.php',
                type:  'post',
                beforeSend: function () {
                        $("#ajaxcont").html("</br></br></br></br>Procesando, Espere por favor...");
                },
                success:  function (response) {
						//alert(response);
                        $("#ajaxcont").html(response);
                }  
        });
  var modal = $(this)    
  //modal.find('.modal-title').text('Reagendando cita...' + recipient)
	
  //modal.find('.modal-body input').val(recipient)
	
	
})
*/
function calculardiasDiscount() {
        var timeStart = new Date(document.getElementById("FechaInicio").value);
        var timeEnd = new Date(document.getElementById("FechaFin").value);
        var actualDate = new Date();
        if (timeEnd > timeStart)
        {
            var diff = timeEnd.getTime() - timeStart.getTime();
            document.getElementById("DiasPedidos").value = Math.round(diff / (1000 * 60 * 60 * 24));
        }
        else if (timeEnd != null && timeEnd < timeStart) {
            alert("La fecha final de la promoción debe ser mayor a la fecha inicial");
            document.getElementById("daysDiscount").value = 0;
        }
    }
    
    
    function calculaPagoVac() {
        var sd = document.getElementById("SueldoDiario").value;
        var dp = document.getElementById("DiasPedidos").value;
        var st = sd * dp;
        document.getElementById("SubTotal").value = st.toFixed(2);
        var pv = dp * 0.25 * sd;  
        document.getElementById("PrimaVacacional").value = pv.toFixed(2);
        var total = st + pv;
        document.getElementById("TototalaPagar").value = total.toFixed(2);
        var dd = document.getElementById("DiasDisfrutados").value;
        var tdd = parseInt(dd) + parseInt(dp);
        document.getElementById("DiasDisfrutados").value = tdd;
        var  tv = document.getElementById("TotalVacaciones").value;
        var ddisp = parseInt(tv) - (parseInt(dd) + parseInt(dp))  ;
        document.getElementById("DiasDisponibles").value = ddisp;
    }

    function calculaIncapacidad() {
        var tv = document.getElementById("TipoVacacion").value;
        if(tv == 3){
          //alert('ocultar campos');
          document.getElementById("DiasDisfrutados").disabled = true;
          document.getElementById("TotalVacaciones").disabled = true;
          document.getElementById("DiasDisponibles").disabled = true;
          document.getElementById("FormaPago").disabled = true;
          document.getElementById("SubTotal").disabled = true;
          document.getElementById("PrimaVacacional").disabled = true;
          document.getElementById("DiasPedidos").disabled = true;         
          document.getElementById("incapacidad").style.display =  '';
        } else{
          document.getElementById("DiasDisfrutados").disabled = false;
          document.getElementById("TotalVacaciones").disabled = false;
          document.getElementById("DiasDisponibles").disabled = false;
          document.getElementById("FormaPago").disabled = false;
          document.getElementById("SubTotal").disabled = false;
          document.getElementById("PrimaVacacional").disabled = false;
          document.getElementById("DiasPedidos").disabled = false;
          document.getElementById("incapacidad").style.display =  'none';
        }
    }


</script>

<?php
    include('footer.php');
?>

<style>


/*label.error {
    color: red;
    font-size: 1rem;
    display: block;
    margin-top: 5px;
}

input.error, textarea.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}
.validate:invalid {
  border-color: red;
}

:invalid {
  border-color: red; /*coloreamos el borde del input:invalid de rojo*
}*/
input:focus:invalid,
#commentform textarea:focus:invalid {
    background-color: transparent;
    border: 2px solid #b92326;
}
/*
:valid {
  background-color: powderblue;
}
:invalid {
  background-color: pink;
}*/




</style>