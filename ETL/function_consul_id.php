<?php

  //  $conversor=strtoupper($datos[7]);
  //************************CONSULTAR ID_FICHA***************************************
  function consul_idFichTar($idMun,$año,$no_tar){
    global $mysqli;
    $id_fich_tar=$idMun.$año.$no_tar;
    $sql="SELECT id FROM ficha_tarifaria WHERE id='$id_fich_tar'";
    $result = mysqli_query ($mysqli,$sql);
    mysqli_data_seek ($result,0);
    $extraido= mysqli_fetch_array($result);

    if(isset($extraido[0])){
      return $extraido[0];
    }
  }



  //*************************fUNCIONES  ID_METADATO
  function consul_idMetadato($idMun,$año){
    global $mysqli;
    $id_metadato=$idMun.$año;
    $sql="SELECT id FROM metadato WHERE id='$id_metadato'";
    $result = mysqli_query ($mysqli,$sql);
    mysqli_data_seek ($result,0);
    $extraido= mysqli_fetch_array($result);

    if(isset($extraido[0])){
      return $extraido[0];
  }

  }

  function crear_idMetadato($id,$plataforma,$dependencia,$documento,$liga,
  $usuario,$municipio,$año){
    global $mysqli;
    $id_año=consul_idAno($año);
    $hoy = getdate();
    $date=$hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
      $sql="INSERT INTO metadato
      (id,plataforma_consuta, dependencia, documento, liga_documento,
         usuario_publicador, fecha_publicacion,municipios_id,años_id) VALUES
      ('$id','$plataforma','$dependencia','$documento','$liga','$usuario'
        ,'$date','$municipio','$id_año')";
      return mysqli_query ($mysqli,$sql);
  }



//*************************funciones de año*************************************
function consul_idAno($año){
  global $mysqli;
  $sql="SELECT id FROM años WHERE Año='$año'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);

    if(isset($extraido[0])){
      return $extraido[0];
  }


}
function crear_idAno($año){
    global $mysqli;
    $sql="INSERT INTO años (Año) VALUES ('$año')";
    return mysqli_query ($mysqli,$sql);
}

//************ funciones de modalidad de servicio*******************************

function consul_idModServ($modSer){
  global $mysqli;
  $sql="SELECT id FROM modalidad_servicio WHERE servicio='$modSer'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);

  if(isset($extraido[0])){
    return $extraido[0];
  }
}

function crear_idModServ($modServ){
  global $mysqli;
    $sql="INSERT INTO modalidad_servicio (servicio) VALUES ( '$modServ')";
    return mysqli_query ($mysqli,$sql);
}


//************ funciones de periodo de cobro*******************************

