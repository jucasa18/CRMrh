<?php
include('header.php');
require 'conexion.php';
$id = $_REQUEST['id'];
//$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
$sql = "SELECT * FROM user WHERE is_active= 1 AND id =$id ";
//echo $sql;
$resultado = mysqli_query($conexion, $sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);


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

                <!-- Customers Card -->
           
<main id="main" class="main">

<div class="pagetitle">
  <h1>Edita Usuario</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item">Usuario</li>
      <li class="breadcrumb-item active">Edita Usuario</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
                             
 <!--<form class="needs-validation" novalidate method="POST" action="action/addUser.php" >-->
 <!--<form class="needs-validation" novalidate    action="insert_empleado.php" name="update_register" id="update_register" method="post" enctype="multipart/form-data" >-->


 
     <!-- <p> Ingresa la información.</p>-->
     <form class="needs-validation" novalidate id="formdata"   method="POST"    action="update_user.php" >


  <div class="card info-card customers-card">
  <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Datos DR-ENC</h5>
        </div>
    <!--Inicio-->
  
           
          <!--fin-->
  <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
  <div class="input-group mb-2 ">
                <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Nombre</label>
                <input type="text" class="form-control" id="name"  name="name" value="<?php echo $row['name']; ?>" required>
                <input type="hidden" class="form-control" id="id"  name="id"  placeholder="id" value="<?php echo $row['id']; ?>" >
                <div class="valid-feedback">
                        Looks good!             
                </div>
                </div>
                <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Número de empleado</label>
                <input type="text" class="form-control" id="numEmpleado" name="numEmpleado"  value="<?php echo $row['numEmpleado']; ?>" required  onkeypress="return event.charCode>=48 && event.charCode<=57" >
                <div class="valid-feedback">
                        Looks good!             
                </div>
                </div>
                <div class="col-md-6 mb-3 px-md-3">
                <label for="validationCustom03">Correo Electrónico</label>
                <input  type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
              
                       
             
          <!--fin-->
          <!--Inicio-->
            <div class="input-group mb-2">
                <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Tipo de usuario</label>
                     <select name="tipo" id="tipo" class="form-control">
                        < <option <?php $op3= 0; if($row['tipo'] = 1){ $op3 = 1; $opt3 = 'Admin'; }elseif($row['tipo'] = 2){$op3 = 2; $opt3 = 'RH';}elseif($row['tipo'] = 3){$op3 = 3; $opt3 = 'RHC Garantía';} ?> value='<?php echo $op3;?>'><?php echo $opt3;?></option>
                        <option value="1">Admin</option>
                        <option value="2">RH</option>
                        <option value="3">RHC</option>
                      </select>
                <div class="valid-feedback">
                      Looks good!             
              </div>
              </div>
              <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Planta</label>
                      <select name="planta" id="planta" class="form-control">
                      <option <?php $op1= 0; if($row['planta'] = 1){ $op1 = 1;}else{$op1 = 2;} ?> value='<?php echo $op1;?>'>Planta <?php echo $row['planta'];?></option>
                        <option value="1">Planta 1</option>
                        <option value="2">Planta 2</option>
                        
                      </select>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
             
            <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Password</label>
                <input type="password" class="form-control" id="password"  name="password" value='<?php echo $row['pass'];?>' required>
                <div class="valid-feedback">
                        Looks good!             
                </div>
                </div>
              
              
  <!--fin-->
  </div>
  </div>
  </div>






  <div class="row" style="padding: 50px;">

  <button class="btn btn-dark" type="submit" id="botonenviar">Agregar Camnbio </button>

</div>
  
    

                        </div>
                    </div>

                </div><!-- End Customers Card -->


                




            </div>

            <!-- Right side columns -->
            <div class="col-lg-4">

            </div>
        </div>
    </div>
</section>




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
   <!-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
                if (e.keyCode == 13) {
                    e.preventDefault();
                }
            }))
        });
    </script>-->
    




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
})();

(function () {
  'use strict'

  // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
  var forms = document.querySelectorAll('.needs-validation')
 // Bucle sobre ellos y evitar el envío
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
          
        }
 

        var val = form.checkValidity();
        alert (val);

        if (form.checkValidity() === true){
                alert("entro al ajax");

         
              //   $("#save").focus(function(){
               //  names = $(this).serialize();
                    //$('#save').prop('disabled',true);
                    names = "JUANA=JUANA" 
                   
              console.log(names);
           
                    $.ajax({
                            data:  names,
                            url:   'acciones/ajax/guardarNuevoEmpleado.php',
                            type:  'POST', 
                            dataType: "json",  
                            success:  function (datos){ 
                                console.log(datos);
                                window.location.href= 'empleados.php';
                              // $('#save').prop('disabled',false);
                              event.preventDefault()
                              event.stopPropagation()
                            }
                        });
                     
                  
                 
        }


    

     





        form.classList.add('was-validated')
       
      }, false)
      
      
    })
   
})()


