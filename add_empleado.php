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
<main id="main" class="main">
<div class="pagetitle">
  <h1>Nuevo Empleado</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item">Empleados</li>
      <li class="breadcrumb-item active">Nuevo Empleado</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
                             
 <!--<form class="needs-validation" novalidate method="POST" action="action/addUser.php" >-->
 <!--<form class="needs-validation" novalidate    action="insert_empleado.php" name="update_register" id="update_register" method="post" enctype="multipart/form-data" >-->


 
     <!-- <p> Ingresa la información.</p>-->
 <form  name="update_register" id="update_register" method="post" enctype="multipart/form-data"  >


  <div class="card info-card customers-card">
  <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Datos DR-ENC</h5>
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
                                        <input class="form-control"  id="uploadImage1" type="file" name="file" onchange="previewImage(1);" />
                                    </div>

                                </div>



                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

   
            </div>
            
              <div class="col-md-3 mb-3 px-md-3" style="margin-top: 60px;">
                <label>Id DRENC</label>
                <input type="text" class="form-control" id="IdDRENCv" placeholder="IdDRENCv" value="<?php echo $max ?>" required disabled>
                <input type="hidden" class="form-control" id="IdDRENC"  name="IdDRENC"  placeholder="IdDRENC" value="<?php echo $max ?>">
               
              </div>

             <!-- <div class="col-md-3 mb-3 px-md-3" style="margin-top: 60px;">
                <label>Id Corto</label>
                <input type="text" class="form-control" id="IdCorto" name="IdCorto" placeholder="Id Corto" value="" required >
              </div>-->
              <div class="col-md-3 mb-3 px-md-3 "style="margin-top: 60px;" >
                <label >Planta</label>
                      <select id="IdPlanta" name="IdPlanta"  class="form-select">
                        <option selected>Selecciona...</option>
                        <option value="1">Planta 1</option>
                        <option value="2">Planta 2</option>
                      </select>
              
              </div>  

             
              <div class="col-md-3 mb-3 px-md-3" style="margin-top: 60px;">
                <label >Fecha de Ingreso</label>
                <input type="date" class="form-control" id="FechaIngreso"  name="FechaIngreso"   required value="<?php echo date('Y-m-d') ?>"   min="<?php echo date('Y-m-d') ?>" >
           
              </div>
            
            </div>
          <!--fin-->
  <!--Inicio-->
  <div class="input-group mb-2">
 

  <div class="col-md-3 mb-3 px-md-3">
                <label >Departamento</label>
                <select name="Depto" id="Depto" class="form-control">
                      <option value="0">Selecciona...</option>
                    </select>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-3 mb-3 px-md-3">
                <label >Linea</label>
                <select name="Linea" id="Linea" class="form-control">
                      <option value="0">Selecciona...</option>
                    </select>
                <div class="valid-feedback">
                      Looks good!             
              </div>
              </div>
              <div class="col-md-3 mb-3 px-md-3">
                <label >Nomina</label>
                      <select name="Nomina" id="Nomina" class="form-control">
                        <option selected>Selecciona...</option>
                        <option value="2">Semanal</option>
                        <option value="1">Quincenal</option>
                        
                      </select>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>

              <div class="col-md-3 mb-3 px-md-3">
                <label >Puesto</label>
                      <select name="Puesto" id="Puesto" class="form-control">
                        <option selected>Selecciona...</option>
                      </select>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
             
  <!--fin-->
  </div>


          <!--Inicio-->
            <div class="input-group mb-2">

          
             
              <div class="col-md-3 mb-3 px-md-3">
                <label >Turno</label>
                      <select name="Turno" id="Turno" class="form-control">
                        <option selected>Selecciona...</option>
                        <option value="1">Turno 1</option>
                        <option value="2">Turno 2</option>
                      </select>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>


              <div class="col-md-3 mb-3 px-md-3">
      <label >Foraneo</label>
      <select name="Foraneo" id="Foraneo" class="form-control">
              <option selected>Selecciona...</option>
              <option value="Foraneo">Foraneo</option>
              <option value="Local">Local</option>
            </select>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>

     <div class="col-md-3 mb-3 px-md-3">
      <label >Empresa Reclutadora</label>
         <!-- <select name="Empresa" id="Empresa" class="form-control">
              <option selected>Selecciona...</option>              
              <option value="PPE">PPE</option>
              <option value="ZUVI EMPRESARIAL">ZUVI EMPRESARIAL</option>
              <option value="CAI">CAI</option>
              <option value="INCOBA">INCOBA</option>
              <option value="C-JOBS">C-JOBS</option>
              <option value="COLOCA">COLOCA</option>
              <option value="DECO">DECO</option>
              <option value="LAM">LAM</option>
              <option value="V TALENT">V TALENT</option>
              <option value="CPH">CPH</option>
              <option value="GSP">GSP</option>
              <option value="SOLUTIONS GARCIA">SOLUTIONS GARCIA </option>
              <option value="ARSE">ARSE</option>
              <option value="TALENT POWER">TALENT POWER</option>
            </select>-->

            <select name="Empresa" id="Empresa" class="form-control">
             <option value="0">Selecciona...</option>
           </select>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
     <div class="col-md-3 mb-3 px-md-3">
      <label >Nacionalidad</label>
      <input type="text" class="form-control" id="Nacionalidad" name="Nacionalidad" placeholder="Nacionalidad" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    

            </div>



             <!--Inicio-->
 

  <!--fin-->
  </div>

  


  <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Datos Personales</h5>
    <!--  <p>Ingresa los siguientes datos.</p>-->
      </div>
      <!--Inicio-->