function consul_idPerCob($perCob){
  global $mysqli;
  $sql="SELECT id FROM periodos_cobro WHERE periodo_cobro='$perCob'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}

//************ funciones de Unidad de Consumo*******************************
function consul_idUniCons($uniCons){
  global $mysqli;
  $sql="SELECT id FROM unidades_consumo_medido WHERE unidad_consumo='$uniCons'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}

//************ funciones de Unidad Tarifaria*******************************
function consul_idUniTar($uniTar){
  global $mysqli;
  $sql="SELECT id FROM unidad_tarifaria WHERE u_tarifa='$uniTar'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido = mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}

//************ funciones de clasifiacion de uso******************************
function consul_idClasUso($clasUso){
  global $mysqli;
  $sql="SELECT id FROM clasificaciones_uso WHERE clasificacion_uso='$clasUso'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}


//************ funciones de subclasifiacion de uso******************************
function consul_idSubClasUso($subClasUso){
  global $mysqli;
  $sql="SELECT id FROM subclasificaciones_uso WHERE subclasificacion_uso ='$subClasUso'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);

  if(isset($extraido[0])){
    return $extraido[0];
  }
}


function crear_idSubClasUso($subClasUso){
  global $mysqli;
    $sql="INSERT INTO subclasificaciones_uso (subclasificacion_uso) VALUES ('$subClasUso')";
    return mysqli_query ($mysqli,$sql);
}


//************ funciones de clasifiacion de uso******************************
function consul_idMedServ($medServ){
  global $mysqli;
  $sql="SELECT id FROM medio_servicio WHERE servicio='$medServ'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}

//************ funciones de tarifa cuota fija******************************

function crear_tarFija($id,$cuota,$idFichTar){
  global $mysqli;
  $sql="INSERT INTO tarifa_cuota_fija (id,cuota,ficha_tarifaria_id)
   VALUES ('$id','$cuota','$idFichTar')";
   return mysqli_query ($mysqli,$sql);
}

function consul_tarFija($id){
  global $mysqli;
  $sql="SELECT id FROM tarifa_cuota_fija WHERE id='$id'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}

//************ funciones de tarifa de servicio medido**************************

function crear_tarMedida($id,$uniRan,$volBase,$cuoBase,$incVol,$total,$idFichTar){
  global $mysqli;
  $sql="INSERT INTO tarifa_serv_medido (id,unidades_o_rango, volumen_base,
     cuota_base, incremento_por_volumen, total, ficha_tarifaria_id)
     VALUES ('$id','$uniRan','$volBase','$cuoBase','$incVol','$total','$idFichTar')";
  return mysqli_query ($mysqli,$sql);
}

function consul_tarMedida($id){
  global $mysqli;
  $sql="SELECT id FROM tarifa_serv_medido WHERE id='$id'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}

//************ funciones de tarifa de servicio por pipa************************


function crear_tarPipa($id,$canDist,$cuota,$idFichTar){
  global $mysqli;
  $sql="INSERT INTO tarifa_por_pipa (id,cantidad_por_distancia, cuota,
     ficha_tarifaria_id) VALUES ('$id','$canDist', '$cuota', '$idFichTar')";
  return mysqli_query ($mysqli,$sql);
}

function consul_tarPipa($id){
  global $mysqli;
  $sql="SELECT id FROM tarifa_por_pipa WHERE id='$id'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}

//************ funciones de Observaciones***************************************
function consul_obser($idFich){
  global $mysqli;
  $sql="SELECT id FROM observaciones WHERE ficha_tarifaria_id='$idFich'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}


function crear_observ($observacion,$idFichTar){
  global $mysqli;
  $sql="INSERT INTO observaciones (observacion,ficha_tarifaria_id)
  VALUES ('$observacion', '$idFichTar')";
  return mysqli_query ($mysqli,$sql);
}
/*
function consul_montoAdi($idFich){
  global $mysqli;
  $sql="SELECT id FROM monto_adicional WHERE ficha_tarifaria_id='$idFich'";
  $result = mysqli_query ($mysqli,$sql);
  mysqli_data_seek ($result,0);
  $extraido= mysqli_fetch_array($result);
  if(isset($extraido[0])){
    return $extraido[0];
  }
}
*/
function crear_montoAdi($monto_saneamiento,$monto_alcantarillado,$monto_total,$idFichTar){
  global $mysqli;
  $sql="INSERT INTO monto_adicional (monto_saneamiento, monto_alcantarillado, monto_total,ficha_tarifaria_id)
  VALUES ('$monto_saneamiento','$monto_alcantarillado','$monto_total','$idFichTar')";
  return mysqli_query ($mysqli,$sql);
}

function crear_ivaAdi($iva_saneamiento,$iva_alcantarillado,$iva_total,$idFichTar){
  global $mysqli;
  $sql="INSERT INTO monto_adicional (iva_saneamiento,iva_alcantarillado,iva_total,ficha_tarifaria_id)
  VALUES ('$iva_saneamiento','$iva_alcantarillado','$iva_total','$idFichTar')";
  return mysqli_query ($mysqli,$sql);
}

?>
