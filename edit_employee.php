<?php
include('header.php');
//include('conexion.php');
include 'acciones/ins/Empleados.php'; 
$id = $_REQUEST['idempleado'];
$lisEmp  = Empleados::listaEmpleadobyId($id);
$edadfecha = strtotime ('-18 year' , strtotime(date('Y-m-d'))); //Se añade un año mas
$fechaactual = date('Y-m-d'); // 2016-12-29
$nuevafecha = strtotime ('-18 year' , strtotime($fechaactual)); //Se añade un año mas
$nuevafecha = date ('Y-m-d',$nuevafecha);
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
  <h1>Editar Empleado</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
      <li class="breadcrumb-item">Empleados</li>
      <li class="breadcrumb-item active">Editar Empleado</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


                <!-- Customers Card -->
           
                                
 <!--<form class="needs-validation" novalidate method="POST" action="action/addUser.php" >-->
  <!--<form class="needs-validation" novalidate    action="update_employee.php" name="update_register2" id="update_register2" method="post" enctype="multipart/form-data" >-->


 
  <div class="card info-card customers-card">
                          <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
                              <h5 class="card-title" style="color: #ffffff;">Datos DRENC </h5>
                            <!--  <p style="padding-left: 20px;">Datos de control.</p>-->
                          </div>
    <!--Inicio-->
  
           
          <!--fin-->
  <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
            <div class="input-group mb-2">
            <div class="col-md-3 mb-3 px-md-3 ">
            <form class="needs-validation" novalidate  name="update_register" id="update_register" method="POST" enctype="multipart/form-data" >  
                <!-- Profile Image -->
                <div class="box box-primary">
                            <div class="box-body box-profile">
                                <div id="load_img">
                                    <img id="uploadPreview1" width="100" height="100" src="<?php echo $lisEmp['Foto']; ?>">

                                </div>
                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input id="uploadImage1" type="file" name="file" onchange="previewImage(1);" />
                                    </div>

                                </div>
                                <input type="hidden" class="form-control" id="IdUf"  name="IdUf"  placeholder="IdDRENC" value="<?php echo $lisEmp['IdDRENC']; ?>">


                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                  <button class="btn btn-dark" type="submit" name="save" id="save" value="actFt" >Actualizar Imagen</button>
            </form>
            </div>
            
              <div class="col-md-3 mb-3 px-md-3" style="margin-top: 60px;">
              <form class="needs-validation" novalidate     name="update_register2" id="update_register2" method="post" >
                <label>Id DRENC</label>
                <input type="text" class="form-control" id="IdDRENC"  name="IdDRENC"  placeholder="IdDRENC" value="<?php echo $lisEmp['IdDRENC']; ?>" readonly="readonly">
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-3 mb-3 px-md-3" style="margin-top: 60px;">
                <label >Planta</label>
                <select id="IdPlanta" name="IdPlanta"  class="form-control" value="<?php echo $lisEmp['IdPlanta']; ?>">
                    <!--  <option <?php $op1 = 0; if($lisEmp['IdPlanta'] == '1'){ $op1 = 1;}else{$op1 == 2;} ?> value='<?php echo $op1;?>'>Planta <?php echo $lisEmp['IdPlanta'];?></option>-->
                        <option  <?php if($lisEmp['IdPlanta'] == 1){ echo 'select';}?> value="1">Planta 1</option>
                        <option <?php if($lisEmp['IdPlanta'] == 2){ echo 'select';}?> value="2">Planta 2</option>
                      </select>
                <div class="valid-feedback">
                      Looks good!             
              </div>
              </div>  
              <div class="col-md-3 mb-3 px-md-3" style="margin-top: 60px;">
                <label >Fecha de Ingreso</label>
                <input type="date" class="form-control" id="FechaIngreso"  name="FechaIngreso"   required value="<?php echo $lisEmp['FechaIngreso'];?>"   >
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
            
            </div>
          <!--fin-->
  <!--Inicio-->
  <div class="input-group mb-2">
  <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom01">Departamento</label>
                <select name="Depto" id="Depto" class="form-control">
                        <option value='<?php echo $lisEmp['Depto'];?>'><?php echo $lisEmp["departamento"];?></option>
                        
                    </select>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Linea</label>
                <select name="Linea" id="Linea" class="form-control">
                        <option value='<?php echo $lisEmp['Linea'];?>'><?php echo $lisEmp['linea'];?></option>
                       
                      </select>
                <div class="valid-feedback">
                      Looks good!             
              </div>
              </div>
              <div class="col-md-3 mb-3 px-md-3">
                <label for="validationCustom02">Nomina</label>
                <select name="Nomina" id="Nomina" class="form-control">
                        <option value='<?php echo $lisEmp['Nomina'];?>'><?php echo $lisEmp['Nom'];?></option>
                        <option value="2">Semanal</option>
                        <option value="1">Quincenal</option>
                        
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
                <label for="validationCustom02">Turno</label>
                <select name="Turno" id="Turno" class="form-control">
                        <option value='<?php echo $lisEmp['Turno']?>'>Turno <?php echo $lisEmp['Turno'];?></option>
                        <option value="1">Turno 1</option>
                        <option value="2">Turno 2</option>
                      </select>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>

              <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Foraneo</label>
      <select name="Foraneo" id="Foraneo" class="form-control">
              <option value='<?php echo $lisEmp['Foraneo'];?>'><?php echo $lisEmp['Foraneo'];?></option>
              <option value="Foraneo">Foraneo</option>
              <option value="Local">Local</option>
            </select>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>

     <div class="col-md-3 mb-3 px-md-3">
      <label >Empresa Reclutadora</label>
          <select name="Empresa" id="Empresa" class="form-control">
             <option value="0">Selecciona...</option>
          </select>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>

    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Nacionalidad</label>
      <input type="text" class="form-control" id="Nacionalidad" name="Nacionalidad" value="<?php echo $lisEmp['Nacionalidad'];?>" placeholder="Nacionalidad" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

            </div>
  <!--fin-->
  </div>


  <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Datos Personales</h5>
    <!--  <p>Ingresa los siguientes datos.</p>-->
      </div>
      <!--Inicio-->

