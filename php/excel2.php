<?php
header("Pragma: public");
header("Expires: 0");
$filename = "metadato.xls";
header("Content-type: application/xls");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
require_once("conexion.php");
$conexion=conexion();
  if (isset($_POST["enviar"])){
    $_POST["enviar"];
  }


  if (isset($_POST['est'])) {
    $estado= $_POST['est'];

  }
  $conexion=conexion();
  if (isset($_POST['mun'])) {
    $municipios= $_POST['mun'];

  }
  if (isset($_POST['año'])) {
    $año= $_POST['año'];

  }







?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <tr>
        <th>Estado</th>
        <th>Municipio</th>
        <th>PLataforma</th>
        <th>Dependencia</th>
        <th>Link documento</th>
        <th>Clasificacion:</th>
        <th>Tipo de uso:</th>
        <th>Modalidad de servicio:</th>
        <th>Periodo de pago:</th>
        <th>Unidad de consumo:</th>
        <th>Unidad tarifaria:</th>
        <th>medio del servicio</th>
        <th>Observaciones</th>
        <th>Rango o Unidad</th>
        <th>Volumen base</th>
        <th>Cuota base</th>
        <th>Incremento por volumen</th>
        <th>Costo Total</th>
        <th>iva alc</th>
        <th>iva san</th>
        <th>iva total</th>
        <th>Monto alc</th>
        <th>Monto san</th>
        <th>Monto total</th>
      </tr>



