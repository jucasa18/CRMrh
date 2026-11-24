<?php
include('header.php');
//include ('acciones/ins/Empleados.php'); 
include 'acciones/ins/Paradas.php'; 
$idruta = $_REQUEST['idruta'];
$lisParadas  = Paradas::listaParadas($idruta);
$nombreRuta  = Paradas::nombreRuta($idruta);
?>


<main id="main" class="main">

<div class="pagetitle">
  <h1>Paradas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
      <li class="breadcrumb-item active">Rutas</li>
      <li class="breadcrumb-item active">Paradas</li>
      
    
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839; color: #ffffff;"> 
            <h5 class="card-title" style="color: #ffffff;">Lista de Paradas.  <a href="#" data-bs-target="#modalinsert" data-bs-toggle="modal" data-bs-whatever="insert"  ><i class='bi bi-plus-square' style="color: #ffffff; font-size: 30px; float: right; padding-right: 15px;"></i></a> </h5>
           

</button>
        </div>
    <!--Inicio-->                                                               
        <div class=""   style="  padding: 30px;" > 
        <div class="table-responsive-xxl">
        <table id="example" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <tr>
                <th style="text-align: center;">Id</th>
                <th style="text-align: center;">Ruta</th>
                <th style="text-align: center;">Parada</th>
                <th style="text-align: center;">Estatus</th>
                <th style="text-align: center;">Editar</th>
                <th style="text-align: center;">Eliminar</th>
                

            </tr>
        </thead>
        <tbody>
		<?php
		//foreach ($resultado as $a_ => $infoRec) {
            foreach ($lisParadas as $a_ => $infoRec) {
			?>
            <tr style="font-weight: lighter;">
               
                <th style="text-align: center; font-weight: 600;  " id="idrm"><?php echo $infoRec['id']; ?></th>
                <th style="text-align: center; font-weight: 600; "><?php echo $nombreRuta['nombre'] ?></th>
                <th style="text-align: center; font-weight: 600; "><?php echo $infoRec['nombre']; ?></th>
                <th style="text-align: center; font-weight: 600; ">
                    <?php $op3= 0; if($infoRec['Estatus'] == '1'){ $op3 = 1; $opt3 = 'Activo'; }else{$op3 = '2'; $opt3 = 'Baja';} ?>               
                    <?php echo $opt3 ?>
                </th>
                <th style="text-align: center; color:red;"><a href="#"  data-bs-target="#editaparadas" data-bs-toggle="modal"  data-bs-whatever="<?php echo $infoRec['id']; ?>" class="btn btn-secondary" ><i class='bi bi-pencil-fill' style="font-size: 18px;"></i></a></th>
                <th style="text-align: center;"><button type="button" class="btn btn-danger" value='<?php echo $infoRec['id']; ?>' name="idelimina" id="idelimina" onclick="eliminaParada('<?php echo $infoRec['id']; ?>');"><i class='bi bi-trash-fill'></i></button></th>
            </tr>
		<?php } ?>

        </tbody>
    </table>
        </div>

<!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>-->
<!-- Modal -->
<div class="modal fade" id="modalinsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edita los datos.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="needs-validation" novalidate id="nuevaParada">
                    <div class="row">
                        <div class="card info-card customers-card">
                                <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
                                    <h5 class="card-title" style="color: #ffffff;">Nueva Parada</h5>
                                </div>
                                <!--Inicio-->
                                <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
                                    <div class="input-group mb-1 ">
                                        <div class="col-md-12 mb-2 px-md-3">
                                            <label for="validationCustom03">Nombre de la Parada</label>
                                            <input type="hidden" class="form-control" id="idruta" name="idruta" value="<?php echo $idruta; ?>" required>
                                            <input  type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce el Nombre" required>
                                    
                                            <!--fin-->
                                        </div>
                                    </div>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-dark" type="submit" id="agregar">Agregar Parada</button>
                        </div>
                    </div>
                       
                </form>
      </div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>

              
        </div>
        <!--fin-->


