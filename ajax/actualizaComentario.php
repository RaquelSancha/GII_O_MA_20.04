<?php
$descrNueva = $_POST['descripcionNueva'];
$id = $_POST['idTabla'];
$sqli = 'UPDATE variable SET Descripcion = .$descrNueva. WHERE idVariable = .$id. ;';
consqli($sqli);
?>