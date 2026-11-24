<?php
include('header.php');

$con = mysqli_connect('localhost:3307', 'root', '', 'rh');

$sql = "SELECT MAX(IdDRENC) AS id FROM empleados";
$dato = mysqli_query($con, $sql);
$respuesta = mysqli_fetch_array($dato, MYSQLI_ASSOC);
$max = (empty($respuesta['id']) ? 1 : $respuesta['id'] += 1);

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
           

                             
 <!--<form class="needs-validation" novalidate method="POST" action="action/addUser.php" >-->
 <!--<form class="needs-validation" novalidate    action="insert_empleado.php" name="update_register" id="update_register" method="post" enctype="multipart/form-data" >-->
 <form  name="update_register" id="update_register" method="post" enctype="multipart/form-data" >


 <div class="row">
  <div class="card info-card customers-card">
                          <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
                              <h5 class="card-title" style="color: #ffffff;">Datos DRENC </h5>
                              <p style="padding-left: 20px;">Datos de control.</p>
                          </div>
    <!--Inicio-->
  
           
          <!--fin-->
  <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
            <div class="input-group mb-2">
            <div class="col-md-3 mb-3 px-md-3 ">
                
                <!-- Profile Image -->
                <div class="box box-primary">
                            <div class="box-body box-profile">
                                <div id="load_img">
                                    <img id="uploadPreview1" width="100" height="100" src="recursos/emple.png">

                                </div>
                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input id="uploadImage1" type="file" name="file" onchange="previewImage(1);" />
                                    </div>

                                </div>



                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

   
            </div>
            
          
  </div>


<!--fin-->
</div>



  <div class="row" style="padding: 50px;">

  <button class="btn btn-success" type="buttom" name="save" id="save">Agregar Empleado </button>

</div>
  
</form>



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

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-whatever="@mdo"  data-bs-target="#exampleModal">
  Launch static backdrop modal
</button>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reagendando cita...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <!--<form id="frm-gurdarPoP"  action="../citas/ajax/editarCita.php" method ="post" class="row mb-5 mx-0"> -->
	  <form id="frm-gurdarPoP"   method ="post" class="row mb-5 mx-0">
		  <div id="ajaxcont" class="modal-body">






		  </div>
	  </form> 
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
        <!--  <a href="empleados.php" class="btn btn-secondary" >Cerrar</a>-->
      </div>
    </div>
  </div>
</div>

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
    <script src="buscar_pag.js"></script>
    <script src="openClose.js"></script>
    <script src="https://kit.fontawesome.com/3bfb8be62d.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">




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
	              /*  $('#botonenviar').prop('disabled',false);
                  $("#exampleModal").modal("show");
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

/*

 $(document).ready(function(){
    $('#update_register').on('submit',function(e){
 
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
               //  alert(datos);
                 $("#empleagre").modal("show");
                 console.log(datos);
                 alert(datos);
                // $("#ajaxcont").html('ok' );
                  //$("#ajaxcont").html(' <p>'+ datos +'"</p>' );
	               // window.location.href= 'empleados.php';
               
                 // window.location='empleados.php';
	              // $('#save').prop('disabled',false);
	            }
	        });
    });
  });*/

  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
 //var parametros="?idCita="+recipient;
 aler('entro');
  $.ajax({  
				//data:  parametros,
			    //url:   _global_ruta+'modulos/clinica/citas/editar/?idCita='+recipient,
				url:   'editaFoto.php',
                type:  'post',
                beforeSend: function () {
                        $("#ajaxcont").html("</br></br></br></br>Procesando, Espere por favor...");
                },
                success:  function (response) {
						alert(response);
                        $("#ajaxcont").html(response);
                }  
        });
  var modal = $(this)    
  //modal.find('.modal-title').text('Reagendando cita...' + recipient)
	
  //modal.find('.modal-body input').val(recipient)
	
	
})



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