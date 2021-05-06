<?php
  function conexion(){
    $servidor="localhost";
    $usuario='u802508119_fernando';
    $bd='u802508119_tarifas';
    $password='Transportador29';

    $conexion=mysqli_connect($servidor,$usuario,$password,$bd);
    return $conexion;
  }


 ?>
