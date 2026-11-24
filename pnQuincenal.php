<?php
$al = '';
include('header.php');
//include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Empleados.php'; 
include 'acciones/funciones/prenomina.php'; 
include 'acciones/funciones/pnQuincenal.php'; 
include 'FormatoNOI.php'; 
//$fecha = $_REQUEST['FechaRetardo']; despues poner el rango de fechas que se cambioe el request
set_time_limit(300);
$al = $_REQUEST['al'];
if($al != 'no'){
    $fechaInicio = $_REQUEST['FechaInicio'];
    $fechaFin = $_REQUEST['FechaFin'];
    $lisEmplAct  = Empleados::listaQuincenales($fechaInicio,$fechaFin);
    $dia16 = date("d", strtotime($fechaFin));
}

//$lisEmplAct  = Empleados::listaQuincenales($fechaInicio,$fechaFin);
$total = 0;
$total1 = 0;
$tp = 0;
$tpd = 0;
$deduccionesTotal = 0;
if( $dia16 == '31' ){
  $diesiseis = 10;
}else{
  $diesiseis = 0;
}
?>
<style>
.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.375rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}


</style>
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Pre-Nomina Quincenal</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Pre-Nomina</li>
          <li class="breadcrumb-item active">Pre-Nomina Quincenal</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

  

  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Lista de Empleados </h5>
        </div>
    <!--Inicio-->
            <form id="rangos" name="rangos" action="pnQuincenal.php" method="post">
            <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
              <div class="input-group mb-2 ">
                  <div class="col-md-3 mb-3 px-md-3">
                  <label for="validationCustom02">Fecha Inicio</label>
                  <input type="date" class="form-control" id="FechaInicio"   name="FechaInicio" value="<?php echo  $fechaInicio; ?>" onblur="RangosQuincena();">
                 
              </div>
              <div class="col-md-3 mb-3 px-md-3" >
                  <label for="validationCustom02">Fecha Fin</label>
                  <input type="date" class="form-control" id="FechaFin"  name="FechaFin"   required value="<?php echo $fechaFin; ?>">
                  
                 
              </div>
            <!--  <div class="col-md-3 mb-3 px-md-3">
                  <div class="row" style="padding: 25px;">
                  <button class="btn btn-dark" type="button" name="guardar" id="guardar"  >Enviar</button>
                  </div>
              </div>-->
              </div>
            </form>

