<?php
    include('header.php');
    include 'acciones/ins/Empleados.php'; 
    $lisEmplAct  = Empleados::listaEmpleadosActivos();
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Empleados</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Empleados</li>
          <li class="breadcrumb-item active">Lista Empleados</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  <div class="card info-card customers-card">
        <div class="card-body" style="background-color: #2B8839;">
            <h5 class="card-title" style="color: #ffffff;">Lista de Empleados</h5>
        </div>
    <!--Inicio-->
        <div class=""   style="  padding: 30px;" style="width:90%;" > 
        <div class="table-responsive-xxl">
        <table id="example" class="display" style="width:100%; font-size: 13px;" >
        <thead>
            <tr>
                <th>Id</th>
                <th>Planta</th>
                <th>Nombre</th>
                <th>CURP</th>
                <th>Tipo Nomina</th>
                <th>Estatus</th>
               <!-- <th>Recomendación</th>-->
                <th>Contratos</th>
                 <th>Ubicación</th>
                <th>Eliminar</th>
                

            </tr>
        </thead>
        <tbody>
		<?php
		     foreach ($lisEmplAct as $a_ => $infoRec) {
		?>
            <tr style="font-weight: lighter;">
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdPlanta']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP']; ?> <?php echo $infoRec['ApellidoM']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Curp']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nomina']; ?></th>
                <th style="text-align: center; " class="form-control">
                    <select style="text-align: center; " name="estatus<?php echo $infoRec['IdDRENC']; ?>" id="estatus<?php echo $infoRec['IdDRENC']; ?>" class="form-control" onchange="cambiaEstatus('<?php echo $infoRec['IdDRENC']; ?>','estatus<?php echo $infoRec['IdDRENC']; ?>');">
                        <option <?php $op3= 0; if($infoRec['Estatus'] == '1'){ $op3 = 1; $opt3 = 'Activo'; }else{$op3 = 2; $opt3 = 'Baja';} ?> value='<?php echo $op3;?>'><?php echo $opt3;?></option>
                        <option value="1">Activo</option>
                        <option value="0">Baja</option>
                    </select>
                </th>
                <th style="text-align: center; color:red;"> <a href="html2/contrato.php?idempleado=<?php echo $infoRec['IdDRENC']; ?>" class="btn btn-secondary"  target="_blank" ><i class='bi bi-file-earmark-pdf-fill' style="font-size: 18px;"></i></a></th>
                <!-- VER UBICACIÓN EN GOOGLE MAPS -->
                <th style="text-align: center;">
                            <?php if (
                                isset($infoRec['Latitud'], $infoRec['Longitud']) &&
                                is_numeric($infoRec['Latitud']) &&
                                is_numeric($infoRec['Longitud'])
                            ): ?>

                                <button type="button"
                                    class="btn btn-primary"
                                    onclick="abrirMapaEmpleado(
                                        <?php echo (float)$infoRec['Latitud']; ?>,
                                        <?php echo (float)$infoRec['Longitud']; ?>
                                    )"
                                    title="Ver ubicación del empleado">

                                    <i class="bi bi-geo-alt-fill"></i>
                                </button>

                            <?php else: ?>

                            <button type="button"
                                class="btn btn-secondary"
                                disabled
                                title="Ubicación no registrada">

                                <i class="bi bi-geo-alt"></i>
                            </button>

                        <?php endif; ?>
                            </th>
                
                <th><button type="button" class="btn btn-danger" value='<?php echo $infoRec['IdDRENC']; ?>' name="idelimina" id="idelimina" onclick="eliminaEmpleado('<?php echo $infoRec['IdDRENC']; ?>');"><i class='bi bi-trash-fill'></i></button></th>
            </tr>
		<?php } ?>

        </tbody>
    </table>

        </div>  

    <div class="modal fade" id="recomendaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Busca al empleado. </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  	  <div class="modal-body">

                <form class="needs-validation" novalidate id="editaRuta">
                    <div class="row">
                        <div class="card info-card customers-card">
                                <div class="card-body" style="background-color: #2B8839; color: #ffffff;">
                                    <h5 class="card-title" style="color: #ffffff;">Recomendaciones</h5>
                                </div>
                                <!--Inicio-->
                                <div class="col-xxl-12 col-xl-12"   style="background-color: #ffffff;  padding: 8px;" > 
                                    <div class="input-group mb-1 ">
                                        <div class="col-md-12 mb-2 px-md-3">
                                           <!-- <input type="hidden" class="form-control" id="id" name="id" required>-->
                                            <input type="hidden" class="form-control" id="IdDRENC2"  name="IdDRENC2"  placeholder="IdDRENC2" value="">
                                           
                                            <!--fin-->
                                        </div>
                                    </div>
                                </div>
                                <div id="ajaxcont">



                                </div>
                     
                    </div>
                       
                </form>

    </div>
  </div>
