$(document).ready(function () {
  var select = $("#department").change(function () {

    var codigo = $("#department").val();
    $("#rack").empty();
    

    $.ajax({
      method: 'GET',
      url: "consultarack.php",
      data: { codigo: codigo },
      cache: false,
      dataType: "json",
      success: function (html) {
        console.log(html);
        if (html.data == 'ok') {
          var cadena = '';
          if (html.ubicacion != '') {


            for (var i = 0; i < html.ubicacion.length; i++) {
              //cadena = "<option value=\"" + html.ubicacion[i].id + "\">" + html.ubicacion[i].colum + html.ubicacion[i].linea + "</option>";
              $("#rack").append("<option value=\"" + html.ubicacion[i].id + "\">" + html.ubicacion[i].colum +'-'+ html.ubicacion[i].linea + "</option>")



              //$('#rack').append(cadena);
              
            }
            $('#department').change(select);
            


          } else {
            alert('No hay rack establecidos');
          }

        }
      }
    });
  });
});