
<?php
  
include 'acciones/ins/Empleados.php'; 
$idcomplemento = $_REQUEST['idcomplemento'];
$Depto= $_REQUEST['Depto'];
$lisEmplAct  = Empleados::listaEmpleadosComplemento($Depto);
?>

            <?php
            foreach ($lisEmplAct as $a_ => $infoRec) {
			?>
            <tr style="font-weight: lighter;">
               
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['IdDRENC']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['Planta']; ?></th>
                <th style="font-weight: 600; text-align: center; "><?php echo $infoRec['dep']; ?></th>
                <th style="font-weight: 600;"><?php echo $infoRec['Nombre'] ?> <?php echo $infoRec['ApellidoP']; ?> <?php echo $infoRec['ApellidoM']; ?></th>
                <th style="text-align: center;"><input type="checkbox"  class="form-check-input" name="check_lista[]" value="<?php echo $infoRec['IdDRENC']; ?>"></th>
            </tr>
		<?php } ?>

       
      