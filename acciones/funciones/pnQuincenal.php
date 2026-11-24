<?php
//trabajando
/*function NominaQuincenal($fechaInicio, $fechaFin){
    $lisEmplAct  = Empleados::listaQuincenales($fechaInicio, $fechaFin);
}
include '../ins/Empleados.php'; */

error_reporting(0);
function vacacionesxR($idEmpleado, $fechaInicio, $fechaFin){
   $lisVacaciones = Empleados::DiasVacaciones($idEmpleado, $fechaInicio, $fechaFin);
    if(is_array($lisVacaciones)){    
        $fiq = $lisVacaciones['FechaInicio'];
        $ffq = $lisVacaciones['FechaFin'];
    }else{
        $fiq = $fechaInicio;
        $ffq = $fechaFin;
    }
       /* echo $fechaInicio .' - '. $fechaFin .'  /  '. $fiq .' '. $ffq; 
        echo '</br>';*/
        if($fiq > $fechaInicio){
            $fiq = $fechaInicio;
         }elseif($ffq > $fechaFin){
            $ffq = $fechaFin;
         }
       /* echo $fechaInicio .' - '. $fechaFin .'  /  '. $fiq .' '. $ffq .'-'. $idEmpleado; 
        echo '</br></br>';*/

        $lisVacacionest = Empleados::DiasVacaciones2($idEmpleado, $fiq , $ffq);
        return $lisVacacionest['diasVacaciones'];
    
}

function vacacionesxR2($idEmpleado, $fechaInicio, $fechaFin){
     
         $lisVacacionest = Empleados::DiasVacacionesxr($idEmpleado, $fechaInicio , $fechaFin);
         return $lisVacacionest;
     
 }

