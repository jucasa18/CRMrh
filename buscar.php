<?php
// Utilizaremos conexion PDO PHP
function conexion() {
	//Declaramos el servidor, la BD, el usuario Mysql y Contraseña BD.
    return new PDO('mysql:host=127.0.0.1:3307;dbname=almacen', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = conexion();
$keyword = '%'.$_POST['palabra'].'%';
$sql = "SELECT * FROM product WHERE name LIKE (:keyword) ORDER BY id ASC LIMIT 0, 7";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$lista = $query->fetchAll();
foreach ($lista as $milista) {
	// Colocaremos negrita a los textos
	$pais_nombre = str_replace($_POST['palabra'], '<b>'.$_POST['palabra'].'</b>', $milista['name']);
	// Aquì, agregaremos opciones
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $milista['id']).'\')">'.$pais_nombre.'</li>';
}
?>