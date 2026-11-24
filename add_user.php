<?php
include('header.php');
include 'acciones/ins/Users.php'; 
/*$lisMax  = Users::maxIdEmpleados();
$max = (empty($lisMax['id']) ? 1 : $lisMax['id'] += 1);
//echo $max;
//exit();*/
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
  <h1>Nuevo Usuario</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item">Usuario</li>
      <li class="breadcrumb-item active">Nuevo Usuario</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
                             
 <!--<form class="needs-validation" novalidate method="POST" action="action/addUser.php" >-->
 <!--<form class="needs-validation" novalidate    action="insert_empleado.php" name="update_register" id="update_register" method="post" enctype="multipart/form-data" >-->


 
     <!-- <p> Ingresa la información.</p>-->
     <form  id="formdata"   method="POST" >


  <div class="card info-card customers-card">
  <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Datos DR-ENC</h5>
        </div>
    <!--Inicio-->
  
           
          <!--fin-->
  <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
            <div class="input-group mb-2">
                <div class="col-md-3 mb-3 px-md-3 ">
                  <label for="validationCustom02">Nombre</label>
                  <input type="text" class="form-control" id="name"  name="name" placeholder="Nombre del usuario" required>
                </div>
                <div class="col-md-3 mb-3 px-md-3">
                  <label for="validationCustom02">Número de empleado</label>
                  <input type="text" class="form-control" id="numEmpleado" name="numEmpleado"  placeholder="Número de Empleado" required  onkeypress="return event.charCode>=48 && event.charCode<=57" >
                </div>
                <div class="col-md-6 mb-3 px-md-3">
                  <label for="validationCustom03">Correo Electrónico</label>
                  <input  type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required>
                </div>
          <!--fin-->
          <!--Inicio-->
            <div class="input-group mb-2">
                <div class="col-md-3 mb-3 px-md-3">
                  <label for="validationCustom02">Password</label>
                  <input type="password" class="form-control" id="password_1"  name="password_1" required>
                </div>
                <div class="col-md-3 mb-3 px-md-3">
                  <label for="validationCustom02">Confirma el Password</label>
                  <input type="password" class="form-control" id="password_2"  name="password_2" required onblur="validaPass();">
                </div>
              <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Tipo de usuario</label>
                      <select name="tipo" id="tipo" class="form-control">
                        <option selected>Selecciona...</option>
                        <option value="1">Admin</option>
                        <option value="2">RH</option>
                        <option value="3">RHC</option>
                      </select>
              </div>
              <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Planta</label>
                      <select name="planta" id="planta" class="form-control">
                        <option selected>Selecciona...</option>
                        <option value="1">Planta 1</option>
                        <option value="2">Planta 2</option>
                      </select>
              </div>
            
  <!--fin-->
  </div>
  </div>
  </div>
  <div class="row" style="padding: 50px;">
     <button class="btn btn-dark" type="submit" id="botonenviar">Agregar Usuario </button>
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
</main>
<script>
 $(document).ready(function(){ 
  $('#formdata').on('submit',function(e){
     var x = $(this).serialize();
      $.ajax({
                url: 'acciones/ajax/guardarNuevoUser.php',
                type:'POST',
                data: x,
                dataType: 'json',
                success:  function (datos){ 
                    alert(datos.mensaje);
                    window.location.href= 'users.php';
              }
            });
      });
  });

function validaPass(){
  var pass1 = document.getElementById("password_1").value;
  var pass2 = document.getElementById("password_2").value;
  if(pass1 != pass2){
    alert('Las contraseñas son diferentes, inténtalo nuevamente.');
    document.getElementById("password_1").focus();
    document.getElementById("password_1").value = '';
    document.getElementById("password_2").value = '';
  }
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