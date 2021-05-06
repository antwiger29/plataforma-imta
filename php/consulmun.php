<?php
require_once("conexion.php");
$conexion=conexion();
$estado=$_POST['estado'];



$sql="SELECT id, nombre_municipio FROM municipios where estado_id='$estado'";
$result=mysqli_query($conexion,$sql);
$cadena="<select id='lista2' name='lista2' required class='form-control'><option value=''>MUNICIPIO</option>";

while ($mostrar=mysqli_fetch_row($result)) {

  $cadena=$cadena.'<option value='.$mostrar[0].'>'.$mostrar[1].'</option>';

}

echo $cadena."</select>";


 ?>
