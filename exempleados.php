<?php
include('header.php');
include 'acciones/ins/Empleados.php'; 
$lisExe  = Empleados::listaEmpleadosInactivos();
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Ex-Empleados</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
      <li class="breadcrumb-item active">Empleados</li>
      <li class="breadcrumb-item active">Ex-Empleados</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<div class="card" >
          
        <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
            <h5 class="card-title" style="color: #ffffff;">Lista de Empleados Inactivos </h5>
        </div>
    <!--Inicio-->
        <div class=""   style="  padding: 30px;" > 
        <div class="table-responsive-xxl">

        <table id="example" class="display table" style="width:100%; font-size: 13px;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Planta</th>
                <th>Nombre</th>
                <th>CURP</th>
                <th>Puesto</th>
                <th>Departamento</th>
                <th>Tipo Nomina</th>
                <th>Estatus</th>
                
                <th>C. Renuncia</th>
                <th>Editar</th>
                <th>Eliminar</th>
                

            </tr>
        </thead>
        <tbody>
		<?php
		foreach ($lisExe as $a_ => $infoRec) {
			?>
            <tr style="font-weight: lighter;">
               
            <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdPlanta']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP'] ?> <?php echo $infoRec['ApellidoM'] ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Curp']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Puesto']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Depto']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nomina']; ?> </th>
                <th>
                    <select style="text-align: center; "  name="estatus<?php echo $infoRec['IdDRENC'] ?>" id="estatus<?php echo $infoRec['IdDRENC'] ?>" class="form-control" onchange="cambiaEstatus('<?php echo $infoRec['IdDRENC']; ?>','estatus<?php echo $infoRec['IdDRENC']; ?>');" >
                    <option <?php $op3= 0; if($infoRec['Estatus'] == '1'){ $op3 = 1; $opt3 = 'Activo'; }else{$op3 = 2; $opt3 = 'Baja';} ?> value='<?php echo $op3;?>'><?php echo $opt3;?></option>
                        <option value="1">Activo</option>
                        <option value="0">Baja</option>
                    </select>
                
                    
                </th>
                <th style="text-align: center; color:red;"> <a href="html2/cartaRenuncia.php?idempleado=<?php echo $infoRec['IdDRENC']; ?>" class="btn btn-secondary"  target="_blank" ><i class='bi bi-file-earmark-pdf-fill' style="font-size: 18px;"></i></a></th>
                <th> <a href="edit_employee.php?idempleado=<?php echo $infoRec['IdDRENC']; ?>" class="btn btn-secondary" ><i class='bi bi-pencil-fill' ></i></a></th>
                <th><button type="button" class="btn btn-danger" value='<?php echo $infoRec['IdDRENC']; ?>' name="idelimina" id="idelimina" onclick="eliminaEmpleado('<?php echo $infoRec['IdDRENC']; ?>');"><i class='bi bi-trash-fill'></i></button></th>
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
        });
});

function eliminaEmpleado(id){	
  var datos = 'idempleado='+id;
      $.ajax({
      type: 'POST',
      url: 'dalete_empleado.php',
      data: datos,
      success: function(respuesta) {
        if(respuesta=='ok'){
            alert('Empleado eliminado');
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

function cambiaEstatus(id,estatus){	
    var estatus2 = document.getElementById(estatus).value;
    var datos = 'id='+id+'&estatus='+estatus2;
    $.ajax({
      type: 'POST',
      url: 'estatus.php',
      data: datos,
      success: function(respuesta) {
        if(respuesta=='cam'){
            alert('El empleado ha cambiado de estatus.');
            window.location='empleados.php';
        }else{
            alert('inténtalo nuevamente.');
        }
    }
    });
}
</script>
