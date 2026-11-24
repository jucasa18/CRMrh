<?php
include('header.php');
//include('conexion.php');
include 'acciones/ins/Empleados.php'; 
include 'acciones/ins/Deducciones.php'; 
$id = $_REQUEST['idDeduccion'];
$idEmpleado = $_REQUEST['idempleado'];
$lisEmp  = Empleados::listaEmpleadobyId($idEmpleado);
$deduccion  = Deducciones::DeduccionByid($id);

$tipo = '';
switch (intval($deduccion['Tipo'])) {
   case 1:
      $tipo = 'Infonavit';
      break;
  case 2:
      $tipo = 'Fonacot';
      break;
  case 3:
      $tipo =  "Pensión Alimenticia";
        break;
}

 ?>
<script>	
</script>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Edita Deducciones</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item">Deducciones</li>
      <li class="breadcrumb-item active">Edita Deducciones</li>
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
      <h5 class="card-title" style="color: #ffffff;">Datos Deduccion</h5>
      
      </div>
      <!--Inicio-->

<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >       
  <div class="input-group mb-2 ">

  <div class="col-md-3 mb-3 px-md-3">
    <label for="validationCustom02">Tipo de Deducción</label>
      <input type="hidden" class="form-control" id="id"  name="id"   value="<?php echo $deduccion['id'];?>">
     
          <select name="Tipo" id="Tipo" class="form-control"  >
              <option value="<?php echo $deduccion['Tipo']; ?>"><?php echo $tipo ?></option>
              <option value="1">Infonavit</option>
              <option value="2">Fonacot</option>
              <option value="3">Pensión  Alimenticia</option>
          </select>
     </div>


     <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Cantidad</label>
            <input type="text" class="form-control decimales" id="Cantidad" name="Cantidad" value="<?php echo $deduccion['Cantidad']; ?>" placeholder="Cantidad" >
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
   /*console.log('acciones/ajax/editaDeducciones.php?'+datose);
                alert('acciones/ajax/editaDeducciones.php?'+datose);*/
			$.ajax({
	          //  data:  datos,
	            url:  'acciones/ajax/editaDeducciones.php',
              type:'POST',
              data: datose,
              dataType: 'json',
              success:  function (datos){ 
	              /* console.log(datos);
                  alert(datos.mensaje);*/
                  alert(datos.mensaje);
                 // window.location.href= 'edit_employee.php?idempleado='+ datos;
                 //location.reload();  istaTt.php
                 window.location.href= datos.tipo;
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