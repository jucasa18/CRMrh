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

           

            $entrada = $lisHoras[$i]['Entrada'];
            $salida = $lisHoras[$i]['Salida'];
           if($entrada == '00:00:00'){
                $entrada =  buscaomicionChecadaE($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha']);
                echo "entrada omicion". $entrada ."<br/>";
            }
            if($salida == '00:00:00'){
                $salida =  buscaomicionChecadaS($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha']);
                echo "salida omicion". $salida ."<br/>";
            }

            /* echo $entrada.' - '.$salida;
                echo '</br>';*/
            
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
            $hrnor = 0;
            $hrext = 0;
            for($k=0;$k<count($horas_arr);$k++) {
            
                $entrada = $horas_arr[$k]['entrada'];
                $salida = $horas_arr[$k]['salida'];
                $fechaE = $horas_arr[$k]['fechaE'];
                $fechaS = $horas_arr[$k]['fechaS'];
                $turno = $horas_arr[$k]['turno'];  
                $pl = $horas_arr[$k]['pl'];
               // echo $entrada."-".$salida."</br>";
               
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
                   // $ts2 = strtotime($fechaE.' '.$salida);
                /* echo $turno;
                    echo '</br>';*/
                 /*   if($turno != 1){
                        $diff = ($ts2 - $ts1) / 3600;
                    }else{
                    $diff = ($ts1 - $ts2) / 3600;
                    }*/

                    
                    if($turno == 2 ){
                     //   echo 'entro 1';
                      //  echo $ts1 .'-'.$ts2;
                     
                        $ts2 = strtotime($fechaS.' '.$salida);
                      
                     
                     
                    }else{
                        $ts2 = strtotime($fechaE.' '.$salida);
                       // $diff = ($ts2 - $ts1) / 3600;
                    }
                    
                    $diff = (intval($ts2) - ceil($ts1)) / 3600;

                    
                   // echo $diff;
                                       
                    if($diff < 0 ){
                        $diff = 0;
                    }

                     //aqui hay que poner la funcion de buscar horas extras, sino esta el formato, no se pagan
                     if($diff >= 12){ //checar
                        $diff = 12;
                        if($turno == 1){
                        
                            $ree = $ree + turno1E($fechaE,$pl, $entrada);
                            $res = $res + turno1S($fechaE,$pl, $salida);
                           // echo $ree.'retardo entrada';
                       }elseif($turno == 2){
                            $ree = $ree + turno2E($fechaE,$pl, $entrada);
                            $res = $res  +turno2S($fechaE,$pl, $salida);
                           // echo $ree.'retardo salida';
                       }
                       
                    }else{
                        
                          /*  $retardo2 = Empleados::BuscaRetardos($idEmpleado, $fechaE);
                            if($retardo2 = ''){
                          
                            //$diff = intval($diff);//checar
                            $diff = horaEntrada($pl, $turno,$entrada, $salida, $fechaE, $fechaS);
                            echo  $diff;
                        
                            }else{
                                function buscaRetardos($idEmpleado, $fecha,$pl,$tur){
                                $diff = horaEntrada($pl, $turno,$entrada, $salida, $fechaE, $fechaS);
                                echo  $diff;
                            }*/
                            //echo "retardos:".$retardos."</br>"; 
                            if($diff <= 23){
                                $fechaS2 = $fechaS;
                            }else{
                                $fechaS2 = $fechaE;
                            }
                           
                            
                    }
                    //$mh = 0;
                  /*  $mh = buscaMediasHoras($fechaE,$pl);
                    $mht = $mht + $mh;*/
                    $mh = $mh+ buscaMediasHoras($fechaE,$pl, $salida);
                    
                    list($horasn, $horasex) = cuentaHorasNor(intval($diff),$turno);       
                    $hrnor = $hrnor +$horasn;
                    $hrext = $hrext +$horasex;
  
                 
                    
                   /* echo $entrada.' - '.$salida.' - '.$fechaS .' - '. intval($diff);
                    echo '</br>';
                    echo $horasxR;
                    echo '</br>';*/
                    $horasxR = intval($horasxR) + intval($diff);
                   // $horasxR =  $horasxR + $mh;
                  // $mh = $mh + $mh;
                

                }
               
                
                //$horasxR = $horasxR + intval($diff);
              
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
        
                  //  $mh = buscaMediasHoras($fechaE,$pl);
                  

                    $horasxR = ($horasxR - $ree - $res) + $mh;
                    $hrnor =  $hrnor + $mh;
                    
                 


                 // return $horasxR;

                 return [$horasxR, $diaf, $turno, $ree, $hrnor, $hrext];
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

 function FormatoNoi($fechaInicio, $fechaFin, $iddrenc, $idcorto, $sueldo, $hd, $ht, $recomendaciones, $diafestivo, $primavac, $bsenlrge, $bonoxarea, $bonopuntualidad, $bonoasistencia, $bonoanti, $bonoapoyo, $bonodiario, $pd, $gratificaciones,$fondodeahorro, $penalim,$cuotas,$fonacot,$infonavit,$tipoNomina){
      if($sueldo != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '1',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $sueldo, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($hd != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '3',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $hd, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($ht != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '5',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $ht, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($recomendaciones != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '32',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $recomendaciones, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($diafestivo != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '29',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $diafestivo, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($primavac != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '10',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $primavac, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($bsenlrge != ''){
        // $noi_arr[] = array("id" => $infoRec['IdDRENC'],"pd" => 'P',"npd" => '28',"nc" => '0',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $fh); 
         $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '35',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bsenlrge, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
      }
      if($bonoxarea != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '34',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bonoxarea, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($bonopuntualidad != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '15',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bonopuntualidad, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($bonoasistencia != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '38',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bonoasistencia, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($bonoanti != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'p',"npd" => '36',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bonoanti, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($bonoapoyo != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'p',"npd" => '33',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bonoapoyo, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }

     if($bonodiario != ''){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '31',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $bonodiario, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '6',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $infonavit, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($pd != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '19',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $pd, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($gratificaciones != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '38',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $gratificaciones, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($fondodeahorro != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'P',"npd" => '6',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $fondodeahorro, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '12',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $fondodeahorro, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '5',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $fondodeahorro, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($penalim != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '10',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $penalim, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($cuotas != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '15',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $cuotas, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($fonacot != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '93',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $fonacot, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($infonavit != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '94',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $infonavit, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
     }
     if($infonavit != 0){
        $noi_arr[] = array("id" => $idcorto,"pd" => 'D',"npd" => '94',"nc" => '0',"aplicadestajo" => 'N',"aplicacion" => '4', "fi" => $fechaInicio , "ff" => $fechaFin, "monto" => $infonavit, "iddrenc" => $iddrenc, "tipoNomina" => $tipoNomina); 
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

function calculaTiempo($fechaIngreso,$fechaFin){   
    $datetime1 = date_create($fechaFin);
    $datetime2 = date_create($fechaIngreso);
    $contador = date_diff($datetime1, $datetime2);
    $anios = $contador->format('%y');
    $meses = ( $contador->y * 12 ) + $contador->m;
    $dias = $contador->format('%a');
    /*echo $anios;
    echo '</br>';
    echo $meses;
    echo '</br>';
    echo $dias;*/
    return [$anios, $meses];
}
function calculaSalarioxCategoria($area,$puesto,$fechaIngreso,$fechaFin){    
    list($anios, $meses) = calculaTiempo($fechaIngreso,$fechaFin);
    if($meses < 3){
        if(($area == 2 OR $area == 14 OR  $area == 12 OR $area == 25 ) AND $puesto == 5){ //entra si el empleado es hombre garantia de las areas de venta y calidad de las 2 plantas
            $salario = 253;
        }elseif($area == 2 OR $area == 14){
            $salario = 260;
        }else{    
            $salario = 253;
        }
    }elseif($meses > 3 AND  $anios < 1){
       if(($area == 2 OR $area == 14 OR  $area == 12 OR $area == 25 ) AND $puesto == 5){ //entra si el empleado es hombre garantia de las areas de venta y calidad de las 2 plantas
            $salario = 265;
        }elseif($area == 2 OR $area == 14){
            $salario = 263;
        }else{
            $salario = 255;
        }
    }elseif($anios == 1){
        if(($area == 2 OR $area == 14 OR  $area == 12 OR $area == 25 ) AND $puesto == 5){ //entra si el empleado es hombre garantia de las areas de venta y calidad de las 2 plantas
            $salario = 267;
        }elseif($area == 2 OR $area == 14){
            $salario = 265;
        }else{
            $salario = 258;
        }
    }elseif($anios == 2){
        if(($area == 2 OR $area == 14 OR  $area == 12 OR $area == 25 ) AND $puesto == 5){ //entra si el empleado es hombre garantia de las areas de venta y calidad de las 2 plantas
            $salario = 269;
        }elseif($area == 2 OR $area == 14){
            $salario = 267;
        }else{
            $salario = 258;
        }
    }elseif($anios == 3){
        if(($area == 2 OR $area == 14 OR  $area == 12 OR $area == 25 ) AND $puesto == 5){ //entra si el empleado es hombre garantia de las areas de venta y calidad de las 2 plantas
            $salario = 271;
        }elseif($area == 2 OR $area == 14){
            $salario = 269;
        }else{
            $salario = 262;
        }
    }elseif($anios == 4){
        if(($area == 2 OR $area == 14 OR  $area == 12 OR $area == 25 ) AND $puesto == 5){ //entra si el empleado es hombre garantia de las areas de venta y calidad de las 2 plantas
            $salario = 271;
        }elseif($area == 2 OR $area == 14){
            $salario = 269;
        }else{
            $salario = 266;
        }
    }elseif($anios >= 5){
        if(($area == 2 OR $area == 14 OR  $area == 12 OR $area == 25 ) AND $puesto == 5){ //entra si el empleado es hombre garantia de las areas de venta y calidad de las 2 plantas
            $salario = 271;
        }elseif($area == 2 OR $area == 14){
            $salario = 269;
        }else{  
            $salario = 270;
        }
    }
    
   return $salario;
}
function calculaSalarioxH($salarioxdia, $turno){   
   // echo $turno;
    if($turno == 1){
        $salarioxhora = $salarioxdia / 8;
    }elseif($turno == 2){
        $salarioxhora =  $salarioxdia / 7;
    }
    return round ($salarioxhora,2);
}
function calculaHeHdHt($horastotal,$turno){  //función para calcular las horas horasdobles y triples $horastotal = horaextras
    $hrs = calculaHRNrm($turno);       
   // $sumtiex = $horastotal - $hrs;
    if($horastotal > 9){
        $hrd = 9;
        $hrt = $horastotal - 9;
    }else{
        $hrd = $horastotal;
        $hrt = 0;
    }
           return [$hrd, $hrt];
}

function calculaHRNrm($turno){  //función para calcular las horas normales
    if($turno == 1){
       $hrs = 9.6;
    }elseif($turno == 2){
        $hrs = 8.4;
    } 
  //  $hrNorm = $hrs * $dt;

    return $hrs;
}      
/*function calculaHRNrm($turno, $dt){  //función para calcular las horas normales
    if($turno == 1){
       $hrs = 9.6;
    }elseif($turno == 2){
        $hrs = 8.4;
    } 
    $hrNorm = $hrs * $dt;

    return $hrNorm;
} */
function calculaSueldo($sbd, $turno, $hn){  //función para calcular el salario
    if($turno == 1){
      $sueldo = ($sbd / 8) * $hn;        
    }elseif($turno == 2){
        $sueldo = ($sbd / 7) * $hn;     
    }        
    return $sueldo;
}  
function calculaSeptimidia($hn,$vac,$turno){  //función para calcular el 7dia
   // $descansos = calculaDescansos($dt, $vac, $faltas);
   /* echo  $descansos;
    echo '</BR>';*/
    if($turno == 1){
        //$septimodia = ($salarioxdia / 8) * ($dt + $vac + $descansos); 
        $septimodia = 8 / 48 * ($hn + ($vac) * 8); 
    }elseif($turno == 2){
        //$septimodia = ($salarioxdia / 7) * ($dt + $vac + $descansos);   
        $septimodia = 7 / 42 * ($hn + ($vac) * 7); 
    }else{
        $septimodia = 0; 
    }

    
    
    return $septimodia;
}  

function calculaDescansos($dt, $vac, $faltas){  //función para calcular el salario
    $descansos = 0;
    $aver = $dt + $vac;
    If($aver == 5){
        $descansos = 2;
    }elseif($aver < 5 ){
        $descansos = 7 - ($aver + $faltas);
    }
    return $descansos;
}  

function bonoxArea($area, $linea){  //función para calcular el salario
    if($area == 10 OR $linea == 12 OR $linea == 25){
        $bonoxrea = 200;
    }elseif($area == 11){
        $bonoxrea = 500;
    }else{
        $bonoxrea = 0;
    }
        return $bonoxrea;
} 

function CuentaRetardos($id, $fecha1,$fecha2, $turno,$pl){  //función para contar los retardos
    if($turno == 1 AND $pl == 1){
       $entrada = '08:00:00';             
     }elseif($turno == 1 AND $pl == 2){
       $entrada = '07:30:00';
     }elseif($turno == 2 AND $pl == 1){
       $entrada = '20:00:00';
     }elseif($turno == 2 AND $pl == 2){
       $entrada = '19:30:00';
     } else{
        $entrada = 0;
     }  
     $retardos = Empleados :: cuentaRetar2s($id, $fecha1,$fecha2, $turno, $entrada);  
     if(is_array($retardos)){       
                $retardo = $retardos['retardos'];         
    }   
     return $retardo;
}
function cuentaPermososnvbp($id){  //función para contar los retardos 
    $permisos = Empleados :: cuentaPermisosNV($id);  
    if(is_array($permisos)){       
                $permiso = $permisos['permisos'];         
    }  
    return $permiso;
}
function bonoPuntualidad($retardos, $faltas, $permisosnv){  //función para contar los retardos 
    if($retardos == 0 AND $faltas == 0 AND $permisosnv == 0){
        $bonopuntualidad = 125;
    }else{
        $bonopuntualidad = 0;
    }
    return $bonopuntualidad;
}
function bonoApoyo($turno, $retardos, $dt, $area,$primerdia){  
    if($turno == 1){
        $horastur = 48;        
      }elseif($turno == 2){
        $horastur = 42;      
      }  
     if($retardos == 0 ){
       /* if($horas >= $horastur){
            $bonoapoyo = 200;
        }*/
        if($area == 9 AND $dt >=4){
            $bonoapoyo = 200;
        }elseif($primerdia != 8){
            $bonoapoyo = 200;
        }elseif($dt == 5){
            $bonoapoyo = 200;
        }
    }else{
        $bonoapoyo = 0;
    }
    return $bonoapoyo;
}
function bonoDiario($dias){  
    $bonodiario = $dias * 22;
    return $bonodiario;
}
function fondoAhorro($sueldo, $septimodia){  //función para calcular el fondo de ahorro
    $fondoahorro = ($sueldo + $septimodia) * 0.06;
    return $fondoahorro;
}
function sumaHorasVacaciones($diasvacaciones, $turno){  //función para sumar loas horas de las vacaciones, depende del turno
    if($turno == 1){
        $horasVacaciones = $diasvacaciones * 9.6;
    }elseif($turno == 2){
        $horasVacaciones = $diasvacaciones * 8.4;
    }else{
        $horasVacaciones = 0;
    }
    return $horasVacaciones;
}
function calculaPv($diasvacaciones, $sd){  //función para cálcular la prima vacacional
  $primavac = ($diasvacaciones * 0.25) * $sd;
    return $primavac;
}
function bonoSemanaLarga($retardos, $dtraba){  //función para calcular el bono de semana larga
    if($retardos == 0 AND $dtraba == 7){
        $bslarg = 300;
    }else{
        $bslarg = 0;
    }
    return $bslarg;
}
function buscaBonoAnti($fecha1, $fecha2, $fechaIngreso){  //función para buscar y calcular el bono de Antigüedad, fecha 2 es el dia final de la semana
    $bono = Empleados :: BuscaBonoAntiguedad($fecha1,$fecha2 );  
    if(is_array($bono)){       
                $bonoan = $bono['bonoanti'];         
    }  
    list($anios, $meses) = calculaTiempo($fechaIngreso,$fecha2);
    if($bonoan == 1){
        if($anios >= 1 And $anios <= 3 ){
            $bonoanti = 100;
        }elseif($anios >= 4){
            $bonoanti = 200;
        }
    }else{
        $bonoanti = 0;
    }
    return $bonoanti;
}
function cuotasindical($incapacides){  //función para calcular el bono de semana larga
    $cuotas = 60;
    if($incapacides > 0 ){
        $inc = $incapacides * 10;
        $cuotas = 60 - $inc ;
    }elseif($cuotas < 0 ){
        $cuotas = 0;
    }
    return $cuotas;
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
function sacaHorasxTurno($turno){  //función para sacar las horas por turno
    if($turno == 1){
        $horasturno = 9.6;
    }elseif($turno == 2){
        $horasturno = 8.4;
    }else{
        $horasturno = 0;
    }
    return $horasturno;
}
function sacaHorasComplemento($complemento, $turno){  //función para sacar las horas por turno
    if($complemento == 'SI'){
        $comple = sacaHorasxTurno($turno);
    }else {
        $comple = 0;
    }
    
    return $comple;
}
function cuentaHorasNor($horas,$turno){  //función para contar las horas normales y las horas extras., checar para hacer la otra funcion para envez de ser 9.6 sea 12, para el caso de la semana 23. CHECAR.
    $hrxtur = sacaHorasxTurno($turno);
    $hn = 0;
    $he = 0;
    if($horas == 12){
       $hn = $hrxtur;
       $he = $horas - $hrxtur;
    }elseif($horas < 12 And $horas > $hrxtur){
        $hn = $hrxtur;
        $he = $horas - $hrxtur;
    }elseif($horas < 12 And $horas < $hrxtur){
        $hn = $horas;
        $he = 0;
    }elseif($horas > 12){
        $hn = $hrxtur;
        $he = $horas - $hrxtur;;
    }
    
    return [$hn, $he];
}
function cuentaJornadaSemanal($turno){ //Cuenta las horas de la jornada semanal.
    if($turno == 1){
        $js = 48;
    }elseif($turno == 2){
        $js = 42;
    }
    
   return $js;
}
/*
function cuentaHorasxSemana($horasnorm, $horasex, $turno){
    $js = cuentaJornadaSemanal($turno);
    $ht = $horasnorm + $horasex;
    if($horasnorm >= $js){
        $hn = $js;
        $shn = $horasnorm - $js;
    }elseif($horasnorm < $js){
        $hn = $horasnorm;
        $shn = 0;
    }
    $he = $horasex + $shn;
    return [$ht, $hn, $he];

}*/
function cuentaHorasxSemana($horasnorm, $horasex, $turno){
    $js = cuentaJornadaSemanal($turno);
    $ht = $horasnorm + $horasex;
    if($horasnorm >= $js){
        $hn = $js;
        $shn = $horasnorm - $js;
    }elseif($horasnorm < $js){
        $hn = $horasnorm;
        $shn = 0;
    }
    $he = $horasex + $shn;

    list($hrd,$hrt) = calculaHeHdHt($he,$turno);

    return [$ht, $hn, $he,$hrd, $hrt];

}
  


?>