<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >       
  <div class="input-group mb-2 ">
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Nombre</label>
      <input type="text" class="form-control" id="Nombre"  name="Nombre" value="<?php echo $lisEmp['Nombre'];?>" placeholder="Nombre de la Persona" required>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Apellido Paterno</label>
      <input type="text" class="form-control" id="ApellidoP" name="ApellidoP" value="<?php echo $lisEmp['ApellidoP'];?>" placeholder="Apellido Paterno" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Apellido Materno</label>
          <input type="text" class="form-control" id="ApellidoM"  name="ApellidoM" value="<?php echo $lisEmp['ApellidoM'];?>" placeholder="Apellido Materno" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Fecha de Nacimiento </label>
      <input type="date" class="form-control" id="Fnacimiento"   name="Fnacimiento" value="<?php echo $lisEmp['Fnacimiento'];?>" placeholder="Last name" required  max="<?php echo $nuevafecha ?>" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>
<!--fin-->
   <!--Inicio-->
   <div class="input-group mb-2 ">
   <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">CURP</label>
      <input type="text" class="form-control" id="Curp" placeholder="CURP" name="Curp"  value="<?php echo $lisEmp['Curp'];?>" required minlength="18"  maxlength="18" onloadstart="validaCurp(this);">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Número de seguro social</label>
      <input type="text" class="form-control" id="Nss" name="Nss"  placeholder="Número de seguro social" value="<?php echo $lisEmp['Nss'];?>" required minlength="11"  maxlength="11"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
   
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">RFC</label>
          <input type="text" class="form-control" id="Rfc"   name="Rfc" value="<?php echo $lisEmp['Rfc'];?>" placeholder="RFC" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Sexo</label>
            <select name="Sexo" id="Sexo" class="form-control">
              <option value='<?php echo $lisEmp['Sexo'];?>'><?php echo $lisEmp['Sexo'];?></option>
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
      <label for="validationCustom02">Estado de Nacimiento</label>
      <input type="text" class="form-control" id="EdoNaci"  name="EdoNaci"   value="<?php echo $lisEmp['EdoNaci'];?>" placeholder="Estado de Nacimiento" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Ciudad de nacimiento</label>
          <input type="text" class="form-control" id="CiudadNaci" name="CiudadNaci"  value="<?php echo $lisEmp['CiudadNaci'];?>"  placeholder="Ciudad de nacimiento" required  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Nivel de Estudios</label>
            <select name="NivEstudios" id="NivEstudios" class="form-control">
              <option value='<?php echo $lisEmp['NivEstudios'];?>'><?php echo $lisEmp['NivEstudios'];?></option>
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
      <label for="validationCustom02">Celular</label>
      <input type="text" class="form-control" id="Cel"  name="Cel" placeholder="Número de Celular" value="<?php echo $lisEmp['Cel'];?>"  required minlength="10"  maxlength="10"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    

  </div>