<?php


  $i=0;
  $sql="SELECT estado.nombre_estado,municipios.nombre_municipio from estado
  INNER JOIN municipios ON estado.id=municipios.estado_id
  WHERE municipios.id='$municipios'";
  $query=mysqli_query($conexion,$sql);
  while ($result=mysqli_fetch_array($query)) {
    $estado=$result['nombre_estado'];
    $municipio=$result['nombre_municipio'];
  }

  $sql2="SELECT * FROM metadato WHERE municipios_id='$municipios'
  AND años_id='$año'";
  $query2=mysqli_query($conexion,$sql2);
  $result2=mysqli_fetch_array($query2);
  if (isset($result2['id'])) {
    $idMeta=$result2['id'];
  }else{$idMeta="S/N";}
  if (isset($result2['plataforma_consuta'])) {
    $plataforma_consulta=$result2['plataforma_consuta'];
  }else{$plataforma_consulta="S/N";}
  if (isset($result2['dependencia'])) {
    $dependencia=$result2['dependencia'];
  }else{$dependencia="S/N";}
  if (isset($result2['liga_documento'])) {
    $liga_documento=$result2['liga_documento'];
  }else{$liga_documento="S/N";}
  if (isset($result2['usuario_publicador'])) {
    $usuario_publicador=$result2['usuario_publicador'];
  }else{$usuario_publicador="S/N";}
  if (isset($result2['fecha_publicacion'])) {
    $fecha_publicacion=$result2['fecha_publicacion'];
  }else{$fecha_publicacion="S/N";}

  $sql3="SELECT* FROM  ficha_tarifaria WHERE metadato_id='$idMeta'";
  $query3=mysqli_query($conexion,$sql3);
  $valorTF=1;
  $valorTM=2;
  while ( $result3=mysqli_fetch_array($query3)) {
    $idficha=$result3['id'];
    $modalidad_servicio_id=$result3['modalidad_servicio_id'];
    $periodo_cobro_id=$result3['periodo_cobro_id'];
    $unidad_consumo_id=$result3['unidad_consumo_id'];
    $unidad_tarifaria_id=$result3['unidad_tarifaria_id'];
    $clasificacion_uso_id=$result3['clasificacion_uso_id'];
    $subclasifacion_uso_id=$result3['subclasifacion_uso_id'];
    $medio_servicio_id=$result3['medio_servicio_id'];

    $sqlcla="SELECT clasificacion_uso FROM clasificaciones_uso WHERE id='$clasificacion_uso_id'";
    $querycla=mysqli_query($conexion,$sqlcla);
    $arraycla=mysqli_fetch_row($querycla);

    $sqlsubcla="SELECT subclasificacion_uso FROM subclasificaciones_uso WHERE id='$subclasifacion_uso_id'";
    $querysubcla=mysqli_query($conexion,$sqlsubcla);
    $arraysubcla=mysqli_fetch_row($querysubcla);

    $sqlmodser="SELECT servicio FROM modalidad_servicio WHERE id='$modalidad_servicio_id'";
    $querymodser=mysqli_query($conexion,$sqlmodser);
    $arraymodSer=mysqli_fetch_row($querymodser);

    $sqlperCob="SELECT periodo_cobro FROM periodos_cobro WHERE id='$periodo_cobro_id'";
    $queryperCob=mysqli_query($conexion,$sqlperCob);
    $arrayperCob=mysqli_fetch_row($queryperCob);

    $sqlunicon="SELECT unidad_consumo FROM unidades_consumo_medido WHERE id='$unidad_consumo_id'";
    $queryunicon=mysqli_query($conexion,$sqlunicon);
    $arrayunicon=mysqli_fetch_row($queryunicon);

    $sqlunitaf="SELECT u_tarifa FROM unidad_tarifaria WHERE id='$unidad_tarifaria_id'";
    $queryunitaf=mysqli_query($conexion,$sqlunitaf);
    $arrayunitaf=mysqli_fetch_row($queryunitaf);

    $sqlmedser="SELECT servicio FROM medio_servicio WHERE id='$medio_servicio_id'";
    $querymedser=mysqli_query($conexion,$sqlmedser);
    $arraymedser=mysqli_fetch_row($querymedser);


    $sqlobs="SELECT observacion FROM observaciones WHERE ficha_tarifaria_id='$idficha'";
    $queryobs=mysqli_query($conexion,$sqlobs);
    $arrayobs=mysqli_fetch_row($queryobs);
    if (!isset($arrayobs[0])) {$arrayobs[0]="Sin comentarios"; }


    if (strcasecmp($modalidad_servicio_id, $valorTF)==0) {


            $sqltarF="SELECT cuota FROM tarifa_cuota_fija WHERE ficha_tarifaria_id='$idficha'";
            $querytarF=mysqli_query($conexion,$sqltarF);

            $sqltarFMA="SELECT * FROM monto_adicional  WHERE ficha_tarifaria_id='$idficha'";
            $querytarFMA=mysqli_query($conexion,$sqltarFMA);

            $sqltarFIA="SELECT * FROM iva_adicional  WHERE ficha_tarifaria_id='$idficha'";
            $querytarFIA=mysqli_query($conexion,$sqltarFIA);


            while ($arraytarF=mysqli_fetch_row($querytarF)) {
              $arraytarFMA=mysqli_fetch_row($querytarFMA);
              if (!isset($arraytarFMA[1])) {$arraytarFMA[1]=0;}
              if (!isset($arraytarFMA[2])) {$arraytarFMA[2]=0;}
              if (!isset($arraytarFMA[3])) {$arraytarFMA[3]=0;}

              $arraytarFIA=mysqli_fetch_row($querytarFIA);
              if (!isset($arraytarFIA[1])) {$arraytarFIA[1]=0;}
              if (!isset($arraytarFIA[2])) {$arraytarFIA[2]=0;}
              if (!isset($arraytarFIA[3])) {$arraytarFIA[3]=0;}





            $arraytarF[0];
            $arraytarFIA[1];
            $arraytarFIA[2];
            $arraytarFIA[3];
            $arraytarFMA[1];
            $arraytarFMA[2];
            $arraytarFMA[3];
            ?>
          <tr>
             <td><?php echo $estado;?></td>
             <td><?php echo $municipio;?></td>
             <td><?php echo $plataforma_consulta;?></td>
             <td><?php echo $dependencia;?></td>
             <td><?php echo $liga_documento;?></td>
             <td><?php echo $arraycla[0];?></td>
             <td><?php echo $arraysubcla[0];?></td>
             <td><?php echo $arraymodSer[0];?></td>
             <td><?php echo $arrayperCob[0];?></td>
             <td><?php echo $arrayunicon[0];?></td>
             <td><?php echo $arrayunitaf[0];?></td>
             <td><?php echo $arraymedser[0];?></td>
             <td><?php echo $arrayobs[0];?></td>
             <td><?php echo  '//';?></td>
             <td><?php echo  '//';?></td>
             <td><?php echo  '//';?></td>
             <td><?php echo  '//';?></td>
             <td><?php echo $arraytarF[0];?></td>
             <td><?php echo $arraytarFIA[1];?></td>
             <td><?php echo $arraytarFIA[2];?></td>
             <td><?php echo $arraytarFIA[3];?></td>
             <td><?php echo $arraytarFMA[1];?></td>
             <td><?php echo $arraytarFMA[2];?></td>
             <td><?php echo $excel[$i][22]=$arraytarFMA[3];?></td>
            <tr>
              <?php
            $excel2 = array($estado,$municipio,$plataforma_consulta,
           $dependencia,$liga_documento,$arraycla[0],$arraysubcla[0],
         $arraymodSer[0],$arrayperCob[0],$arrayunicon[0],$arrayunitaf[0],
        $arraymedser[0],$arrayobs[0],"","","","",$arraytarF[0],$arraytarFIA[1],
        $arraytarFIA[2],$arraytarFIA[3],$arraytarFMA[1],$arraytarFMA[2],$arraytarFMA[3]);
            }
          }
        }

 $sql3="SELECT* FROM  ficha_tarifaria WHERE metadato_id='$idMeta'";
 $query3=mysqli_query($conexion,$sql3);
 $valorTF=1;
 $valorTM=2;
 while ( $result3=mysqli_fetch_array($query3)) {
   $idficha=$result3['id'];
   $modalidad_servicio_id=$result3['modalidad_servicio_id'];
   $periodo_cobro_id=$result3['periodo_cobro_id'];
   $unidad_consumo_id=$result3['unidad_consumo_id'];
   $unidad_tarifaria_id=$result3['unidad_tarifaria_id'];
   $clasificacion_uso_id=$result3['clasificacion_uso_id'];
   $subclasifacion_uso_id=$result3['subclasifacion_uso_id'];
   $medio_servicio_id=$result3['medio_servicio_id'];

   $sqlcla="SELECT clasificacion_uso FROM clasificaciones_uso WHERE id='$clasificacion_uso_id'";
   $querycla=mysqli_query($conexion,$sqlcla);
   $arraycla=mysqli_fetch_row($querycla);

   $sqlsubcla="SELECT subclasificacion_uso FROM subclasificaciones_uso WHERE id='$subclasifacion_uso_id'";
   $querysubcla=mysqli_query($conexion,$sqlsubcla);
   $arraysubcla=mysqli_fetch_row($querysubcla);

   $sqlmodser="SELECT servicio FROM modalidad_servicio WHERE id='$modalidad_servicio_id'";
   $querymodser=mysqli_query($conexion,$sqlmodser);
   $arraymodSer=mysqli_fetch_row($querymodser);

   $sqlperCob="SELECT periodo_cobro FROM periodos_cobro WHERE id='$periodo_cobro_id'";
   $queryperCob=mysqli_query($conexion,$sqlperCob);
   $arrayperCob=mysqli_fetch_row($queryperCob);

   $sqlunicon="SELECT unidad_consumo FROM unidades_consumo_medido WHERE id='$unidad_consumo_id'";
   $queryunicon=mysqli_query($conexion,$sqlunicon);
   $arrayunicon=mysqli_fetch_row($queryunicon);

   $sqlunitaf="SELECT u_tarifa FROM unidad_tarifaria WHERE id='$unidad_tarifaria_id'";
   $queryunitaf=mysqli_query($conexion,$sqlunitaf);
   $arrayunitaf=mysqli_fetch_row($queryunitaf);

   $sqlmedser="SELECT servicio FROM medio_servicio WHERE id='$medio_servicio_id'";
   $querymedser=mysqli_query($conexion,$sqlmedser);
   $arraymedser=mysqli_fetch_row($querymedser);


   $sqlobs="SELECT observacion FROM observaciones WHERE ficha_tarifaria_id='$idficha'";
   $queryobs=mysqli_query($conexion,$sqlobs);
   $arrayobs=mysqli_fetch_row($queryobs);
   if (!isset($arrayobs[0])) {$arrayobs[0]="Sin comentarios"; }

 if (strcasecmp($modalidad_servicio_id, $valorTM)==0) {

         $sqltarM="SELECT * FROM tarifa_serv_medido WHERE ficha_tarifaria_id='$idficha'";
         $querytarM=mysqli_query($conexion,$sqltarM);

         if (!isset($arraytarM[1])) {$arraytarM[1]=0;}
         if (!isset($arraytarM[2])) {$arraytarM[2]=0;}
         if (!isset($arraytarM[3])) {$arraytarM[3]=0;}
         if (!isset($arraytarM[4])) {$arraytarM[4]=0;}
         if (!isset($arraytarM[5])) {$arraytarM[5]=0;}


         $sqltarMMA="SELECT * FROM monto_adicional  WHERE ficha_tarifaria_id='$idficha'";
         $querytarMMA=mysqli_query($conexion,$sqltarMMA);

         $sqltarMIA="SELECT * FROM iva_adicional  WHERE ficha_tarifaria_id='$idficha'";
         $querytarMIA=mysqli_query($conexion,$sqltarMIA);


         while ($arraytarM=mysqli_fetch_row($querytarM)) {
           $arraytarMMA=mysqli_fetch_row($querytarMMA);
           if (!isset($arraytarMMA[1])) {$arraytarMMA[1]=0;}
           if (!isset($arraytarMMA[2])) {$arraytarMMA[2]=0;}
           if (!isset($arraytarMMA[3])) {$arraytarMMA[3]=0;}

           $arraytarMIA=mysqli_fetch_row($querytarMIA);
           if (!isset($arraytarMIA[1])) {$arraytarMIA[1]=0;}
           if (!isset($arraytarMIA[2])) {$arraytarMIA[2]=0;}
           if (!isset($arraytarMIA[3])) {$arraytarMIA[3]=0;}
?>
         <tr>
           <td><?php echo $estado;?></td>
           <td><?php echo $municipio;?></td>
           <td><?php echo $plataforma_consulta;?></td>
           <td><?php echo $dependencia;?></td>
           <td><?php echo $liga_documento;?></td>
           <td><?php echo $arraycla[0];?></td>
           <td><?php echo $arraysubcla[0];?></td>
           <td><?php echo $arraymodSer[0];?></td>
           <td><?php echo $arrayperCob[0];?></td>
           <td><?php echo $arrayunicon[0];?></td>
           <td><?php echo $arrayunitaf[0];?></td>
           <td><?php echo $arraymedser[0];?></td>
           <td><?php echo $arrayobs[0];?></td>
           <td> <?php echo $arraytarM[1];?>
           <td> <?php echo $arraytarM[2];?>
           <td> <?php echo $arraytarM[3];?>
           <td> <?php echo $arraytarM[4];?>
           <td> <?php echo $arraytarM[5];?>
           <td> <?php echo $arraytarMIA[1];?>
           <td> <?php echo $arraytarMIA[2];?>
           <td> <?php echo $arraytarMIA[3];?>
           <td> <?php echo $arraytarMMA[1];?>
           <td> <?php echo $arraytarMMA[2];?>
           <td> <?php echo $arraytarMMA[3];?>
          <tr>
          <?php
        }
      }
    }

   ?>
   <?php
   $sql3="SELECT* FROM  ficha_tarifaria WHERE metadato_id='$idMeta'";
   $query3=mysqli_query($conexion,$sql3);
   $valorTF=1;
   $valorTM=2;
   $valorTP=3;
   while ( $result3=mysqli_fetch_array($query3)) {
     $idficha=$result3['id'];
     $modalidad_servicio_id=$result3['modalidad_servicio_id'];
     $periodo_cobro_id=$result3['periodo_cobro_id'];
     $unidad_consumo_id=$result3['unidad_consumo_id'];
     $unidad_tarifaria_id=$result3['unidad_tarifaria_id'];
     $clasificacion_uso_id=$result3['clasificacion_uso_id'];
     $subclasifacion_uso_id=$result3['subclasifacion_uso_id'];
     $medio_servicio_id=$result3['medio_servicio_id'];

     $sqlcla="SELECT clasificacion_uso FROM clasificaciones_uso WHERE id='$clasificacion_uso_id'";
     $querycla=mysqli_query($conexion,$sqlcla);
     $arraycla=mysqli_fetch_row($querycla);

     $sqlsubcla="SELECT subclasificacion_uso FROM subclasificaciones_uso WHERE id='$subclasifacion_uso_id'";
     $querysubcla=mysqli_query($conexion,$sqlsubcla);
     $arraysubcla=mysqli_fetch_row($querysubcla);

     $sqlmodser="SELECT servicio FROM modalidad_servicio WHERE id='$modalidad_servicio_id'";
     $querymodser=mysqli_query($conexion,$sqlmodser);
     $arraymodSer=mysqli_fetch_row($querymodser);

     $sqlperCob="SELECT periodo_cobro FROM periodos_cobro WHERE id='$periodo_cobro_id'";
     $queryperCob=mysqli_query($conexion,$sqlperCob);
     $arrayperCob=mysqli_fetch_row($queryperCob);

     $sqlunicon="SELECT unidad_consumo FROM unidades_consumo_medido WHERE id='$unidad_consumo_id'";
     $queryunicon=mysqli_query($conexion,$sqlunicon);
     $arrayunicon=mysqli_fetch_row($queryunicon);

     $sqlunitaf="SELECT u_tarifa FROM unidad_tarifaria WHERE id='$unidad_tarifaria_id'";
     $queryunitaf=mysqli_query($conexion,$sqlunitaf);
     $arrayunitaf=mysqli_fetch_row($queryunitaf);

     $sqlmedser="SELECT servicio FROM medio_servicio WHERE id='$medio_servicio_id'";
     $querymedser=mysqli_query($conexion,$sqlmedser);
     $arraymedser=mysqli_fetch_row($querymedser);


     $sqlobs="SELECT observacion FROM observaciones WHERE ficha_tarifaria_id='$idficha'";
     $queryobs=mysqli_query($conexion,$sqlobs);
     $arrayobs=mysqli_fetch_row($queryobs);
     if (!isset($arrayobs[0])) {$arrayobs[0]="Sin comentarios"; }


     if (strcasecmp($modalidad_servicio_id, $valorTP)==0) {



             $sqltarP="SELECT * FROM tarifa_por_pipa WHERE ficha_tarifaria_id='$idficha'";
             $querytarP=mysqli_query($conexion,$sqltarP);

             $sqltarPMA="SELECT * FROM monto_adicional  WHERE ficha_tarifaria_id='$idficha'";
             $querytarPMA=mysqli_query($conexion,$sqltarPMA);

             $sqltarPIA="SELECT * FROM iva_adicional  WHERE ficha_tarifaria_id='$idficha'";
             $querytarPIA=mysqli_query($conexion,$sqltarPIA);


             while ($arraytarP=mysqli_fetch_row($querytarP)) {
               $arraytarPMA=mysqli_fetch_row($querytarPMA);
               if (!isset($arraytarPMA[1])) {$arraytarPMA[1]=0;}
               if (!isset($arraytarPMA[2])) {$arraytarPMA[2]=0;}
               if (!isset($arraytarPMA[3])) {$arraytarPMA[3]=0;}

               $arraytarPIA=mysqli_fetch_row($querytarPIA);
               if (!isset($arraytarPIA[1])) {$arraytarPIA[1]=0;}
               if (!isset($arraytarPIA[2])) {$arraytarPIA[2]=0;}
               if (!isset($arraytarPIA[3])) {$arraytarPIA[3]=0;}

   ?>


             <tr>
                   <td><?php echo $estado;?></td>
                   <td><?php echo $municipio;?></td>
                   <td><?php echo $plataforma_consulta;?></td>
                   <td><?php echo $dependencia;?></td>
                   <td><?php echo $liga_documento;?></td>
                   <td><?php echo $arraycla[0];?></td>
                   <td><?php echo $arraysubcla[0];?></td>
                   <td><?php echo $arraymodSer[0];?></td>
                   <td><?php echo $arrayperCob[0];?></td>
                   <td><?php echo $arrayunicon[0];?></td>
                   <td><?php echo $arrayunitaf[0];?></td>
                   <td><?php echo $arraymedser[0];?></td>
                   <td><?php echo $arrayobs[0];?></td>
                  <td><?php echo $arraytarP[1];?></td>
                  <td><?php echo  '//';?></td>
                  <td><?php echo  '//';?></td>
                  <td><?php echo  '//';?></td>
                  <td><?php echo $arraytarP[2];?></td>
                  <td><?php echo $arraytarPIA[1];?></td>
                  <td><?php echo $arraytarPIA[2];?></td>
                  <td><?php echo $arraytarPIA[3];?></td>
                  <td><?php echo $arraytarPMA[1];?></td>
                  <td><?php echo $arraytarPMA[2];?></td>
                  <td><?php echo $arraytarPMA[3];?></td>
            </tr>

  <?php

             }
   }
   }
   ?>









</table>
</body>
</html>
