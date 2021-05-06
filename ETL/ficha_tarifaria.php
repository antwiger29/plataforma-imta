<?php

function crear_ficha_tar($idMun,$año,$noFich,$idEst,$modServ,$perCob,
$uniCons,$uniTar,$clasUso,$subClasUso,$medServ,$sanInt,$alcInt){
  require_once("function_consul_id.php");
  require_once("conexion.php");
  global $mysqli;

  
  $idFichTar=$idMun.$año.$noFich;
  $idMetadato=$idMun.$año;
  $idAño;
  $idmodServ;
  $idPerCob;
  $idUniCons;
  $idUniTar;
  $idClasUso;
  $idSubClasUso;
  $idMedServ;
//*******************ID DE AÑO**************************************************

  if (empty(consul_idAno($año))){
    echo "año inexistente  ->";
  }else{
    $idAño=consul_idAno($año);
    echo "id del año = ".$idAño." ->";
  }




  //*******************ID MODALIDAD DE SERVICIO*******************************

  if (empty(consul_idModServ($modServ))){
    echo "modalidad de servicio inexistente  ->";
    }else{
    $idmodServ=consul_idModServ($modServ);
    echo "id modSer = ".$idmodServ." ->";
  }

//*******************ID  PERIODO DE COBRO***************************************
if (empty(consul_idPerCob($perCob))){
  echo "periodo de cobro inexistente  ->";
  }else{
  $idPerCob=consul_idPerCob($perCob);
  echo "id Periodo cobro = ".$idPerCob." ->";
}

//*******************ID  UNIDAD DE CONSUMO***************************************
if (empty(consul_idUniCons($uniCons))){
  echo "unidad de cosumo inexistente  ->";
  }else{
  $idUniCons=consul_idUniCons($uniCons);
  echo "id unidad de consumo = ".$idPerCob." ->";
}


//*******************ID  UNIDAD TARIFARIA***************************************
if (empty(consul_idUniTar($uniTar))){
  echo "unidad tarifaria inexistente  ->";
  }else{
  $idUniTar=consul_idUniTar($uniTar);
  echo "id unidad tarifaria = ".$idUniTar." ->";
}
//*******************ID  CLASIFICACION DE USO***************************************
if (empty(consul_idClasUso($clasUso))){
  echo "clasificacion de uso inexistente  ->";
  }else{
  $idClasUso=consul_idClasUso($clasUso);
  echo "id clasificacion de  uso = ".$idClasUso." ->";
}

//*******************ID  SUBCLASIFICACION DE USO***************************************
if (empty(consul_idSubClasUso($subClasUso))){
  echo "subclasificacion de uso inexistente  ->";
  if (crear_idSubClasUso($subClasUso)){
    echo "subClasUso creado  ->";
    $idSubClasUso=consul_idSubClasUso($subClasUso);
    echo "id subClasUso ".$idSubClasUso;
  }else {
    echo "subClasUso error  ->";
  }
  }else{
  $idSubClasUso=consul_idSubClasUso($subClasUso);
  echo "id subClasUso ".$idSubClasUso;
}


//*******************ID MEDIO DE SERVICIO***************************************
if (empty(consul_idMedServ($medServ))){
  echo "medio de servicio inexistente  ->";
  }else{
  $idMedServ=consul_idMedServ($medServ);
  echo "id medio de servicio = ".$idMedServ." ->";
}

//****************** CREACION DE FICHA TARIFARIA *******************************

$sql="INSERT INTO ficha_tarifaria (id, no_ficha, estado_id, municipio_id,
  año_id, metadato_id, modalidad_servicio_id, periodo_cobro_id, unidad_consumo_id,
  unidad_tarifaria_id, clasificacion_uso_id, subclasifacion_uso_id,
   medio_servicio_id, saneamiento_integradol, alcantarillado_integradol)
    VALUES ('$idFichTar', '$noFich', '$idEst', '$idMun','$idAño',
      '$idMetadato', '$idmodServ', '$idPerCob', '$idUniCons', '$idUniTar',
       '$idClasUso','$idSubClasUso', '$idMedServ','$sanInt','$alcInt')";
       return mysqli_query ($mysqli,$sql);


}//Fin crear ficha Tar



 ?>
