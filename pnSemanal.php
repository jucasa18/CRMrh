<?php
$al = '';
include('header.php');
//include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Empleados.php'; 
include 'acciones/funciones/prenomina.php'; 
include 'acciones/funciones/pnSemanal.php'; 
include 'FormatoNOI.php'; 
//$fecha = $_REQUEST['FechaRetardo']; despues poner el rango de fechas que se cambioe el request
set_time_limit(800);
$al = $_REQUEST['al'];
if($al != 'no'){
    $fechaInicio = $_REQUEST['FechaInicio'];
    $fechaFin = $_REQUEST['FechaFin'];
    $lisEmplAct  = Empleados::listaSemanales($fechaInicio,$fechaFin);
   // $dia16 = date("d", strtotime($fechaFin));
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
      <h1>Pre-Nomina Semanal</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Pre-Nomina</li>
          <li class="breadcrumb-item active">Pre-Nomina Semanal</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

  

  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Lista de Empleados </h5>
        </div>
    <!--Inicio-->
            <form id="rangos" name="rangos" action="pnSemanal.php" method="post">
            <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
              <div class="input-group mb-2 ">
                  <div class="col-md-3 mb-3 px-md-3">
                  <label for="validationCustom02">Fecha Inicio</label>
                  <input type="date" class="form-control" id="FechaInicio"   name="FechaInicio" value="<?php echo  $fechaInicio; ?>" onblur="RangosSemanal();">
                 
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
                <th>R</th>
                <th>F</th>
                <th>P</th>
                <th>I</th>
                <th>H</th>
                <th>HN</th>
                <th>HDN</th>
                <th>HTN</th>
                <th>HD</th>
                <th>HT</th>
               <!-- <th>HB</th>-->
                
               <!--  <th>SB</th> SALARIO BRUTO-->
                <th>SxDia</th>
                <th>SxHr</th>
                <th>Tur</th>
                <th>Sueldo</th>
                <th>7D</th>
                <th>BXA</th>
                <th>DF</th>
                <th>BP</th>
                <th>BA</th>
                <th>BApy</th>
                <th>BD</th>
                <th>PD</th>
                <th>FH</th>
              <!--  <th>HV</th>-->
                <th>PV</th>
                <th>CS</th>
                <th>BSL</th>
                <th>BA</th>
                <th>BR</th>
                <th>COM</th>
                <th>TP</th>
                <th>DED</th>
                <th>TD</th>
                <!--
                <th>TD</th>
                <th>Vac</th>
                <th>PV</th>
                <th>DESP</th>
                <th>FH</th>
                <th>PD</th>
                
               
             
                <th>G</th> 
                <th>Rec</th> 
                <th>D</th> 
                <th>TP</th>
                <th>TP-DEDUCCIONES</th> -->

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
             
            
             $vxr = vacacionesxR2($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             //$horas = ValTurnosPNQ(intval($infoRec['IdDRENC']), $fechaInicio, $fechaFin);
             list($horas1, $df, $turno,$ree,$hrnor, $hrext) = ValTurnosPNQ(intval($infoRec['IdDRENC']), $fechaInicio, $fechaFin);
             $faltas = cuentaFaltas($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $permisos = cuentapermisos($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $incapacidades = IncapacidadesxR2($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $dfNT = $infoRec['diafestivoNT'];
             $heHombreGarantia = $infoRec['hombregarantiaH'];
             $cpercepciones = buscaConceptosP($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $cdeducciones = buscaConceptosD($infoRec['IdDRENC'], $fechaInicio, $fechaFin);
             $rec = buscaRecomendaciones($infoRec['IdDRENC']);
             $horasvacaciones = sumaHorasVacaciones($vxr['diasVacaciones'], $turno);
             $complemento = sacaHorasComplemento($infoRec['comple'], $turno);
             $primerdia =  buscaPrimerDia($infoRec['IdDRENC'],$fechaInicio, $fechaFin);
             
       
             //$complemento = 0;

             $hrNorm1 =  $hrnor + $complemento + $horasvacaciones;
            

             list($hrtot, $hrNorm, $hrext2,$hrd,$hrt)  = cuentaHorasxSemana($hrNorm1, $hrext, $turno);
             
             
             if( $infoRec['SueldoEsp'] == 0 ){
                    $sueldoxdia = calculaSalarioxCategoria($infoRec['Depto'], $infoRec['Puesto'], $infoRec['FechaIngreso'], $fechaFin);
             }elseif($infoRec['SueldoEsp'] == 1 ){
                    $sueldoxdia = $infoRec['SueldoDiario'];
             }
             $salxhr = calculaSalarioxH($sueldoxdia, $turno);
             $sb = $sueldoxdia * 7;//sueldo base


            
              $hdfN = 0;
              $diafestivo = 0;
              if ($df > 0 ){
                if($turno == 1){
                  $diafestivo = ($salxhr * 9.6)*2;
                }elseif($turno == 2){
                  $diafestivo = ($salxhr * 8.4)*2;
                }
                //$diafestivo = $df * ($infoRec['SueldoDiario'] * 2);
              }elseif($dfNT > 0) {
                  $hdfN = 9.6; //horas dia festivo no trabajado es igual para los dos turnos

              }
            //  $horas =  $horas + $hdfN + $heHombreGarantia + $horasvacaciones +$infoRec['horasExtras'] + $complemento;
             //  $horas =  $hrNorm1 + $hrext;
               $horas =  $hrtot;
              if($turno == 1){
                $horasH = ($salxhr * 9.6)*2;
              }elseif($turno == 1){
                $horasH = ($salxhr * 8.4)*2;
              }
              
           /*  if($horasH > 96){
                $hb = $horasH - 96;
             }else{
                $hb = 0;
             }*/

            

          //  $bonoQ = $hb * 50; //INCLUYE LAS  HORAS EXTRAS
            // $bonoasistencia = $infoRec['dias'] * 13;
            $bonoasistencia = $infoRec['dias'] * 22; // a partir del 2024 son 22 pesos
            // $diasNomina = 15;

             $banderadias = $infoRec['dias'] + $vxr['diasVacaciones'] + $faltas + $permisos + $incapacidades;

             if ($banderadias <= 0){
                $diasNomina = 0;

             } 
             

           /*  
             $hrNorm1 = $hrNorm + $complemento + $horasvacaciones ;*/


           // list($hrtot, $hrNorm, $hrext) = cuentaHorasxSemana($hrNorm1, $hrext, $turno);

           
             
          
             $hn = $hrNorm *  $salxhr;
             $hd = $hrd * ($salxhr * 2);
             $ht = $hrt * ($salxhr * 3);
             $pd = ($sueldoxdia *0.25) * $infoRec['domingos'];
             $sueldo = calculaSueldo($sueldoxdia, $turno, $hrNorm);
          
             $septimodia = calculaSeptimidia($hn, $vxr['diasVacaciones'], $turno);
       
            
            // $diasNomina =  $diasNomina - $faltas - $permisos - $incapacidades;    
             $bonoxarea =bonoxArea($infoRec['Depto'], $infoRec['Linea']);
             $retardos = CuentaRetardos($infoRec['IdDRENC'], $fechaInicio, $fechaFin, $turno,$infoRec['IdPlanta']);
             $permisosnv = cuentaPermososnvbp($infoRec['IdDRENC']);
             $bonopuntualidad =  bonoPuntualidad($retardos, $faltas, $permisosnv);
             $bonoasistencia =  bonoPuntualidad($retardos, $faltas, $permisosnv);
             $bonoapoyo = bonoApoyo($turno, $retardos, $infoRec['dias'], $infoRec['Depto'],$primerdia);    
                   

             $bonodiario = bonoDiario($infoRec['dias']);
             $fondodeahorro = fondoAhorro($sueldo, $septimodia);
             $primavac = calculaPv($vxr['diasVacaciones'], $sueldoxdia);
            // $csindical = 60;
             $bsenlrge = bonoSemanaLarga($retardos, $infoRec['dias']);
             $bonoanti = buscaBonoAnti($fechaInicio, $fechaFin, $infoRec['FechaIngreso']);
             $cuotas = cuotasindical($incapacidades);
            

          
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
             
              if($rec > 0){
                   $recomendaciones = $rec * 2000;
                   $recomendadores[] = array("idRecomendador" => $infoRec['IdDRENC']); 

              }else{
                    $recomendaciones = 0;
              }
             $deducciones = $bonodiario + $infoRec['infonavit'] + $infoRec['fonacot'] + $infoRec['pa'] + ($fondodeahorro * 2) + $cdeducciones + $cuotas;
             $tp = $sueldo + $septimodia + $hd + $ht + $recomendaciones + $diafestivo + $primavac + $bsenlrge + $bonoxarea + $bonoasistencia + $bonoanti + $bonoapoyo + $bonopuntualidad + $bonodiario + $pd + $fondodeahorro  + $infoRec['gratificaiones'] + $cpercepciones + $recomendaciones;
             $tpd = ($sueldo + $septimodia + $hd + $ht + $recomendaciones + $diafestivo + $primavac + $bsenlrge + $bonoxarea + $bonoasistencia + $bonoanti + $bonoapoyo + $bonopuntualidad + $bonodiario + $pd + $fondodeahorro  + $infoRec['gratificaiones'] + $cpercepciones + $recomendaciones) - $deducciones;
             if($horas == 0 ){
              $tpd = 0;
             }

             $total = $total +  $tp;
             $deduccionesTotal = $deduccionesTotal + $deducciones;
             $total1 = $total1 + $tpd ;
             $noi_arr2[] =  FormatoNoi($fechaInicio, $fechaFin, $infoRec['IdDRENC'], $infoRec['IdCorto'], $sueldo, $hd, $ht, $recomendaciones, $diafestivo, $primavac, $bsenlrge, $bonoxarea, $bonopuntualidad, $bonoasistencia, $bonoanti, $bonoapoyo, $bonodiario, $pd, $gratificaciones,$fondodeahorro, $penalim,$cuotas,$infoRec['fonacot'],$infoRec['infonavit'],2);
            
             $pn_arr2[] = array("IdDRENC" => $infoRec['IdDRENC'],"FechaInicio" => date('Y-m-d',strtotime($fechaInicio)),"FechaFin" => date('Y-m-d',strtotime($fechaFin)),"dt" => $infoRec['dias'],"vacaciones" => $vxr['diasVacaciones'],"retardos" => $retardos,
             "faltas" => $faltas , "permisos" => $permisos, "incapacidades" => $incapacidades , "horas" => $horas, "hdobles" => $hd, "htriples" => $ht, "septimodia" => $septimodia, "bonoxarea" => $bonoxarea, 
             "diafestivo" => $diafestivo, "bonopuntualidad" => $bonopuntualidad, "bonoasistencia" => $bonoasistencia, "bonoapoyo" => $bonoapoyo, "bonodiario" => $bonodiario, "pridom" => $pd, 
             "fondodeahorro" => $fondodeahorro, "primavac" => $primavac, "cuotas" => $cuotas, "bsenlrge" => $bsenlrge, "bonoanti" => $bonoanti, "sueldoxdia" => $sueldoxdia,"tp" => $tp,"deducciones" => $deducciones,"tpd" => $tpd,
             "IdUsuario" => $_SESSION['id'], "tipoNomina" => 2); 
            //"g" => $infoRec['gratificaiones']    //pener esto cuando termine las pruebas
            
			?>
            <tr style="font-weight: lighter;">
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <!--<th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP']; ?> <?php echo $infoRec['ApellidoM']; ?></th>-->
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['dias']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $vxr['diasVacaciones']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $retardos; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $faltas; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $permisos; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $incapacidades; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $horas; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($hrNorm,2); ?> - <?php echo number_format($hrext2,2); ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($hrd,2); ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($hrt,2); ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($hd,2);  ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($ht,2);  ?></th>
               <!-- <th style="font-weight: 600; text-align: center; "><?php echo $hb; ?></th>-->
              <!--  <th style="font-weight: 600; text-align: center; "><?php echo number_format($sb,2); ?></th>  -->   
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($sueldoxdia,2); ?></th>            
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($salxhr,2); ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $turno ?>
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($sueldo,2); ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($septimodia,2); ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo number_format($bonoxarea,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($diafestivo,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($bonopuntualidad,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($bonoasistencia,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($bonoapoyo,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($bonodiario,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($pd,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($fondodeahorro,2); ?></th>
                <!--<th style="font-weight: 600;"><?php echo $horasvacaciones; ?></th>-->
                <th style="font-weight: 600;"><?php echo number_format($primavac,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($cuotas,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($bsenlrge,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($bonoanti,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($recomendaciones,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($complemento,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($tp,2); ?></th>
                <th style="font-weight: 600;">*<?php echo number_format($deducciones,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($tpd,2); ?></th>
                <!--
                <th style="font-weight: 600;"><?php echo number_format($td,2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($vxr['SubTotal'],2); ?></th>
                <th style="font-weight: 600;"><?php echo number_format($vxr['PrimaVacacional'],2); ?></th>
                <th style="font-weight: 600;"><?php echo $de; ?></th>
                <th style="font-weight: 600;"><?php echo $fh; ?></th>
                <th style="font-weight: 600;"><?php echo number_format($pd,2); ?></th>
                
                
              
                <th style="font-weight: 600;"><?php echo number_format($infoRec['gratificaiones'],2);?>
                <th style="font-weight: 600;"><?php echo number_format($recomendaciones,2);?>
                <th style="font-weight: 600;"><?php echo number_format($deducciones,2); ?>
                <th style="font-weight: 600;">-<?php echo number_format($tp,2); ?></th>
                <th style="font-weight: 600;">-<?php echo number_format($tpd,2); ?></th>-->
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
                                    <h5 class="card-title" style="color: #ffffff;">Número de Semana</h5>
                                </div>
                                <!--Inicio-->
                                <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
                                    <div class="input-group mb-1 ">
                                        <div class="col-md-12 mb-2 px-md-10">
                                            <label for="validationCustom03">Introduce el Número de Semana</label>                                            
                                            <input  type="text" class="form-control" id="nquincena" name="nquincena" placeholder="Número de Semana" required>
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

  function RangosSemanal(){
  //  alert('entro');
   
        var fecha = document.getElementById("FechaInicio").value;
       // var timeEnd = new Date(document.getElementById("FechaFin").value);
       datos = 'fecha=' + fecha;
       alert ('acciones/ajax/rangosSemana.php?'+datos);
       console.log(datos);
       $.ajax({
	        url:  'acciones/ajax/rangosSemana.php',
            type:'POST',
            data: datos,
            dataType: 'json',
            success:  function (datos){ 
              console.log(datos);
              alert(datos);
             // location.reload()
              document.getElementById("FechaInicio").value = datos.fi;
              document.getElementById("FechaFin").value = datos.ff;
              window.location.href= 'pnSemanal.php?FechaInicio='+ datos.fi+'&FechaFin='+datos.ff+ '&al= ok';
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
        var numq= document.getElementById("nquincena").value;
        var fin= document.getElementById("FechaInicioN").value;
        var ffn= document.getElementById("FechaFinN").value;
        var datos = {
          arrayEx:JSON.stringify(excel),
          arrayNo:JSON.stringify(noi),
          rec:JSON.stringify(rec),
          fin:fin, 
          ffn:ffn, 
          sem:8, 
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
                /*  beforeSend: function () {
                        $("#ajaxcont").html("</br></br></br></br>Procesando, Espere por favor...");
                },*/
                   success:  function (datos) {
					            //	alert(datos);
                    //   console.log(datos);
                        alert(datos.mensaje);
                        $("#ajaxcont").html(datos);
                      window.location.href= 'pnQuincenal.php?al=no';
                     // alert(datos);
                     // console.log(datos);
                        
                }  
              });
        });
  });


</script>