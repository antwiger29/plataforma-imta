<?php
function consulta(){
require_once("conexion.php");
$conexion=conexion();

$salida="";
$query = " SELECT estado.nombre_estado,municipios.nombre_municipio,años.Año,
metadato.dependencia,metadato.plataforma_consuta,estado.id,municipios.id,años.id
    FROM estado
  LEFT JOIN municipios ON municipios.estado_id = estado.id
  LEFT JOIN metadato ON metadato.municipios_id= municipios.id
  LEFT JOIN años ON metadato.años_id= años.id where metadato.años_id > 0";




$resultado=mysqli_query($conexion,$query);

if($resultado->num_rows > 0){
$salida.="<table class='table table-striped '>
  <thead>
    <tr>
      <td>ESTADO</td>
      <td>MUNICIPIO</td>
      <td>AÑO</td>
      <td>DEPENDENCIA</td>

      <td>ENLACE</td>
    </tr> </thead> <tbody>";


while ($fila =mysqli_fetch_row($resultado)) {
  $salida.="<tr>
    <td>".$fila[0]."</td>
    <td>".$fila[1]."</td>
    <td>".$fila[2]."</td>
    <td>".$fila[3]."</td>
    <td><form class='form-horizontal' role='form' action='tarifas.php' method='post'>
      <input id='lista1' style='display: none;' type='text' name='lista1'value='".$fila[5]."'>
      <input id='lista2'style='display: none;' type='text' name='lista2'value='".$fila[6]."'>
      <input id='lista3' style='display: none;' type='text' name='lista3'value='".$fila[7]."'>
      <button class='btn btn-primary btn-sm active' type='submit' name='button'>  <span class='icon-search'></span> Ver</button>
    </form> </td>
  </tr>";

}
$salida.="</tbody>
</table>";

}else {
  $salida="No hay dato";
}

echo $salida;
}
?>
