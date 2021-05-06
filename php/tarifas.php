<?php
require_once("conexion.php");
$conexion=conexion();

if (isset($_POST['lista1'])) {
  $estado= $_POST['lista1'];
  $posest= $_POST['lista1'];
}
$conexion=conexion();
if (isset($_POST['lista2'])) {
  $municipios= $_POST['lista2'];
  $posmun= $_POST['lista2'];
}
if (isset($_POST['lista3'])) {
  $año= $_POST['lista3'];
  $posaño= $_POST['lista3'];
}

$i=0;
$j=0;

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
if (isset($result2['documento'])) {
  $documento=$result2['documento'];
}else{$documento="S/N";}


 ?>
 <!DOCTYPE html>
 <html lang="es">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Tarifas</title>

     <!-- CSS -->
     <link href="/favicon.ico" rel="shortcut icon">
     <link  rel="stylesheet" href="../css/normalize.css" >
     <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
     <link  rel="stylesheet" href="../css/style.css" >


     </script>
     <!-- Respond.js soporte de media queries para Internet Explorer 8 -->
     <!-- ie8.js EventTarget para cada nodo en Internet Explorer 8 -->
     <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/ie8/0.2.2/ie8.js"></script>
     <![endif]-->

   </head>
   <body>

     <!-- Contenido -->
     <main class="page">
       <nav class="navbar navbar-inverse sub-navbar navbar-fixed-top">
   <div class="container">
     <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subenlaces">
         <span class="sr-only">Interruptor de Navegación</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="/">IMTA-CNDH</a>
     </div>
     <div class="collapse navbar-collapse" id="subenlaces">
       <ul class="nav navbar-nav navbar-right">
         <li><a href="#">Enlace</a></li>
         <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Opciones <span class="caret"></span></a>
           <ul class="dropdown-menu" role="menu">
             <li><a href="#">Acción</a></li>
             <li><a href="#">Otra acción</a></li>
             <li><a href="#">Algo más aquí</a></li>
             <li class="divider"></li>
             <li><a href="#">Enlace separado</a></li>
           </ul>
         </li>
       </ul>
     </div>
   </div>
 </nav>
       <div class="container">
         <div class="container1" >
           <img src="../componentes/banner4.png" alt=""class="img-responsive"style="width:100%; max-width:1200px;" >
           <ol class="breadcrumb">
             <li><a href="../index.html"><i class="icon icon-home"></i></a></li>
             <li ><a href="../index.html">Inicio</a></li>
             <li ><a href="formulario.php">Consulta</a></li>
             <li class="active"><a href="#">Ficha Tarifaria</a></li>
           </ol>
           <div class="ficha">


             <div class="row">
               <div class="col-md-8 pull-left">
                 <h2>Ficha Tarifaria</h2>
                 <hr class="red">
               </div>
             </div>
             <div class="row">
                <div class="col-md-12 titulo">
                  <p>Metadatos</p>
                </div>
             </div>
             <div class="row" style="background-color:#DDDDDD;">
               <div class="col-md-3 variante">
                   <label class="control-label">Estado:</label>
               </div> <!--col-md-3 -->
               <div class="col-md-3 dato">
                   <?php echo $estado; ?>
               </div>
               <div class="col-md-3 variante">
                   <label class="control-label">Municipio:</label>
               </div><!--col-md-3 -->
               <div class="col-md-3 dato">
                  <?php echo $municipio; ?>
               </div>
            </div>
            <div class="row" style="background-color:#DDDDDD;">
              <div class="col-md-3 variante"><label class="control-label">Plataforma de consulta:</label></div>
              <?php echo '<div class="col-md-9 dato">'.$plataforma_consulta.'</div>'; ?>
            </div>
            <div class="row" style="background-color:#DDDDDD;">
              <div class="col-md-3 variante"><label class="control-label">Dependencia:</label></div>
              <?php echo '<div class="col-md-9 dato">'.$dependencia.'</div>'; ?>
            </div>
            <div class="row" style="background-color:#DDDDDD;">
              <div class="col-md-3 variante"><label class="control-label">Link documento:</label></div>
              <?php  echo '<div class="col-md-9 dato"><a href="'.$liga_documento.'">'.$liga_documento.'</a> </div>'; ?>
            </div>
            <div class="row" style="background-color:#DDDDDD;">
              <div class="col-md-3 variante"><label class="control-label">Nombre publicador:</label></div>
              <?php echo '<div class="col-md-9 dato">'.$usuario_publicador.'</div>'; ?>
            </div>
            <div class="row" style="background-color:#DDDDDD;">
              <div class="col-md-3 variante"><label class="control-label">Fecha de publicación:</label></div>
              <?php echo '<div class="col-md-9 dato">'.$fecha_publicacion.'</div>'; ?>
            </div>
            <div class="row ">
              <div class="col-md-3"></div>
              <div class="col-md-9 ">
                <form class="" action="excel.php" method="post" style="margin-top: 20px;">
                <input class="invisible" type="text" name="est" value="<?php echo $posest;?>">
                <input class="invisible" type="text" name="mun" value="<?php echo $posmun; ?>">
                <input class="invisible" type="text" name="año" value="<?php echo $posaño; ?>">
                <div class="btn-group" role="group" aria-label="...">
                  <button style="width: 300px;"type="submit" name="enviar"class="btn btn-primary  active" >
                    <span class="glyphicon glyphicon-floppy-save"></span>    Descargar XLS    </button>
                  <a href="../archivos/<?php echo $documento; ?>" class="btn btn-default " download="<?php
                  echo $documento; ?>"><span class="glyphicon glyphicon-floppy-save"></span> Descargar Documento</a>

                </div>

                </form>
              </div>

            </div>
            <div class="row"><div class="col-md-12" style="height: 25px;"></div></div>
            <div class="row">
              <div class="col-md-8 pull-left">

                <h2>Tarifas</h2>
                <hr class="red">
              </div>
            </div>
            <div class="row"><div class="col-md-12" style="height: 30px;"></div></div>
            </div><!--ficha -->

            <div class="tarifas">
               <ul class="nav nav-tabs">
                 <li class="active" ><a data-toggle="tab" href="#tab-01">Tarifa fija</a></li>
                 <li><a data-toggle="tab" href="#tab-02">Tarifa medida</a></li>
                 <li><a data-toggle="tab" href="#tab-03">Tarifa por Transporte</a></li>
               </ul>

               <div class="tab-content" style="background-color: #F3F3F3;">

                 <div class="tab-pane active" id="tab-01">
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
                     if (isset($arrayobs[0])) {$obs=$arrayobs[0]; }
                     else{$obs="no existe";}


                     if (strcasecmp($modalidad_servicio_id, $valorTF)==0) {


                   echo '<div class="row cuadro">';
                     echo '<div class="col-md-12" >';

                       echo '<div class="row ">';
                         echo '<div class="col-md-12 titulo" style="background-color: #9D2449;margin-bottom: 20px;">';
                           echo '<p>Propiedades de la tarifa</p>';
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label">Clasificacion:</label>';
                         echo '</div>';
                         echo '<div class="col-md-3  dato">';
                           echo $arraycla[0];
                         echo '</div>';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label">Tipo de uso:</label>';
                         echo '</div>';
                         echo '<div class="col-md-3  dato">';
                           echo $arraysubcla[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante" >';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-labelm">Modalidad de servicio:</label>';
                         echo '</div>';
                         echo '<div class="col-md-9 dato">';
                           echo $arraymodSer[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">Periodo de pago:</label>';
                         echo '</div>';
                         echo '<div class="col-md-9  dato">';
                           echo $arrayperCob[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">Unidad de consumo:</label>';
                        echo ' </div>';
                        echo '<div class="col-md-9 dato">';
                           echo $arrayunicon[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">Unidad tarifaria:</label>';
                         echo '</div>';
                         echo '<div class="col-md-9 dato">';
                           echo $arrayunitaf[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">medio del servicio</label>';
                         echo '</div>';
                         echo '<div class="col-md-9 dato">';
                           echo $arraymedser[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row  rowvariante " style="height:50px;">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">Observaciones</label>';
                         echo '</div>';
                         echo '<div class="col-md-9 dato  observacion cuadro">';
                           echo $obs;
                         echo '</div>';
                       echo '</div>';
                     echo '</div>';//col-12
                     echo '</div>';//cuadro
                     echo '<div class="row"><div class="col-md-12" style="height: 30px;"></div></div>';




                     echo '<div class="row cuadro">';
                     echo '<div class="col-md-12">';
                    /*   echo '<div class="row">';
                         echo '<div class="col-md-12 titulo" >';
                           echo '<p>Tarifa</p>';
                         echo '</div>';
                       echo '</div>';
                    */   echo '<div class="row ">';
                         echo '<div class="col-md-12 reductor ">';
                           echo '<table class="table  table-striped tabmod  ">';
                             echo '<tr>';
                               echo '<th>Costo Total</th>';
                               echo '<th>iva alc</th>';
                               echo '<th>iva san</th>';
                               echo '<th>iva total</th>';
                               echo '<th>Monto alc</th>';
                               echo '<th>Monto san</th>';
                               echo '<th>Monto total</th>';
                             echo '</tr>';
                             $sqltarF="SELECT cuota FROM tarifa_cuota_fija WHERE ficha_tarifaria_id='$idficha'";
                             $querytarF=mysqli_query($conexion,$sqltarF);


                             $sqltarFMA="SELECT * FROM monto_adicional  WHERE ficha_tarifaria_id='$idficha'";
                             $querytarFMA=mysqli_query($conexion,$sqltarFMA);

                             $sqltarFIA="SELECT * FROM iva_adicional  WHERE ficha_tarifaria_id='$idficha'";
                             $querytarFIA=mysqli_query($conexion,$sqltarFIA);


                             while ($arraytarF=mysqli_fetch_row($querytarF)) {

                                 if (!isset($arraytarF[0])) {$arraytarF[0]=0;}

                               $arraytarFMA=mysqli_fetch_row($querytarFMA);
                               if (!isset($arraytarFMA[1])) {$arraytarFMA[1]=0;}
                               if (!isset($arraytarFMA[2])) {$arraytarFMA[2]=0;}
                               if (!isset($arraytarFMA[3])) {$arraytarFMA[3]=0;}

                               $arraytarFIA=mysqli_fetch_row($querytarFIA);
                               if (!isset($arraytarFIA[1])) {$arraytarFIA[1]=0;}
                               if (!isset($arraytarFIA[2])) {$arraytarFIA[2]=0;}
                               if (!isset($arraytarFIA[3])) {$arraytarFIA[3]=0;}




                             echo '<tr>';
                               echo '<td>'.$arraytarF[0].'</td>';
                               echo '<td>'.$arraytarFIA[1].'</td>';
                               echo '<td>'.$arraytarFIA[2].'</td>';
                               echo '<td>'.$arraytarFIA[3].'</td>';
                               echo '<td>'.$arraytarFMA[1].'</td>';
                               echo '<td>'.$arraytarFMA[2].'</td>';
                               echo '<td>'.$arraytarFMA[3].'</td>';
                             echo '</tr>';



                             }

                           echo '</table>';
                         echo '</div>';
                       echo '</div>';
                     echo '</div>';
                   echo '</div>';


                   echo '<div class="row separador"></div>';


                 }
               }
                   ?>

                   </div>
                 <div class="tab-pane" id="tab-02">
                   <?php
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
                     if (isset($arrayobs[0])) {$obs=$arrayobs[0]; }else{$obs="no existe";}

                   if (strcasecmp($modalidad_servicio_id, $valorTM)==0) {
                     echo '<div class="row">';
                        //echo '<div class="col-md-1 "></div>';
                        echo '<div class="col-md-12 titulo" style="background-color: #9D2449; margin-bottom: 20px; ">';
                          echo '<p>Propiedades</p>';
                        echo '</div>';//row
                      //  echo '<div class="col-md-1 "></div>';
                     echo '</div>';

                     echo '<div class="row">';
                       echo '<div class="col-md-3 variante"><label class="control-label">clasificacion:</label></div>';
                       echo '<div class="col-md-3 dato">'.$arraycla[0].'</div>';
                       echo '<div class="col-md-3 variante"><label class="control-labelm">Tipo de uso:</label></div>';
                       echo '<div class="col-md-3 dato">'.$arraysubcla[0].'</div>';
                     echo '</div>';

                     echo '<div class="row">';
                       echo '<div class="col-md-3 variante"><label class="control-label ">Modalidad de servicio:</label></div>';
                       echo '<div class="col-md-9 dato">'.$arraymodSer[0].'</div>';
                     echo '</div>';

                     echo '<div class="row">';
                       echo '<div class="col-md-3 variante"><label class="control-label ">Periodo de pago:</label></div>';
                       echo '<div class="col-md-9 dato">'.$arrayperCob[0].'</div>';
                     echo '</div>';

                     echo '<div class="row">';
                       echo '<div class="col-md-3 variante"><label class="control-label ">Unidad de consumo:</label></div>';
                       echo '<div class="col-md-9 dato">'.$arrayunicon[0].'</div>';
                     echo '</div>';

                     echo '<div class="row">';
                       echo '<div class="col-md-3 variante"><label class="control-label ">Unidad tarifaria:</label></div>';
                       echo '<div class="col-md-9 dato">'.$arrayunitaf[0].'</div>';
                     echo '</div>';

                     echo '<div class="row">';
                       echo '<div class="col-md-3 variante"><label class="control-label ">Medio del servicio:</label></div>';
                       echo '<div class="col-md-9 dato">'.$arraymedser[0].'</div>';
                     echo '</div>';

                     echo '<div class="row">';
                       echo '<div class="col-md-3 variante"><label class="control-label ">Observaciones</label></div>';
                       echo '<div class="col-md-9 dato observacion cuadro">'. $obs.'</div>';
                     echo '</div>';
                     echo '<div class="row "><div class="col-md-12"  style="height:35px;"> </div> </div>';
                     echo '<div class="row cuadro">';
                       echo '<div class="col-md-12 reductor ">';
                         echo '<table class="table table-striped tabmod">';
                           echo '<tr>';
                             echo '<th>Rango o Unidad</th>';
                             echo '<th>Volumen base</th>';
                             echo '<th>Cuota base</th>';
                             echo '<th>Incremento por volumen</th>';
                             echo '<th>Costo Total</th>';
                             echo '<th>iva alc</th>';
                             echo '<th>iva san</th>';
                             echo '<th>iva total</th>';
                             echo '<th>Monto alc</th>';
                             echo '<th>Monto san</th>';
                             echo '<th>Monto total</th>';
                           echo '</tr>';

                           $sqltarM="SELECT * FROM tarifa_serv_medido WHERE ficha_tarifaria_id='$idficha'";
                           $querytarM=mysqli_query($conexion,$sqltarM);


                           $sqltarMMA="SELECT * FROM monto_adicional  WHERE ficha_tarifaria_id='$idficha'";
                           $querytarMMA=mysqli_query($conexion,$sqltarMMA);

                           $sqltarMIA="SELECT * FROM iva_adicional  WHERE ficha_tarifaria_id='$idficha'";
                           $querytarMIA=mysqli_query($conexion,$sqltarMIA);


                           while ($arraytarM=mysqli_fetch_row($querytarM)) {

                             if (!isset($arraytarM[1])) {$arraytarM[1]=0;}
                             if (!isset($arraytarM[2])) {$arraytarM[2]=0;}
                             if (!isset($arraytarM[3])) {$arraytarM[3]=0;}
                             if (!isset($arraytarM[4])) {$arraytarM[4]=0;}
                             if (!isset($arraytarM[5])) {$arraytarM[5]=0;}

                             $arraytarMMA=mysqli_fetch_row($querytarMMA);
                             if (!isset($arraytarMMA[1])) {$arraytarMMA[1]=0;}
                             if (!isset($arraytarMMA[2])) {$arraytarMMA[2]=0;}
                             if (!isset($arraytarMMA[3])) {$arraytarMMA[3]=0;}

                             $arraytarMIA=mysqli_fetch_row($querytarMIA);
                             if (!isset($arraytarMIA[1])) {$arraytarMIA[1]=0;}
                             if (!isset($arraytarMIA[2])) {$arraytarMIA[2]=0;}
                             if (!isset($arraytarMIA[3])) {$arraytarMIA[3]=0;}

                           echo '<tr>';
                             echo '<td>'.$arraytarM[1].'</td>';
                             echo '<td>'.$arraytarM[2].'</td>';
                             echo '<td>'.$arraytarM[3].'</td>';
                             echo '<td>'.$arraytarM[4].'</td>';
                             echo '<td>'.$arraytarM[5].'</td>';
                             echo '<td>'.$arraytarMIA[1].'</td>';
                             echo '<td>'.$arraytarMIA[2].'</td>';
                             echo '<td>'.$arraytarMIA[3].'</td>';
                             echo '<td>'.$arraytarMMA[1].'</td>';
                             echo '<td>'.$arraytarMMA[2].'</td>';
                             echo '<td>'.$arraytarMMA[3].'</td>';
                           echo '</tr>';
                             }
                         echo '</table>';
                       echo '</div>';
                     echo '</div>';

                      echo '<div class="row"><div class="col-md-12" style="margin: 20px 0px;"></div></div>';
                      }
                      }
                     ?>

                 </div>
                 <div class="tab-pane" id="tab-03">
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
                     if (isset($arrayobs[0])) { $obs=$arrayobs[0]; }else{$obs="no existe";}


                     if (strcasecmp($modalidad_servicio_id, $valorTP)==0) {


                   echo '<div class="row cuadro">';
                     echo '<div class="col-md-12" >';

                       echo '<div class="row ">';
                         echo '<div class="col-md-12 titulo" style="background-color: #9D2449;margin-bottom: 20px;">';
                           echo '<p>Propiedades de la tarifa</p>';
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label">Clasificacion:</label>';
                         echo '</div>';
                         echo '<div class="col-md-3  dato">';
                           echo $arraycla[0];
                         echo '</div>';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label">Tipo de uso:</label>';
                         echo '</div>';
                         echo '<div class="col-md-3  dato">';
                           echo $arraysubcla[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante" >';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-labelm">Modalidad de servicio:</label>';
                         echo '</div>';
                         echo '<div class="col-md-9 dato">';
                           echo $arraymodSer[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">Periodo de pago:</label>';
                         echo '</div>';
                         echo '<div class="col-md-9  dato">';
                           echo $arrayperCob[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">Unidad de consumo:</label>';
                        echo ' </div>';
                        echo '<div class="col-md-9 dato">';
                           echo $arrayunicon[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">Unidad tarifaria:</label>';
                         echo '</div>';
                         echo '<div class="col-md-9 dato">';
                           echo $arrayunitaf[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row rowvariante">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">medio del servicio</label>';
                         echo '</div>';
                         echo '<div class="col-md-9 dato">';
                           echo $arraymedser[0];
                         echo '</div>';
                       echo '</div>';

                       echo '<div class="row  rowvariante " style="height:50px;">';
                         echo '<div class="col-md-3 variante">';
                           echo '<label class="control-label ">Observaciones</label>';
                         echo '</div>';
                         echo '<div class="col-md-9 dato  observacion cuadro">';
                           echo $obs;
                         echo '</div>';
                       echo '</div>';
                     echo '</div>';//col-12
                     echo '</div>';//cuadro
                     echo '<div class="row"><div class="col-md-12" style="height: 30px;"></div></div>';




                     echo '<div class="row cuadro">';
                     echo '<div class="col-md-12">';
                    /*   echo '<div class="row">';
                         echo '<div class="col-md-12 titulo" >';
                           echo '<p>Tarifa</p>';
                         echo '</div>';
                       echo '</div>';
                    */   echo '<div class="row ">';
                         echo '<div class="col-md-12 reductor ">';
                           echo '<table class="table  table-striped tabmod  ">';
                             echo '<tr>';
                               echo '<th>Cantidad (L) por distancia(KM)</th>';
                               echo '<th>Costo Total</th>';
                               echo '<th>iva alc</th>';
                               echo '<th>iva san</th>';
                               echo '<th>iva total</th>';
                               echo '<th>Monto alc</th>';
                               echo '<th>Monto san</th>';
                               echo '<th>Monto total</th>';
                             echo '</tr>';
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




                             echo '<tr>';
                               echo '<td>'.$arraytarP[1].'</td>';
                               echo '<td>'.$arraytarP[2].'</td>';
                               echo '<td>'.$arraytarPIA[1].'</td>';
                               echo '<td>'.$arraytarPIA[2].'</td>';
                               echo '<td>'.$arraytarPIA[3].'</td>';
                               echo '<td>'.$arraytarPMA[1].'</td>';
                               echo '<td>'.$arraytarPMA[2].'</td>';
                               echo '<td>'.$arraytarPMA[3].'</td>';
                             echo '</tr>';



                             }

                           echo '</table>';
                         echo '</div>';
                       echo '</div>';
                     echo '</div>';
                   echo '</div>';


                   echo '<div class="row separador"></div>';


                 }
               }
                   ?>
                 </div>


   </div><!--tab contend -->
 </div><!--tarifas -->

     </div><!--container1 -->

         </div><!--container -->

     </main><!--page -->

     <!-- JS -->
     <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

   </body>
 </html>