<!--fin-->

<!--Inicio-->
<div class="input-group mb-2">
    <div class="col-md-6 mb-3 px-md-3">
      <label for="validationCustom03">Correo Electrónico</label>
      <input  type="email" class="form-control" id="Email" name="Email" value="<?php echo $lisEmp['Email'];?>" placeholder="Correo Electrónico" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom04">Estado Civil</label>
      <select name="EdoCivil" id="EdoCivil" class="form-control">
              <option value='<?php echo $lisEmp['EdoCivil'];?>'><?php echo $lisEmp['EdoCivil'];?></option>
              <option value="Soltero">Soltero</option>
              <option value="Casado">Casado</option>
              <option value="Viudo">Viudo</option>
            </select>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom04">Hijos</label>
      <select name="Hijos" id="Hijos" class="form-control">
              <option value='<?php echo $lisEmp['Hijos'];?>'><?php echo $lisEmp['Hijos'];?></option>
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
    <label for="validationCustom05">Número de Hijos</label>
      <input type="number" class="form-control" id="NumHijos" name="NumHijos"min="0" value="<?php echo $lisEmp['NumHijos'];?>" placeholder="Número de Hijos" >
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
   
    <div class="col-md-6 mb-3 px-md-3">
        <label for="validationCustom03">Nombre del Beneficiario</label>
        <input type="text" class="form-control" id="Beneficiario" name="Beneficiario" value="<?php echo $lisEmp['Beneficiario'];?>" placeholder="Nombre del Beneficiario" required>
        <div class="invalid-feedback">
          Please provide a valid city.
        </div>
      </div>
      <div class="col-md-3 mb-3 px-md-3">
        <label for="validationCustom05">Parentesco</label>        
            <select name="Parentesco" id="Parentesco" class="form-control">
               <option value='<?php echo $lisEmp['Parentesco'];?>'><?php echo $lisEmp['Parentesco'];?></option>
               <option value="Padre">Padre</option>
               <option value="Madre">Madre</option>
               <option value="Hermano">Hermano</option>
               <option value="Hermana">Hermana</option>
               <option value="Esposa">Esposa</option>
               <option value="Esposo">Esposo</option>
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
        <label for="validationCustom02">Celular del Beneficiario</label>
        <input type="text" class="form-control" id="CelBeneficiario" name="CelBeneficiario" placeholder="Celular del Beneficiario" value="<?php echo $lisEmp['CelBeneficiario'];?>" required minlength="10"  maxlength="10"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>


      <div class="col-md-6 mb-3 px-md-3">
        <label >Contacto de Emergencia (Nombre)</label>
        <input type="text" class="form-control" id="ContactoEme" name="ContactoEme" placeholder="Contacto de Emergencia (Nombre)" value="<?php echo $lisEmp['ContactoEme'];?>" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
<div class="col-md-3 mb-3 px-md-3">
        <label >Celular de Contacto </label>
        
        <input type="text" class="form-control" id="CelEme"  name="CelEme" placeholder="Número de Celular (Contacto)" required minlength="10" value="<?php echo $lisEmp['CelEme'];?>" maxlength="10"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
        <div class="invalid-feedback">
          Please provide a valid city.
        </div>
      </div>
   </div>
   
 <!--fin-->
</div> 

 <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Dirección </h5>
     <!-- <p> Ingresa la dirección.</p>-->
  </div>
<!--Inicio-->

<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >     
<div class="input-group mb-2 ">
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Calle</label>
      <input type="text" class="form-control" id="Calle" name="Calle" value="<?php echo $lisEmp['Calle'];?>"  placeholder="Nombre de la Calle" required>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Numero</label>
      <input type="text" class="form-control" id="Numero" name="Numero" value="<?php echo $lisEmp['Numero'];?>"  placeholder="Numero" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Colonia</label>
          <input type="text" class="form-control" id="Colonia" name="Colonia" value="<?php echo $lisEmp['Colonia'];?>" placeholder="Colonia" required  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Ciudad</label>
      <input type="text" class="form-control" id="Ciudad" name="Ciudad" value="<?php echo $lisEmp['Ciudad'];?>" placeholder="Ciudad" required  >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>
<!--fin-->

