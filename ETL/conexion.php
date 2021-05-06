<?php
    $mysqli= new mysqli('localhost','u802508119_fernando','Transportador29','u802508119_tarifas');


  if($mysqli->connect_error){
    die('error en la conexion<br>'.$mysqli->connect_error);
  }else{
    echo "conexion correcta<br>";
  }

?>
