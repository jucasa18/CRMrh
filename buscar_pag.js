$("#buscar").click(function(){
   
  var codigo = $("#clave").val();

  $.ajax({
    method:'GET',
    url: "consultarProducto.php",
    data:{codigo:codigo},
    cache: false,
    dataType:"json",
    success: function(html){
      console.log(html);
       if(html.data=='ok'){
           var cadena = '';
          if(html.productos!=''){
            var filas= html.productos.length;
           
            for (var i = 0; i < filas; i++) {
              cadena +='<tr id= "anclaregistro'+html.productos[i].id+'">';

              cadena += '<td>'+html.productos[i].clave+'</td>';
              cadena += '<td>'+html.productos[i].bc+'</td>';
              cadena += '<td>'+html.productos[i].codigoCompra+'</td>';
              cadena += '<td><img src="'+html.productos[i].image+'" width="90" height="90"></td>';
              cadena += '<td>'+html.productos[i].nombre+'</td>';
              cadena += '<td>'+html.productos[i].descrip+'</td>';
              cadena += '<td>'+html.productos[i].tiempoVida+'</td>';
              cadena += '<td>'+html.productos[i].cate+'</td>';
              cadena += '<td>'+html.productos[i].fecha+'</td>';
              cadena += '<td>'+html.productos[i].prov+'</td>';
              cadena += '<td><a class="btn btn-info" style="color: #000;" href="bc.php?id='+html.productos[i].clave+'">Barcode <img src="https://cdn.iconscout.com/icon/free/png-256/barcode-2196788-1851857.png" width="28" height="28"></td>';
              cadena += '<td><a class="btn btn-warning" style="color: #000;" href="edit_prod.php?id='+html.productos[i].clave+'">Editar 📝</a></td>';
              cadena += '<td><a class="btn btn-danger" style="color: #000;" href="eliminar_prod.php?id='+html.productos[i].clave+'">Eliminar 🗑️</a></td>';
              
 
              cadena +='</tr>';
         
            }
          
           $('#tablaproductos').html(cadena);

          }else{
              alert('Producto No Registrado');
          }

       }
    }
  });
});