<!--Inicio-->
<div class="input-group mb-2 ">
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Estado</label>
      <input type="text" class="form-control" id="Estado" name="Estado" value="<?php echo $lisEmp['Estado'];?>" placeholder="Estado" required>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Código Postal </label>
      <input type="text" class="form-control" id="CP" name="CP" placeholder="Código Postal " value="<?php echo $lisEmp['CP'];?>" required  minlength="5"  maxlength="5"  onkeypress="return event.charCode>=48 && event.charCode<=57" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Código Postal (Fiscal) </label>
      <input type="text" class="form-control" id="CPF" name="CPF" placeholder="Código Postal (Fiscal) " required  minlength="5"  maxlength="5" value="<?php echo $lisEmp['CPF'];?>" onkeypress="return event.charCode>=48 && event.charCode<=57" >
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
   <!-- <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Pais</label>
          <input type="text" class="form-control" id="Pais" name="Pais" value="<?php echo $row['Pais'];?>" placeholder="Pais" required  >
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
          <option value='<?php echo $lisEmp['Banco'];?>'><?php echo $lisEmp['Banco'];?></option>
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
     
      <input type="text" class="form-control" id="Clabe" name="Clabe" placeholder="Clabe Bancaria" value="<?php echo $lisEmp['Clabe'];?>"  required  minlength="18"  maxlength="18"  onkeypress="return event.charCode>=48 && event.charCode<=57">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Número de Cuenta</label>
     
      <input type="text" class="form-control" id="CuentaBBVA" name="CuentaBBVA" placeholder="Número de Cuenta"  value="<?php echo $lisEmp['CuentaBBVA'];?>" required  minlength="20"  maxlength="20"  onkeypress="return event.charCode>=48 && event.charCode<=57">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label >Número de Tarjeta</label>
      <input type="text" class="form-control" id="NumTajeta" name="NumTajeta" placeholder="Número de Tarjeta"  value="<?php echo $lisEmp['NumTajeta'];?>" required  minlength="13"  maxlength="19"  onkeypress="return event.charCode>=48 && event.charCode<=57">
    </div>
    
    
  </div>
<!--fin-->


  </div>
<div class="card-body" style="background-color: #2B8839; color: #ffffff;">
      <h5 class="card-title" style="color: #ffffff;">Otros Datos </h5>
    <!--  <p> Ingresa la información.</p>-->
  </div>
  
<!--Inicio-->
<div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff; padding: 30px;" " >  
<div class="input-group mb-2 ">
<div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Ruta del transporte</label>
            <?php 
                  $ruta  = Empleados::listaRutabyId($lisEmp["Ruta"]);

            ?>

          <select name="Ruta" id="Ruta" class="form-control">
          <option value='<?php echo $ruta['id'];?>'><?php echo $ruta['nombre'];?></option> 
             
          </select>
          
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>

     <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Parada del transporte</label>
            <?php 
                  $parada  = Empleados::listaParadabyId($lisEmp["Parada"]);
             ?>
            <select name="Parada" id="Parada" class="form-control">
            <option value='<?php echo $parada['id'];?>'><?php echo $parada['nombre'];?></option> 
             
           </select>
      
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Crédito Infonavit</label>
           <select name="Infonavit" id="Infonavit" class="form-control">
              <option value='<?php echo $lisEmp['Infonavit'];?>'><?php echo $lisEmp['Infonavit'];?></option> 
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    
        
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Empresa Reclutadora</label>
          <select name="Empresa" id="Empresa" class="form-control">
              <option value='<?php echo $lisEmp['Empresa'];?>'><?php echo $lisEmp['Empresa'];?></option>             
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
              <option value="SOLUTIONS GARCIA ">SOLUTIONS GARCIA </option>
              <option value="ARSE">ARSE</option>
              <option value="TALENT POWER">TALENT POWER</option>
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
      <label for="validationCustom02">Sueldo Diario</label>
     
      <input type="text" class="form-control decimales" id="SueldoDiario" name="SueldoDiario" value="<?php echo $lisEmp['SueldoDiario'];?>" placeholder="Sueldo Diario" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Sueldo Diario</label>
      <input type="text" class="form-control" id="SueldoDiarioText" name="SueldoDiarioText" value="<?php echo $lisEmp['SueldoDiarioText'];?>" placeholder="Escribe la cantidad" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">SDI</label>
      <input type="text" class="form-control decimales" id="SDI" name="SDI" value="<?php echo $lisEmp['SDI'];?>" placeholder="SDI" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>

    <div class="col-md-3 mb-3 px-md-3">
      <label for="validationCustom02">Sueldo Mensual</label>
            <input type="text" class="form-control decimales" id="SueldoMensual" name="SueldoMensual" value="<?php echo $lisEmp['SueldoMensual'];?>" placeholder="Sueldo Mensual" required>
      <div class="valid-feedback">
            Looks good!             
     </div>
     </div>
 
    
    
  </div>