<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >       
  <div class="input-group mb-2">
    <div class="col-md-3 mb-3 px-md-3">
      <label for="">Nombre</label>
      <input type="text" class="form-control" id="Nombre"  name="Nombre" placeholder="Nombre de la Persona" title="Ingrese su nombre" required>
  
     </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Apellido Paterno</label>
      <input type="text" class="form-control" id="ApellidoP" name="ApellidoP" placeholder="Apellido Paterno" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Apellido Materno</label>
          <input type="text" class="form-control" id="ApellidoM"  name="ApellidoM"  placeholder="Apellido Materno" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Fecha de Nacimiento </label>
      <input type="date" class="form-control" id="Fnacimiento"   name="Fnacimiento" placeholder="Last name" required  max="<?php echo $nuevafecha ?>" >
     <!-- <label >Sexo</label>
            <select name="Sexo" id="Sexo" class="form-control">
              <option selected>Selecciona...</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>-->
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>
<!--fin-->
   <!--Inicio-->
   <div class="input-group mb-2 ">
   <div class="col-md-2 mb-3 px-md-3">
      <label >CURP</label>
     <!-- <input type="text" class="form-control" id="Curp" placeholder="CURP" name="Curp"  required minlength="18"  maxlength="18" onloadstart="validaCurp(this);" onblur="validacionCurp();">-->
     <input type="text" class="form-control" id="Curp" placeholder="CURP" name="Curp"  required minlength="18"  maxlength="18" onloadstart="validaCurp(this);" onchange="validacionCurp();"    require >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-2 mb-3 px-md-3">
      <label >Número de seguro social</label>
      <input type="text" class="form-control" id="Nss" name="Nss"  placeholder="Número de seguro social" required minlength="11"  maxlength="11"  onkeypress="return event.charCode>=48 && event.charCode<=57" onchange="validacioNss();" require>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
   <div class="col-md-2 mb-3 px-md-3">
      <label>RFC</label>
          <input type="text" class="form-control" id="Rfc"   name="Rfc" placeholder="RFC" onchange="validacionRfc();"  require>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="col-md-3 mb-3 px-md-3">
      <label >Código Postal (Fiscal) </label>
      <input type="text" class="form-control" id="CPF" name="CPF" placeholder="Código Postal (Fiscal) " required  minlength="5"  maxlength="5"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="col-md-3 mb-3 px-md-3">
      <label >Sexo</label>
            <select name="Sexo" id="Sexo" class="form-control">
              <option selected>Selecciona...</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>