</div>
              
        </div>
        <!--fin-->




            </main>

         
<!-- Modal para mostrar la ubicación del empleado -->
<div class="modal fade" id="modalMapa" tabindex="-1"
     aria-labelledby="tituloMapa" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="tituloMapa">
                    <i class="bi bi-geo-alt-fill"></i>
                    Ubicación del empleado en México
                </h5>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div id="mapaMexico"
                     style="width:100%; height:550px;"></div>
            </div>

        </div>
    </div>
</div>
  


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
            "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
            order: [[0, 'desc']]
       
    });
});

function eliminaEmpleado(id){	

    var mensaje;
    var opcion = confirm("¿Deseas eliminar al empleado?");
    if (opcion == true) {
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
	} else {
	    
	}
  
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

var exampleModal = document.getElementById('recomendaciones')
exampleModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;

if (!button) {
    return;
}

var recipient = button.getAttribute('data-bs-whatever');
          $.ajax({
            url: 'recomendadores.php',
            type: 'post',
            success:function(datos){
                 exampleModal.querySelector('#IdDRENC2').value = recipient;
                $("#ajaxcont").html(datos);
            }
        });
    var modalTitle = exampleModal.querySelector('.modal-title')
 })

function agregarecomendacion(idem,fingreso){
        var idnu = document.getElementById("IdDRENC2").value;
        var  dator = 'idnuevo='+ idem +'&idrenc=' + idnu +'&fingreso='+ fingreso ;
        console.log(dator);
                $.ajax({
                     url:   'acciones/ajax/guardarNuevaRecomendacion.php',
                     type: 'post',
                     dataType: 'json',
                     data: dator,
                     success:  function (datos){ 
                          console.log(datos);
                         alert(datos.mensaje);
                          window.location.href= 'empleados.php';
                    }
              });

}
</script>

<style>
    /*Estilos para el modal del mapa de Google  */
#modalMapa .modal-dialog {
    width: 90%;
    max-width: 1100px;
    margin: 1.75rem auto;
}

#modalMapa .modal-content {
    width: 100%;
    min-height: 600px;
}

#modalMapa .modal-body {
    width: 100%;
    min-height: 550px;
    padding: 10px;
}

#mapaMexico {
    width: 100% !important;
    height: 550px !important;
    min-height: 550px !important;
    position: relative !important;
    display: block !important;
    background: #eaf0e8 !important;
    overflow: hidden !important;
}

</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
</script>
<script>
    //Funciones con la appi de Google, para mostrar el mapa
let mapaMexico = null;
let marcadorEmpleado = null;
let capaEstados = null;
let datosEstados = null;
// Comprobar si un punto está dentro de un polígono
function puntoEnAnillo(punto, anillo) {

    const x = punto[0];
    const y = punto[1];

    let dentro = false;

    for (
        let i = 0, j = anillo.length - 1;
        i < anillo.length;
        j = i++
    ) {
        const xi = anillo[i][0];
        const yi = anillo[i][1];

        const xj = anillo[j][0];
        const yj = anillo[j][1];

        const intersecta =
            ((yi > y) !== (yj > y)) &&
            (x < (xj - xi) * (y - yi) / (yj - yi) + xi);

        if (intersecta) {
            dentro = !dentro;
        }
    }

    return dentro;
}

// Comprobar si el punto está dentro de un estado
function puntoEnGeometria(punto, geometria) {

    if (geometria.type === 'Polygon') {

        const anillos = geometria.coordinates;

        if (!puntoEnAnillo(punto, anillos[0])) {
            return false;
        }

        // Excluir huecos interiores
        for (let i = 1; i < anillos.length; i++) {
            if (puntoEnAnillo(punto, anillos[i])) {
                return false;
            }
        }

        return true;
    }

    if (geometria.type === 'MultiPolygon') {

        return geometria.coordinates.some(poligono => {

            if (!puntoEnAnillo(punto, poligono[0])) {
                return false;
            }

            for (let i = 1; i < poligono.length; i++) {
                if (puntoEnAnillo(punto, poligono[i])) {
                    return false;
                }
            }

            return true;
        });
    }

    return false;
}

