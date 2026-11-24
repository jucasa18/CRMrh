<?php
include('auth_session.php');
include('session_expire.php');
include('conexion_PDO.php');

# Cuántos productos mostrar por página
$productosPorPagina = 15;
// Por defecto es la página 1; pero si está presente en la URL, tomamos esa
$pagina = 1;
$buscar = (isset($_GET['search'])) ? $_GET['search'] : '';
$filtro = '';
$params = [];
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}


# El límite es el número de productos por página
$limit = $productosPorPagina;
# El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
$offset = ($pagina - 1) * $productosPorPagina;
# Necesitamos el conteo para saber cuántas páginas vamos a mostrar
$sentencia = $base_de_datos->query("SELECT count(*) AS conteo FROM operation ");
$conteo = $sentencia->fetchObject()->conteo;
# Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
$paginas = ceil($conteo / $productosPorPagina);

# Ahora obtenemos los productos usando ya el OFFSET y el LIMIT
$sentencia = $base_de_datos->prepare("SELECT  tab2.folio AS foli,tab2.created_at AS fecha,tab6.name AS plant,tab3.company as prov,tab7.name AS tipo,tab8.name AS detalle,tab9.id AS prod,tab9.name AS arti,tab1.cuantifity AS cant,tab4.name AS almacen,tab5.name AS solicito ,tab9.codigoCompra AS codigoCompra
FROM inventary AS tab1
INNER JOIN operation AS tab2 ON(tab1.operation_id=tab2.id)
INNER JOIN product AS tab9 ON(tab1.product_id=tab9.id)
INNER JOIN supplier AS tab3 ON(tab2.supplier_id=tab3.id)
INNER JOIN alm AS tab4 ON(tab2.alm_id=tab4.id)
INNER JOIN department AS tab5 ON(tab2.department_id=tab5.id)
INNER JOIN plant AS tab6 on(tab2.planta_id=tab6.id)
INNER JOIN operation_type AS tab7 ON(tab1.operation_type_id=tab7.id)
INNER JOIN detail_operation AS tab8 ON(tab2.detail_id=tab8.id)
ORDER by tab1.operation_id LIMIT ? OFFSET ?");
$sentencia->execute([$limit, $offset]);
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
    <link href="css/style_opetation.css" rel="stylesheet" type="text/css" />
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
            <div class="row">
                <div class="col-md-3 col-xs-5">

                    <a href="add_entrada.php" class="btn btn-primary"><img src="recursos/carrito.png" width="50" height="50"><i class='fa fa-plus'></i> Entrada</a>


                </div>
                <div class="col-md-3 col-xs-5">
                    <div class="input-group">


                        <a href="add_salida.php" class="btn btn-info"><img src="recursos/carrito.png" width="50" height="50"><i class='fa fa-minus'></i> Salida</a>


                    </div>


                    <div class="col-xs-12 ">


                    </div>
                </div>
            </div>
            <div class="col-md-10 col-xs-12">
                <div class="btn-group pull-right">
                    <span class="input-group-text"><input type="text" class="form-control" id="clave" name="delay" placeholder="Buscar..." autofocus>
                        <button class="btn btn-info" type="button" name="busqueda" id="busqueda"><i class='fa fa-search'></i></button>
                    </span>
                    <div class="btn-group pull-right">


                    </div>
                </div>
            </div>

            <h1>Listado de Movimientos</h1>
            <table class="table table-striped table-hover" id="datos">

                <thead>

                    <tr>

                        <th>Folio</th>
                        <th>Código de Compra</th>
                        <th>Fecha</th>
                        <th>Planta</th>
                        <th>Proveedor</th>
                        <th>Tipo de operación</th>
                        <th>Detalle</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Almacen</th>
                        <th>Solicito</th>


                    </tr>
                </thead>
                <tbody id="tablamovimientos">


                    <?php foreach ($productos as $producto) { ?>

                        <tr>

                            <td><?php echo $producto->foli ?></td>
                            <td><?php echo $producto->codigoCompra ?></td>
                            <td><?php echo $producto->fecha ?></td>
                            <td><?php echo $producto->plant ?></td>
                            <td><?php echo $producto->prov ?></td>
                            <td><?php echo $producto->tipo ?></td>
                            <td><?php echo $producto->detalle ?></td>
                            <td><?php echo $producto->arti ?></td>
                            <td><?php echo $producto->cant ?></td>
                            <td><?php echo $producto->almacen ?></td>
                            <td><?php echo $producto->solicito ?></td>


                        </tr>

                    <?php
                    }
                    ?>

                </tbody >
            </table>
            <nav aria-label="Page navigation" class="pagina">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">

                        <p>Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> movimientos Realizados</p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <p>Página <?php echo $pagina ?> de <?php echo $paginas ?> </p>
                    </div>
                </div>
                <ul class="pagination">
                    <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás -->
                    <?php if ($pagina > 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href="./operation.php?pagina=<?php echo $pagina - 1 ?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php } ?>

                    <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
                    <?php for ($x = 1; $x <= 3; $x++) { ?>
                        <li class="<?php if ($x == $pagina) echo "active" ?>">
                            <a class="page-link" href="./operation.php?pagina=<?php echo $x ?>">
                                <?php echo $x ?></a>
                        </li>
                    <?php } ?>
                    <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
                    <?php if ($pagina < $paginas) { ?>
                        <li class="page-item">
                            <a class="page-link" href="./operation.php?pagina=<?php echo $pagina + 1 ?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>

        </form>




    </div><!-- // End #container -->
    <script src=" https://code.jquery.com/jquery-3.6.0.js " integridad="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anónimo"></script>
    <script src="buscar_mov.js"></script>
    <script src="openClose.js"></script>
    <script src="https://kit.fontawesome.com/3bfb8be62d.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

</body>

</html>