function ValTurnosPNQ($idEmpleado, $fechaInicio, $fechaFin){
    $ht2 = 0;
    $ht1 = 0;
    $lisHoras = Empleados::EntradasSalidas($idEmpleado, $fechaInicio, $fechaFin);
    $j=0;
    $diaf = 0;
    $primerdia = buscaPrimerDia($idEmpleado,$fechaInicio, $fechaFin);
    //echo $primerdia;
if(count($lisHoras) > 0){
            for($i=0;$i<count($lisHoras);$i++) {
                if($lisHoras[$i]['Entrada'] != '00:00:00'){
                    //echo 'fecha antes'.$lisHoras[$i]['Fecha'];
                    $diafestivo = buscaDiaFestivo($lisHoras[$i]['Fecha']);
                    //echo $diafestivo;
            
                    $diaf = $diaf + intval($diafestivo);
            } 
          


            

         /*   $retardos = buscaRetardos($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha']);
            if($retardos <> ''){
                $entrada = $retardos;
            }else {
                $entrada = $lisHoras[$i]['Entrada'];
            }*/
          /*  if($primerdia == $lisHoras[$i]['Fecha']){
                echo $primerdia;
                echo 'entro';
                    $horentrada = entradaPrimerDia($lisHoras[$i]['Turno'],$lisHoras[$i]['pl']);
                    $entrada = $horentrada;
                    echo $entrada;
                    echo '</br>';
    
                }else{
                    $entrada = $lisHoras[$i]['Entrada'];
                }*/
            
            $entrada = $lisHoras[$i]['Entrada'];
            $salida = $lisHoras[$i]['Salida'];
          

            if($entrada == '00:00:00'){
                $entrada =  buscaomicionChecadaE($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha']);
                //echo "entrada omicion". $entrada ."<br/>";
            }
            if($salida == '00:00:00'){
                $salida =  buscaomicionChecadaS($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha']);
                //echo "salida omicion". $salida ."<br/>";
            }
            
            if($lisHoras[$i]['Turno'] == 1){ 
                      
                $retardos = buscaRetardos($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha'],$lisHoras[$i]['pl'],1);
                if($retardos <> ''){
                    $entrada = $retardos;
                }else {
                    $entrada = $lisHoras[$i]['Entrada'];
                }
                $horas_arr[] = array("turno" => 1,"fechaE" => $lisHoras[$i]['Fecha'], "fechaS" => $lisHoras[$i]['fechas'],"entrada" => $entrada, "salida" =>  $salida, "pl" => $lisHoras[$i]['pl']);


            } elseif($lisHoras[$i]['Turno'] == 2 ){ 
                    
                        $retardos = buscaRetardos($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha'],$lisHoras[$i]['pl'],2);
                        if($retardos <> ''){
                            $entrada = $retardos;
                        }else {
                            $entrada = $lisHoras[$i]['Entrada'];
                        }
                     if($lisHoras[$i]['Entrada'] != ''){
                             $horas_arr[] = array("turno" => 2, "fechaE" => $lisHoras[$i]['Fecha'], "fechaS" => $lisHoras[$i]['fechas'],"entrada" => $entrada , "salida" => $salida, "pl" => $lisHoras[$i]['pl'] );
                             //echo $lisHoras[$i]['Fecha'];
                     }
                // }

              //echo $entrada.' - '.$salida;
             }
                
                

            }      




            
            $horasxR = 0; 
            $ree  = 0;
            $res  = 0;
            $diff = 0;
            $mh = 0;
            for($k=0;$k<count($horas_arr);$k++) {


                if($primerdia == $horas_arr[$k]['fechaE']){
                        $horentrada = entradaPrimerDia($horas_arr[$k]['turno'],$horas_arr[$k]['pl']);
                        $entrada = $horentrada;
                }else{
                        $entrada = $horas_arr[$k]['entrada'];
                }
            
                
                $salida = $horas_arr[$k]['salida'];
                $fechaE = $horas_arr[$k]['fechaE'];
                $fechaS = $horas_arr[$k]['fechaS'];
                $turno = $horas_arr[$k]['turno'];  
                $pl = $horas_arr[$k]['pl'];
               // if($entrada != ''  OR $salida != ''){
                if($entrada != "00:00:00"  && $salida != "00:00:00"){
                /* echo $entrada.' - '.$salida.' - '.$fecha;
                    echo '</br>';*/
                
                /*  $checkIn = explode(":", $entrada);
                    $checkOut = explode(":", $salida);*/


                     //busco las contingencias, y pongo el horario de salida correspondiente a la planta
                     $contingenciasE = buscaContingenciasE($fechaE ,$pl);
                    // echo $contingenciasE ."con e";
                     if($contingenciasE != 0){
                          $entrada = $contingenciasE;
                     }
                     $contingenciasS = buscaContingenciasS($fechaE ,$pl);
                    // echo $contingenciasS ."con s";
                     if($contingenciasS != 0){
                          $salida = $contingenciasS;
                     }         
                       
                     $ts1 = strtotime($fechaE.' '.$entrada);
                                       
                      if($turno == 2 ){
                            $ts2 = strtotime($fechaS.' '.$salida);
                       }else{
                          $ts2 = strtotime($fechaE.' '.$salida);
                         // $diff = ($ts2 - $ts1) / 3600;
                      }
                      
                     // $diff = ($ts2 - $ts1) / 3600;
                     $diff = (ceil($ts2) - ceil($ts1)) / 3600; ///checar si funciona, sino regresar a la de arriba
                      
                      if($diff < 0 ){
                          $diff = 0;
                      }

                     //aqui hay que poner la funcion de buscar horas extras, sino esta el formato, no se pagan
                     if($diff >= 12){ //checar
                        $diff = 12;
                        if($turno == 1){
                        
                            $ree = $ree + turno1E($fechaE,$pl, $entrada);
                           // $res = $res + turno1S($fechaE,$pl, $salida);
                           // echo $ree.'retardo entrada';
                       }elseif($turno == 2){
                            $ree = $ree + turno2E($fechaE,$pl, $entrada);
                          //  $res = $res  +turno2S($fechaE,$pl, $salida);
                           // echo $ree.'retardo salida';
                       }
                       
                    }else{
                        if($diff <= 23){
                            $fechaS2 = $fechaS;
                        }else{
                            $fechaS2 = $fechaE;
                        }
                            $diff = horaEntrada($pl, $turno,$entrada, $salida, $fechaE, $fechaS2);
                            //echo  $diff;
                           
                    }
                    
                    $mh = $mh+ buscaMediasHoras($fechaE,$pl, $salida);

                    $horasxR = intval($horasxR) + intval($diff);
                
                    
                   /* echo $entrada.' - '.$salida.' - '.$fechaS .' - '. intval($diff);
                    echo '</br>';
                    echo $horasxR;
                    echo '</br>';*/
                }

                
                //$horasxR = $horasxR + intval($diff);
              //  $horasxR = intval($horasxR) + intval($diff);
                // $horasxR = $horasxR - $ree - $res;
 
                 if($horasxR < 0 ){
                     $horasxR = 0;
                 }
               // $horasxR = $horasxR - $ree - $res;
            }
            //print_r($horas_arr);
            
      /*  echo intval($horasxR);
                    echo '</br>';*/
              
                  /*  if ($horasxR == 11){
                        $horasxR = $horasxR - $ree - $res;
                    }*/

                  /*  if ($ree == 1) {
                        $horasxR = $horasxR - $ree - $res;
                    }*///PONER
        
                 
                    $horasxR = ($horasxR - $ree - $res) + $mh;


                 // return $horasxR;

                 return [$horasxR, $diaf];
        }
}

function cuentaFaltas($idEmpleado, $fechaInicio, $fechaFin){
    $lisFaltas = Empleados::Faltas($idEmpleado, $fechaInicio, $fechaFin);
    return $lisFaltas['faltas'];
 
}
function cuentapermisos($idEmpleado, $fechaInicio, $fechaFin){
    $lisPermisos = Empleados::Permisos($idEmpleado, $fechaInicio, $fechaFin);
    return $lisPermisos['permisos'];
 
}


function IncapacidadesxR($idEmpleado, $fechaInicio, $fechaFin){
    $lisIncapacidades = Empleados::DiasIncapacidad2($idEmpleado, $fechaInicio, $fechaFin);
     if(is_array($lisIncapacidades)){    
         $fiq = $lisIncapacidades['FechaInicio'];
         $ffq = $lisIncapacidades['FechaFin'];
     }else{
         $fiq = $fechaInicio;
         $ffq = $fechaFin;
     }
        /* echo $fechaInicio .' - '. $fechaFin .'  /  '. $fiq .' '. $ffq; 
         echo '</br>';*/
         if($fiq > $fechaInicio){
             $fiq = $fechaInicio;
          }elseif($ffq > $fechaFin){
             $ffq = $fechaFin;
          }
        /* echo $fechaInicio .' - '. $fechaFin .'  /  '. $fiq .' '. $ffq .'-'. $idEmpleado; 
         echo '</br></br>';*/
 
         $lisIncapacidadest = Empleados::DiasIncapacidad2($idEmpleado, $fiq , $ffq);
         return $lisIncapacidadest['diasIncapacidad'];
     
 }

 function IncapacidadesxR2($idEmpleado, $fechaInicio, $fechaFin){
    
 
         $lisIncapacidadest = Empleados::DiasIncapacidad2($idEmpleado, $fechaInicio , $fechaFin);
         return $lisIncapacidadest['diasIncapacidad'];
     
 }

 function buscaRetardos($idEmpleado, $fecha,$pl,$tur){
    $hr='';
    if($pl == 1 AND $tur == 1){
        $hr = '08:00:00';
    }elseif($pl == 1 AND $tur == 2){
        $hr = '20:00:00';
    }elseif($pl == 2 AND $tur == 2){
        $hr = '07:30:00';
    }elseif($pl == 2 AND $tur == 2){
        $hr = '19:30:00';
    }
  
    $retardo = Empleados::BuscaRetardos($idEmpleado, $fecha);
    $entrada = '';
   if(is_array($retardo)){
       // if($retardo['Salida'] >= '20:00:00'){
            $entrada = $hr;
       // }
        
        
        /*elseif($retardo['Entrada'] >= '08:00:00'){
             $entrada = $hr;
        }     */
    }    
         return $entrada;
 }



 function turno1E($fecha,$pl, $entrada){
    $enpl1= '08:00:00';
    $enpl2= '07:30:00';
    $retardo =0;
    
    if($pl == 1){
        if($entrada > $enpl1){
          
            $he = strtotime($fecha.' '.$entrada);
            $en = strtotime($fecha.' '.$enpl1);
            $retardo = (intval($he) - intval($en)) / 3600;
        }
    }elseif($pl == 2){
        if($entrada > $enpl2){
            $he = strtotime($fecha.' '.$entrada);
            $en = strtotime($fecha.' '.$enpl2);
            $retardo = (intval($he) - intval($en)) / 3600;

        }
     }
 return ceil($retardo);
}
 function turno2E($fecha,$pl, $entrada){
    $enpl1= '20:00:00';
    $enpl2= '19:30:00';
    $retardo =0;
    
    if($pl == 1){
        if($entrada > $enpl1){
          
            $he = strtotime($fecha.' '.$entrada);
            $en = strtotime($fecha.' '.$enpl1);
            $retardo = (intval($he) - intval($en)) / 3600;
        }
    }elseif($pl == 2){
        if($entrada > $enpl2){
            $he = strtotime($fecha.' '.$entrada);
            $en = strtotime($fecha.' '.$enpl2);
            $retardo = (intval($he) - intval($en)) / 3600;

        }
    
    }
 return ceil($retardo);
}

 function turno1S($fecha,$pl, $salida){
    $sapl1= '20:00:00';
    $sapl2= '19:30:00';
    $retardos =0;
    if($pl == 1){
        if($salida > $sapl1){
            $hs = strtotime($fecha.' '.$salida);
            $sa = strtotime($fecha.' '.$sapl1);
            $retardos = (intval($sa ) - intval($hs)) / 3600;
        }
    }elseif($pl == 2){
        if($salida < $sapl2){
            $hs = strtotime($fecha.' '.$salida);
            $sa = strtotime($fecha.' '.$sapl2);
            $retardos = (intval($sa) - intval($hs)) / 3600;

        }
    }
 return ceil($retardos);
}
 function turno2S($fecha,$pl, $salida){
    $sapl1= '08:00:00';
    $sapl2= '07:30:00';
    $retardos =0;
    
    if($pl == 1){
        if($salida > $sapl1){
         
            $hs = strtotime($fecha.' '.$salida);
            $sa = strtotime($fecha.' '.$sapl1);
            $retardos = (intval($sa ) - intval($hs)) / 3600;
        }
    }elseif($pl == 2){
        if($salida > $sapl2){
           
            $hs = strtotime($fecha.' '.$salida);
            $sa = strtotime($fecha.' '.$sapl2);
            $retardos = (intval($sa) - intval($hs)) / 3600;

         }
    }
 return ceil($retardos);
 }

 function buscaContingenciasE($fecha,$pl){
    $enpl1= '08:00:00';
    $enpl2= '07:30:00';
    $ent = 0;
        if($pl == 1){
            $entrada = Empleados::BuscaContingenciasE($enpl1,$fecha);
            if (is_array($entrada)) {
                $ent = $entrada['contingencia'];
            }
        }elseif($pl == 2){
            $entrada = Empleados::BuscaContingenciasE($enpl2,$fecha);
            if (is_array($entrada)) {
                $ent = $entrada['contingencia'];
            }
        }
     return $ent;
 }
 function buscaContingenciasS($fecha,$pl){

    $sapl1 = '20:00:00';
    $sapl2 = '19:30:00';
    $sal = 0;
        if($pl == 1){
            $salida = Empleados:: BuscaContingenciasS($sapl1, $fecha);
            if (is_array($salida)) {
                $sal = $salida['contingencia'];
            }
        }elseif($pl == 2){
            $salida = Empleados:: BuscaContingenciasS($sapl2, $fecha);
            if (is_array($salida)) {
             $sal = $salida['contingencia'];
            }
        }
        
           return $sal;
 }

 function buscaDiaFestivo($fecha){  
    $diafestivo = Empleados::BuscaDiaFestivo($fecha);
    $df = "";
       if(is_array($diafestivo)){
           $df = $diafestivo['diafestivo'];
       }
    return $df;
}
function buscaomicionChecadaS($idEmpleado, $fecha){
    $sal = 0;
    $omision = Empleados:: BuscaOmisiones($idEmpleado, $fecha);
    if(is_array($omision)){
        if( $omision['Motivo'] = 2){
                $sal = $omision['Hora'];
         }
    }   
           return $sal;
 }
 function buscaomicionChecadaE($idEmpleado, $fecha){
    $ent = 0;
    $omision = Empleados:: BuscaOmisiones($idEmpleado, $fecha);
    if(is_array($omision)){
        if( $omision['Motivo'] = 1){
                $ent = $omision['Hora'];
         }
    }   
           return $ent;
 }

 function FormatoNoi($fechaInicio, $fechaFin, $iddrenc, $idcorto, $bonoQ, $bonoasistencia, $td, $SubTotal, $PrimaVacacional, $de, $fh, $pd, $diafestivo, $infonavit, $fonacot, $pa, $gratificaiones, $tipoNomina, $recomendaciones){
    if($bonoQ != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '30',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bonoQ, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($bonoasistencia != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '31',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bonoasistencia, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($td != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '1',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $td, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($SubTotal != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '9',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $SubTotal, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($PrimaVacacional != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '9',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $PrimaVacacional, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($de != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '24',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $de, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($fh != ''){
        // $noi_arr[] = array("id" => $infoRec['IdDRENC'],"pd" => 'P',"npd" => '28',"nc" => '0',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $fh); 
         $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '6',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $fh, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
      }
      if($pd != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '19',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $pd, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($diafestivo != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '29',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $diafestivo, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($gratificaiones != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '38',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $gratificaiones, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($infonavit != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '94',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $infonavit, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($fonacot != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '93',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $fonacot, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }

     if($pa != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '10',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $pa, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($recomendaciones != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '32',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $recomendaciones, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }

     $conceptosD = Empleados:: BuscaConceptosDNoi($iddrenc, $fechaInicio, $fechaFin);
     foreach ($conceptosD as $a_ => $infoRecd) {
           $noi_arr[] = array("id" => $idcorto,"pd" => $infoRecd['DP'],"npd" => $infoRecd['Concepto'],"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $infoRecd['Cantidad'], "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
      
     } 
     $conceptosP = Empleados:: BuscaConceptosPNoi($iddrenc, $fechaInicio, $fechaFin);
     foreach ($conceptosP as $a_ => $infoRec) {
            $noi_arr[] = array("id" => $idcorto,"pd" => $infoRec['DP'],"npd" => $infoRec['Concepto'],"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $infoRec['Cantidad'], "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
    }



     
    /* if($pa != ''){
          $noi_arr[] = array(
            'id' => $iddrenc,
            'pd' => 'P',
            'npd' =>  '93',
            'nc'=> '0',
            'aplicadestajo'=> 'N',
            'aplicacion' => '4',
            'fi' => $fechaInicio,
            'ff' =>  $fechaFin,
            'monto'=> $pa
        );
        $noi_arr[] = array("id" => $iddrenc,"pd" => 'D',"npd" => '10',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $pa); 
     }*/
   //  print_r($noi_arr);
           return $noi_arr;
 }
 
 function restaMinE($hora){ 
    list($h,$m,$s) = explode(":",$hora);
    if($m > 0) {
        $m = '00';
       // $h += 1; 
    }
    $hora = "$h:$m:$s";
    return $hora; 
} 
function sumaHora($hora){ 
    list($h,$m,$s) = explode(":",$hora);
    if($m > 0) {
        $m = '00';
       $h += 1; 
    }
    $hora = "$h:$m:$s";
    return $hora; 
} 

function horaEntrada($pl, $turno,$horaentrada, $horasalida, $fecha, $fechaS){//Está funcion es para los retardos, cuando salio antes
    $enpl1= '08:00:00';
    $enpl2= '07:30:00';
    $enpl1t2= '20:00:00';
    $enpl2t2= '19:30:00';
    $horast = 0;
   // $entrada= 0;
    $entrada = sumaHora($horaentrada);
    if($pl == 1 and $turno == 1){//Se combierte en la hora de entrada depéndiendo del turno
        if($horaentrada <= $enpl1){
            $entrada = $enpl1;  
        }       
    }elseif($pl == 2 and $turno == 1){
        if($horaentrada <= $enpl2){
            $entrada = $enpl2;
        }   
    }elseif($pl == 1 and $turno == 2){
        if($horaentrada <= $enpl1t2){
            $entrada = $enpl1t2;
        }    
    }elseif($pl == 2 and $turno == 2){
        if($horaentrada <= $enpl2t2){
            $entrada = $enpl2t2;
        }
     }else{
        $entrada = sumaHora($horaentrada);
    }
    $salida = restaMinE($horasalida);
    $he = strtotime($fecha.' '.$entrada);
    if($turno == 2 ){
            $hs = strtotime($fechaS.' '.$salida);
    }else{
            $hs = strtotime($fecha.' '.$salida);
    }

   // $hs = strtotime($fecha.' '.$salida);
        $horast = (intval($hs) - ceil($he)) / 3600;
      
    return $horast;
}
function buscaMediasHoras($fecha,$pl,$salida){
    $mediasHrs = 0;
    $mh = Empleados::BuscaMediasHoras($pl,$fecha);
   // if(!empty($mh['Horario'])   != ''){
    if(!empty($mh['Horario']) &&  $salida >= $mh['Hora']){
        //echo "entro =";
        $mediasHrs = .5;
    }
 return $mediasHrs;
}

function buscaConceptosP($id, $fechaInicio, $fechaFin){
    $cpercepciones = 0;
    $percepciones = Empleados::BuscaConceptosP($id, $fechaInicio, $fechaFin);
   // if(!empty($mh['Horario'])   != ''){
    if(!empty($percepciones['percepciones'])){
        //echo "entro =";
        $cpercepciones = $percepciones['percepciones'];
    }
 return $cpercepciones;
}
function buscaConceptosD($id, $fechaInicio, $fechaFin){
    $cdeducciones = 0;
    $deducciones = Empleados::BuscaConceptosD($id, $fechaInicio, $fechaFin);
   // if(!empty($mh['Horario'])   != ''){
    if(!empty($deducciones['deducciones'])){
        //echo "entro =";
        $cdeducciones = $deducciones['deducciones'];
    }
 return $cdeducciones;
}

function buscaRecomendaciones($idRecomendador){   
    $recomendados = Empleados::buacaRecomendados($idRecomendador);
    
    $bonoRec = 0;
    $numRec= 0;

    foreach ($recomendados as $a_ => $infoRec) {       
                $recomendado = $infoRec['idRecomendado'];
                $fechaInicio =$infoRec['FechaIngreso'];
                $fechaFin = $infoRec['dias'];
                $bonoRec = buscaIncidenciasRecomendacion($recomendado,$fechaInicio,$fechaFin);    
                if($bonoRec == 'true'){
                    $numRec = $numRec + 1;
                }       
    }
    return $numRec;
}

function buscaIncidenciasRecomendacion($recomendado,$fechaInicio,$fechaFin){   
    $inc = IncapacidadesxR2($recomendado, $fechaInicio, $fechaFin);
    $per = cuentapermisos($recomendado, $fechaInicio, $fechaFin);
    $fal = cuentaFaltas($recomendado, $fechaInicio, $fechaFin);
    if($fal == 0 AND $per == 0 AND $inc == 0){
        $recomendacion = true;    
    }else{
        $recomendacion = false;  
    }
 return $recomendacion;
}
function buscaNuevosQuincenales($id){   //función  que busca a las nuevos Quincenales, cuando se hace el cambio de semanales a quincenales.
    $nuevo = Empleados::BuscaNuevosQuincenales($id);
    if(is_array($nuevo)){       
        $nuevoQ = $nuevo['NuevoQ'];         
        $fnq = $nuevo['FechaCambioNom'];  
    }else{
        $nuevoQ = 0;
    }  
    if($nuevoQ > 0){

        $fecheinicionq =  $fnq;
    }else{
        $fecheinicionq =  8;
    }
    return $fecheinicionq;
}

function cuentaDiasTrabajados($id,$fecha1,$fecha2){   //función  que cuenta los dias trabajados por empleado.
    $diastrabajados = Empleados::cuentaDiasTrabajados($id,$fecha1,$fecha2);
    if(is_array($diastrabajados)){       
        $dt = $diastrabajados['dt'];         
       
    }else{
        $dt = 0;
    }  
    return $dt;
}

function buscaPrimerDia($id,$fecha1,$fecha2){   //función  que busca el primer dia de cada empleado.
    $pdia = Empleados::BuscaPrimerDia($id,$fecha1,$fecha2);
    if(is_array($pdia)){       
        $primerdia = $pdia['fecing'];         
       
    }else{
        $primerdia = 8;
    }   
    
//echo $primerdia;
    return $primerdia;
}

function entradaPrimerDia($turno,$planta){   //función  que busca la hora de entrada del primer dia
    if($turno == 1 AND $planta == 1){
        $entrada = '08:00:00';

    }elseif($turno == 1 AND $planta == 2){
        $entrada = '07:30:00';

    }if($turno == 2 AND $planta == 1){
        $entrada = '20:00:00';

    }if($turno == 2 AND $planta == 2){
        $entrada = '19:30:00';

    }
    

    return $entrada;
}



?>