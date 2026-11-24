<?php
include('header.php');
$con = mysqli_connect('localhost', 'root', '', 'rh');
$instruccion_SQL = "SELECT * FROM user WHERE is_active=1";
$resultado = mysqli_query($con, $instruccion_SQL);
?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Usuarios</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
      <li class="breadcrumb-item active">Usuarios</li>
      <li class="breadcrumb-item active">Lista Usuarios</li>
      
    
    </ol>
  </nav>
</div><!-- End Page Title -->

  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
            <h5 class="card-title" style="color: #ffffff;">Lista de Empleados. </h5>
        </div>
    <!--Inicio-->
        <div class=""   style="  padding: 30px;" > 
        <div class="table-responsive-xxl">

        <table id="example" class="display" style="width:100%; font-size: 13px;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Planta</th>
                <th>Nombre</th>
                <th>email</th>
                <th>Editar</th>
                <th>Eliminar</th>

            </tr>
        </thead>
        <tbody>
		<?php
		foreach ($resultado as $a_ => $infoRec) {
			?>
            <tr style="font-weight: lighter;">
                <th style="font-weight: 600;"><?php echo $infoRec['numEmpleado']; ?></th>
                <th style="font-weight: 600;">Planta <?php echo $infoRec['planta']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['name'] ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['email']; ?></th>
                <th> <a href="edit_user.php?id=<?php echo $infoRec['id']; ?>" class="btn btn-secondary" ><i class='bx bxs-pencil' style="font-size: 20px;"></i></a></th>
                <th><button type="button" class="btn btn-danger" value='<?php echo $infoRec['id']; ?>' name="idelimina" id="idelimina" onclick="eliminaEmpleado('<?php echo $infoRec['id']; ?>');"><i class='bx bxs-trash' style="font-size: 20px;"></i></button></th>
            </tr>
		<?php } ?>

        </tbody>
    </table>
        </div>
              
        </div>
        <!--fin-->

        </main>
<?php
    include('footer.php');
?>

   <!-- <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />-->
   <link href="css/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <script>

$(document).ready(function () {
    $('#example').DataTable({
        processing: true,
        
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            order: [[0, 'desc']]
       // serverSide: true,
       // ajax: 'ajaxtabla.php',
 
    });
});

/*
$(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    } );
} );
*/

function eliminaEmpleado(id){	
  var datos = 'iduser='+id;
      $.ajax({
      type: 'POST',
      url: 'dalete_user.php',
      data: datos,
      success: function(respuesta) {
        if(respuesta=='ok'){
            alert('Usuario eliminado');
            window.location.reload();
        }
        else {
            alert('Inténtalo Nuevamente');
        }
    }
    });
}

function updateEmpleado(id){	
  var datos = 'idempleado='+id;
      $.ajax({
      type: 'POST',
      url: 'dalete_empleado.php',
      data: datos,
      success: function(respuesta) {
        if(respuesta=='ok'){
            alert('IEmpleado eliminado');
            window.location.reload();
        }
        else {
            alert('Inténtalo Nuevamente');
        }
    }
    });
}
</script>
