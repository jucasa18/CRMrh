<?php
/*include_once '../ins/PreNomina_principal.php'; 
include_once '../ins/FNoi_principal.php'; */
include 'acciones/ins/PreNomina_principal.php'; 
include 'acciones/ins/FNoi_principal.php'; 
include 'acciones/ins/Recomendaciones_principal.php'; 
include('auth_session.php');


function guardaPN($IdDRENC, $NumQuincena, $FechaInicio, $FechaFin, $dt, $v, $f, $p, $i, $h, $bqna, $ba, $dn, $td, $vac, $pv, $desp, $fh, $pd, $df, $he, $g, $d, $tp, $tpd, $salDiario, $IdUsuario, $tipoNomina){
	$empleado = new PreNomina_principal();
	$empleado->IdDRENC 			    = $IdDRENC;
	$empleado->TipoNomina 			= $tipoNomina;
	$empleado->NumQuincena 			= $NumQuincena;
	$empleado->FechaInicio 	 	  	= date('Y-m-d',strtotime($FechaInicio));
	$empleado->FechaFin   			= date('Y-m-d',strtotime($FechaFin));
	$empleado->dt   				= $dt;
	$empleado->v    		 		= $v;
	$empleado->f 					= $f;
	$empleado->p  					= $p;
	$empleado->i 					= $i;
	$empleado->h 					= $h;
	$empleado->bqna					= $bqna;
	$empleado->ba 					= $ba;
	$empleado->dn					= $dn;
	$empleado->td   				= $td;
	$empleado->vac   				= $vac;
	$empleado->pv    			 	= $pv;
	$empleado->desp				 	= $desp;
	$empleado->fh  					= $fh;
	$empleado->pd 					= $pd;
	$empleado->df 					= $df;
	$empleado->he   				= $he;
	$empleado->g 					= $g;
	$empleado->d 					= $d;
	$empleado->tp					= $tp;
	$empleado->tpd 					= $tpd;
	$empleado->salDiario			= $salDiario;
	$empleado->IdUsuario   			= $IdUsuario;
	//$empleado->FechaCreacion  	 	= $FechaCreacion;
	$guradra	= $empleado->save();
	if ($guradra) { 
		return true;

	}
}

function guardaNoi($IdDRENC, $NumQuincena, $IdCorto, $pd, $npd, $nc, $AplicaDestajo, $Aplicación, $fi, $ff, $Monto, $tipoNomina){
	$empleado = new FNoi_principal();
	$empleado->TipoNomina 			= $tipoNomina;
	$empleado->IdDRENC 			    = $IdDRENC;
	$empleado->NumQuincena 			= $NumQuincena;
	$empleado->IdCorto 	 	  		= $IdCorto;
	$empleado->pd   				= $pd;
	$empleado->npd   				= $npd;
	$empleado->nc    		 		= $nc;
	$empleado->AplicaDestajo 		= $AplicaDestajo;
	$empleado->Aplicación  			= $Aplicación;
	$empleado->fi 					= $fi;
	$empleado->ff 					= $ff;
	$empleado->Monto				= $Monto;
	//$empleado->FechaCreacion		= $FechaCreacion;
	$empleado->IdUsuario			= $_SESSION['id'];
	$guradra	= $empleado->save();
	if ($guradra) { 
		return true;

	}
}

function pagoRecomendacion($IdRecomendacion){
	$empleado = new Recomendaciones_principal();
	$empleado->Pagado 			= 1;
	$empleado->id 			= $IdRecomendacion;
	$guradra	= $empleado->pagaRecomendaciones();
	if ($guradra) { 
		return true;

	}

}

function guardaPNS($IdDRENC, $NumQuincena, $FechaInicio, $FechaFin, $dt, $f, $p, $i, $h, $vac, $pv, $fh, $pd, $df, $d, $tp, $tpd, $salDiario, $IdUsuario, $tipoNomina, $Retardos, $Hdobles, $Htriples, $Septimodia, $BonoxArea, $BonoPuntualidad, $BonoApoyo, $BonoDiario, $CuotaS, $BsenLrge, $BonoASnti){
	$empleado = new PreNomina_principal();
	$empleado->IdDRENC 			    = $IdDRENC;
	$empleado->TipoNomina 			= $tipoNomina;
	$empleado->NumQuincena 			= $NumQuincena;
	$empleado->FechaInicio 	 	  	= date('Y-m-d',strtotime($FechaInicio));
	$empleado->FechaFin   			= date('Y-m-d',strtotime($FechaFin));
	$empleado->dt   				= $dt;
	$empleado->f 					= $f;
	$empleado->p  					= $p;
	$empleado->i 					= $i;
	$empleado->h 					= $h;
	$empleado->vac   				= $vac;
	$empleado->pv    			 	= $pv;
	$empleado->fh  					= $fh;
	$empleado->pd 					= $pd;
	$empleado->df 					= $df;
	$empleado->d 					= $d;
	$empleado->tp					= $tp;
	$empleado->tpd 					= $tpd;
	$empleado->Retardos 			= $Retardos;
	$empleado->Hdobles 				= $Hdobles;
	$empleado->Htriples 			= $Htriples;
	$empleado->Septimodia 			= $Septimodia;
	$empleado->BonoxArea 			= $BonoxArea;
	$empleado->BonoPuntualidad 		= $BonoPuntualidad;
	$empleado->BonoApoyo 			= $BonoApoyo;
	$empleado->BonoDiario 			= $BonoDiario;
	$empleado->CuotaS 				= $CuotaS;
	$empleado->BsenLrge 			= $BsenLrge;
	$empleado->BonoASnti 			= $BonoASnti;
	$empleado->salDiario			= $salDiario;
	$empleado->IdUsuario   			= $IdUsuario;
	//$empleado->FechaCreacion  	 	= $FechaCreacion;
	
	$guradra	= $empleado->save();
	if ($guradra) { 
		return true;

	}
}

function quitaNquincenal($IdDRENC){
	$empleado = new Recomendaciones_principal();
	$empleado->IdRecomendador 			= 0;
	$empleado->id 			= $IdDRENC;
	$guradra	= $empleado->quitarNquincenal();
	if ($guradra) { 
		return true;

	}

}





 ?>