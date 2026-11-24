<?php
include ('auth_session.php');
include('session_expire.php');
require 'conexion.php';

$id = $_GET['id'];

$sql = "SELECT a.id AS clave,a.barcode AS bc,a.ruta_image AS imagen,a.name AS nombre,a.description AS descrip,d.name AS categoria,a.price AS precio,
    h.abreviatura AS moneda,c.name AS almacen,b.abreviatura as unidad,g.name AS almacen,e.name as estado,i.name AS presen,
    e.name AS estado,j.company as proveedor FROM product AS a 
      INNER JOIN unit AS b ON (a.unit_id=b.id) 
      INNER JOIN alm AS c ON (a.alm_id=c.id)
      INNER JOIN category as d ON(a.category_id=d.id)
      INNER JOIN condi as e ON (a.condi_id=e.id)
      INNER JOIN plant as g ON (a.plant_id=g.id)
      INNER JOIN coin as h ON(a.coin_id=h.id)
      INNER JOIN packing as i ON(a.packing_id=i.id)
      INNER JOIN supplier as j ON(a.supplier_id=j.id)
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
    <link href="css/barcode_style.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendor/driftyco/ionicons/css/ionicons.css">
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


            
       

        </ul>
        <label for="check" class="bar">
            <i class='bx bx-menu' id="open"></i>
            <i class="fas fa-times" id="close"></i>
        </label>
    </nav>
    <!-- // #container -->
    <div class="conteiner" id="container">

        <h1>producto </h1>

        <form method="post" class="barcode">

            <section class="content">
                <div class="row">


                    <div class="col-md-6">


                        <div class="nav-tabs-custom">

                            <div class="tab-content">
                                <div id="resultados_ajax"></div>



                                <div class="tab-pane active" id="details">



                                    <div class="form-group">
                                        <label for="product_name" class="col-sm-2 control-label">ID</label>

                                        <div class="col-sm-28">
                                            <input type="text" class="form-control" value="<?php echo $row['clave']; ?>" disabled>
                                        </div>
                                        <label for="product_name" class="col-sm-2 control-label">Nombre</label>

                                        <div class="col-sm-30">
                                            <input type="text" class="form-control" value="<?php echo $row['nombre']; ?>" disabled>
                                        </div>
                                        <label for="product_name" class="col-sm-2 control-label">Categoria</label>

                                        <div class="col-sm-18">
                                            <input type="text" class="form-control" value="<?php echo $row['categoria']; ?>" disabled>
                                        </div>
                                        <label for="product_name" class="col-sm-2 control-label">Codigo:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="barcode_text" value="<?php echo $row['bc']; ?>" disabled>

                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.col -->

                    <div class="col-md">
                        <div class="form-group">



                            <?php
                            require  'vendor/autoload.php';

                            use Picqer\Barcode\BarcodeGeneratorPNG;


                            
                                $text = $row['bc'];
                                $generador = new  Picqer\Barcode\BarcodeGeneratorPNG();
                                $tipo = $generador::TYPE_CODE_128;
                                $imagen = $generador->getBarcode($text, $tipo);
                                $nombreArchivo = "codigo_de_barras.png";
                                $bytesEscritos = file_put_contents($nombreArchivo, $imagen);


                            ?>
                                <div id="imp1">
                                    <div>

                                        <label for="product_name" class="col-sm-2 control-label">Producto:<?php echo $text ?></label>
                                    </div>
                                <?php
                                echo '<img src="data:image/png;base64,' . base64_encode($imagen) . '">';
                            
                                ?>
                               
                                </div>
                                <div>
                                  <button type="button" onclick="javascript:imprim1(imp1);">Imprimir</button>  
                                </div>
                                 

                        </div>
                        
                        <script>
                            function imprim1(imp1) {
                                var printContents = document.getElementById('imp1').innerHTML;
                                w = window.open();
                                w.document.write(printContents);
                                w.document.close(); // necessary for IE >= 10
                                //w.focus(); // necessary for IE >= 10
                                w.print();
                                w.close();
                                return true;
                           
                            }
                        </script>







                    </div>
                </div>
            </section>





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