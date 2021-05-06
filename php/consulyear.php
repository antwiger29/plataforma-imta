<?php

require_once("conexion.php");
$conexion=conexion();

if (isset($año)) {
  $año=$_POST['año'];
}


$sql2="SELECT id, Año FROM años";
$result2=mysqli_query($conexion,$sql2);
$cadena2="<select required id='lista3' name='lista3' class='form-control'><option value=''>AÑO</option>";
while ($mostrar2=mysqli_fetch_row($result2)) {

  $cadena2=$cadena2.'<option value='.$mostrar2[0].'>'.$mostrar2[1].'</option>';

}
echo $cadena2."</select>";


 ?>
