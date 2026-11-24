<?php
include ('auth_session.php');
include('session_expire.php');
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
    <link href="css/style_add_product.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendor/driftyco/ionicons/css/ionicons.css">
    <link href='https://unpkg.com/boxicons@2.0.8/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3bfb8be62d.js" crossorigin="anonymous"></script>
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>
        function previewImage(nb) {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById('uploadImage' + nb).files[0]);
            reader.onload = function(e) {
                document.getElementById('uploadPreview' + nb).src = e.target.result;
            };
        }
    </script>

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
                <a href="settings.php"><span class="icono"><i class='bx bxs-cog'></i></span>
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

        <h1> Agregar nuevo producto </h1>

        <form name="update_register" id="update_register" action="insert_product.php" class="form-horizontal" method="post" enctype="multipart/form-data">

            <section class="content">
                <div class="row">

                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <div id="load_img">
                                    <img id="uploadPreview1" width="300" height="300" src="recursos/box_ilum.png">

                                </div>
                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input id="uploadImage1" type="file" name="file" name="file" onchange="previewImage(1);" />
                                    </div>

                                </div>



                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->


                    </div>
                    <!-- /.col -->
                    <div class="col-md">


                        <div class="nav-tabs-custom">

                            <div class="tab-content">
                                <div id="resultados_ajax"></div>



                                <div class="tab-pane active" id="details">



                                    <div class="form-group">
                                        <label for="product_name" class="col-sm-2 control-label">Codigo</label>
                                        <?php
                                        require 'conexion.php';

                                        $sql = "SELECT MAX(id) AS id FROM product";
                                        $dato = mysqli_query($conexion, $sql);
                                        $respuesta = mysqli_fetch_array($dato, MYSQLI_ASSOC);
                                        $max = (empty($respuesta['id']) ? 1 : $respuesta['id'] += 1);;



                                        $folioprod = sprintf('DR%03d', $max);


                                        ?>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="barcode" name="barcode" value="<?php echo $folioprod ?>" readonly>
                                            <?php

                                            ?>
                                        </div>
                                        <label for="product_name" class="col-sm-5 control-label">Código de Compra</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="codigoCompra" name="codigoCompra" required>
                                            </div>
                                         <label for="product_name" class="col-sm-2 control-label">Nombre</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Producto" required>
                                        </div>
                                        <label for="presentation" class="col-sm-7 control-label">Unidad de medida</label>

                                        <div class="col-sm-8">
                                            <select class="form-control" name="unit_id" id="unit_id" required>
                                                <?php
                                                $unidad = "SELECT *  FROM unit";
                                                $dat_unid = mysqli_query($conexion, $unidad);
                                                ?>
                                                <option value=" " selected> A Elegir..</option>

                                                <?php
                                                while ($filauni = mysqli_fetch_array($dat_unid)) { ?>

                                                    <option value="<?php echo $filauni['id']; ?>"><?php echo $filauni['abreviatura']; ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <label for="presentation" class="col-sm-7 control-label">Presentación</label>

                                        <div class="col-sm-8">
                                            <select class="form-control" name="packing_id" id="packing_id" required>
                                                <?php
                                                $pres = "SELECT *  FROM packing";
                                                $dat_pres = mysqli_query($conexion, $pres);
                                                ?>
                                                <option value=" " selected> A Elegir..</option>

                                                <?php
                                                while ($filapres = mysqli_fetch_array($dat_pres)) { ?>

                                                    <option value="<?php echo $filapres['id']; ?>"><?php echo $filapres['name']; ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="buying_price" class="col-sm-2 control-label">Precio</label>

                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-usd"></i>
                                                    </div>
                                                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                                                </div>
                                            </div>
                                            <label for="profit" class="col-sm-2 control-label">Moneda</label>

                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select class="form-control" name="coin_id" id="coin_id" required>
                                                        <?php
                                                        $moneda = "SELECT *  FROM coin";
                                                        $dat_moneda = mysqli_query($conexion, $moneda);
                                                        ?>
                                                        <option value=" " selected> A Elegir..</option>

                                                        <?php
                                                        while ($filamoneda = mysqli_fetch_array($dat_moneda)) { ?>

                                                            <option value="<?php echo $filamoneda['id']; ?>"><?php echo $filamoneda['abreviatura']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <label for="product_name" class="col-sm-5 control-label">C. Maxima</label>

                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="maxim" name="maxim"  required>
                                            </div>
                                            <label for="product_name" class="col-sm-5 control-label">C. Minima</label>

                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="minim" name="minim" required>
                                            </div>




                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- /.col -->

                    <div class="col-md">


                        <div class="form-group">
                            <label for="manufacturer_id" class="col-sm-2 control-label">Categoria</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <?php
                                    $categoria = "SELECT *  FROM category";
                                    $dat_cat = mysqli_query($conexion, $categoria);
                                    ?>
                                    <option value=" " selected> A Elegir..</option>

                                    <?php
                                    while ($filacat = mysqli_fetch_array($dat_cat)) { ?>

                                        <option value="<?php echo $filacat['id']; ?>"><?php echo $filacat['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <label for="condition_id" class="col-sm-2 control-label">Condicion</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="condi_id" id="condi_id" required>
                                    <?php
                                    $estado = "SELECT *  FROM condi";
                                    $dat_estado = mysqli_query($conexion, $estado);
                                    ?>
                                    <option value=" " selected> A Elegir..</option>

                                    <?php
                                    while ($filaestado = mysqli_fetch_array($dat_estado)) { ?>

                                        <option value="<?php echo $filaestado['id']; ?>"><?php echo $filaestado['name']; ?></option>
                                    <?php
                                    }
                                    ?>



                                </select>
                            </div>




                        </div>







                        <div class="form-group">
                            <label for="buying_price" class="col-sm-2 control-label">Proveedor</label>

                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="form-control" name="supplier_id" id="supplier_id" required>
                                        <?php
                                        $proveedores = "SELECT *  FROM supplier";
                                        $datosprov = mysqli_query($conexion, $proveedores);
                                        ?>
                                        <option value=" " selected> A Elegir..</option>

                                        <?php
                                        while ($filaprov = mysqli_fetch_array($datosprov)) { ?>
                                            <option value="<?php echo $filaprov['id']; ?>"><?php echo $filaprov['company']; ?></option>
                                        <?php
                                        }
                                        ?>




                                    </select>
                                </div>
                            </div>
                            <label for="buying_price" class="col-sm-2 control-label">Planta</label>

                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="form-control" name="plant_id" id="plant_id" required>
                                        <?php
                                        $planta = "SELECT *  FROM plant";
                                        $datos_planta = mysqli_query($conexion, $planta);
                                        ?>
                                        <option value=" " selected> A Elegir..</option>

                                        <?php
                                        while ($fila_planta = mysqli_fetch_array($datos_planta)) { ?>
                                            <option value="<?php echo $fila_planta['id']; ?>"><?php echo $fila_planta['name']; ?></option>
                                        <?php
                                        }
                                        ?>



                                    </select>
                                </div>
                            </div>
                            <label for="buying_price" class="col-sm-2 control-label">Almacen</label>

                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="form-control" name="alm_id" id="alm_id" required>
                                        <?php
                                        $alm = "SELECT *  FROM alm";
                                        $datosalm = mysqli_query($conexion, $alm);
                                        ?>
                                        <option value=" " selected> Opciones..</option>

                                        <?php
                                        while ($filalm = mysqli_fetch_array($datosalm)) { ?>
                                            <option value="<?php echo $filalm['id']; ?>"><?php echo $filalm['name']; ?></option>
                                        <?php
                                        }
                                        ?>


                                    </select>
                                </div>
                            </div>
                            <label for="buying_price" class="col-sm-2 control-label">Ubicacion</label>

                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="form-control" name="rack_id" id="rack_id">
                                        <?php
                                        $alm = "SELECT *  FROM rack";
                                        $datosalm = mysqli_query($conexion, $alm);
                                        ?>
                                        <option value="13" selected> Opciones..</option>

                                        <?php
                                        while ($filalm = mysqli_fetch_array($datosalm)) { ?>
                                            <option value="<?php echo $filalm['id']; ?>"><?php echo $filalm['description']; ?></option>
                                        <?php
                                        }
                                        ?>


                                    </select>
                                </div>
                            </div>


                            


                            

                            <div class="row">
                            </div>

                            <label for="product_name" class="col-sm-5 control-label">Tiempo de Vida</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="tiempoVida" name="tiempoVida"  >
                            </div>
                           
                            <div class="form-group">
                                <label for="note" class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description" required></textarea>
                                </div>
                            </div>


                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon">

                                    </div>

                                    <script>
                                        var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                                        var diasSemana = new Array("Domingo", "Lunes", "Martes", "Mi&eacute;rcoles", "Jueves", "Viernes", "S&aacute;bado");
                                        var f = new Date();
                                        document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " del " + f.getFullYear());
                                    </script>
                                </div>
                            </div>


                        </div>






                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" name="save" class="btn btn-primary actualizar_datos">Guardar datos</button>
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


    <script src="openClose.js"></script>
</body>

</html>