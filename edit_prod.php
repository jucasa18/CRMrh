<?php
include('auth_session.php');
include('session_expire.php');
require 'conexion.php';

$id = $_GET['id'];

$sql = "SELECT a.id AS clave,a.unit_id AS uni,a.packing_id AS pack,a.coin_id AS mon,a.category_id AS cat,a.condi_id AS con,a.supplier_id AS pro,a.plant_id AS pla,a.alm_id AS alma,a.rack_id AS rak,a.barcode AS bc,a.ruta_image AS imagen,a.maxim AS cant1,a.minim AS cant2,a.name AS nombre,a.description AS descrip,d.name AS categoria,a.price AS precio,
    h.abreviatura AS moneda,c.name AS almacen,b.abreviatura as unidad,g.name AS plant,e.name as estado,i.name AS presen,
    e.name AS estado,j.company as proveedor,k.colum AS ubi,k.linea AS line,a.tiempoVida AS tiempoVida,a.codigoCompra AS codigoCompra   FROM product AS a 
      INNER JOIN unit AS b ON (a.unit_id=b.id) 
      INNER JOIN alm AS c ON (a.alm_id=c.id)
      INNER JOIN category as d ON(a.category_id=d.id)
      INNER JOIN condi as e ON (a.condi_id=e.id)
      INNER JOIN plant as g ON (a.plant_id=g.id)
      INNER JOIN coin as h ON(a.coin_id=h.id)
      INNER JOIN packing as i ON(a.packing_id=i.id)
      INNER JOIN supplier as j ON(a.supplier_id=j.id)
      INNER JOIN rack AS K ON(a.rack_id=k.id)
      WHERE  a.id = '$id'
       ORDER BY a.name;";
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
    <link href="css/style_add_product.css" rel="stylesheet" type="text/css" />
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
        <div class="logo">Control <span>Inventario</span></div>
        <div class="interactuar" onclick="openClose()"></div>
        <ul>


            <!-- logged in user information -->
            <?php if (isset($_SESSION['username'])) : ?>
                <li style="font-size: 22px; color:aliceblue;">Bienvenido(a): <strong style="color: red;"><?php echo $_SESSION['username']; ?></strong></li>

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

        <h1> Editar producto </h1>

        <form name="update_register" id="update_register" action="update_prod.php" class="form-horizontal" method="post" enctype="multipart/form-data">

            <section class="content">
                <div class="row">

                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <div id="load_img">
                                    <img id="uploadPreview1" width="300" height="300" src="<?php echo $row['imagen']; ?>">

                                </div>
                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input id="uploadImage1" type="file" name="file" onchange="previewImage(1);" />
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
                                        <label for="product_name" class="col-sm-2 control-label">ID</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo $row['clave']; ?>" id="id" name="id" readonly>
                                        </div>
                                        <label for="product_name" class="col-sm-2 control-label">Barcode</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo $row['bc']; ?>" id="barcode" name="barcode" readonly>
                                        </div>
                                      
                                        <label for="product_name" class="col-sm-5 control-label">Código de Compra</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="codigoCompra" name="codigoCompra" value="<?php echo $row['codigoCompra']; ?>" >
                                        </div>
                                      
                                        <label for="product_name" class="col-sm-2 control-label">Nombre</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo $row['nombre']; ?>" id="name" name="name" placeholder="Nombre del Producto" required>
                                        </div>
                                        <label for="presentation" class="col-sm-7 control-label">Unidad de medida</label>

                                        <div class="col-sm-8">
                                            <select class="form-control" name="unit_id" id="unit_id" required>
                                                <option value="<?php echo $row['uni']; ?>"><?php echo $row['unidad']; ?></option>
                                                <?php
                                                $unidad = "SELECT *  FROM unit";
                                                $dat_unid = mysqli_query($conexion, $unidad);
                                                ?>


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
                                                <option value="<?php echo $row['pack']; ?>"><?php echo $row['presen']; ?></option>
                                                <?php
                                                $pres = "SELECT *  FROM packing";
                                                $dat_pres = mysqli_query($conexion, $pres);
                                                ?>


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
                                                    <input type="number" class="form-control" id="price" value="<?php echo $row['precio']; ?>" name="price" required>
                                                </div>
                                            </div>
                                            <label for="profit" class="col-sm-2 control-label">Moneda</label>

                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select class="form-control" name="coin_id" id="coin_id" required>
                                                        <option value="<?php echo $row['mon']; ?>"><?php echo $row['moneda']; ?></option>
                                                        <?php
                                                        $moneda = "SELECT *  FROM coin";
                                                        $dat_moneda = mysqli_query($conexion, $moneda);
                                                        ?>


                                                        <?php
                                                        while ($filamoneda = mysqli_fetch_array($dat_moneda)) { ?>

                                                            <option value="<?php echo $filamoneda['id']; ?>"><?php echo $filamoneda['abreviatura']; ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <label for="product_name" class="col-sm-2 control-label">C.Maxima</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="<?php echo $row['cant1']; ?>" id="maxim" name="maxim" required>
                                            </div>
                                            <label for="product_name" class="col-sm-2 control-label">C.Minima</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="<?php echo $row['cant2']; ?>" id="minim" name="minim" required>
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
                                    <option value="<?php echo $row['cat']; ?>"><?php echo $row['categoria']; ?></option>
                                    <?php
                                    $categoria = "SELECT *  FROM category";
                                    $dat_cat = mysqli_query($conexion, $categoria);
                                    ?>


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
                                    <option value="<?php echo $row['con']; ?>"><?php echo $row['estado']; ?></option>
                                    <?php
                                    $estado = "SELECT *  FROM condi";
                                    $dat_estado = mysqli_query($conexion, $estado);
                                    ?>


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
                                        <option value="<?php echo $row['pro']; ?>"><?php echo $row['proveedor']; ?></option>
                                        <?php
                                        $proveedores = "SELECT *  FROM supplier";
                                        $datosprov = mysqli_query($conexion, $proveedores);
                                        ?>


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
                                        <option value="<?php echo $row['pla']; ?>"><?php echo $row['plant']; ?></option>
                                        <?php
                                        $planta = "SELECT *  FROM plant";
                                        $datos_planta = mysqli_query($conexion, $planta);
                                        ?>


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
                                        <option value="<?php echo $row['alma']; ?>"><?php echo $row['almacen']; ?></option>
                                        <?php
                                        $alm = "SELECT *  FROM alm";
                                        $datosalm = mysqli_query($conexion, $alm);
                                        ?>


                                        <?php
                                        while ($filalm = mysqli_fetch_array($datosalm)) { ?>
                                            <option value="<?php echo $filalm['id']; ?>"><?php echo $filalm['name']; ?></option>
                                        <?php
                                        }
                                        ?>



                                    </select>


                                </div>
                                <label for="note" class="col-sm-2 control-label">Rack</label>
                                <div class="input-group">
                                    <select class="form-control" name="rack_id" id="rack_id">
                                        <option value="<?php echo $row['rak']; ?>"><?php echo $row['ubi'], $row['line']; ?></option>
                                        <?php
                                        $alm = "SELECT *  FROM rack ";
                                        $datosalm = mysqli_query($conexion, $alm);
                                        ?>


                                        <?php
                                        while ($filalm = mysqli_fetch_array($datosalm)) { ?>
                                            <option value="<?php echo $filalm['id']; ?>"><?php echo $filalm['colum'], $filalm['linea']; ?></option>
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
                                    <input type="text" class="form-control" id="tiempoVida" name="tiempoVida" value="<?php echo $row['tiempoVida']; ?>" >
                                </div>
                                
                              
                                <div class="form-group">
                                <label for="note" class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description"><?php echo $row['descrip']; ?></textarea>
                                </div>
                            </div>


                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon">

                                    </div>

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


    <script src="app.js"></script>
    <script src="https://unpkg.com/boxicons@2.0.8/dist/boxicons.js"></script>
</body>

</html>