/*
$(document).ready(function() {
  
  $("#update_register").validate();
  
  
});*/


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
	                $('#botonenviar').prop('disabled',false);
                  $("#exampleModal").modal("show");
                  //  $("#ajaxcont").html(' <p>'+ datos.mensaje +'"</p>' );
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

 function mandaselect() {
  var cod = document.getElementById("Ruta").value;
  alert(cod);
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

function validacionCurp(){	
    //var dato = id;
    var dato = document.getElementById("Curp").value;
    datos = 'dato='+dato;
    //alert(datos);
     $.ajax({
      type: 'POST',
      url: 'validaciones.php',
      data: datos,
      success: function(respuesta) {
     //  alert(respuesta);
      // window.location='empleados.php';
       //window.location.href = 'empleados.php';
       if(respuesta=='inn'){
        alert('El empleado se encuentra inactivo');
        window.location='exempleados.php';
        }
    }
    });
}
function validacionRfc(){	
    //var dato = id;
    var dato = document.getElementById("Rfc").value;
    datos = 'dato='+dato;
    //alert(datos);
     $.ajax({
      type: 'POST',
      url: 'validaciones.php',
      data: datos,
      success: function(respuesta) {
     //  alert(respuesta);
      // window.location='empleados.php';
       //window.location.href = 'empleados.php';
       if(respuesta=='inn'){
        alert('El empleado se encuentra inactivo');
        window.location='exempleados.php';
        }
    }
    });
}
function validacioNss(){	
    //var dato = id;
    var dato = document.getElementById("Nss").value;
    datos = 'dato='+dato;
    //alert(datos);
     $.ajax({
      type: 'POST',
      url: 'validaciones.php',
      data: datos,
      success: function(respuesta) {
     //  alert(respuesta);
      // window.location='empleados.php';
       //window.location.href = 'empleados.php';
       if(respuesta=='inn'){
        alert('El empleado se encuentra inactivo');
        window.location='exempleados.php';
        }
    }
    });
}




function enviaAjaxEmpleado(){	
      names = $('#update_register').serialize();
			$('#btn-gurdar').prop('disabled',true);

			$.ajax({
	            data:  names,
	            url:   'acciones/ins/Empleados_principal.php',
	            type:  'POST', 
	            dataType: "json",  
	            success:  function (datos){ 
	                console.log(datos);
	                window.location.href= 'empleados.php';
	                $('#btn-save').prop('disabled',false);
	            }
	        });
		}
/*$(document).ready(function(){


  $('#update_register').on('submit',function(e){
 
 alert("entro");
      names = $(this).serialize();
		alert(names);
      console.log(names);

console.log(names);
			$.ajax({
	            data:  names,
	            url:   'acciones/ajax/guardarNuevoEmpleado.php',
	            type:  'POST', 
	            dataType: "json",  
	            success:  function (datos){ 
	              //  console.log(datos);
                  alert(datos);
	               window.location.href= 'empleados.php';
               
                 // window.location='empleados.php';
	              // $('#save').prop('disabled',false);
	            }
	        });
    });

});*/

$(document).ready(function(){

$('#update_register').on('submit',function(e){
  //  $("#update_register").validate();

 //   $("#save").focus(function(){

//  $('#inputnombre').addClass('is-valid')


var x = new FormData(this);
console.log(x );
//alert(x);
console.log(x );
			$.ajax({
	          //  data:  datos,
	            url:   'acciones/ajax/guardarNuevoEmpleado.php',
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

                 
	               window.location.href= 'empleados.php';
               
                 // window.location='empleados.php';
	              // $('#save').prop('disabled',false);
	            }
	        });
    });
  });



/*$(document).on('click', '.validar', function (event) {
        event.preventDefault();
        var cantidad = 0;

       
        $.each(obj, function (identificador, value) {
            cantidad = ($.onlyData("#" + value));
            if (cantidad > 0) {
                toastr["error"]("Este " + identificador + " ya se encuentra registrado!");
            } else {
                $("#update_register").submit();
            }
        });
    });*/




 /*$(document).ready(function() {
  
  $("#update_register").click.validate();
  
  
  
  
  
});*/



/*
$(document).ready(function() {
  
  $("#update_register").validate();
  
  //$("#update_register").submit();
});*/

var exampleModal = document.getElementById('recomendaciones')
exampleModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-whatever')
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

                $("#ajaxcont").html(datos);
            }
        });
    var modalTitle = exampleModal.querySelector('.modal-title')
    // var modalBodyInput = exampleModal.querySelector('.modal-body input')
    // modalTitle.textContent = 'Edita la Ruta. ' + recipient
    // modalBodyInput.value = recipient
})
function agregarecomendacion(idem){

  var idnu = document.getElementById("IdDRENC").value;
  var  dator = 'idem='+ idem +'&idnu=' + idnu;
  console.log(dator);
  alert(dator);

                 $.ajax({
                       url:   'acciones/ajax/guardarNuevaRecomendacion.php',
                       type: 'post',
                       dataType: 'json',
                       data: dator,
                       success:  function (datos){ 
                            console.log(datos);
                            alert(datos.mensaje);
                          //  window.location.href= 'rutas.php';

                          
                          
                         
                      }
                });


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