<?php
include('header.php');
include 'acciones/ins/Empleados.php'; 
?>	
</script>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Altas Sua</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item">Empleados</li>
      <li class="breadcrumb-item active">Altas Sua</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


                <!-- Customers Card -->
           
<form  name="update_register" id="update_register" method="post" action="acciones/funciones/altasSua.php">
   <div class="card info-card customers-card">
  <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Fechas de Creación</h5>
        </div>

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

</div>
  <div class="row" style="padding: 50px;">
  <button class="btn btn-dark" type="submit" name="guardar" id="guardar">Generar Archivo</button>
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


</main>
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

<?php
    include('footer.php');
?>

<style>
input:focus:invalid,
#commentform textarea:focus:invalid {
    background-color: transparent;
    border: 2px solid #b92326;
}
</style>