<!--fin-->

   <!--Inicio-->
   <div class="input-group mb-2 ">
  
    <div class="col-md-3 mb-3 px-md-3">
      <label >Estado de Nacimiento</label>
      <input type="text" class="form-control" id="EdoNaci"  name="EdoNaci" placeholder="Estado de Nacimiento" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Ciudad de nacimiento</label>
          <input type="text" class="form-control" id="CiudadNaci" name="CiudadNaci" placeholder="Ciudad de nacimiento" required  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
   
    <div class="col-md-3 mb-3 px-md-3">
      <label >Nivel de Estudios</label>
            <select name="NivEstudios" id="NivEstudios" class="form-control">
              <option selected>Selecciona...</option>
              <option value="Sin Estudios">Sin Estudios</option>
              <option value="Primaria">Primaria</option>
              <option value="Secundaria">Secundaria</option>
              <option value="Preparatoria">Preparatoria</option>
              <option value="Universidad">Universidad</option>
              <option value="Maestría">Maestría</option>
              <option value="Doctorado">Doctorado</option>
            </select>
      
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Celular</label>
      <input type="text" class="form-control" id="Cel"  name="Cel" placeholder="Número de Celular" required minlength="10"  maxlength="10"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>


    
  </div>
<!--fin-->

<!--Inicio-->
<div class="input-group mb-2">

    <div class="col-md-6 mb-3 px-md-3">
      <label >Correo Electrónico</label>
      <input  type="email" class="form-control" id="Email" name="Email" placeholder="Correo Electrónico" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Estado Civil</label>
      <select name="EdoCivil" id="EdoCivil" class="form-control">
              <option selected>Selecciona...</option>
              <option value="Soltero">Soltero</option>
              <option value="Casado">Casado</option>
              <option value="Unión libre">Unión libre</option>
              <option value="Viudo">Viudo</option>
            </select>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
<div class="col-md-3 mb-3 px-md-3">
      <label ">Hijos</label>
      <select name="Hijos" id="Hijos" class="form-control">
              <option selected>Selecciona...</option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
   
 
<!--fin-->


<!--Inicio-->
<div class="input-group mb-2">

      <div class="col-md-3 mb-3 px-md-3">
    <label >Número de Hijos</label>
      <input type="number" class="form-control" id="NumHijos" name="NumHijos" min="0" placeholder="Número de Hijos" >
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>

    <div class="col-md-6 mb-3 px-md-3">
        <label >Nombre del Beneficiario</label>
        <input type="text" class="form-control" id="Beneficiario" name="Beneficiario" placeholder="Nombre del Beneficiario" required>
        <div class="invalid-feedback">
          Please provide a valid city.
        </div>
      </div>
      <div class="col-md-3 mb-3 px-md-3">
        <label >Parentesco</label>        
            <select name="Parentesco" id="Parentesco" class="form-control">
              <option selected>Selecciona...</option>
               <option value="Padre">Padre</option>
               <option value="Madre">Madre</option>
               <option value="Hermano">Hermano</option>
               <option value="Hermana">Hermana</option>
               <option value="Esposa">Esposa</option>
               <option value="Esposo">Esposo</option>
               <option value="Concubino">Concubino</option>
               <option value="Hijo">Hijo</option>
               <option value="Hija">Hija</option>
               <option value="Conocido">Conocido</option>
               <option value="Tío">Tío</option>
               <option value="Tía">Tía</option>
               <option value="Abuelo">Abuelo</option>
               <option value="Abuela">Abuela</option>
               <option value="Primo">Primo</option>
               <option value="Prima">Prima</option>
            </select>
        <div class="invalid-feedback">
          Please provide a valid zip.
        </div>
      </div>
     
   
    
   </div>
 <!--fin-->
 </div>


<!--Inicio-->
<div class="input-group mb-2">
<div class="col-md-3 mb-3 px-md-3">
        <label >Celular del Beneficiario</label>
        <input type="text" class="form-control" id="CelBeneficiario" name="CelBeneficiario" placeholder="Celular del Beneficiario" required minlength="10"  maxlength="10"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-6 mb-3 px-md-3">
        <label >Contacto de Emergencia (Nombre)</label>
        <input type="text" class="form-control" id="ContactoEme" name="ContactoEme" placeholder="Contacto de Emergencia (Nombre)" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
<div class="col-md-3 mb-3 px-md-3">
        <label >Celular de Contacto </label>
        
        <input type="text" class="form-control" id="CelEme"  name="CelEme" placeholder="Número de Celular (Contacto)" required minlength="10"  maxlength="10"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
        <div class="invalid-feedback">
          Please provide a valid city.
        </div>
      </div>

   
 <!--fin-->
</div> 

 <!--fin-->
</div> 

 <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Dirección </h5>
      <!--<p> Ingresa la dirección.</p>-->
  </div>
<!--Inicio-->