// Obtener nombre del estado
function obtenerNombreEstado(feature) {

    const propiedades = feature.properties || {};

    return (
        propiedades.NOMGEO ||
        propiedades.NOMBRE ||
        propiedades.name ||
        propiedades.NOM_ENT ||
        propiedades.ENTIDAD ||
        propiedades.nom_ent ||
        'Estado de México'
    );
}

// Abrir mapa del empleado
async function abrirMapaEmpleado(latitud, longitud) {

    const lat = parseFloat(latitud);
    const lng = parseFloat(longitud);

    const modalElemento = document.getElementById('modalMapa');

    if (!modalElemento) {
        console.error('No existe el modal del mapa');
        return;
    }

    if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
        alert('Coordenadas incorrectas');
        return;
    }

    document.body.appendChild(modalElemento);

    const modal = bootstrap.Modal.getOrCreateInstance(modalElemento);

    const iniciarMapa = async function () {

        const contenedor = document.getElementById('mapaMexico');

        try {

            // Crear el mapa solamente una vez
            if (!mapaMexico) {

                mapaMexico = L.map(contenedor, {
                    zoomControl: true,
                    attributionControl: true,
                    minZoom: 4,
                    maxZoom: 12
                });

                // Descargar los límites estatales
                if (!datosEstados) {

                    const respuesta = await fetch(
                        './assets/geojson/estados_mexico.geojson'
                    );

                    if (!respuesta.ok) {
                        throw new Error(
                            'No se pudo cargar el archivo GeoJSON'
                        );
                    }

                    datosEstados = await respuesta.json();
                }

                // Dibujar los 32 estados
                capaEstados = L.geoJSON(datosEstados, {

                    style: function () {
                        return {
                            color: '#526b58',
                            weight: 1.5,
                            opacity: 1,
                            fillColor: '#dce9dc',
                            fillOpacity: 0.85
                        };
                    },

                    onEachFeature: function (feature, layer) {

                        const nombre = obtenerNombreEstado(feature);

                        layer.bindTooltip(nombre, {
                            sticky: true
                        });

                    }

                }).addTo(mapaMexico);

                // Ajustar el mapa al territorio mexicano
                const limites = capaEstados.getBounds();

                mapaMexico.fitBounds(limites, {
                    padding: [15, 15]
                });

                mapaMexico.setMaxBounds(limites.pad(0.10));

            }

            // Identificar el estado correspondiente a las coordenadas
            let estadoEncontrado = null;

            capaEstados.eachLayer(function (layer) {

                const geometria = layer.feature.geometry;

                const pertenece = puntoEnGeometria(
                    [lng, lat],
                    geometria
                );

                if (pertenece) {

                    estadoEncontrado = layer;

                    layer.setStyle({
                        color: '#a61b1b',
                        weight: 3,
                        fillColor: '#ffb347',
                        fillOpacity: 0.9
                    });

                } else {

                    layer.setStyle({
                        color: '#526b58',
                        weight: 1.5,
                        fillColor: '#dce9dc',
                        fillOpacity: 0.85
                    });

                }

            });

            // Colocar o actualizar marcador
            if (!marcadorEmpleado) {

                marcadorEmpleado = L.marker([lat, lng])
                    .addTo(mapaMexico);

            } else {

                marcadorEmpleado.setLatLng([lat, lng]);

            }

            marcadorEmpleado.bindPopup(
                estadoEncontrado
                    ? 'Estado: ' +
                      obtenerNombreEstado(estadoEncontrado.feature)
                    : 'Ubicación del empleado'
            );

            // Centrar el mapa en el empleado sin perder México
            mapaMexico.invalidateSize(true);

            if (estadoEncontrado) {
                mapaMexico.fitBounds(
                    capaEstados.getBounds(),
                    { padding: [15, 15] }
                );
            }

            mapaMexico.setMaxBounds(capaEstados.getBounds().pad(0.10));

            marcadorEmpleado.openPopup();

        } catch (error) {

            console.error('Error al mostrar el mapa:', error);

            alert(
                'No se pudo cargar el mapa de México. ' +
                'Verifica el archivo estados_mexico.geojson.'
            );

        }
    };

    modalElemento.addEventListener(
        'shown.bs.modal',
        iniciarMapa,
        { once: true }
    );

    modal.show();
}


</script>