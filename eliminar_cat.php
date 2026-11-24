<?php
	
	require 'conexion.php';
 
	$id = $_GET['id'];
	
	$sql = "DELETE FROM category WHERE id = '$id'";
	$resultado = mysqli_query($conexion,$sql);
	
?>
 
<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
				<?php if($resultado) { 
					echo '<script>
					alert("Categoria Eliminada");
					window.history.go(-2)</script>'
					?>
				
				<?php } else { ?>
				<h3>ERROR AL ELIMINAR</h3>
				<?php  } ?>
				
				
				
				</div>
			</div>
		</div>
	</body>
</html>