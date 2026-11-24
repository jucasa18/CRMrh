<?php
include('auth_session.php');
include('session_expire.php');
//include('conexion_PDO.php');
if(   $_SESSION['tipo'] == ""){
    echo "<script>alert(\"Debes iniciar sesión.\");window.location='index.php';</script>";

}

$edadfecha = strtotime ('-18 year' , strtotime(date('Y-m-d'))); //Se añade un año mas
$fechaactual = date('Y-m-d'); // 2016-12-29
$nuevafecha = strtotime ('-18 year' , strtotime($fechaactual)); //Se añade un año mas
$nuevafecha = date ('Y-m-d',$nuevafecha);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DR-ENC</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logoico5.ico" rel="icon">
  <link href="assets/img/logoico5.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src=" https://code.jquery.com/jquery-3.6.0.js " integridad="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anónimo"></script>


  <link rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">


  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center" style="text-decoration:none;">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block"> ADMIN</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   


    <nav class="header-nav ms-auto">
     
      



          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/user.png" alt="Profile" class="rounded-circle">
            <?php if (isset($_SESSION['name'])) : ?>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['name'];?></span>
            <?php endif?>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <!--    <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>-->

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="empleados.php">
          <i class="bi bi-grid" style="font-size: 30px;" ></i>
          <span>inicio</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="empleados.php">
          <i class="bi bi-people-fill" style="font-size: 30px;"></i><span>Empleados</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="empleados.php">
              <i class="bi bi-circle"></i><span>Lista Empleados</span>
            </a>
          </li>
          <li>
            <a href="add_empleado.php">
              <i class="bi bi-circle"></i><span>Nuevo Empleado</span>
            </a>
          </li>
          <li>
            <a href="exempleados.php">
              <i class="bi bi-circle"></i><span>Ex-Empleados</span>
            </a>

            <a href="altasSua.php">
              <i class="bi bi-circle"></i><span>Altas SUA</span>
            </a>

            <a href="suaModifBaja.php">
              <i class="bi bi-circle"></i><span>Baja / Modificación SUA</span>
            </a>
            <a href="altasIdse.php">
              <i class="bi bi-circle"></i><span>Altas IDSE</span>
            </a>
            <a href="IdseModifBaja.php">
              <i class="bi bi-circle"></i><span>Baja / Modificación IDSE</span>
            </a>

           

          </li>
          
        </ul>
      </li><!-- End Components Nav -->
      
      <li class="nav-item">
        <a class="nav-link " href="#" target="_blank" onclick="creaContratos();">
          <i class="bi bi-file-earmark-arrow-down" style="font-size: 30px;" ></i>
          <span>Contratos</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link "  href="retardos.php?FechaRetardo=<?php echo date('Y-m-d'); ?>">
          <i class="bi bi-alarm" style="font-size: 30px;" ></i>
          <span>Retardos</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <?php if( $_SESSION['tipo'] == 1 ||  $_SESSION['tipo'] == 2){?>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="users.php">
          <i class="bi bi-exclamation-triangle"  style="font-size: 30px;" ></i><span>Incidencias</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="listaVacaciones.php">
               <i class="bi bi-circle"></i><span>Vacaciones</span>
            </a>
            <a href="listaPermisoNoLab.php">
              <i class="bi bi-circle"></i><span>Permiso a no Laborar</span>
            </a>
            <a href="listaOmisionChecada.php">
              <i class="bi bi-circle"></i><span>Omision de Checada</span>
            </a>
            <a href="listaPaseEntrada.php">
               <i class="bi bi-circle"></i><span>Pase de Entrada</span>
            </a>
            <a href="listaPaseSalida.php">
               <i class="bi bi-circle"></i><span>Pase de Salida</span>
            </a>
              <!--
              <a href="retardos.php?FechaRetardo=<?php echo date('Y-m-d'); ?>">
               <i class="bi bi-circle"></i><span>Retardos </span>
            </a>-->
            <a href="listaFaltas.php">
               <i class="bi bi-circle"></i><span>Faltas</span>
            </a>
            <a href="listaContingencias.php">
               <i class="bi bi-circle"></i><span>Contingencias</span>
            </a>
            <a href="listaTt.php">
               <i class="bi bi-circle"></i><span>Tarjeta Temporal</span>
            </a>
            <a href="listaDiasFestivos.php">
               <i class="bi bi-circle"></i><span>Dias Festivos</span>
            </a>
            <a href="listaHe.php">
               <i class="bi bi-circle"></i><span>Horas Extras</span>
            </a>
            <a href="listaMediasHoras.php">
               <i class="bi bi-circle"></i><span><b>½</b> Horas</span>
            </a>
            <a href="listaHg.php">
               <i class="bi bi-circle"></i><span>Hombres Garantía</span>
            </a>
            <a href="listaGratificaciones.php">
               <i class="bi bi-circle"></i><span>Gratificaciones</span>
            </a>
          </li>
             
          
        </ul>
      </li><!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav7" data-bs-toggle="collapse" href="users.php">
          <i class="bi bi-gear"  style="font-size: 30px;" ></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav7" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="listaBonoAnti.php">
               <i class="bi bi-circle"></i><span>Antigüedad</span>
            </a>
            <a href="listaCompJor.php">
               <i class="bi bi-circle"></i><span>Complementos</span>
            </a>
           <!-- <a href="listaPermisoNoLab.php">
              <i class="bi bi-circle"></i><span>Vales</span>
            </a>-->
           
          </li>
             
          
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link " href="listaConceptos.php">
          <i class="bi bi-calculator" style="font-size: 30px;" ></i>
          <span>Conceptos</span>
        </a>
      </li><!-- End Dashboard Nav -->

    
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav6" data-bs-toggle="collapse" href="users.php">
          <i class="bi bi-dash-square"  style="font-size: 30px;" ></i><span>Deducciones</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav6" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="listaInfonavit.php">
              <i class="bi bi-circle"></i><span>Infonavit</span>
            </a>
          </li>
          <li>
            <a href="listaFonacot.php">
              <i class="bi bi-circle"></i><span>Fonacot</span>
            </a>
          </li>
          <li>
            <a href="listaPA.php">
              <i class="bi bi-circle"></i><span>Pensión alimenticia</span>
            </a>
          </li>
         
         
        </ul>
      </li><!-- End Components Nav -->


      <li class="nav-item">
        <a class="nav-link " href="empleadosRec.php">
          <i class="ri-user-star-fill" style="font-size: 30px;" ></i>
          <span>Recomendaciones</span>
        </a>
      </li><!-- End Dashboard Nav -->
      

          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="">
              <i class="bi bi-file-earmark-diff"  style="font-size: 30px;" ></i><span>Pre-Nóminas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav4" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="pnQuincenal.php?al=no">
                  <i class="bi bi-circle"></i><span>Quincenal</span>
                </a>
              </li>
              <li>
                <a href="pnSemanal.php?al=no">
                  <i class="bi bi-circle"></i><span>Semanal</span>
                </a>
              </li>
             

              </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav8" data-bs-toggle="collapse" href="">
              <i class="bi bi-check2-square"  style="font-size: 30px;" ></i><span>Aprobadas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav8" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="listaNAprobadas.php">
                  <i class="bi bi-circle"></i><span>Quincenal</span>
                </a>
              </li>
              <li>
                <a href="listaNAprobadasS.php?al=no">
                  <i class="bi bi-circle"></i><span>Semanal</span>
                </a>
              </li>
             

              </ul>
      </li><!-- End Components Nav -->
     


      
      <?php } 
                if( $_SESSION['tipo'] == "1"){ 
            ?>
      <li class="nav-item">
        <a class="nav-link "  href="rutas.php">
          <i class="bi bi-truck-front" style="font-size: 30px;" ></i>
          <span>Rutas</span>
        </a>
      </li><!-- End Dashboard Nav -->

     

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav5" data-bs-toggle="collapse" href="users.php">
          <i class="bi bi-person-circle"  style="font-size: 30px;" ></i><span>Usuarios</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav5" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="users.php">
              <i class="bi bi-circle"></i><span>Lista Usuarios</span>
            </a>
          </li>
          <li>
            <a href="add_user.php">
              <i class="bi bi-circle"></i><span>Nuevo Usuario</span>
            </a>
          </li>
         
          <?php } ?>
        </ul>
      </li><!-- End Components Nav -->

      
   </ul>

  </aside><!-- End Sidebar-->
 
  

<script>
function creaContratos(){	

var mensaje;
var opcion = confirm("Este proceso tardara.  ¿deseas continuar?");
if (opcion == true) {
  //  window.location='html2/funcionContratos.php';
    window.open('html2/funcionContratos.php', '_blank');
} else {
    //mensaje = "Has clickado Cancelar";
    window.history.go();
}

}
</script>