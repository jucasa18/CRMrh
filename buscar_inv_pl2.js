function buscarempleado() {

    var codigo = $("#codigoescaneado").val();

    $.ajax({
        method: 'GET',
        url: "consultarinv.php",
        data: { codigo: codigo },
        cache: false,
        dataType: "json",
        success: function (html) {
            console.log(html);
            if (html.data == 'ok') {
                var cadena = '';
                if (html.productos != '') {
                    var filas = html.productos.length;



                    for (var i = 0; i < filas; i++) {



                        cadena += '<tr id= "anclaregistro' + html.productos[i].ident + '">';


                        cadena += '<td>' + html.productos[i].bc + '</td>';
                        cadena += '<td><img src="' + html.productos[i].imagen + '" width="90" height="90"></td>';
                        cadena += '<td>' + html.productos[i].nombre + '</td>';
                        cadena += '<td>' + html.productos[i].cate + '</td>';
                        cadena += '<td>' + html.productos[i].precio + '</td>';
                        cadena += '<td>' + html.productos[i].moneda + '</td>';
                        cadena += '<td>' + "ALM-1" + '</td>';
                        cadena += '<td>' + html.productos[i].suma + '</td>';
                        cadena += '<td>' + html.productos[i].minimos + '</td>';
                        cadena += '<td>' + html.productos[i].unidad + '</td>';
                        cadena += '<td>' + "PL-1" + '</td>';
                        cadena += '<td>' + html.productos[i].estado + '</td>';


                        cadena += '</tr>';
                    }

                    $('#items').html(cadena);

                } else {
                    alert('Producto No encontradosssssss');
                }

            }
        }
    });
};