<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >     
<div class="input-group mb-2 ">
    <div class="col-md-3 mb-3 px-md-3">
      <label >Calle</label>
      <input type="text" class="form-control" id="Calle" name="Calle" placeholder="Nombre de la Calle" required>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Numero</label>
      <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Colonia</label>
          <input type="text" class="form-control" id="Colonia" name="Colonia" placeholder="Colonia" required  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Ciudad</label>
      <input type="text" class="form-control" id="Ciudad" name="Ciudad" placeholder="Ciudad" required  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>
<!--fin-->

<!--Inicio-->
<div class="input-group mb-2 ">
    <div class="col-md-3 mb-3 px-md-3">
      <label >Estado</label>
      <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado" required>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Código Postal </label>
      <input type="text" class="form-control" id="CP" name="CP" placeholder="Código Postal " required  minlength="5"  maxlength="5"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
   
  <!-- <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Pais</label>
          <input type="text" class="form-control" id="Pais" name="Pais" placeholder="Pais" required  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>-->
   
    
  </div>
<!--fin-->

</div>


<div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Datos Bancarios </h5>
     <!-- <p> Ingresa la información.</p>-->
  </div>
  
<!--Inicio-->
<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >  
<div class="input-group mb-2 ">
    <div class="col-md-3 mb-3 px-md-3">
      <label >Banco</label>
          <select name="Banco" id="Banco" class="form-control">
              <option selected>Selecciona...</option>    
              <option value="BBVA">BBVA</option> 
              <option value="Santander">Santander</option>         
              <option value="BanBajio">BanBajio</option>              
          </select>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Clabe Bancaria</label>
     
      <input type="text" class="form-control" id="Clabe" name="Clabe" placeholder="Clabe Bancaria" required  minlength="18"  maxlength="18"  onkeypress="return event.charCode>=48 && event.charCode<=57">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Número de Cuenta</label>
     
      <input type="text" class="form-control" id="CuentaBBVA" name="CuentaBBVA" placeholder="Número de Cuenta" required  minlength="12"  maxlength="12"  onkeypress="return event.charCode>=48 && event.charCode<=57">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Número de Tarjeta</label>
      <input type="text" class="form-control" id="NumTajeta" name="NumTajeta" placeholder="Número de Tarjeta" required  minlength="13"  maxlength="19"  onkeypress="return event.charCode>=48 && event.charCode<=57">
    </div>
    
    
  </div>
<!--fin-->


  </div>


<div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Otros Datos </h5>
     <!-- <p> Ingresa la información.</p>-->
  </div>
  
<!--Inicio-->
<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >  
<div class="input-group mb-2 ">

    <div class="col-md-3 mb-3 px-md-3">
      <label >Ruta del transporte</label>
            <select name="Ruta" id="Ruta" class="form-control">
            <option value="0">Selecciona...</option>
             
          </select>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Parada del transporte</label>
         <select name="Parada" id="Parada" class="form-control">
           <option value="0">Selecciona...</option>
         </select>
      
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
   <!-- <div class="col-md-3 mb-3 px-md-3">
      <label >Activo</label>
            <select name="Estatus" id="Estatus" class="form-control">
              <option selected>Selecciona...</option>
              <option value="1">Activo</option>
              <option value="0">Baja</option>
            </select>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>-->
    <div class="col-md-3 mb-3 px-md-3">
      <label >Crédito Infonavit</label>
      <select name="Infonavit" id="Infonavit" class="form-control">
              <option selected>Selecciona...</option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
   
    
  
    
  </div>
<!--fin-->

<!--Inicio-->
<div class="input-group mb-2 ">
   
<!--fin-->
<!--Inicio-->
<div class="input-group mb-2 ">
    
    <div class="col-md-3 mb-3 px-md-3">
      <label >Sueldo Diario</label>
      <input type="text" class="form-control decimales" id="SueldoDiario" name="SueldoDiario" placeholder="Sueldo Diario"  onchange="calculaSM();" required >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Sueldo Diario (Escrito)</label>
      <input type="text" class="form-control" id="SueldoDiarioText" name="SueldoDiarioText" placeholder="Escribe la cantidad" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >SDI</label>
      <input type="text" class="form-control decimales " id="SDI" name="SDI" placeholder="SDI" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="col-md-3 mb-3 px-md-3">
      <label >Sueldo Mensual</label>
            <input type="text" class="form-control decimales" id="SueldoMensual" name="SueldoMensual" placeholder="Sueldo Mensual"  required >   
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
 
    
    
  </div>
