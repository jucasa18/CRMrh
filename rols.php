<?php
include ('auth_session.php');
include('session_expire.php');

if($_SESSION["group"] == 'admin'){
//include("dash.php");
}else{
echo "<script>alert(\"No tienes permisos suficientes\");window.location='../dashboard.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" &amp;gt;>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendor/components/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendor/driftyco/ionicons/css/ionicons.css">
    <link href="css/style_rols.css" rel="stylesheet" type="text/css" />
    <link href='https://unpkg.com/boxicons@2.0.8/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3bfb8be62d.js" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="menu">
        <ul>
            <li>
                <a href="dashboard.php"><span class="icono"><i class='bx bxs-home'></i></span>
                    <span class="texto">Inicio</span>
                </a>
            </li>
            
            <li>
                <a href="products.php"><span class="icono"><i class='bx bxs-barcode'></i></span>
                    <span class="texto">Productos</span>
                </a>
            </li>
            <li>
                <a href="category.php"><span class="icono"><i class='bx bxs-category'></i></span>
                    <span class="texto">Categorias</span>
                </a>
            </li>
            <li>
                <a href="inventary.php"><span class="icono"><i class='bx bxs-package'></i></span>
                    <span class="texto">Inventario</span>
                </a>
            </li>
            <li>
                <a href="operation.php"><span class="icono"><i class='bx bxs-customize' ></i></span>
                    <span class="texto">Movimientos</span>
                </a>
            </li>
            <li>
                <a href="supplier.php"><span class="icono"><i class='bx bxs-store-alt' ></i></span>
                    <span class="texto">Proveedores</span>
                </a>
            </li>
            <li>
                <a href="reports.php"><span class="icono"><i class='bx bxs-report' ></i></span>
                    <span class="texto">Reportes</span>
                </a>
            </li>
            <li>
                <a href="employee.php"><span class="icono"><i class='bx bxs-group' ></i></span>
                    <span class="texto">Empleados</span>
                </a>
            </li>
            <li>
                <a href="rols.php"><span class="icono"><i class='bx bxs-user-plus'></i></span>
                    <span class="texto">Perfiles</span>
                </a>
            </li>
        </ul>
    </nav>
    <input type="checkbox" id="check">
    <nav class="extras">
       <div class="logo"><a href="dashboard.php">Control <span>Inventario</span></a></div>
       <div class="interactuar" onclick="openClose()"></div>
       <ul>
         

         <!-- logged in user information -->
         <?php if (isset($_SESSION['username'])) : ?>
             <li style="font-size: 22px; color:aliceblue;">Bienvenido(a):  <strong style="color: red;"><?php echo $_SESSION['username']; ?></strong></li>
             
         <?php endif ?>
 
 
             
             <li><a href="logout.php"><img src="https://www.pngkey.com/png/full/271-2715363_user-logout-icon-png.png" width="48" height="48" /></a></li>
 
         </ul>
       

        <label for="check" class="bar">
            <i class='bx bx-menu' id="open"></i>
            <i class="fas fa-times" id="close"></i>
        </label>
    </nav>

    <div class="conteiner" id="container">
        
        <div class="row">
            <div class="col-md-3 col-xs-12">
            <input type="text" class="form-control" placeholder="&#xf002; Buscar..." id='searchTerm' onkeyup="doSearch()"style="font-family:Arial,FontAwesome"/>
			</div>
				<div class="col-md-3 col-xs-12">
					<div class="input-group">
					
                   
                   
       
                    <div class="col-xs-1">
						<div id="loader" class="text-center"></div>
						
					</div>
					    <div class="col-xs-12 "  >
						    <div class="btn-group pull-right" >
								<a href="register.php" class="btn btn-primary"><i class='fa fa-plus'></i> Nuevo</a>
									
							 

					    </div>
                    </div>
                </div>
            </div>
        </div>
        <form class="tabla">
            <h1>Usuarios</h1>
            <table class="table table-striped table-hover" id="datos" >
                
                <thead  >
              
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Grupo de usuario</th>
                        <th>Fecha Alta</th>
                        

                        
                        
                    </tr>
                </thead>
                <tbody>
<?php
require "conexion.php";
$query=mysqli_query($conexion,"SELECT *  FROM user ");
while($fetch=mysqli_fetch_array($query)){
  ?>
                    <tr>
                        
                       
                        <td><?php echo $fetch['id']?></td>
                        <td><?php echo $fetch['username']?></td>
                        <td><?php echo $fetch['name']?></td>
                        <td><?php echo $fetch['email']?></td>
                        <td><?php echo $fetch['grupo']?></td>
                        <td><?php echo $fetch['created_at']?></td>
                        
                       
                        
                    </tr>
<?php
}
?>
            
                 
                </tbody>
            </table>
           
        </form>
  
               
    
               
    </div><!-- // End #container -->
  

    <script src="buscar_datos.js"></script>
    <script src="openClose.js"></script>

</body>
</html>