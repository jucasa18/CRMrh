<?php
include ('auth_session.php');
include('session_expire.php');
require 'conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM supplier WHERE id = '$id'";
$resultado = mysqli_query($conexion, $sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);
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
    <link href="css/style_add_supplier.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendor/driftyco/ionicons/css/ionicons.css">
    <link href='https://unpkg.com/boxicons@2.0.8/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3bfb8be62d.js" crossorigin="anonymous"></script>
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>


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
                <a href="operation.php"><span class="icono"><i class='bx bxs-customize'></i></span>
                    <span class="texto">Movimientos</span>
                </a>
            </li>
            <li>
                <a href="supplier.php"><span class="icono"><i class='bx bxs-store-alt'></i></span>
                    <span class="texto">Proveedores</span>
                </a>
            </li>
            <li>
                <a href="reports.php"><span class="icono"><i class='bx bxs-report'></i></span>
                    <span class="texto">Reportes</span>
                </a>
            </li>

            <li>
                <a href="rols.php"><span class="icono"><i class='bx bxs-cog'></i></span>
                    <span class="texto">Configuración</span>
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
 
 
             
             <li><a href="logout.php"><img src="recursos/logout.png" width="48" height="48" /></a></li>
 
         </ul>
        <label for="check" class="bar">
            <i class='bx bx-menu' id="open"></i>
            <i class="fas fa-times" id="close"></i>
        </label>
    </nav>
    <!-- // #container -->
    <div class="conteiner" id="container">

        <h1> Editar proveedor</h1>



        <section class="content">
            <div class="row">

                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div id="load_img">
                                <img id="uploadPreview1" width="300" height="300" src="https://www.liderdelemprendimiento.com/wp-content/uploads/2019/10/Qu%C3%A9-son-los-proveedores-y-cu%C3%A1les-son-sus-tipos-2848x3000.png">

                            </div>




                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col -->
                <div class="col-md">
                    <form name="update_register" action="update_supplier.php" id="update_register" class="form-horizontal" method="post">

                        <div class="nav-tabs-custom">

                            <div class="tab-content">
                                <div id="resultados_ajax"></div>



                                <div class="tab-pane active" id="details">

                                    <div class="form-group ">
                                        <label for="name_company" class="col-sm-2 control-label">ID</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="id" value="<?php echo $row['id']; ?>" name="id" readonly>
                                        </div>

                                        <label for="name_company" class="col-sm-2 control-label">Nombre</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="company" value="<?php echo $row['company']; ?>" name="company" required>
                                        </div>
                                        <label for="address" class="col-sm-2 control-label">Direccion</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="address" value="<?php echo $row['address']; ?>" name="address" required>
                                        </div>
                                        <label for="address" class="col-sm-2 control-label">T. de Entrega</label>

                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="delivery_times" value="<?php echo $row['delivery_times']; ?>" name="delivery_times" required>
                                        </div>
                                        <div>
                                            <label class="col-sm-12 control-label" style="font-size: 30px;">Información del Contacto</label>
                                        </div>
                                        <label for="name" class="col-sm-2 control-label">Nombre</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" name="name" required>
                                        </div>
                                        <label for="lastname" class="col-sm-2 control-label">Apellido</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="lastname" value="<?php echo $row['lastname']; ?>" name="lastname" required>
                                        </div>
                                        <label for="email" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="email" value="<?php echo $row['email']; ?>" name="email" required>
                                        </div>
                                        <label for="phone" class="col-sm-2 control-label">Telefono</label>

                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-6">
                                            <button type="submit" class="btn btn-primary actualizar_datos">Guardar datos</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </form>
                </div>
                <!-- /.col -->
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    </div><!-- // End #container -->


    <script src="app.js"></script>
    <script src="https://unpkg.com/boxicons@2.0.8/dist/boxicons.js"></script>
</body>

</html>