<!--fin-->
</div>


<div id="ajaxcont">



</div>


  <div class="row" style="padding: 50px;">

  <button class="btn btn-dark" type="buttom" name="save" id="save">Agregar Empleado </button>

</div>
  
</form>
<form id="formulario">
<div id="exito" style="display:none" >
            Sus datos han sido recibidos con éxito.
        </div>
        <div id="fracaso" style="display:none">
            Se ha producido un error durante el envío de datos.
        </div>
</form>        

                        </div>
                    </div>

                </div><!-- End Customers Card -->


<!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalinsert">
  Launch demo modal
</button>-->
<!-- Modal -->

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
                                            <input type="text" class="form-control" id="IdDRENC"  name="IdDRENC"  placeholder="IdDRENC" value="<?php echo $max ?>">
                                           
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
        alert('Empleado registrado');
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
        alert('Empleado registrado');
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
        alert('Empleado registrado');
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

//alert('')

/*var x = new FormData(this);
console.log(x);*/
//var x = new FormData(this);
/*console.log(x );
alert(x);*/
//console.log(x );
/*alert("entro");
      names = $(this).serialize();
		alert('acciones/ajax/guardarNuevoEmpleado.php' + names);
      console.log(names);*/
      

			$.ajax({
	          //  data:  datos,
	            url:   'acciones/ajax/guardarNuevoEmpleado.php',
              type:'POST',
              data: new FormData(this),
              //ContenType: false; ya qe estamos cargando archivos
              contentType:false,
              //No queremos guardar la cache en el navegador
              cache:false,
              processData:false,
              dataType: "json", 
	         /*   success:  function (datos){ 
	              //console.log(datos);
                alert(datos.mensaje);
                window.location.href= 'empleados.php';
               
                 // window.location='empleados.php';
	              // $('#save').prop('disabled',false);
	            }*/
              beforeSend: function () {
                        $("#ajaxcont").html("</br></br></br></br>Procesando, Espere por favor...");
                },
                   success:  function (datos) {
					            	//alert(response);

                        alert(datos.mensaje);
                        $("#ajaxcont").html(datos);
                        console.log(datos);
                       window.location.href= 'empleados.php?al=no';
                        
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

function calculaSD() {
        var sm = document.getElementById("SueldoMensual").value;
        var sd = sm / 30;
        document.getElementById("SueldoDiario").value = sd.toFixed(2);
        document.getElementById("SDI").value = sd.toFixed(2);
    }


    
    function calculaSM() {
        var sd = document.getElementById("SueldoDiario").value;
        var sm = sd * 30;
        document.getElementById("SueldoMensual").value = sm.toFixed(2);
       // document.getElementById("SDI").value = sd.toFixed(2);
    }  

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





$("#Depto").change(function(){
var deptid = $("#Depto").val();

$.ajax({
url: 'selectDL.php',
type: 'post',
data: {depart:deptid},
dataType: 'json',
success:function(response){
//alert(response);
var len = response.length;
$("#Linea").empty();
for( var i = 0; i<len; i++){
var id = response[i]['id'];
var name = response[i]['name'];

$("#Linea").append("<option value='"+id+"'>"+name+"</option>");

}
}
});
});

$("#Empresa").focus(function(){
//var deptid = $(this).val();
//alert("select.php");
//alert(deptid);

$.ajax({
url: 'selectReclu.php',
type: 'post',
//data: {depart:deptid},
dataType: 'json',
success:function(response){
  // alert(response);

var len = response.length;

$("#Empresa").empty();
for( var i = 0; i<len; i++){
var id = response[i]['id'];
var name = response[i]['name'];

$("#Empresa").append("<option value='"+id+"'>"+name+"</option>");

}
}
});
});

$("#Puesto").focus(function(){
var deptid = $(this).val();
//alert("select.php");
//alert(deptid);

$.ajax({
url: 'selectPuestos.php',
type: 'post',
//data: {depart:deptid},
dataType: 'json',
success:function(response){
   //alert(response);

var len = response.length;

$("#Puesto").empty();
for( var i = 0; i<len; i++){
var id = response[i]['id'];
var name = response[i]['name'];

$("#Puesto").append("<option value='"+id+"'>"+name+"</option>");

}
}
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