<?php
            if($al != 'no'){    ?>

        <div class=""   style="padding: 30px;" style="width:90%;" > 
        <div class="table-responsive-xxl">
        <form id="retardos2" name="retardos2" method="post">
        <table id="example" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <tr>
                <th>Id</th>
               <!-- <th>Nombre</th>-->
                <th>DT</th>
                <th>V</th>
                <th>F</th>
                <th>P</th>
                <th>I</th>
                <th>H</th>
               <!-- <th>HB</th>-->
                <th>BQNA</th>
                <th>BA</th>
                <th>DN</th>
                <th>TD</th>
                <th>Vac</th>
                <th>PV</th>
                <th>DESP</th>
                <th>FH</th>
                <th>PD</th>
                <th>DF</th>
                <th>HE</th>
              <!-- <th>PS</th> -->
                <th>G</th> <!-- gratificaciones -->
                <th>Rec</th> <!-- recomendaciones -->
                <th>D</th> <!-- deducciones -->
                <th>TP</th>
                <th>TP-DEDUCCIONES</th> <!-- TOTAL MENOS DEDUCCIONES -->

            </tr>
        </thead>
        <tbody>
		<?php
		//foreach ($resultado as $a_ => $infoRec) {
            foreach ($lisEmplAct as $a_ => $infoRec) {
            //  $sxh = sxh($infoRec['SueldoDiario']); 
             // $dt = Empleados::diastrabajados($infoRec['IdDRENC']);
           /*  $diasVacaciones = Empleados::DiasVacasiones($infoRec['IdDRENC'], $fechaInicio,$fechaFin);
              if(is_array($diasVacaciones)){
                $dv = $diasVacaciones['diasVacaciones'];
              }else{
                 $dv = 0;
              }*/
           //  $gratificaciones = 0;
            $fnq = buscaNuevosQuincenales($infoRec['IdDRENC']);
            if($fnq == 8){
              $fechaInicio = $_REQUEST['FechaInicio'];
            } else{
              $fechaInicio = $fnq;
            }       
            if($fnq != 8){
             
              $nquincenales[] = array("idDrenc" => $infoRec['IdDRENC']); 

              }
             /* echo 'id= '. $infoRec['IdDRENC'] . ' fechainicio = '.$fechaInicio. ' fnq = '.$fnq;
              echo '</br>';*/

             $vxr = vacacionesxR2($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             //$horas = ValTurnosPNQ(intval($infoRec['IdDRENC']), $fechaInicio, $fechaFin);
             list($horas, $df) = ValTurnosPNQ(intval($infoRec['IdDRENC']), $fechaInicio, $fechaFin);
             $faltas = cuentaFaltas($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $permisos = cuentapermisos($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $incapacidades = IncapacidadesxR2($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $dfNT = $infoRec['diafestivoNT'];
             $heHombreGarantia = $infoRec['hombregarantiaH'];
             $cpercepciones = buscaConceptosP($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $cdeducciones = buscaConceptosD($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $rec = buscaRecomendaciones($infoRec['IdDRENC']);
             $dt = cuentaDiasTrabajados($infoRec['IdDRENC'],$fechaInicio, $fechaFin);
            

             //echo $rec;
            
            // $df = $infoRec['diafestivo'] * ($infoRec['SueldoDiario'] * 2 );
          //  $horas = $horas - $infoRec['horasExtras']; //se restan las horas de los pases de salida
             // echo $cpercepciones;
              //echo $cdeducciones;

              $hdfN = 0;
              $diafestivo = 0;
              if ($df > 0 ){
                $diafestivo = $df * ($infoRec['SueldoDiario'] * 2);
              }elseif($dfNT > 0) {
                
                // $diafestivo = ($infoRec['SueldoDiario']);
              //  $hdfN = 8; //horas dia festivo no trabajado
              $hdfN = 9.6; //horas dia festivo no trabajado

              }
              $psrtiempo = 0;
              if($infoRec['Tiempo'] != ''){
                $psrtiempo = $infoRec['Tiempo'];

              }
              $horas =  ($horas + $hdfN + $heHombreGarantia) - $psrtiempo;

              $horasH = ($horas + $infoRec['horasExtras'] );
             if($horasH > 96){
                $hb = $horasH - 96;
             }else{
                $hb = 0;
             }
           //  $hb = $hb + $infoRec['horasExtras'];  //SE AGRAGAN LAS HORAS EXTRAS, SI HAY // se restan las horas del pase de salida, si hay //// SE QUITO ORQUE SE SUMAN EN LAS HORAS Y SE RESTAN LAS 96 HORAS
            // $hb = $hb;
           /*  ECHO  $hb.'</BR>';;
             ECHO $horas.'</BR>';
             ECHO $horasH.'</BR>';*/
            

             $bonoQ = $hb * 50; //INCLUYE LAS  HORAS EXTRAS
            // $bonoasistencia = $infoRec['dias'] * 13;
            $bonoasistencia = $dt * 22; // a partir del 2024 son 22 pesos
             $diasNomina = 15;

             $banderadias = $dt + $vxr['diasVacaciones'] + $faltas + $permisos + $incapacidades;

             if ($banderadias <= 0){
                $diasNomina = 0;

             } 
             $pd = ($infoRec['SueldoDiario'] *0.25) * $infoRec['domingos'];
            
             $diasNomina =  $diasNomina - $faltas - $permisos - $incapacidades;    
          
             $td =    $infoRec['SueldoDiario'] *   $diasNomina - ($infoRec['SueldoDiario'] * $vxr['diasVacaciones']); 
           
             $despe =($dt + $vxr['diasVacaciones'])  *25;
             if($despe > 250){
                $de = 250;
             }else{
                $de = $despe;
             }
             $fh = ($diasNomina * 10) + $diesiseis;
            // $he = $infoRec['horasExtras'] * 50; // el orden, no altera el resultado...
            
          /*$total = 0;
             $totalh = 0;
             $totalb = 0;
             $totala = 0;
             $totald = 0;
             $totalv = 0;
             $totalvp = 0;
             $totald = 0;
             $totalfh = 0;*/
            
             if ($infoRec['gratificaiones'] != 'NULL' OR $infoRec['gratificaiones'] != ''){
                $gratificaciones = $infoRec['gratificaiones'];
             }else{
                $gratificaciones = 0;
             }
             
              if($rec > 0){
                   $recomendaciones = $rec * 2000;
                   $recomendadores[] = array("idRecomendador" => $infoRec['IdDRENC']); 

              }else{
                    $recomendaciones = 0;
              }



           //  $gratificaciones = $infoRec['gratificaiones'];
          //   $total = $total + $tp + $pd + $diafestivo;
           /*  $totalh = $totalh + $horas;
             $totalb = $totalb + $bonoQ;
             $totala = $totala + $bonoasistencia;
             $totald = $totald + $td;
             $totalv = $totalv + $vxr['SubTotal'];
             $totalvp = $totalvp + $vxr['PrimaVacacional'];
             $totald = $totald + $de;
             $totalfh = $totalfh + $fh;*/

             $deducciones = $infoRec['infonavit'] + $infoRec['fonacot'] + $infoRec['pa'] + ($fh * 2) + $cdeducciones;
             

             $tp = $td + $bonoQ + $bonoasistencia + $vxr['SubTotal'] + $vxr['PrimaVacacional'] + $de + $fh + $pd +  $diafestivo + $infoRec['gratificaiones'] + $cpercepciones + $recomendaciones;

             $tpd = ($td + $bonoQ + $bonoasistencia + $vxr['SubTotal'] + $vxr['PrimaVacacional'] + $de + $fh + $pd +  $diafestivo + $infoRec['gratificaiones'] + $cpercepciones + $recomendaciones) - $deducciones;
             if($horas <= 0 ){
              $tpd = 0;
              $tp = 0;
             }
            

             $total = $total +  $tp;
             $deduccionesTotal = $deduccionesTotal + $deducciones;
             $total1 = $total1 + $tpd ;
          
           //  $noi_arr2[] = FormatoNoi($fechaInicio, $fechaFin, $infoRec['IdDRENC'], $bonoQ, $bonoasistencia, $td, $vxr['SubTotal'] , $vxr['PrimaVacacional'], $de, $fh, $pd, $diafestivo, $infoRec['infonavit'] , $infoRec['fonacot'], $infoRec['pa'], $infoRec['gratificaiones']);
            // print_r($noi_arr2);
            //poner lo de abajo 2024-05-06
           $noi_arr2[] = FormatoNoi($fechaInicio, $fechaFin, $infoRec['IdDRENC'], $infoRec['IdCorto'], $bonoQ, $bonoasistencia, $td, $vxr['SubTotal'] , $vxr['PrimaVacacional'], $de, $fh, $pd, $diafestivo, $infoRec['infonavit'] , $infoRec['fonacot'], $infoRec['pa'], $infoRec['gratificaiones'],1, $recomendaciones);
          
           $pn_arr2[] = array("IdDRENC" => $infoRec['IdDRENC'],"FechaInicio" => $fechaInicio,"FechaFin" => $fechaFin,"dt" => $dt,"v" => $vxr['diasVacaciones'],"f" => $faltas,
           "p" => $permisos , "i" => $incapacidades, "h" => $horas , "bqna" => $bonoQ, "ba" => $bonoasistencia, "dn" => $diasNomina, "td" => $td, "vac" => $vxr['SubTotal'], 
           "pv" => $vxr['PrimaVacacional'], "desp" => $de, "fh" => $fh, "pd" => $pd, "df" => $diafestivo, "he" => $infoRec['horasExtras'], 
           "g" => 0, "d" => $deducciones, "tp" => $tp, "tpd" => $tpd, "salDiario" => $infoRec['SueldoDiario'], 
           "IdUsuario" => $_SESSION['id'], "tipoNomina" => 1); 
           //"g" => $infoRec['gratificaiones']    //pener esto cuando termine las pruebas
            
			?>
            <tr style="font-weight: lighter;">
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <!--<th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP']; ?> <?php echo $infoRec['ApellidoM']; ?></th>-->
                <th style="font-weight: 600; text-align: center; "><?php echo $dt; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $vxr['diasVacaciones']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $faltas; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $permisos; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $incapacidades; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $horas; ?></th>
               <!-- <th style="font-weight: 600; text-align: center; "><?php echo $hb; ?></th>-->
                <th style="font-weight: 600; text-align: center; "><?php echo $bonoQ; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $bonoasistencia;?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $diasNomina; ?></th>
                <th style="font-weight: 600;"><?php echo number_format($td,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($vxr['SubTotal'],2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($vxr['PrimaVacacional'],2); ?></th>
                <th style="font-weight: 600;"><?php echo $de; ?></th>
                <th style="font-weight: 600;"><?php echo $fh; ?></th>
                <th style="font-weight: 600;"><?php echo number_format($pd,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($diafestivo,2); ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['horasExtras']; ?></th>
               <!-- <th style="font-weight: 600;">-<?php echo $infoRec['Tiempo']; ?></th>-->
                <th style="font-weight: 600;"><?php echo number_format($infoRec['gratificaiones'],2);?>
                <th style="font-weight: 600;"><?php echo number_format($recomendaciones,2);?>
                <th style="font-weight: 600;"><?php echo number_format($deducciones,2); ?>
                <th style="font-weight: 600;">-<?php echo number_format($tp,2); ?></th>
                <th style="font-weight: 600;">-<?php echo number_format($tpd,2); ?></th>
           </tr>
   

		<?php  } 

       // $noi = FormatoNoiExcel($noi_arr2);
       /* print_r($pn_arr2);
        echo 'empieza array NOI </br>';
        print_r($noi_arr2);
        print_r($recomendadores);*/
        ?>

        </tbody>
    </table>
    
    <?php echo number_format($total,2); 
    echo '</BR>';
    echo number_format($deduccionesTotal,2); 
    echo '</BR>';
    echo number_format($total1,2); 
   
    
    
    
    ?>

                   <!-- <div class="row" style="padding: 10px;">
                        <button class="btn btn-dark" type="submit" name="guardarRetardo" id="guardarRetardo">Guardar</button>
                    </div>-->

        </div>



        </form>


<div class="row" style="padding: 50px;">
  <button class="btn btn-dark" type="button" name="guardar" id="guardar" data-bs-target="#modalinsert" data-bs-toggle="modal" data-bs-whatever="insert">APROBAR</button>
  <a href="#" data-bs-target="#modalinsert" data-bs-toggle="modal" data-bs-whatever="insert"  ><i class='bi bi-plus-square' style="color: #ffffff; font-size: 30px; float: right; padding-right: 15px;"></i></a>
</div>

        <?php } ?>
  


               
        </div>
        <!--fin-->

        <div class="modal fade" id="modalinsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aprobar Pre-Nómina</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <div id="ajaxcont" class="modal-body">
      <form class="needs-validation" novalidate id="numquincena">
                    <div class="row">
                        <div class="card info-card customers-card">
                                <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
                                    <h5 class="card-title" style="color: #ffffff;">Número de Quincena</h5>
                                </div>
                                <!--Inicio-->
                                <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
                                    <div class="input-group mb-1 ">
                                        <div class="col-md-12 mb-2 px-md-10">
                                            <label for="validationCustom03">Introduce el Número de Quincena</label>                                            
                                            <input  type="text" class="form-control" id="nquincena" name="nquincena" placeholder="Número de Quincena" required>
                                            <label for="validationCustom03">Introduce la Fecha de Inicio NOI</label>
                                            <input type="date" class="form-control" id="FechaInicioN"   name="FechaInicioN" value="">
                                            <label for="validationCustom03">Introduce la Fecha Fin NOI</label>
                                            <input type="date" class="form-control" id="FechaFinN"   name="FechaFinN" value="">
                                        </div>
                                    </div>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                           <!-- <button class="btn btn-dark" type="button" id="agregar" onclick="guardaRepExNo('<?php  echo json_encode($pn_arr2);?>','<?php  echo json_encode($noi_arr2);?>')" > APROBAR </button>-->
                           <button class="btn btn-dark" type="submit"  id="agregar" > APROBAR </button>
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

              
        </div>
        <!--fin-->

  
            </main>
<?php
    include('footer.php');
?>

    <link href="css/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <script>

$(document).ready(function () {
    $('#example').DataTable({
        processing: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            order: [[0, 'desc']]
       // serverSide: true,
       // ajax: 'ajaxtabla.php',
    });
});



/*
$(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    } );
} );
*/

function eliminaEmpleado(id){	

    var mensaje;
    var opcion = confirm("¿Deseas eliminar al empleado?");
    if (opcion == true) {
        var datos = 'idempleado='+id;
      $.ajax({
      type: 'POST',
      url: 'dalete_empleado.php',
      data: datos,
      success: function(respuesta) {
        if(respuesta=='ok'){
            alert('Empleado eliminado');
            window.location.reload();
        }
        else {
            alert('Inténtalo Nuevamente');
        }
    }
    });
	} else {
	    //mensaje = "Has clickado Cancelar";
	}
  
}

function updateEmpleado(id){	
  var datos = 'idempleado='+id;
      $.ajax({
      type: 'POST',
      url: 'dalete_empleado.php',
      data: datos,
      success: function(respuesta) {
        if(respuesta=='ok'){
            alert('IEmpleado eliminado');
            window.location.reload();
        }
        else {
            alert('Inténtalo Nuevamente');
        }
    }
    });
}

function cambiaEstatus(id,estatus){	
   // alert (estatus);
  //  alert("entro");
 
    var estatus2 = document.getElementById(estatus).value;
   // alert (estatus2);
    var datos = 'id='+id+'&estatus='+estatus2;
    //alert(datos);
    $.ajax({
      type: 'POST',
      url: 'estatus.php',
      data: datos,
      success: function(respuesta) {
       // alert(respuesta);
        if(respuesta=='cam'){
            alert('El empleado ha cambiado de estatus.');
            window.location='empleados.php';
        }else{
            alert('inténtalo nuevamente.');
        }
    }
    });
}




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



/*function guardaretardos(){

    
        var  datose = $("#retardos2").serialize();
    console.log('acciones/ajax/guardarRetardos.php?'+datose);
                 alert('acciones/ajax/guardarRetardos.php?'+datose);

			$.ajax({
	          //  data:  datos,
	            url:  'acciones/ajax/guardarRetardos.php',
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
 
        }*/




 $(document).ready(function(){

$('#retardos2').on('submit',function(e){
  
var  datose = $(this).serialize();
  

			$.ajax({
	          
	            url:  'acciones/ajax/guardarRetardos.php',
              type:'POST',
              data: datose,
      
              success:  function (datos){ 
                console.log(datos);
                location.reload()
             

           
	            }
	        });
    });
  });

  function RangosQuincena(){
    alert('entro');
   
        var fecha = document.getElementById("FechaInicio").value;
       // var timeEnd = new Date(document.getElementById("FechaFin").value);
       datos = 'fecha=' + fecha;
       alert ('acciones/ajax/rangosQuincena.php?'+datos);
       console.log(datos);
       $.ajax({
	        url:  'acciones/ajax/rangosQuincena.php',
            type:'POST',
            data: datos,
            dataType: 'json',
            success:  function (datos){ 
              console.log(datos);
              alert(datos);
             // location.reload()
              document.getElementById("FechaInicio").value = datos.fi;
              document.getElementById("FechaFin").value = datos.ff;
              window.location.href= 'pnQuincenal.php?FechaInicio='+ datos.fi+'&FechaFin='+datos.ff+ '&al= ok';
             }
          });
    }


function FNoi(Narray){
    alert('entro');
   
       datos = 'fecha=' + Narray;
       alert ('FormatoNOI.php?'+datos);
       console.log(datos);
       $.ajax({
	        url:  'FormatoNOI.php',
            type:'POST',
            data: datos,
            dataType: 'json',
            success:  function (datos){ 
              console.log(datos);
              alert(datos);
             // location.reload()
             
              }
          });
    }

    
  /*  function guardaRepExNo(arrayEx,arrayNo){
        alert("entro");
        var idnu = document.getElementById("IdDRENC2").value;
        datos = 'fecha=' + idnu;
       // var  datos = $(this).serialize();
        console.log(idnu);
        alert("entro2");          

                $.ajax({
                       url:   'Repositorio.php',
                       type: 'post',
                       dataType: 'json',
                      // data: {arrayEx: arrayEx,arrayNo: arrayNo},
                      data: {arrayEx: arrayEx,arrayNo: arrayNo}
                       success:  function (datos){ 
                        console.log(datos);
                        alert(datos);
                       // window.location.href= 'rutas.php';
                      }
                });
        }*/


        function guardaRepExNo(){
        alert("entro");
        var idnu = document.getElementById("nquincena").value;
        datos = 'numQ=' + idnu;
       // var  datos = $(this).serialize();
        console.log(idnu);
        alert("entro2");          

        $.ajax({
	        url:  'Repositorio.php',
            type:'POST',
            data: datos,
            dataType: 'json',
            success:  function (datos){ 
              console.log(datos.mensaje);
              alert(datos.mensaje);
             // location.reload()
             
              }
          });
        }


  $(document).ready(function(){
    $('#numquincena').on('submit',function(e){
        var excel = <?php echo json_encode($pn_arr2); ?>; 
        var noi = <?php echo json_encode($noi_arr2); ?>;
        var rec = <?php echo json_encode($recomendadores); ?>; 
        var nquin = <?php echo json_encode($nquincenales); ?>;
        var numq= document.getElementById("nquincena").value;
        var fin= document.getElementById("FechaInicioN").value;
        var ffn= document.getElementById("FechaFinN").value;
        var datos = {
          arrayEx:JSON.stringify(excel),
          arrayNo:JSON.stringify(noi),
          rec:JSON.stringify(rec),
          nquin:JSON.stringify(nquin),
          fin:fin, 
          ffn:ffn, 
          sem:0,
          numq:numq      
        }
      /*  console.log(datos);
        alert('entro');*/
        $.ajax({
                  url:   'Repositorio.php',
                   type: 'POST',
                  dataType: 'json',
                   data: datos,
                 /*  success:  function (datos){ 
                         alert(datos.mensaje);
                         window.location.href= 'pnQuincenal.php?al=no';
                   }*/
                  beforeSend: function () {
                        $("#ajaxcont").html("</br></br></br></br>Procesando, Espere por favor...");
                },
                   success:  function (datos) {
					              alert(datos.mensaje);
                        $("#ajaxcont").html(datos);
                       //  alert(datos.no);
                       window.location.href= 'pnQuincenal.php?al=no';
                        
                }  
              });
        });
  });


</script>