<!--fin-->




<!--Inicio-->
<div class="input-group mb-2 ">
  

  


  
   
  
    
    
  </div>
<!--fin-->

</div>

  <div class="row" style="padding: 50px;">

  <button class="btn btn-dark" type="submit" name="guardar" id="guardar">Actualizar Datos</button>


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
  

<div class="modal fade" id="modalinsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambio de Nómina</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <div id="ajaxcont" class="modal-body">
      <form class="needs-validation" novalidate id="cambioNomina">
                    <div class="row">
                        <div class="card info-card customers-card">
                                <div class="card-body" style="background-color: #2B8839; color: #ffffff;">     
                                    <h5 class="card-title" style="color: #ffffff;">Cambio de Nómina</h5>
                                </div>
                                <!--Inicio-->
                                <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
                                    <div class="input-group mb-1 ">
                                        <div class="col-md-12 mb-2 px-md-10">
                                           
                                            <label for="validationCustom03">Introduce la fecha de cambio</label>
                                            <input type="date" class="form-control" id="FechaCambioNom"   name="FechaCambioNom" value="">
                                           <!-- <input type="hidden" class="form-control" id="bandera"   name="bandera" value="1">-->
                                           <input type="hidden" class="form-control" id="IdDRENC"   name="IdDRENC" value="<?php echo $lisEmp['IdDRENC']; ?>">
                                        </div>
                                    </div>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                           <!-- <button class="btn btn-dark" type="button" id="agregar" onclick="guardaRepExNo('<?php  echo json_encode($pn_arr2);?>','<?php  echo json_encode($noi_arr2);?>')" > APROBAR </button>-->
                           <button class="btn btn-dark" type="submit"  id="agregar" > CAMBIAR </button>
                        </div>
                    </div>
                       
                </form>
      </div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
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
var  datose = $(this).serialize();
  console.log('acciones/ajax/editaEmpleado.php?'+datose);
                alert('acciones/ajax/editaEmpleado.php?'+datose);*/

			$.ajax({
	          //  data:  datos,
	            url:  'acciones/ajax/editaEmpleado.php',
              type:'POST',
              data: datose,
              dataType: 'json',
              success:  function (datos){ 
                console.log(datos);
                //alert(datos.id);
               // alert(datos.id);
              //   window.location.href= 'empleados.php';
             alert('Datos actualizados');
           //  window.location.href= 'edit_employee.php?idempleado='+ datos.id;
           location.reload()
             

           
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
//console.log(x );
//alert(x);
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
	              // console.log(datos);
                 // alert(datos);
                  alert('Datos actualizados');
                 // window.location.href= 'edit_employee.php?idempleado='+ datos;
                 location.reload();
                 
                 
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

var exampleModal = document.getElementById('modalinsert')
exampleModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-whatever')
 /* alert('Repositorio.php?idQ='+ recipient);
        $.ajax({
            url: 'Repositorio.php?idQ='+recipient,
            type: 'post',
            dataType: 'json',
            success:function(datos){
                 alert(datos.mensaje);
               // exampleModal.querySelector('#id').value = datos.idr;
               // exampleModal.querySelector('#nquincena').value = datos.nquincena;
              
              //  $("#Estatus").append("<option value='"+datos.estatus+"' selected >"+ text +"</option>");


            }
        });*/
    var modalTitle = exampleModal.querySelector('.modal-title')
    // var modalBodyInput = exampleModal.querySelector('.modal-body input')
    // modalTitle.textContent = 'Edita la Ruta. ' + recipient
    // modalBodyInput.value = recipient
})

$("#Nomina").change(function (){
    var Nomina= document.getElementById("Nomina").value;
    if(Nomina == 1){
        $('#modalinsert').modal('show');
    }   
});

$(document).ready(function(){  
        $('#cambioNomina').on('submit',function(e){
            var FechaCambioNom= document.getElementById("FechaCambioNom").value;
            var IdDRENC= document.getElementById("IdDRENC").value;
            var  datos = 'fcnom='+ FechaCambioNom + '&idd='+ IdDRENC;
          //  alert('acciones/ajax/editaEmpleadoNomina.php?' + datos);
        $.ajax({
                      url:   'acciones/ajax/editaEmpleadoNomina.php',
                      type: 'POST',
                      dataType: 'json',
                      data: datos,
                      success:  function (datos) {
                            alert(datos.mensaje);
                            $("#ajaxcont").html(datos);
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




 
</script>

<?php
    include('footer.php');
?>