<div class="modal fade" id="editaparadas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edita los datos. </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  	  <div id="ajaxcont" class="modal-body">

                <form class="needs-validation" novalidate id="editaParada">
                    <div class="row">
                        <div class="card info-card customers-card">
                                <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
                                    <h5 class="card-title" style="color: #ffffff;">Paradas</h5>
                                </div>
                                <!--Inicio-->
                                <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 30px;" > 
                                    <div class="input-group mb-1 ">
                                        <div class="col-md-12 mb-2 px-md-3">
                                            <label for="validationCustom03">Nombre de la Parada</label>
                                            <input type="hidden" class="form-control" id="idruta" name="idruta" value="<?php echo $idruta; ?>" required>
                                            <input type="hidden" class="form-control" id="id" name="id" required>
                                            <input  type="text" class="form-control" id="nombrer" name="nombrer" required>
                                            <label for="validationCustom03">Estatus</label>
                                            
                                            <select name="Estatus" id="Estatus" class="form-control">
                                              <!--  <option value='<?php echo $lisEmp['Infonavit'];?>'><?php echo $lisEmp['Infonavit'];?></option> -->
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                    
                                            <!--fin-->
                                        </div>
                                    </div>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-dark" type="submit" id="botonenviar2">Guardar</button>
                        </div>
                    </div>
                       
                </form>

    </div>
  </div>
</div>



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

function eliminaParada(id){	
    var mensaje;
    var opcion = confirm("¿Deseas eliminar la Parada?");
    if (opcion == true) {
        var datos = 'idParada='+id;
           $.ajax({
                type: 'POST',
                url: 'acciones/ajax/eliminarParada.php',
                data: datos,
                dataType: 'json',
                success:  function (datos){ 
                        console.log(datos);
                        alert(datos.mensaje);
                        location.reload();
                }
            });
  
    }
}





/*('#insert').on('show.bs.modal', function (event) {
    alert(entro);
// var button = $(event.relatedTarget) // Button that triggered the modal
 // var recipient = button.data('whatever') // Extract info from data-* attributes
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-whatever')
  alert(recipient);
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
 //var parametros="?idCita="+recipient;
  $.ajax({
				//data:  parametros,
			    //url:   _global_ruta+'modulos/clinica/citas/editar/?idCita='+recipient,
				url:   _global_ruta+'modulos/clinica/citas/editar/?idCita='+recipient,
                type:  'post',
                beforeSend: function () {
                        $("#ajaxcont").html("</br></br></br></br>Procesando, Espere por favor...");
                },
                success:  function (response) {
						//alert(response);
                        $("#ajaxcont").html(response);
                }  
        });
  var modal = $(this)    
  //modal.find('.modal-title').text('Reagendando cita...' + recipient)
	
  //modal.find('.modal-body input').val(recipient)
	
	
})*/


var exampleModal = document.getElementById('editaparadas')
exampleModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-whatever')
        $.ajax({
            url: 'acciones/ajax/seleccionaParada.php?id='+recipient,
            type: 'post',
            dataType: 'json',
            success:function(datos){
                // alert(datos.nombre);
                exampleModal.querySelector('#id').value = datos.idr;
                exampleModal.querySelector('#nombrer').value = datos.nombre;
                if(datos.estatus = 1){
                        var text = 'Activo';
                }else{
                        var text = 'Inactivo';
                }
                $("#Estatus").append("<option value='"+datos.estatus+"' selected >"+ text +"</option>");
            }
        });
    var modalTitle = exampleModal.querySelector('.modal-title')
    // var modalBodyInput = exampleModal.querySelector('.modal-body input')
    // modalTitle.textContent = 'Edita la Ruta. ' + recipient
    // modalBodyInput.value = recipient
})

$(document).ready(function(){
    $('#nuevaParada').on('submit',function(e){
       // alert("entro");
        
       /* var idr2 = $("#idr2").val();
        console.log(idr2);
        alert(idr2);*/
        var  dator = $(this).serialize();
            console.log(dator);
                    //    alert(dator);
                $.ajax({
                       url:   'acciones/ajax/guardarNuevaParada.php',
                       type: 'post',
                       dataType: 'json',
                       data: dator,
                      success:  function (datos){ 
                        console.log(datos);
                        alert(datos.mensaje);
                       // window.location.href= 'Paradas.php';
                       location.reload();
                      }
                });
        });
  });

  $(document).ready(function(){
    $('#editaParada').on('submit',function(e){
        //alert("entro");
        var  dator = $(this).serialize();
        console.log(dator);
      //  alert(dator);
                $.ajax({
                       url:   'acciones/ajax/editaParada.php',
                       type: 'post',
                       dataType: 'json',
                       data: dator,
                       success:  function (datos){ 
                            console.log(datos);
                            alert(datos.mensaje);
                           // window.location.href= 'paradas.php';
                           location.reload();
                      }
                });
        });
  });

</script>
