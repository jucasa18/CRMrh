<?php
//trabajando
/*function NominaQuincenal($fechaInicio, $fechaFin){
    $lisEmplAct  = Empleados::listaQuincenales($fechaInicio, $fechaFin);
}*/

include '../ins/Empleados.php'; 
function vacacionesxR($idEmpleado, $fechaInicio, $fechaFin){
   $lisVacaciones = Empleados::DiasVacaciones($idEmpleado, $fechaInicio, $fechaFin);
        $fiq = $lisVacaciones['FechaInicio'];
        $ffq = $lisVacaciones['FechaFin'];
        if($fiq < $fechaInicio){
            $fiq = $fechaInicio;
         }elseif($ffq > $fechaFin ){
            $ffq = $fechaFin;
         }
        
        $lisVacacionest = Empleados::DiasVacaciones2($idEmpleado, $fiq , $ffq);
        return $lisVacacionest['diasVacaciones'];
}

function ValTurnosPNQ($idEmpleado, $fechaInicio, $fechaFin){
    $ht2 = 0;
    $ht1 = 0;
    $lisHoras = Empleados::EntradasSalidas($idEmpleado, $fechaInicio, $fechaFin);
    $j=0;
    $diaf = 0;
if(count($lisHoras) > 0){



            for($i=0;$i<count($lisHoras);$i++) {
        // foreach ($lisHoras as $a_ => $infoRec) {
            

//poner la funion de buscar retardo por ruta
if($lisHoras[$i]['Entrada'] != '00:00:00'){
        //echo 'fecha antes'.$lisHoras[$i]['Fecha'];
        $diafestivo = buscaDiaFestivo($lisHoras[$i]['Fecha']);
        //echo $diafestivo;
     
        $diaf = $diaf + intval($diafestivo);
} 




               /* $retardos = buscaRetardos($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha']);
                if($retardos <> ''){
                    $entrada = $retardos;
                }else {
                    $entrada = $lisHoras[$i]['Entrada'];
                }*/
              
                $entrada = $lisHoras[$i]['Entrada'];
                $salida = $lisHoras[$i]['Salida'];

                
           /* echo $entrada.' retardo - ';
                echo '</br>';*/
               // echo $lisHoras[$i]['Fecha']. '<br>';
               if(($entrada >= '07:00' AND $entrada <= '09:00' AND $entrada != '00:00:00' ) OR  ($salida >= '18:00' AND $salida <= '21:00' AND $entrada != '00:00:00')){ //se cambio
                        //si se cumple la condicion el turno es 1  08:00 a 20:00 hrs
                        $retardos = buscaRetardos($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha'],$lisHoras[$i]['pl'],1);//RETARDOS RUTA
                        if($retardos <> ''){
                            $entrada = $retardos;
                        }else {
                            $entrada = $lisHoras[$i]['Entrada'];
                        }
                        $horas_arr[] = array("turno" => 1,"fechaE" => $lisHoras[$i]['Fecha'],"fechaS" => $lisHoras[$i]['Fecha'],"entrada" => $entrada, "salida" => $lisHoras[$i]['Salida'], "pl" => $lisHoras[$i]['pl']);
                       // echo $lisHoras[$i]['Fecha'] .'<br>';
                       
                      
//SECANBIO POR OR CHECAR
                    } elseif(($entrada >= '19:00' AND $entrada <= '21:00' ) OR  ($salida >= '07:00' AND $salida <= '09:00' ) ){ //se cambio

                                $retardos = buscaRetardos($lisHoras[$i]['idEmpleado'], $lisHoras[$i]['Fecha'],$lisHoras[$i]['pl'],2);
                                if($retardos <> ''){
                                    $entrada = $retardos;
                                }else {
                                    $entrada = $lisHoras[$i]['Entrada'];
                                }
                             if($lisHoras[$i]['Entrada'] != ''){
                                     $horas_arr[] = array("turno" => 2, "fechaE" => $lisHoras[$i]['Fecha'],"fechaS" => $lisHoras[$i]['fechas2'],"entrada" => $entrada , "salida" => $lisHoras[$i]['Salida2'], "pl" => $lisHoras[$i]['pl'] );
                                     //echo $lisHoras[$i]['Fecha'];
                                    
                             }
                        // }
 
                      //echo $entrada.' - '.$salida;
                     }
                  //   $j++;

            }      
         


          //  echo '<br><br>';
           // echo $lisHoras[0]['Fecha']. '<br>';
            $horasxR = 0; 
            $retardo = 0;
            $ree  = 0;
            $res  = 0;
            for($k=0;$k<count($horas_arr);$k++) {              
                $entrada = $horas_arr[$k]['entrada'];
                $salida = $horas_arr[$k]['salida'];
                $fechaE = $horas_arr[$k]['fechaE'];
                $fechaS = $horas_arr[$k]['fechaS'];
                $turno = $horas_arr[$k]['turno'];
                $pl = $horas_arr[$k]['pl'];
                if($entrada != ''  OR $salida != ''){
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
                    $ts2 = strtotime($fechaS.' '.$salida);
                /* echo $turno;
                    echo '</br>';*/
                /*    if($turno != 1){
                        $diff = (intval($ts2) - intval($ts1)) / 3600;
                    }else{
                    $diff = (intval($ts1) - intval($ts2)) / 3600;
                    }*/

                  /*  if($entrada > '08:00:00'){
                         $e = strtotime($fechaE.'  '. '08:00:00');
                         $r = strtotime($fechaE.' '.$entrada);
                         $retardo = $e - $r / 3600;
                         echo  $e.'  '. $r.'  '.$retardo;
                         echo '</br>';

                    
                    }*/


                 //   $horasxR =  intval($horasxR);
               

                    $diff = (intval($ts2) - intval($ts1)) / 3600;
                    if($diff < 0 ){
                        $diff = 0;
                    }
                    
                        //aqui hay que poner la funcion de buscar horas extras, sino esta el formato, no se pagan
                        if($diff >12){
                            $diff = 12;
                            if($turno == 1){ // RETARDOS NORMALES- SE DESCUENTAN LAS HORAS
                        
                                $ree = $ree + turno1E($fechaE,$pl, $entrada);
                                $res = $res + turno1S($fechaE,$pl, $salida);
                                echo $ree.'retardo entrada';
                           }elseif($turno == 2){
                                $ree = $ree + turno2E($fechaE,$pl, $entrada);
                                $res = $res  +turno2S($fechaE,$pl, $salida);
                                echo $ree.'retardo salida';
                           }
                            
                                                   
                        }else{
                                $diff = $diff;
                               
                               
                        }
                       
                     
                       

                    echo $ree.'--'.$res;

                    echo $entrada.' - '.$salida.' - '.$fechaS .' - >'. intval($diff);
                    echo '</br>';
                    echo $horasxR.' / '. intval($diff);
                    echo '</br>';
                   // echo $retardo;
                    echo '</br>';


                }
                $horasxR = intval($horasxR) + intval($diff);
               // $horasxR = $horasxR - $ree - $res;

               if($horasxR < 0 ){
                $horasxR = 0;
            }

            /*  if($ree < 0 ){
                    $horasxR = 0;
                }*/

              
                
            }
            //print_r($horas_arr);

          
          //  $horasxR = $horasxR - $ree - $res;

           /* if ($horasxR == 11){*/
          /*  if ($ree == 1) {
                $horasxR = $horasxR - $ree - $res;
            }*/
            $horasxR = $horasxR - $ree - $res;
         
          echo $diaf;
        echo $horasxR;
                    echo '</br>';

               //    return intval($horasxR);
        }
}



function cuentaFaltas($idEmpleado, $fechaInicio, $fechaFin){
    $lisFaltas = Empleados::Faltas($idEmpleado, $fechaInicio, $fechaFin);
    return $lisFaltas['faltas'];
 
}
//busca si hay retardos por ruta y cambia la hora de entrada a la normal, 08:00:00 o 20:00:00 sea el caso o la del segundo turno
function buscaRetardos($idEmpleado, $fecha,$pl,$tur){
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
        if($retardo['Salida'] >= '20:00:00'){
            $entrada = $hr;
        }
        
        
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
           // $contingencia = buscaContingenciasE($enpl1,$fecha);
            $he = strtotime($fecha.' '.$entrada);
            $en = strtotime($fecha.' '.$enpl1);
            $retardo = (intval($he) - intval($en)) / 3600;
           // echo $retardo ;
        }
    }elseif($pl == 2){
        if($entrada > $enpl2){
            $he = strtotime($fecha.' '.$entrada);
            $en = strtotime($fecha.' '.$enpl2);
            $retardo = (intval($he) - intval($en)) / 3600;
           // echo $retardo ;
        }
     }
    // echo ceil($retardo);
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
            echo $retardo;
        }
    }elseif($pl == 2){
        if($entrada > $enpl2){
            $he = strtotime($fecha.' '.$entrada);
            $en = strtotime($fecha.' '.$enpl2);
            $retardo = (intval($he) - intval($en)) / 3600;
            echo $retardo;
        }
    
    }
    echo ceil($retardo);
 return ceil($retardo);
}

 function turno1S($fecha,$pl, $salida){
    $sapl1= '20:00:00';
    $sapl2= '19:30:00';
    $retardos =0;
        if($pl == 1){
            if($salida < $sapl1){
                
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
    echo ceil($retardos);
 return ceil($retardos);
}
 function turno2S($fecha,$pl, $salida){
    $sapl1= '08:00:00';
    $sapl2= '07:30:00';
    $retardos =0;
    
    if($pl == 1){
        if($salida < $sapl1){
         
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

 function quincenas(){  
    $number = cal_days_in_month(CAL_GREGORIAN, 8, 2003); // 31
    echo "There were {$number} days in August 2003";
}
/*
$prueba = ValTurnosPNQ(110000196, '2023-09-16', '2023-09-30');
echo $prueba;*/

$dias = quincenas();
echo $dias;


//vieeeeeejooooooooooooooo

 /*

 $prueba = turno2S('2023-11-01',2,'07:03:00');
 echo $prueba;*/
/*
 $prueba = buscaContingenciasE('2023-07-06',2);
 echo $prueba;*/

 
 /*$prueba = turno1E('2023-07-11',1, '08:05:00');
 echo $prueba;*/

 /*$prueba = buscaDiaFestivo('2023-09-16', '2023-09-30');
 echo $prueba;*/

 //ValTurnosPNQ(110020895, '2023-09-16', '2023-09-30') 



 /*$retardos = buscaRetardos(110020127, '2023-07-03');
 echo $retardos;*/


/*$pruebahoras = cuentaFaltas(210000050, '2023-07-01', '2023-09-15');
echo  $pruebahoras;

/*
$pruebahoras = ValTurnosPNQ(210000050, '2023-07-01', '2023-09-15');
echo  $pruebahoras;*/



?>