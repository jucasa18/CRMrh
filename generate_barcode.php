<?php 
require  'vendor/autoload.php' ;


if(isset($_POST['generate_barcode']))
{
 $text=$_POST['barcode_text'];
$generador = new  Picqer\Barcode\BarcodeGeneratorPNG ();
// Esto generará el código de barras como salida HTML para mostrar en el navegador 
$code = $generador -> getBarcode ( $text , $generador :: TYPE_CODE_128 );
echo  "Codigo generado";
}

?>
