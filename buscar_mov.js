$("#busqueda").click(function(){
   
  var codigo = $("#clave").val();

  $.ajax({
    method:'GET',
    url: "consultaroperaciones.php",
    data:{codigo:codigo},
    cache: false,
    dataType:"json",
    success: function(html){
      console.log(html);
       if(html.data=='ok'){
           var cadena = '';
          if(html.productos!=''){


          
          cadena +='<tr id= "anclaregistro'+html.productos[0].ident+'">';

           
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
           

           cadena +='</tr>';
          
           $('#tablamovimientos').html(cadena);

          }else{
              alert('Movimiento No encontrado');
          }

       }
    }
  });
});