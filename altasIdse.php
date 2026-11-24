<?php
include('header.php');
//include('conexion.php');
include 'acciones/ins/Empleados.php'; 
//include 'acciones/funciones/altasSua.php'; 
//$lisEmp  = Empleados::listaEmpleadobyId($id);


?>
  

	
</script>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Altas IDSE</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item">Empleados</li>
      <li class="breadcrumb-item active">Altas IDSE</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


                <!-- Customers Card -->
           
                                
 <!--<form class="needs-validation" novalidate method="POST" action="action/addUser.php" >-->
  <!--<form class="needs-validation" novalidate    action="update_employee.php" name="update_register2" id="update_register2" method="post" enctype="multipart/form-data" >-->

  <form  name="update_register" id="update_register" method="post" action="acciones/funciones/altasIdse.php">
 
 
  <div class="card info-card customers-card">
  <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Fechas de Creación</h5>
        </div>
    <!--Inicio-->
  
           
          <!--fin-->
          <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 

          <div class="input-group mb-2 ">
    
     <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Fecha Inicio</label>
      <input type="date" class="form-control" id="FechaInicio"   name="FechaInicio" value="<?php echo date('Y-m-d'); ?>" required >
   
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Fecha Fin</label>
      <input type="date" class="form-control" id="FechaFin"  name="FechaFin"   required value="<?php echo date('Y-m-d') ?>" required >
      <input type="hidden" class="form-control" id="tipo"   name="tipo" value="1"  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

   
   
   
<!--fin-->
  
  </div>






 




 <!--<div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Formato </h5>
     
  </div>
<!-Inicio->

<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;">     
<div class="input-group mb-2 ">
<div class="col-md-3 mb-3 px-md-3">
        <a class="nav-link " href="#" target="_blank" onclick="formatoVacaciones();">
          <i class="bi bi-file-earmark-excel-fill" style="font-size: 30px; color:#2B8839" ></i>
          <span>Formato Vacaciones</span>
        </a>
      
     </div>
    
  </div>-->
<!--fin-->


<!--fin-->
</div>


  <div class="row" style="padding: 50px;">

  <button class="btn btn-dark" type="submit" name="guardar" id="guardar">Generar Archivo</button>


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


/*

  $(document).ready(function(){
    $('#update_register').on('submit',function(e){
        alert("entro");
        var  dator = $(this).serialize();
        console.log(dator);
        alert('acciones/funciones/altasSua.php'+ dator);
                $.ajax({
                       url:   'acciones/funciones/altasSua.php',
                       type: 'post',
                       dataType: 'json',
                       data: dator,
                      success:  function (datos){ 
                        console.log(datos);
                        alert(datos.mensaje);
                       // window.location.href= 'altasSua.php';
                      }
                });
        });
  });

*/

       
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