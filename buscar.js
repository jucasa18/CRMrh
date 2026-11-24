$("#buscar").click(function(){
   
    var codigo = $("#item_id").val();
    $.ajax({
      method:'GET',
      url: "consultarproductos.php",
      data:{codigo:codigo},
      cache: false,
      dataType:"json",
      success: function(html){
        console.log(html);      
         if(html.data=='ok'){
             var cadena = '';
            if(html.productos!=''){

                   
             cadena +='<tr id= "anclaregistro'+html.productos[0].id+'">';
             cadena += '<td>'+html.productos[0].id+'</td>';
             cadena += '<td>'+html.productos[0].barcode+'</td>';
             cadena += '<td>'+html.productos[0].name+'</td>';
             cadena += '<td>'+html.productos[0].description+'</td>';
             cadena += '<td><input id="codigoCompra'+html.productos[0].id+'" type="text"  name="codigoCompra[]" class="form-control agregarproductoi" data-id="'+html.productos[0].id+'" value="'+html.productos[0].codigoCompra+'" readonly="readonly"> <input id="proveedor'+html.productos[0].id+'" type="hidden"  name="proveedor[]" class="form-control agregarproductoi" data-id="'+html.productos[0].id+'" value="'+html.productos[0].supplier_id +'""> </td>';
             cadena += '<td><input id="precio'+html.productos[0].id+'" type="number"  name="precio[]" step="0.01" class="form-control agregarproductoi" data-id="'+html.productos[0].id+'" value="'+html.productos[0].price+'" readonly="readonly"></td>';
             /*cadena += '<td><input id="precio" type="number"  name="precio" step="0.01" class="form-control agregarproductoi" data-id="'+html.productos[0].id+'" value="'+html.productos[0].price+'" disabled></td>';*/
             cadena += '<td><input id="cantidadp'+html.productos[0].id+'" type="number"  name="cantidadp[]" class="form-control agregarproductoi" data-id="'+html.productos[0].id+'"><input  type="hidden" name="idproducto[]" class="form-control " value="'+html.productos[0].id+'"> </td>';
             cadena += '<td id= "anclabtn_'+html.productos[0].id+'"><button data-id="'+html.productos[0].id+'" class="btn btn-danger eliminarproducto">Eliminar</button>';
             

             cadena +='</tr>';
            
             $('#tablaproductos').html(cadena);

            }else{
                alert('Producto No Registrado');
            }

         }
      }
    });
  });

$(document).on('click', '.eliminarproducto', function () {
    var id = $(this).data('id');
$('#anclaregistro'+id).remove();



});