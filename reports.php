<?php
include('auth_session.php');
include('session_expire.php');
include('conexion.php');

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
    <link rel="stylesheet" type="text/css" href="js/filtergrid.css" media="screen" />
    <link href="css/style_reports.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/tablefilter.js"></script>
    <link rel="stylesheet" href="vendor/components/flag-icon-css/css/flag-icon.min.css">
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

    <div class="conteiner" id="container">
        <form method="POST">
            
            <div class="btn-group pull-right">
                <span class="input-group-text">Item:</span><input type="text" class="form-control" id="item" name="delay" placeholder="Buscar..." autofocus required>
                
                <select class="form-control" id="proveedor" name="proveedor" required>
                                <?php
                                $proveedores = "SELECT *  FROM supplier";
                                $datosprov = mysqli_query($conexion, $proveedores);
                                ?>
                                <option value=" " selected> Proveedor</option>

                                <?php
                                while ($filaprov = mysqli_fetch_array($datosprov)) { ?>
                                    <option value="<?php echo $filaprov['id']; ?>"><?php echo $filaprov['company']; ?></option>
                                <?php
                                }
                                ?>



                            </select>
                <button name="buscar" id="buscar" class="btn btn-warning" type="submit"><i class='fa fa-search'></i></button>

            </div>
            <div>
                <h1>Reporte</h1>
            <div >
            <a class="btn btn-info" href="export_movimientos.php">Descargar Movimientos <i class="fa fa-file-excel"></i></a>
            <a class="btn btn-primary" href="export_existencias.php">Descargar Existencias-PL1 <i class="fa fa-file-excel"></i></a>
            <a class="btn btn-primary" href="export_totales.php">Descargar Total-Existencias <i class="fa fa-file-excel"></i></a>
            <a class="btn btn-info" href="export_productos.php">Descargar Productos <i class="fa fa-file-excel"></i></a>
            <a class="btn btn-info" href="reportspl2.php">PL2 <i class="fa fa-external-link" aria-hidden="true"></i></a>
            </div>
            </div>


            
            <table class="table table-striped table-hover">

                <thead>

                    <tr>

                        <th>Fecha</th>
                        <th>Folio</th>
                        <th>Operacion</th>
                        <th>Articulo</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Proveedor</th>
			<th>Solicito</th>
                     



                    </tr>
                </thead>
                <tbody>

                    <?php
                    require "conexion.php";
                    if (isset($_POST['buscar'])) {
                        $date1 = $_POST['delay'];
                        $prov = $_POST['proveedor'];
                        

                        $consultaSQL = mysqli_query($conexion, "SELECT  tab9.id AS prod,tab9.barcode AS bc,tab9.name AS arti,tab7.name AS tipo,tab2.folio AS foli,tab3.company as prov,tab8.name AS detalle,tab1.cuantifity AS cant,tab1.price AS precio,tab2.created_at AS fecha,tab5.name AS solicito
                    FROM inventary AS tab1
                    INNER JOIN operation AS tab2 ON(tab1.operation_id=tab2.id)
                    INNER JOIN product AS tab9 ON(tab1.product_id=tab9.id)
                    INNER JOIN supplier AS tab3 ON(tab2.supplier_id=tab3.id)
                    INNER JOIN alm AS tab4 ON(tab2.alm_id=tab4.id)
                    INNER JOIN department AS tab5 ON(tab2.department_id=tab5.id)
                    INNER JOIN plant AS tab6 on(tab2.planta_id=tab6.id)
                    INNER JOIN operation_type AS tab7 ON(tab1.operation_type_id=tab7.id)
                    INNER JOIN detail_operation AS tab8 ON(tab2.detail_id=tab8.id)
                    WHERE tab1.product_id LIKE '%".$date1."%' OR tab9.barcode LIKE '%".$date1."%'  AND tab3.id = '$prov'");
                    
                        while ($fetch = mysqli_fetch_array($consultaSQL)) {
                            if($fetch == TRUE){
                    ?>

                            <tr>

                                <td><?php echo $fetch['fecha'] ?></td>
                                <td><?php echo $fetch['foli'] ?></td>
                                <td><?php echo $fetch['tipo'] ?></td>
                                <td><?php echo $fetch['arti'] ?></td>
                                <th><?php echo $fetch['cant'] ?></th>
                                <th><?php echo $fetch['precio'] ?></th>
                                <th><?php echo $fetch['prov'] ?></th>
				<th><?php echo $fetch['solicito'] ?></th>



                            </tr>
                    <?php
                        }
                        else {
                    
                    
                        echo ' <tr><td colspan = "7"><center>No Existen Registros </center></td></tr>';
                        }
                    }
                    }
                    ?>



                </tbody>
            </table>


        </form>




    </div><!-- // End #container -->



</body>
<script>
        $.fn.delayPasteKeyUp = function(fn, ms) {
            var timer = 0;
            $(this).on("propertychange input", function() {
                clearTimeout(timer);
                timer = setTimeout(fn, ms);
            });
        };

        //la utilizamos
        $(document).ready(function() {
            $("#clave").delayPasteKeyUp(function() {
                $("#respuesta").append("Producto registrado: " + $("#clave").val() + "");
                $("#clave").val("");
            }, 200);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
                if (e.keyCode == 13) {
                    e.preventDefault();
                }
            }))
        });
    </script>
    <script src="openClose.js"></script>

</html>