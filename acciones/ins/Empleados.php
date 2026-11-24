<?php
require_once 'Empleados_principal.php';

class Empleados extends Empleados_principal{
		
	//inicializa un objeto Usuario
	public function __construct(){   
		parent::__construct();
	}
	

	public static function listaEmpleadosActivos(){
		$_Modul   = new Empleados();
		$query  = sprintf('SELECT * FROM empleados WHERE Estatus=1');
		$result = $_Modul->_db->query($query);
		$return =[];
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
                $return []= $row;
            }
			mysqli_free_result($result);
		}

		$_Modul->desconectar();
		return $return;
	}

	public static function listaEmpleadosInactivos(){
		$_Modul   = new Empleados();
		$query  = sprintf('SELECT * FROM empleados WHERE Estatus=0');
		$result = $_Modul->_db->query($query);
		$return =[];
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
                $return []= $row;
            }
			mysqli_free_result($result);
		}

		$_Modul->desconectar();
		return $return;
	}

	public static function listaEmpleadobyId($idEmpleado){
		$_Modul   = new Empleados();
		$query  = sprintf('SELECT *, (SELECT Nombre FROM areas WHERE Id= Depto) AS departamento, (SELECT Nombre FROM lineas WHERE Id = Linea) AS linea, (SELECT Nombre FROM agencias WHERE Id = Empresa) AS agencia,
			(CASE
				WHEN Nomina = 1 THEN "Quincenal"
				WHEN Nomina = 2 THEN "Semanal"
				ELSE "Coreana"
			END ) AS Nom
		 FROM empleados WHERE IdDRENC =%d',
			$idEmpleado );
			echo $query;
			$result = $_Modul->_db->query($query);
			$return =0;
			if ($result->num_rows){
				while( $row = $result->fetch_assoc() ){
					$return = $row;
				}
				mysqli_free_result($result);
			}
			
			$_Modul->desconectar();
			return $return;
		}

		public static function listaRutas(){
			$_Modul   = new Empleados();
			$query  = sprintf('SELECT * FROM rutas');
				//echo $query;
				
				$result = $_Modul->_db->query($query);
				$return =0;
				if ($result->num_rows){
					while( $row = $result->fetch_assoc() ){
						$return = $row;
					}
					mysqli_free_result($result);
				}
				
				$_Modul->desconectar();
				return $return;
			}

		public static function listaRutabyId($idRuta){
			$_Modul   = new Empleados();
			$query  = sprintf('SELECT * FROM rutas WHERE  id = %d',    
				$idRuta );
				//echo $query;
				$result = $_Modul->_db->query($query);
				$return =0;
				if ($result->num_rows){
					while( $row = $result->fetch_assoc() ){
						$return = $row;
					}
					mysqli_free_result($result);
				}
				
				$_Modul->desconectar();
				return $return;
			}

			
		public static function listaParadabyId($idParada){
			$_Modul   = new Empleados();
			$query  = sprintf('SELECT * FROM paradas WHERE  id = %d',    
				$idParada );
				//echo $query;
				$result = $_Modul->_db->query($query);
				$return =0;
				if ($result->num_rows){
					while( $row = $result->fetch_assoc() ){
						$return = $row;
					}
					mysqli_free_result($result);
				}
				
				$_Modul->desconectar();
				return $return;
			}
			
					// se usa en el archivo de la prenomina, como prueba, se debe de poner el rango de fechas de la nomina que se desea calcular, trabajar sobre el query
				public static function listaEmpleadosActivosPN(){
					$_Modul   = new Empleados();
				//	$query  = sprintf('SELECT *, (SueldoDiario/8) as sxh FROM empleados WHERE Estatus=1');
					//$query  = sprintf('SELECT * FROM empleados WHERE Estatus=1');
					$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) FROM es WHERE es.idEmpleado =  IdDRENC  AND Fecha BETWEEN "2023-09-16" AND "2023-09-30") AS dias FROM empleados WHERE Estatus=1 AND Nomina = "Quincenal"');
					$result = $_Modul->_db->query($query);
					$return =[];
					if ($result->num_rows){
						while( $row = $result->fetch_assoc() ){
							$return []= $row;
						}
						mysqli_free_result($result);
					}
			
					$_Modul->desconectar();
					return $return;
				}

				public static function vacaciones2023($idEmpleado){
					$_Modul   = new Empleados();
					$query  = sprintf('SELECT ((12/365)* (DATEDIFF(NOW(),FechaIngreso)+1))  AS diasVacaciones FROM `empleados` WHERE IdDRENC= %d',
						$idEmpleado );
					//	echo $query;
						$result = $_Modul->_db->query($query);
						$return =0;
						if ($result->num_rows){
							while( $row = $result->fetch_assoc() ){
								$return = $row;
							}
							mysqli_free_result($result);
						}
						
						$_Modul->desconectar();
						return $return;
					}

					public static function añostrabajados23($idEmpleado){
						$_Modul   = new Empleados();
						$query  = sprintf('SELECT floor (TIMESTAMPDIFF(YEAR,FechaIngreso,CURDATE())) AS antiguedad  FROM empleados WHERE IdDRENC= %d',
							$idEmpleado );
							//echo $query;
							$result = $_Modul->_db->query($query);
							$return =0;
							if ($result->num_rows){
								while( $row = $result->fetch_assoc() ){
									$return = $row;
								}
								mysqli_free_result($result);
							}
							
							$_Modul->desconectar();
							return $return;
						}


						public static function añostrabajadosold($idEmpleado){
							$_Modul   = new Empleados();
							$query  = sprintf('SELECT floor (DATEDIFF("2022-12-31",FechaIngreso)/360)  AS antiguedadold FROM empleados WHERE IdDRENC = %d',
								$idEmpleado);
								//echo $query;
								$result = $_Modul->_db->query($query);
								$return =0;
								if ($result->num_rows){
									while( $row = $result->fetch_assoc() ){
										$return = $row;
									}
									mysqli_free_result($result);
								}
								
								$_Modul->desconectar();
								return $return;
							}

							public static function VacacionesbyId($idEmpleado){
								$_Modul   = new Empleados();
								$query  = sprintf('SELECT * FROM  vacaciones WHERE idEmpleado =%d AND TipoVacacion != 3',
									$idEmpleado );
									//echo $query;
									$result = $_Modul->_db->query($query);
									$return =0;
									if ($result->num_rows){
										while( $row = $result->fetch_assoc() ){
											$return = $row;
										}
										mysqli_free_result($result);
									}
									
									$_Modul->desconectar();
									return $return;
								}
							
								public static function empleadosAltaSuaxRango($fecha1,$fecha2){
									$_Modul   = new Empleados();
									$query  = sprintf('SELECT * FROM empleados WHERE  FechaIngreso BETWEEN "%s" AND "%s" AND Estatus = 1',
									 $fecha1,$fecha2);
										//echo $query;
										
										$result = $_Modul->_db->query($query);
										$return =[];
										if ($result->num_rows){
											while( $row = $result->fetch_assoc() ){
												$return []= $row;
											}
											mysqli_free_result($result);
										}
										
										$_Modul->desconectar();
										return $return;
									}

									public static function listaEmpleadosActivosRetardos($fecha){
										$_Modul   = new Empleados();
									/*	$query  = sprintf('SELECT e.IdDRENC, e.IdPlanta, e.Nombre, e.ApellidoP, e.ApellidoM ,es.Fecha, es.Hora, r.nombre, es.id, MIN(es.Hora) AS horaE  FROM empleados AS e INNER JOIN es ON (e.IdDRENC = es.idEmpleado) INNER JOIN rutas AS r ON (e.Ruta = r.id) WHERE e.Estatus=1 AND Retardo = 0 AND Operacion = "Entrada" AND  Hora > "8:01" AND Hora < "19:01" AND  es.Fecha = "%s" GROUP BY idEmpleado,Fecha',
										      $fecha);*/

										 $query  = sprintf('SELECT e.IdDRENC, e.IdPlanta, e.Nombre, e.ApellidoP, e.ApellidoM ,es.Fecha, es.Entrada, r.nombre, es.id, MIN(es.Entrada) AS horaE  FROM empleados AS e INNER JOIN es2 AS es ON (e.IdDRENC = es.idEmpleado) INNER JOIN rutas AS r ON (e.Ruta = r.id) WHERE e.Estatus=1 AND Retardo = 0  AND  (((es.Entrada > "08:00:00" AND IdPlanta = 1) OR (es.Entrada > "20:00:00" AND IdPlanta = 1)) OR ((es.Entrada > "07:30:00" AND IdPlanta = 2) OR (es.Entrada > "19:30:00" AND IdPlanta = 2))) AND Ruta != 47 AND es.Fecha = "%s" GROUP BY idEmpleado,Fecha',
										      $fecha);
											 // echo $query;
										$result = $_Modul->_db->query($query);
										$return =[];
										if ($result->num_rows){
											while( $row = $result->fetch_assoc() ){
												$return []= $row;
											}
											mysqli_free_result($result);
										}
								
										$_Modul->desconectar();
										return $return;
									}
								//aplica solo paa quincenales de pl1 con horario de 8 -20 hrs
									public static function listaQuincenales($fecha1,$fecha2){
										$_Modul   = new Empleados();
										/*$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND  Entrada != "00:00:00" ) AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9) AS horasExtras FROM empleados WHERE Estatus=1' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
										//	echo $query;*/
										//$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00") AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9) AS horasExtras FROM empleados WHERE Estatus=1 LIMIT 10;' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
										//Quitar el limit cuando termina de hacer las pruebas del repositorio 
										$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9 AND Estatus = 1) AS horasExtras, (SELECT SUM(TIMESTAMPDIFF(hour, CONCAT(FechaIncidencia," ",Hora), CONCAT(FechaIncidencia," ",HoraR))) AS Tiem  FROM incidencias WHERE TipoIncidencia = 4 AND idEmpleado = IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Regreso = "SI") AS Tiempo, (SELECT SUM(Cantidad) as can FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Estatus = 1 AND TipoIncidencia = 10) AS gratificaiones,  (SELECT Cantidad FROM deducciones WHERE Tipo =1 AND idEmpleado = IdDRENC AND Status = 1  LIMIT 1) AS infonavit, (SELECT Cantidad FROM deducciones WHERE Tipo =2 AND idEmpleado = IdDRENC AND Status = 1 LIMIT 1) AS fonacot, (SELECT Cantidad FROM deducciones WHERE Tipo =3 AND idEmpleado = IdDRENC AND Status = 1 LIMIT 1) AS pa, (SELECT COUNT(FechaIncidencia) AS diafestivo  FROM incidencias WHERE TipoIncidencia = 8 AND Estatus = 1 AND  FechaIncidencia BETWEEN "%s" AND "%s") AS diafestivoNT, (SELECT SUM(Cantidad) as hg FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 12 AND Estatus = 1) AS hombregarantiaH FROM empleados WHERE Estatus=1 AND Nomina	= 1; ' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
										//echo $query;
										$result = $_Modul->_db->query($query);
										$return =[];
										if ($result->num_rows){
											while( $row = $result->fetch_assoc() ){
												$return []= $row;
											}
											mysqli_free_result($result);
										}
								
										$_Modul->desconectar();
										return $return;
									}		
									
									// esta funcion calcula los dias trabajados (A = asistencia), se basaen las entradas o salidas cuenta las dos.
								/*	public static function diastrabajados($idEmpleado){
										$_Modul   = new Empleados();
										/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
											$idEmpleado );*
											$query  = sprintf('SELECT COUNT(DISTINCT Fecha) AS dias FROM es WHERE es.idEmpleado = %d  AND Fecha BETWEEN "2023-09-16" AND "2023-09-30"',    
											$idEmpleado );
											//echo $query;
											$result = $_Modul->_db->query($query);
											$return =0;
											if ($result->num_rows){
												while( $row = $result->fetch_assoc() ){
													$return = $row;
												}
												mysqli_free_result($result);
											}
											
											$_Modul->desconectar();
											return $return;
										}*/

									// esta funcion calcula los dias trabajados (A = asistencia), se basaen las entradas o salidas cuenta las dos.
									public static function DiasVacaciones($idEmpleado, $fechaInicio, $fechaFin){
										$_Modul   = new Empleados();
									
											/*$query  = sprintf('SELECT FechaInicio, FechaFin, SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
											$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);*/
											$query  = sprintf('SELECT FechaInicio, FechaFin FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3 AND Estatus = 1;',    
											$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
											//echo $query;
											$result = $_Modul->_db->query($query);
											$return =0;
											if ($result->num_rows){
												while( $row = $result->fetch_assoc() ){
													$return = $row;
												}
												mysqli_free_result($result);
											}
											
											$_Modul->desconectar();
											return $return;
										}
										
										public static function DiasVacaciones2($idEmpleado, $fechaInicio,$fechaFin){
											$_Modul   = new Empleados();
											/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
												$idEmpleado );*/
												/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
												$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
												//echo $query;*/
												$query  = sprintf('SELECT  SUM(DATEDIFF (FechaFin, FechaInicio) + 1)   AS diasVacaciones FROM vacaciones WHERE idEmpleado= %d AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s")  AND TipoVacacion != 3 AND Estatus = 1;',    
												$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
												//echo $query;
												$result = $_Modul->_db->query($query);
												$return =0;
												if ($result->num_rows){
													while( $row = $result->fetch_assoc() ){
														$return = $row;
													}
													mysqli_free_result($result);
												}
												
												$_Modul->desconectar();
												return $return;
											}
											public static function DiasVacacionesxr($idEmpleado, $fechaInicio,$fechaFin){//////fincion bien por rangos
												$_Modul   = new Empleados();
												/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
													$idEmpleado );*/
													/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
													$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
													//echo $query;*/
													$query  = sprintf('SELECT  SUM(dv.SubTotal) AS SubTotal  , SUM(dv.PrimaVacacional) AS PrimaVacacional, COUNT(Dia)  AS diasVacaciones FROM detvacaciones AS dv INNER JOIN vacaciones AS v ON (dv.idVacaciones = v.id)  WHERE dv.idEmpleado = %d AND dv.Dia BETWEEN "%s" AND "%s"  AND v.TipoVacacion != 3 AND v.Estatus = 1;',    
													$idEmpleado, $fechaInicio, $fechaFin);
													//echo $query;
													$result = $_Modul->_db->query($query);
													$return =0;
													if ($result->num_rows){
														while( $row = $result->fetch_assoc() ){
															$return = $row;
														}
														mysqli_free_result($result);
													}
													
													$_Modul->desconectar();
													return $return;
												}

											public static function Turno1($idEmpleado){
												$_Modul   = new Empleados();
													$query  = sprintf('SELECT *, SUM(TIMESTAMPDIFF(HOUR, Entrada,Salida)) AS HorasTrabajadas FROM es2 WHERE idEmpleado = %d AND (Entrada BETWEEN "07:00" AND "09:00" OR Salida BETWEEN "18:00" AND "21:00") AND Fecha BETWEEN "2023-09-15" AND "2023-09-30";',    
													$idEmpleado);
													//echo $query;
													$result = $_Modul->_db->query($query);
													$return =0;
													if ($result->num_rows){
														while( $row = $result->fetch_assoc() ){
															$return = $row;
														}
														mysqli_free_result($result);
													}
													
													$_Modul->desconectar();
													return $return;
												}

												public static function Turno2($idEmpleado){
													$_Modul   = new Empleados();
														$query  = sprintf('SELECT *, SUM(TIMESTAMPDIFF(HOUR, Salida,Entrada)) AS HorasTrabajadas FROM es2 WHERE idEmpleado = %d AND (Entrada BETWEEN "18:00" AND "21:00" OR Salida BETWEEN "08:00" AND "09:00") AND Fecha BETWEEN "2023-09-16" AND "2023-09-30";',    
														$idEmpleado);
														
														//echo $query;
														$result = $_Modul->_db->query($query);
														$return =0;
														if ($result->num_rows){
															while( $row = $result->fetch_assoc() ){
																$return = $row;
															}
															mysqli_free_result($result);
														}
														
														$_Modul->desconectar();   
														return $return;
													}

													public static function EntradasSalidas($idEmpleado, $fechaInicio, $fechaFin ){
														$_Modul   = new Empleados();
														
													/*	$query  = sprintf('SELECT DISTINCT(Fecha),id, (id +1)as id2, idEmpleado, Fecha, Entrada, Salida, (SELECT idPlanta FROM empleados WHERE IdDRENC = idEmpleado ) AS pl, (SELECT Salida FROM es2 WHERE id = id2 ) as Salida2, (SELECT Fecha FROM es2 WHERE id = id2 ) as fechas2 FROM es2 WHERE idEmpleado = %d AND Fecha BETWEEN "%s" AND "%s";',    
														$idEmpleado,$fechaInicio, $fechaFin);*/

															$query  = sprintf('SELECT idEmpleado, Fecha, Entrada, Salida, Retardo, (SELECT idPlanta FROM empleados WHERE IdDRENC = idEmpleado ) AS pl, Turno, DATE_ADD(Fecha, INTERVAL 1 DAY) AS fechas FROM es2 WHERE idEmpleado = %d AND Fecha BETWEEN "%s" AND "%s";',    
															$idEmpleado,$fechaInicio, $fechaFin);
														//	echo $query;
															$result = $_Modul->_db->query($query);
															$return =[]; 
															if ($result->num_rows){
																while( $row = $result->fetch_assoc() ){
																	$return []= $row;
																}
																mysqli_free_result($result);
															}
													
															$_Modul->desconectar();
															return $return;
														
													}
													
													public static function Turnopp($idEmpleado){
														$_Modul   = new Empleados();
														$query  = sprintf('SELECT *, TIMESTAMPDIFF(HOUR, Salida,Entrada) AS HorasTrabajadas FROM es2 WHERE idEmpleado = %d AND (Entrada BETWEEN "18:00" AND "21:00" OR Salida BETWEEN "08:00" AND "09:00") AND Fecha BETWEEN "2023-09-16" AND "2023-09-30";',    
														$idEmpleado);
														//	echo $query;
															$result = $_Modul->_db->query($query);
															$return =[];
															if ($result->num_rows){
																while( $row = $result->fetch_assoc() ){
																	$return []= $row;
																}
																mysqli_free_result($result);
															}
													
															$_Modul->desconectar();
															return $return;
														
													}
													public static function validaVacaciones($idEmpleado, $fechaVacaciones){
														$_Modul   = new Empleados();
														$query  = sprintf('SELECT * FROM vacaciones WHERE "%s" BETWEEN FechaInicio AND FechaFin AND Estatus = 1  AND idEmpleado = %d;',    
														$fechaVacaciones, $idEmpleado);
															//echo $query;
															$result = $_Modul->_db->query($query);
															$return =0;
															if ($result->num_rows){
																while( $row = $result->fetch_assoc() ){
																	$return = $row;
																}
																mysqli_free_result($result);
															}
													
															$_Modul->desconectar();
															return $return;
													}


													public static function Faltas($idEmpleado, $fechaInicio, $fechaFin){
														$_Modul   = new Empleados();
														$query  = sprintf('SELECT COUNT(DISTINCT FechaIncidencia) AS faltas FROM incidencias WHERE idEmpleado = %d  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 5 AND Estatus = 1;',    
														$idEmpleado, $fechaInicio, $fechaFin);
														//echo $query;
														$result = $_Modul->_db->query($query);
														$return =0;
														if ($result->num_rows){
															while( $row = $result->fetch_assoc() ){
																$return = $row;
															}
															mysqli_free_result($result);
														}     
														
														$_Modul->desconectar();
														return $return;
													}
													
													public static function Permisos($idEmpleado, $fechaInicio, $fechaFin){
														$_Modul   = new Empleados();
														$query  = sprintf('SELECT COUNT(DISTINCT FechaIncidencia) AS permisos, Sueldo FROM incidencias WHERE idEmpleado = %d  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 1 AND Estatus = 1;',    
														$idEmpleado, $fechaInicio, $fechaFin);
														//echo $query;
														$result = $_Modul->_db->query($query);
														$return =0;
														if ($result->num_rows){
															while( $row = $result->fetch_assoc() ){
																$return = $row;
															}
															mysqli_free_result($result);
														}     
														
														$_Modul->desconectar();
														return $return;
													}

													// esta funcion calcula los dias trabajados (A = asistencia), se basaen las entradas o salidas cuenta las dos.
											public static function DiasIncapacidad($idEmpleado, $fechaInicio, $fechaFin){
												$_Modul   = new Empleados();
											
													/*$query  = sprintf('SELECT FechaInicio, FechaFin, SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
													$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);*/
													$query  = sprintf('SELECT FechaInicio, FechaFin FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion = 3 AND Estatus = 1;',    
													$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
													//echo $query;
													$result = $_Modul->_db->query($query);
													$return =0;
													if ($result->num_rows){
														while( $row = $result->fetch_assoc() ){
															$return = $row;
														}
														mysqli_free_result($result);
													}
													
													$_Modul->desconectar();
													return $return;
												}
												public static function DiasIncapacidad2($idEmpleado, $fechaInicio, $fechaFin){
													$_Modul   = new Empleados();
													/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
														$idEmpleado );*/
														/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
														$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
														//echo $query;*/
														$query  = sprintf('SELECT  COUNT(Dia)  AS diasIncapacidad FROM detvacaciones AS dv INNER JOIN vacaciones AS v ON (dv.idVacaciones = v.id)  WHERE dv.idEmpleado = %d AND dv.Dia BETWEEN "%s" AND "%s"  AND v.TipoVacacion = 3 AND v.Estatus = 1;',    
														$idEmpleado, $fechaInicio, $fechaFin);
														// $query;
														$result = $_Modul->_db->query($query);
														$return =0;
														if ($result->num_rows){
															while( $row = $result->fetch_assoc() ){
																$return = $row;
															}
															mysqli_free_result($result);
														}
														
														$_Modul->desconectar();
														return $return;
													}
										

													public static function BuscaRetardos($idEmpleado, $fecha){
														$_Modul   = new Empleados();
														/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
															$idEmpleado );*/
															/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
															$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
															//echo $query;*/
															$query  = sprintf('SELECT Entrada, Salida, Fecha FROM es2 WHERE Retardo = 3 AND idEmpleado = %d  AND Fecha = "%s";',    
															$idEmpleado, $fecha);
															//echo $query;
															$result = $_Modul->_db->query($query);
															$return =0;
															if ($result->num_rows){
																while( $row = $result->fetch_assoc() ){
																	$return = $row;
																}
																mysqli_free_result($result); 
															}
															
															$_Modul->desconectar();
															return $return;
														}

														public static function BuscaContingenciasE($he,$fecha){
															$_Modul   = new Empleados();
															/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
																$idEmpleado );*/
																/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
																$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
																//echo $query;*/
																$query  = sprintf('SELECT IF(Hora < "%s","%s",0)  AS contingencia FROM incidencias WHERE TipoIncidencia = 6 AND FechaIncidencia = "%s";',    
																$he,$he, $fecha);
																//echo $query;
																$result = $_Modul->_db->query($query);
																$return =0;
																if ($result->num_rows){
																	while( $row = $result->fetch_assoc() ){
																		$return = $row;
																	}
																	mysqli_free_result($result);
																}
																
																$_Modul->desconectar();
																return $return;
															}

															public static function BuscaContingenciasS($hs, $fecha){
																$_Modul   = new Empleados();
																/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
																	$idEmpleado );*/
																	/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
																	$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
																	//echo $query;*/
																	$query  = sprintf('SELECT IF(HoraR > "%s","%s",0)  AS contingencia FROM incidencias WHERE TipoIncidencia = 6 AND FechaIncidencia = "%s";',    
																	$hs,$hs, $fecha);
																	//echo $query;
																	$result = $_Modul->_db->query($query);
																	$return =0;
																	if ($result->num_rows){
																		while( $row = $result->fetch_assoc() ){
																			$return = $row;
																		}
																		mysqli_free_result($result);
																	}
																	
																	$_Modul->desconectar();
																	return $return;
																}

																public static function BuscaDiaFestivo($fecha){
																	$_Modul   = new Empleados();
																	//	$query  = sprintf('SELECT FechaIncidencia  AS diafestivo FROM incidencias WHERE TipoIncidencia = 8 AND FechaIncidencia = "%s";', $fecha);
																	$query  = sprintf('SELECT IF(FechaIncidencia = "%s", 1,0) AS diafestivo FROM incidencias WHERE TipoIncidencia = 8 AND Estatus = 1 ', $fecha);
																	//	echo $query;
																		$result = $_Modul->_db->query($query);
																		$return =0;
																		if ($result->num_rows){
																			while( $row = $result->fetch_assoc() ){
																				$return = $row;
																			}
																			mysqli_free_result($result);
																		}
																	$_Modul->desconectar();
																	return $return;
																	}

																	
																	public static function BuscaOmisiones($idEmpleado, $fecha){
																		$_Modul   = new Empleados();
																			$query  = sprintf('SELECT Hora, Motivo FROM incidencias WHERE TipoIncidencia = 2 AND idEmpleado = %d  AND FechaIncidencia =  "%s";',    
																			$idEmpleado, $fecha);
																			//echo $query;
																			$result = $_Modul->_db->query($query);
																			$return =0;
																			if ($result->num_rows){
																				while( $row = $result->fetch_assoc() ){
																					$return = $row;
																				}
																				mysqli_free_result($result);
																			}
																			
																			$_Modul->desconectar();
																			return $return;
																		}
																		public static function BuscaPaseSalida($idEmpleado, $fecha){
																			$_Modul   = new Empleados();
																				$query  = sprintf('SELECT Hora, Motivo FROM incidencias WHERE TipoIncidencia = 4 AND idEmpleado = %d  AND FechaIncidencia =  "%s";',    
																				$idEmpleado, $fecha);
																				//echo $query;
																				$result = $_Modul->_db->query($query);
																				$return =0;
																				if ($result->num_rows){
																					while( $row = $result->fetch_assoc() ){
																						$return = $row;
																					}
																					mysqli_free_result($result);
																				}
																				
																				$_Modul->desconectar();
																				return $return;
																			}

																			//aplica solo paa quincenales de pl1 con horario de 8 -20 hrs
									public static function listaQuincenalesP($fecha1,$fecha2){
										$_Modul   = new Empleados();
										/*$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND  Entrada != "00:00:00" ) AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9) AS horasExtras FROM empleados WHERE Estatus=1' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
										//	echo $query;*/
										//$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00") AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9) AS horasExtras FROM empleados WHERE Estatus=1 LIMIT 10;' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
										//$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00") AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9 AND Estatus = 1) AS horasExtras, (SELECT SUM(TIMESTAMPDIFF(hour, CONCAT(FechaIncidencia," ",Hora), CONCAT(FechaIncidencia," ",HoraR))) AS Tiem  FROM incidencias WHERE TipoIncidencia = 4 AND idEmpleado = IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Regreso = "SI") AS Tiempo, (SELECT SUM(Cantidad) as can FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 10) AS gratificaiones,  (SELECT Cantidad FROM deducciones WHERE Tipo =1 AND idEmpleado = IdDRENC LIMIT 1) AS infonavit, (SELECT Cantidad FROM deducciones WHERE Tipo =2 AND idEmpleado = IdDRENC LIMIT 1) AS fonacot, (SELECT Cantidad FROM deducciones WHERE Tipo =3 AND idEmpleado = IdDRENC LIMIT 1) AS pa, (SELECT COUNT(FechaIncidencia) AS diafestivo  FROM incidencias WHERE TipoIncidencia = 8 AND FechaIncidencia BETWEEN "%s" AND "%s") AS diafestivoNT FROM empleados WHERE Estatus=1 AND Nomina	= 1  LIMIT 15;' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
										//$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00") AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9) AS horasExtras FROM empleados WHERE Estatus=1 LIMIT 10;' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
										//$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00") AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9 AND Estatus = 1) AS horasExtras, (SELECT SUM(TIMESTAMPDIFF(hour, CONCAT(FechaIncidencia," ",Hora), CONCAT(FechaIncidencia," ",HoraR))) AS Tiem  FROM incidencias WHERE TipoIncidencia = 4 AND idEmpleado = IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Regreso = "SI") AS Tiempo, (SELECT SUM(Cantidad) as can FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Estatus = 1 AND TipoIncidencia = 10) AS gratificaiones,  (SELECT Cantidad FROM deducciones WHERE Tipo =1 AND idEmpleado = IdDRENC AND Status = 1  LIMIT 1) AS infonavit, (SELECT Cantidad FROM deducciones WHERE Tipo =2 AND idEmpleado = IdDRENC AND Status = 1 LIMIT 1) AS fonacot, (SELECT Cantidad FROM deducciones WHERE Tipo =3 AND idEmpleado = IdDRENC AND Status = 1 LIMIT 1) AS pa, (SELECT COUNT(FechaIncidencia) AS diafestivo  FROM incidencias WHERE TipoIncidencia = 8 AND Estatus = 1 AND  FechaIncidencia BETWEEN "%s" AND "%s") AS diafestivoNT, (SELECT SUM(Cantidad) as hg FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 12 AND Estatus = 1) AS hombregarantiaH FROM empleados WHERE Estatus=1 AND Nomina	= 1 LIMIT 15; ' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
										$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00") AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9 AND Estatus = 1) AS horasExtras, (SELECT SUM(TIMESTAMPDIFF(hour, CONCAT(FechaIncidencia," ",Hora), CONCAT(FechaIncidencia," ",HoraR))) AS Tiem  FROM incidencias WHERE TipoIncidencia = 4 AND idEmpleado = IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Regreso = "SI") AS Tiempo, (SELECT SUM(Cantidad) as can FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Estatus = 1 AND TipoIncidencia = 10) AS gratificaiones,  (SELECT Cantidad FROM deducciones WHERE Tipo =1 AND idEmpleado = IdDRENC AND Status = 1  LIMIT 1) AS infonavit, (SELECT Cantidad FROM deducciones WHERE Tipo =2 AND idEmpleado = IdDRENC AND Status = 1 LIMIT 1) AS fonacot, (SELECT Cantidad FROM deducciones WHERE Tipo =3 AND idEmpleado = IdDRENC AND Status = 1 LIMIT 1) AS pa, (SELECT COUNT(FechaIncidencia) AS diafestivo  FROM incidencias WHERE TipoIncidencia = 8 AND Estatus = 1 AND  FechaIncidencia BETWEEN "%s" AND "%s") AS diafestivoNT, (SELECT SUM(Cantidad) as hg FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 12 AND Estatus = 1) AS hombregarantiaH FROM empleados WHERE Estatus=1 AND Nomina	= 1; ' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
											//echo $query;
										//echo $query;
										$result = $_Modul->_db->query($query);
										$return =[];
										if ($result->num_rows){
											while( $row = $result->fetch_assoc() ){
												$return []= $row;
											}
											mysqli_free_result($result);
										}
								
										$_Modul->desconectar();
										return $return;
									}		
									public static function BuscaMediasHoras($pl,$fecha){
										$_Modul   = new Empleados();
										/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
											$idEmpleado );*/
											/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
											$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
											//echo $query;*/  
											//SELECT  Horario FROM incidencias WHERE Horario = 1 AND TipoIncidencia = 11 AND Estatus = 1 AND  FechaIncidencia ="2024-02-09";

											$query  = sprintf('SELECT  Horario, Hora, DATE_ADD(Hora, INTERVAL 29 MINUTE) AS Rango FROM incidencias WHERE Horario = %d  AND TipoIncidencia = 11 AND Estatus = 1 AND  FechaIncidencia ="%s";',    
											$pl, $fecha);
											//echo $query;
											$result = $_Modul->_db->query($query);
											$return =0;
											if ($result->num_rows){
												while( $row = $result->fetch_assoc() ){
													$return = $row;
												}
												mysqli_free_result($result);
											}
											
											$_Modul->desconectar();
											return $return;
										}
										public static function BuscaConceptosD($id, $fechaInicio, $fechaFin){
											$_Modul   = new Empleados();
											/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
												$idEmpleado );*/
												/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
												$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
												//echo $query;*/  
												//SELECT  Horario FROM incidencias WHERE Horario = 1 AND TipoIncidencia = 11 AND Estatus = 1 AND  FechaIncidencia ="2024-02-09";
	
												$query  = sprintf('SELECT SUM(Cantidad) AS deducciones FROM deducciones WHERE idEmpleado = %d AND Tipo = 4 AND Status=1 AND DP = "D" AND Fecha BETWEEN "%s" AND "%s";',     
												$id, $fechaInicio, $fechaFin);
												//echo $query;
												$result = $_Modul->_db->query($query);
												$return =[];
												if ($result->num_rows){
													while( $row = $result->fetch_assoc() ){
														$return = $row;
													}
													mysqli_free_result($result);
												}
												
												$_Modul->desconectar();
												return $return;
											}
											public static function BuscaConceptosP($id, $fechaInicio, $fechaFin){
												$_Modul   = new Empleados();
												/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
													$idEmpleado );*/
													/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
													$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
													//echo $query;*/  
													//SELECT  Horario FROM incidencias WHERE Horario = 1 AND TipoIncidencia = 11 AND Estatus = 1 AND  FechaIncidencia ="2024-02-09";
		
													$query  = sprintf('SELECT SUM(Cantidad) AS percepciones FROM deducciones WHERE idEmpleado = %d AND Tipo = 4 AND Status=1 AND DP = "P" AND Fecha BETWEEN "%s" AND "%s";',     
													$id, $fechaInicio, $fechaFin);
													//echo $query;
													$result = $_Modul->_db->query($query);
												    $return =[];
													if ($result->num_rows){
														while( $row = $result->fetch_assoc() ){
															$return = $row;
														}
														mysqli_free_result($result);
													}
													
													$_Modul->desconectar();
													return $return;
												}
																		
												public static function BuscaConceptosDNoi($id, $fechaInicio, $fechaFin){
													$_Modul   = new Empleados();
													/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
														$idEmpleado );*/
														/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
														$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
														//echo $query;*/  
														//SELECT  Horario FROM incidencias WHERE Horario = 1 AND TipoIncidencia = 11 AND Estatus = 1 AND  FechaIncidencia ="2024-02-09";
			
														$query  = sprintf('SELECT * FROM deducciones WHERE idEmpleado = %d AND Tipo = 4 AND Status=1 AND DP = "D" AND Fecha BETWEEN "%s" AND "%s";',     
														$id, $fechaInicio, $fechaFin);
														//echo $query."</br>";
														$result = $_Modul->_db->query($query);
														$return =[];
														if ($result->num_rows){
															while( $row = $result->fetch_assoc() ){
																$return []= $row;
															}
															mysqli_free_result($result);
														}
												
														$_Modul->desconectar();
														return $return;
													}
													public static function BuscaConceptosPNoi($id, $fechaInicio, $fechaFin){
														$_Modul   = new Empleados();
														/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
															$idEmpleado );*/
															/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
															$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
															//echo $query;*/  
															//SELECT  Horario FROM incidencias WHERE Horario = 1 AND TipoIncidencia = 11 AND Estatus = 1 AND  FechaIncidencia ="2024-02-09";
				
															$query  = sprintf('SELECT * FROM deducciones WHERE idEmpleado = %d AND Tipo = 4 AND Status=1 AND DP = "P" AND Fecha BETWEEN "%s" AND "%s";',     
															$id, $fechaInicio, $fechaFin);
															//echo $query."</br>";
															$result = $_Modul->_db->query($query);
															$return =[];
															if ($result->num_rows){
																while( $row = $result->fetch_assoc() ){
																	$return []= $row;
																}
																mysqli_free_result($result);
															}
													
															$_Modul->desconectar();
															return $return;
														}

														public static function buacaRecomendados($idRecomendador){
															$_Modul   = new Empleados();
															$query  = sprintf('SELECT *, (SELECT DATE_ADD(FechaIngreso, INTERVAL 2 month)) AS dias FROM recomendados WHERE idRecomendador= %d AND now() >= (SELECT DATE_ADD(FechaIngreso, INTERVAL 2 month))  AND Estatus = 1 AND Pagado = 0;', 
																				$idRecomendador);
																				//echo $query;
															$result = $_Modul->_db->query($query);
															$return =[];
															if ($result->num_rows){
																while( $row = $result->fetch_assoc() ){
																	$return []= $row;
																}
																mysqli_free_result($result);
															}
													
															$_Modul->desconectar();
															return $return;
														}
														public static function listaSemanales($fecha1,$fecha2){
															$_Modul   = new Empleados();
															/*$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND  Entrada != "00:00:00" ) AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9) AS horasExtras FROM empleados WHERE Estatus=1' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
															//	echo $query;*/
															//$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00") AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9) AS horasExtras FROM empleados WHERE Estatus=1 LIMIT 10;' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
															//Quitar el limit cuando termina de hacer las pruebas del repositorio 
															$query  = sprintf('SELECT *, (SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE es2.idEmpleado =  IdDRENC  AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00") AS dias, (SELECT COUNT(DISTINCT Fecha) as dom FROM es2 WHERE es2.idEmpleado = IdDRENC AND Dia = "Domingo" AND Fecha BETWEEN "%s" AND "%s" AND Retardo != 19 ) as domingos, (SELECT SUM(Horario) as te FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 9 AND Estatus = 1) AS horasExtras, (SELECT SUM(TIMESTAMPDIFF(hour, CONCAT(FechaIncidencia," ",Hora), CONCAT(FechaIncidencia," ",HoraR))) AS Tiem  FROM incidencias WHERE TipoIncidencia = 4 AND idEmpleado = IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Regreso = "SI") AS Tiempo, (SELECT SUM(Cantidad) as can FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND Estatus = 1 AND TipoIncidencia = 10) AS gratificaiones,  (SELECT Cantidad FROM deducciones WHERE Tipo =1 AND idEmpleado = IdDRENC AND Status = 1  LIMIT 1) AS infonavit, (SELECT Cantidad FROM deducciones WHERE Tipo =2 AND idEmpleado = IdDRENC AND Status = 1 LIMIT 1) AS fonacot, (SELECT Cantidad FROM deducciones WHERE Tipo =3 AND idEmpleado = IdDRENC AND Status = 1 LIMIT 1) AS pa, (SELECT COUNT(FechaIncidencia) AS diafestivo  FROM incidencias WHERE TipoIncidencia = 8 AND Estatus = 1 AND  FechaIncidencia BETWEEN "%s" AND "%s") AS diafestivoNT, (SELECT SUM(Cantidad) as hg FROM incidencias WHERE idEmpleado =  IdDRENC  AND FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 12 AND Estatus = 1) AS hombregarantiaH, IF( Complemento = (SELECT id FROM incidencias WHERE  FechaIncidencia BETWEEN "2024-05-06" AND "2024-05-12" AND TipoIncidencia = 14 AND Estatus = 1),"SI", "NO") as comple FROM empleados WHERE Estatus=1 AND Nomina	= 2 ORDER BY IdDRENC ASC LIMIT 15; ' ,$fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2, $fecha1,$fecha2);
															//	echo $query;
															$result = $_Modul->_db->query($query);
															$return =[];
															if ($result->num_rows){
																while( $row = $result->fetch_assoc() ){
																	$return []= $row;
																}
																mysqli_free_result($result);
															}
													
															$_Modul->desconectar();
															return $return;
														}	
														public static function cuentaRetar2s($id, $fecha1,$fecha2, $turno, $entrada){
															$_Modul   = new Empleados();
																$query  = sprintf('SELECT COUNT(Entrada) AS retardos FROM es2 WHERE idEmpleado =%d AND Fecha BETWEEN "%s" AND "%s" AND Turno = %d AND Entrada > "%s" AND Retardo != 3;' ,$id, $fecha1,$fecha2, $turno, $entrada);
																//echo $query;
																$result = $_Modul->_db->query($query);
																$return =0;
																if ($result->num_rows){
																	while( $row = $result->fetch_assoc() ){
																		$return = $row;
																	}
																	mysqli_free_result($result);
																}
																
																$_Modul->desconectar();
																return $return;
														}	
												
														public static function cuentaPermisosNV($id){
															$_Modul   = new Empleados();
																$query  = sprintf('SELECT COUNT(idEmpleado) AS permisos FROM incidencias WHERE idEmpleado= %d AND TipoIncidencia = 1 AND Sueldo = 1;' ,$id);
																//echo $query;
																$result = $_Modul->_db->query($query);
																$return =0;
																if ($result->num_rows){
																	while( $row = $result->fetch_assoc() ){
																		$return = $row;
																	}
																	mysqli_free_result($result);
																}
																
																$_Modul->desconectar();
																return $return;
														}	
												
														public static function BuscaBonoAntiguedad($fecha1,$fecha2 ){
															$_Modul   = new Empleados();
															//	$query  = sprintf('SELECT FechaIncidencia  AS diafestivo FROM incidencias WHERE TipoIncidencia = 8 AND FechaIncidencia = "%s";', $fecha);
															$query  = sprintf('SELECT IF (COUNT(FechaIncidencia) > 0, 1, 0) bonoanti FROM incidencias WHERE FechaIncidencia BETWEEN "%s" AND "%s" AND TipoIncidencia = 13 AND Estatus = 1;', $fecha1,$fecha2);
															//	echo $query;
																$result = $_Modul->_db->query($query);
																$return =0;
																if ($result->num_rows){
																	while( $row = $result->fetch_assoc() ){
																		$return = $row;
																	}
																	mysqli_free_result($result);
																}
															$_Modul->desconectar();
															return $return;
															}

															public static function BuscaNuevosQuincenales($idEmpleado){
																$_Modul   = new Empleados();
																/*$query  = sprintf('SELECT DISTINCT  idEmpleado, COUNT(DISTINCT Fecha) AS dias FROM es WHERE idEmpleado = %d AND Fecha BETWEEN "2023-07-01" AND "2023-07-15"',    
																	$idEmpleado );*/
																	/*$query  = sprintf('SELECT SUM(DATEDIFF (FechaFin, FechaInicio) + 1)  AS diasVacaciones  FROM vacaciones WHERE idEmpleado= %d  AND (FechaInicio BETWEEN "%s" AND "%s" OR FechaFin BETWEEN "%s" AND "%s") AND TipoVacacion != 3;',    
																	$idEmpleado, $fechaInicio, $fechaFin, $fechaInicio, $fechaFin);
																	//echo $query;*/
																	$query  = sprintf('SELECT FechaCambioNom, COUNT(IdDRENC) AS NuevoQ FROM empleados WHERE IdDRENC = %d AND IdRecomendador = 1 AND FechaCambioNom != "NULL";',    
																	$idEmpleado);
																	//echo $query;
																	$result = $_Modul->_db->query($query);
																	$return =0;
																	if ($result->num_rows){
																		while( $row = $result->fetch_assoc() ){
																			$return = $row;
																		}
																		mysqli_free_result($result); 
																	}
																	
																	$_Modul->desconectar();
																	return $return;
																}
																public static function cuentaDiasTrabajados($id,$fecha1,$fecha2){
																	$_Modul   = new Empleados();
																	//	$query  = sprintf('SELECT FechaIncidencia  AS diafestivo FROM incidencias WHERE TipoIncidencia = 8 AND FechaIncidencia = "%s";', $fecha);
																	$query  = sprintf('SELECT COUNT(DISTINCT Fecha) as dt FROM es2 WHERE idEmpleado = %d AND Fecha BETWEEN  "%s" AND "%s" AND Retardo != 19 AND Entrada != "00:00:00" AND Salida != "00:00:00";', $id,$fecha1,$fecha2);
																	//	echo $query;
																		$result = $_Modul->_db->query($query);
																		$return =0;
																		if ($result->num_rows){
																			while( $row = $result->fetch_assoc() ){
																				$return = $row;
																			}
																			mysqli_free_result($result);
																		}
																	$_Modul->desconectar();
																	return $return;
																	}
																	public static function BuscaPrimerDia($id,$fecha1,$fecha2){
																		$_Modul   = new Empleados();
																		//	$query  = sprintf('SELECT FechaIncidencia  AS diafestivo FROM incidencias WHERE TipoIncidencia = 8 AND FechaIncidencia = "%s";', $fecha);
																		$query  = sprintf('SELECT IF(COUNT(IdDRENC) > 0,FechaIngreso,8  ) AS fecing FROM empleados WHERE IdDRENC = %d AND FechaIngreso BETWEEN "%s" AND "%s";', $id,$fecha1,$fecha2);
																			//echo $query;
																			$result = $_Modul->_db->query($query);
																			$return =0;
																			if ($result->num_rows){
																				while( $row = $result->fetch_assoc() ){
																					$return = $row;
																				}
																				mysqli_free_result($result);
																			}
																		$_Modul->desconectar();
																		return $return;
																		}

																		public static function listaEmpleadosComplemento($idDep){
																			$_Modul   = new Empleados();
																		/*	$query  = sprintf('SELECT e.IdDRENC, e.IdPlanta, e.Nombre, e.ApellidoP, e.ApellidoM ,es.Fecha, es.Hora, r.nombre, es.id, MIN(es.Hora) AS horaE  FROM empleados AS e INNER JOIN es ON (e.IdDRENC = es.idEmpleado) INNER JOIN rutas AS r ON (e.Ruta = r.id) WHERE e.Estatus=1 AND Retardo = 0 AND Operacion = "Entrada" AND  Hora > "8:01" AND Hora < "19:01" AND  es.Fecha = "%s" GROUP BY idEmpleado,Fecha',
																				  $fecha);*/
									
																			 $query  = sprintf('SELECT IdDRENC,IF(IdPlanta = 1,"PL1","PL2") AS Planta, Nombre,ApellidoP, ApellidoM,(SELECT Nombre FROM areas WHERE Id = %d) AS dep  FROM empleados WHERE Depto = %d AND Nomina = 2', $idDep,$idDep);
																				//  echo $query;
																			$result = $_Modul->_db->query($query);
																			$return =[];
																			if ($result->num_rows){
																				while( $row = $result->fetch_assoc() ){
																					$return []= $row;
																				}
																				mysqli_free_result($result);
																			}
																	
																			$_Modul->desconectar();
																			return $return;
																		}
																		
														
												/*	public static function validaRfcCurpNss($dato){
														$_Modul   = new Empleados();
															$query  = sprintf('SELECT IdDRENC FROM empleados WHERE Nss = "%s" OR  Curp = "%s" OR Rfc= "%s";',    
															$dato, $dato, $dato);
															
															//echo $query;
															$result = $_Modul->_db->query($query);
															$return =0;
															if ($result->num_rows){
																while( $row = $result->fetch_assoc() ){
																	$return = $row;
																}
																mysqli_free_result($result);
															}
															
															$_Modul->desconectar();   
															return $return;
														}*/

													

	/*

	public static function listaCitasByIdUser($idCita){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM cita WHERE idCita=%d',
			$idCita );
			//echo $query;
			$result = $_Modul->_db->query($query);
			$return =0;
			if ($result->num_rows){
				while( $row = $result->fetch_assoc() ){
					$return = $row;
				}
				mysqli_free_result($result);
			}
			
			$_Modul->desconectar();
			return $return;
		}
	
	

	public static function CitaByIdUserId($idPaciente){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM cita WHERE idPaciente=%d',
			$idPaciente );
		//echo 	$query;
		$result = $_Modul->_db->query($query);
		$return =0;
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
                $return = $row;
            }
			mysqli_free_result($result);
		}
		
		$_Modul->desconectar();
		return $return;
	}
	    
    public static function eliminarexpedienteById($idExpediente){
		$_soporte   =   new Citas();
		$query = sprintf('UPDATE cita SET
						eliminado = 1
						WHERE idExpediente = %d ',$idExpediente );
		if ($_soporte->_db->query($query) ){
			return true;
		}else{
			return false;
		}
		$_soporte->desconectar();
		return false;
    }
    
	public static function CitaByPaciente($idPaciente){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM paciente WHERE idPaciente=%d',
			$idPaciente );
		$result = $_Modul->_db->query($query);
		$return =0;
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
                $return = $row;
            }
			mysqli_free_result($result);
		}
		
		$_Modul->desconectar();
		return $return;
	}
	public static function listaRetrasos(){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT *, TIME(fecha_hora) as Hora FROM cita WHERE (DATE(fecha_hora) = CURDATE() AND TIME(fecha_hora) < CURTIME()) ORDER BY TIME(fecha_hora) DESC;');
		$result = $_Modul->_db->query($query);
		$return =[];
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
                $return []= $row;
            }
			mysqli_free_result($result);
		}

		$_Modul->desconectar();
		return $return;
	}
	public static function listaProximas(){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT *, TIME(fecha_hora) as Hora FROM cita WHERE DATE(fecha_hora) > CURDATE() ORDER BY TIME(fecha_hora) ASC;');
		$result = $_Modul->_db->query($query);
		$return =[];
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
                $return []= $row;
            }
			mysqli_free_result($result);
		}

		$_Modul->desconectar();
		return $return;
	}
	public static function Doctores(){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM usuarios WHERE consultas=1');
		$result = $_Modul->_db->query($query);
		$return =[];
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
                $return []= $row;
            }
			mysqli_free_result($result);
		}

		$_Modul->desconectar();
		return $return;
	}
	public static function DatosDoctor($idDoctor){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM usuarios WHERE idUsuario=%d',
			$idDoctor );
		$result = $_Modul->_db->query($query);
		$return =0;
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
                $return = $row;
            }
			mysqli_free_result($result);
		}
		
		$_Modul->desconectar();
		return $return;
	}*/

}
?>