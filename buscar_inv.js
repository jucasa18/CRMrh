$("#busqueda").click(function(){
   
  var codigo = $("#clave").val();

  $.ajax({
    method:'GET',
    url: "consultarinv.php",
    data:{codigo:codigo},
    cache: false,
    dataType:"json",
    success: function(html){
      console.log(html);
       if(html.data=='ok'){
           var cadena = '';
          if(html.productos!=''){


          
         

          cadena += '<td>' + html.productos[0].bc + '</td>';
          cadena += '<td>' + html.productos[0].codigoCompra + '</td>';
          cadena += '<td><img src="' + html.productos[0].imagen + '" width="90" height="90"></td>';
          cadena += '<td>' + html.productos[0].nombre + '</td>';
          cadena += '<td>' + html.productos[0].tiempoVida + '</td>';
          cadena += '<td>' + html.productos[0].cate + '</td>';
          cadena += '<td>' + html.productos[0].precio + '</td>';
          cadena += '<td>' + html.productos[0].moneda + '</td>';
          cadena += '<td>' +"ALM-11"+'</td>';
          cadena += '<td>' + html.productos[0].columna +"-"+ html.productos[0].fila + '</td>';
          cadena += '<td style="color: red;">' + html.productos[0].suma + '</td>';
          cadena += '<td>' + html.productos[0].minimos + '</td>';
          cadena += '<td>' + html.productos[0].unidad + '</td>';
          if(html.productos[0].suma != null){

               cadena += '<td>' + "PL-1" + '</td>';
              } else   {
               cadena += '<td>' + "PL-2" + '</td>';}

            cadena += '<td>' + html.productos[0].estado + '</td>';
            cadena += '</tr>';
          

        
           /*
           cadena += '<td>'+html.productos[0].foli+'</td>';
           cadena += '<td>'+html.productos[0].codigoCompra+'</td>';
           cadena += '<td>'+html.productos[0].fecha+'</td>';
           cadena += '<td>'+html.productos[0].plant+'</td>';
           cadena += '<td>'+html.productos[0].prov+'</td>';
           cadena += '<td>'+html.productos[0].tipo+'</td>';
           cadena += '<td>'+html.productos[0].detalle+'</td>';
           cadena += '<td>'+html.productos[0].arti+'</td>';
           cadena += '<td>'+html.productos[0].cant+'</td>';
           cadena += '<td>'+html.productos[0].almacen+'</td>';
           cadena += '<td>'+html.productos[0].solicito+'</td>';
           */

           cadena +='</tr>';
          
           $('#tablainventario').html(cadena);

          }else{
              alert('Movimiento No encontrado');
          }

       }
    }
  });
});