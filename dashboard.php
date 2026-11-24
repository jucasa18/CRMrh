<?php
include('auth_session.php');
include('session_expire.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href='https://unpkg.com/boxicons@2.0.8/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/3bfb8be62d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script src="calendario.js"></script>
    <script src="openClose.js"></script>
    <link rel="stylesheet" href="style2.css">


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
            <?php
            if($_SESSION['planta']!=1){
                
                //echo "<script> alert('".$_SESSION['planta']."'); </script>";
                $ruta="reportspl2.php";
                
            }else{
                $ruta="reports.php";
            
            }
            ?>
            <li>
                <a href="<?php echo $ruta; ?>"><span class="icono"><i class='bx bxs-report'></i></span>
                    <span class="texto">Reportes</span>
                </a>
            </li>
            <li>
                <a href="repProd.php"><span class="icono"><i class='bx bxs-report'></i></span>
                    <span class="texto">Cos/Prom/Almacen</span>
                </a>
            </li>
            
            <li>
                <a href="extras.php"><span class="icono"><i class='bx bxs-add-to-queue'></i></span>
                    <span class="texto">Extras</span>
                </a>

            </li>

            <li>
                <a href="employee.php"><span class="icono"><i class='bx bxs-group'></i></span>
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
        <div class="logo">Control <span>Inventario</span></a></div>
        <div class="interactuar" onclick="openClose()"></div>

        <ul>


            <!-- logged in user information -->
            <?php if (isset($_SESSION['username'])) : ?>
                </i>
                <li style="font-size: 22px; color:aliceblue;">Bienvenido(a): <strong style="color: red;"><?php echo $_SESSION['username']; ?></strong></li>

            <?php endif ?>



            <li><a href="logout.php"><img src="recursos/logout.png" width="48" height="48" /></a></li>

        </ul>
        <label for="check" class="bar">
            <i class='bx bx-menu' id="open"></i>
            <i class="fas fa-times" id="close"></i>
        </label>
    </nav>

    <div class="col-6 " id="container">

        <div id="calendario">
            <div id="anterior" onclick="mesantes()">Antes</div>
            <div id="posterior" onclick="mesdespues()">Despues</div>
            <h2 id="titulos"></h2>
            <table id="diasc">
                <tr id="fila0">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr id="fila1">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="fila2">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="fila3">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="fila4">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="fila5">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr id="fila6">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <div id="fechaactual"></div>

            <form action="#" name="buscar">

                <select name="buscames">
                    <option value="0">Enero</option>
                    <option value="1">Febrero</option>
                    <option value="2">Marzo</option>
                    <option value="3">Abril</option>
                    <option value="4">Mayo</option>
                    <option value="5">Junio</option>
                    <option value="6">Julio</option>
                    <option value="7">Agosto</option>
                    <option value="8">Septiembre</option>
                    <option value="9">Octubre</option>
                    <option value="10">Noviembre</option>
                    <option value="11">Diciembre</option>
                </select>
                AÑO
                <input type="text" name="buscaanno" maxlength="4" size="4" />

                <input type="button" value="BUSCAR" onclick="mifecha()" />
                </p>
            </form>

        </div>
        <?php
        require "conexion.php";
        $query = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM product ");
        while ($fetch = mysqli_fetch_array($query)) {
        ?>
            <div class="cuadrado">Productos:
                <center><?php echo $fetch['total'] ?><img src="recursos/prod.png" width="50" height="50" /></center>
            </div>
            <div class="alert" id="taula">
                
              
                <table class="table" id="table_alert">
                
                    <thead >
                       <th colspan="8">COMPRAS URGENTES PL1</th>
                        <tr>
                            
                            <th scope="col">Codigo</th>
                             <th scope="col">Código de Compra</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Minima</th>
                            <th scope="col" style="width: 10px;">Existencia</th>
                            <th scope="col">Tiempo de Vida</th>
                            <th scope="col">Planta</th>
                            <th scope="col">Aviso</th>
                        </tr>
                    </thead>
                    <tbody> 
                         <?php
                require 'conexion.php';

                $sql = mysqli_query($conexion,"SELECT a.id AS clave,a.barcode AS bc,a.name AS nombre,a.tiempoVida AS tiempoVida,a.codigoCompra AS codigoCompra,a.minim AS minima,(SELECT SUM(cuantifity) FROM inventary tb1 INNER JOIN operation AS tb2 ON(tb1.operation_id=tb2.id) WHERE tb1.product_id=a.id AND tb2.planta_id='1')AS suma, f.name AS planta,IF(a.minim >=((SELECT SUM(cuantifity) FROM inventary tb1 INNER JOIN operation AS tb2 ON(tb1.operation_id=tb2.id) WHERE tb1.product_id=a.id AND tb2.planta_id='1')),'Requiere Compra','No Requiere Compra')AS mensaje FROM product AS a INNER JOIN plant AS f ON (a.plant_id=f.id)");
                $array =array();
                while($fetch=mysqli_fetch_array($sql)){
                    $array[0] = $fetch['bc'];
                    $array[1] = $fetch['nombre'];
                    $array[2] = $fetch['minima'];
                    $array[3] = $fetch['suma'];
                    $array[4] = $fetch['planta'];
                    $array[5] = $fetch['mensaje'];
                    $array[6] = $fetch['tiempoVida'];
                    $array[7] = $fetch['codigoCompra'];
                    
                    if($array[5]=='Requiere Compra'){
                        
                ?>
                        <tr>
                            <th scope="row" style="background-color: gray;"><?php echo $array[0]?></th>
                            <td ><?php echo $array[7]?></td>

                            <td><?php echo $array[1]?></td>
                            <td style="color: orange;"><?php echo $array[2]?></td>
                            <td style="color: green;"><?php echo $array[3]?></td>
                            <td ><?php echo $array[6]?></td>
                            
                            <td><?php echo $array[4]?></td>
                            <td style="color: blue;"><?php echo $array[5]?></td>
                        </tr>
                     
                    </tbody>
                    <?php
                    }
                   
                }
                ?>
                </table>
            </div>
    </div>
<?php
        }
?>

</body>

</html>