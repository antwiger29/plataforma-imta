<?php
/** Incluir la libreria PHPExcel */

require_once '../librerias/Classes/PHPExcel.php';
error_reporting(0);
// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Cattivo")
->setLastModifiedBy("Cattivo")
->setTitle("Documento de Tarifas")
->setSubject("Documento de Tarifas")
->setDescription("Estos son todas las tarifas actuales del municipio")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("");
$gdImage=imagecreatefrompng('../componentes/encabezado3.PNG');
$objPHPExcel->setActiveSheetIndex(0);
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(80);
	$objDrawing->setCoordinates('A1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

  $estiloTituloReporte = array(
      'font' => array(
  	'name'      => 'Arial',
  	'bold'      => true,
  	'italic'    => false,
  	'strike'    => false,
  	'size' =>13
      ),
      'fill' => array(
  	'type'  => PHPExcel_Style_Fill::FILL_SOLID
  	),
      'borders' => array(
  	'allborders' => array(
  	'style' => PHPExcel_Style_Border::BORDER_NONE
  	)
      ),
      'alignment' => array(
  	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      )
  	);

$objPHPExcel->getActiveSheet()->getStyle('A1:X4')->applyFromArray($estiloTituloReporte);

$estiloTituloColumnas = array(
    'font' => array(
	'name'  => 'Arial',
	'bold'  => true,
	'size' =>10,
	'color' => array(
	'rgb' => 'FFFFFF'
	)
    ),
    'fill' => array(
	'type' => PHPExcel_Style_Fill::FILL_SOLID,
	'color' => array('rgb' => '175F44')
    ),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
    'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);
$objPHPExcel->getActiveSheet()->getStyle('A5:X5')->applyFromArray($estiloTituloColumnas);
// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A5', 'Estado')
->setCellValue('B5', 'Municipio')
->setCellValue('C5', 'Clasificación')
->setCellValue('D5', 'Tipo de uso')
->setCellValue('E5',  'Modalidad de servicio')
->setCellValue('F5', 'Periodo de pago')
->setCellValue('G5', 'Unidad de consumo')
->setCellValue('H5', 'Unidad tarifaria')
->setCellValue('I5', 'Medio del servicio')
->setCellValue('J5', 'Observaciones')
->setCellValue('K5', 'Rango o Unidad')
->setCellValue('L5', 'Volumen base')
->setCellValue('M5', 'Cuota base')
->setCellValue('N5', 'Incremento por volumen')
->setCellValue('O5', 'Costo Total')
->setCellValue('P5', 'IVA Alc')
->setCellValue('Q5', 'IVA San')
->setCellValue('R5', 'IVA Total')
->setCellValue('S5', 'Monto Alc')
->setCellValue('T5', 'Monto San')
->setCellValue('U5', 'Monto Total')
->setCellValue('V5', 'Plataforma')
->setCellValue('W5', 'Dependencia')
->setCellValue('X5', 'Link documento');


$clave="";
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

$fila=6;


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
    $clave=$result2['municipios_id'];
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
  if (isset(  $result2['años_id'])) {
    $metaAño=$result2['años_id'];
  }else {
    $metaAño="s/n";
  }

  $añosql="SELECT año FROM años WHERE id='$metaAño'";
  $añoquer=mysqli_query($conexion,$añosql);
  $añoresult=mysqli_fetch_array($añoquer);
  if (isset($añoresult[0])) {
    $añodigit=$añoresult[0];
  }else {
    $añodigit="s/n";
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

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$fila, $estado)
        ->setCellValue('B'.$fila, $municipio)
        ->setCellValue('C'.$fila, $arraycla[0])
        ->setCellValue('D'.$fila, $arraysubcla[0])
        ->setCellValue('E'.$fila, $arraymodSer[0])
        ->setCellValue('F'.$fila, $arrayperCob[0])
        ->setCellValue('G'.$fila, $arrayunicon[0])
        ->setCellValue('H'.$fila, $arrayunitaf[0])
        ->setCellValue('I'.$fila, $arraymedser[0])
        ->setCellValue('J'.$fila, $arrayobs[0])
        ->setCellValue('K'.$fila, 'S/n')
        ->setCellValue('L'.$fila, 'S/n')
        ->setCellValue('M'.$fila, 'S/n')
        ->setCellValue('N'.$fila,'S/n')
        ->setCellValue('O'.$fila, $arraytarF[0])
        ->setCellValue('P'.$fila, $arraytarFIA[1])
        ->setCellValue('Q'.$fila, $arraytarFIA[2])
        ->setCellValue('R'.$fila, $arraytarFIA[3])
        ->setCellValue('S'.$fila, $arraytarFMA[1])
        ->setCellValue('T'.$fila, $arraytarFMA[2])
        ->setCellValue('U'.$fila, $arraytarFMA[3])
				->setCellValue('V'.$fila, $plataforma_consulta)
        ->setCellValue('W'.$fila, $dependencia)
        ->setCellValue('X'.$fila, $liga_documento);
        $fila++;
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

           $objPHPExcel->setActiveSheetIndex(0)
           ->setCellValue('A'.$fila, $estado)
           ->setCellValue('B'.$fila, $municipio)
           ->setCellValue('C'.$fila, $arraycla[0])
           ->setCellValue('D'.$fila, $arraysubcla[0])
           ->setCellValue('E'.$fila, $arraymodSer[0])
           ->setCellValue('F'.$fila, $arrayperCob[0])
           ->setCellValue('G'.$fila, $arrayunicon[0])
           ->setCellValue('H'.$fila, $arrayunitaf[0])
           ->setCellValue('I'.$fila, $arraymedser[0])
           ->setCellValue('J'.$fila, $arrayobs[0])
           ->setCellValue('K'.$fila, $arraytarM[1])
           ->setCellValue('L'.$fila, $arraytarM[2])
           ->setCellValue('M'.$fila, $arraytarM[3])
           ->setCellValue('N'.$fila, $arraytarM[4])
           ->setCellValue('O'.$fila, $arraytarM[5])
           ->setCellValue('P'.$fila, $arraytarMIA[1])
           ->setCellValue('Q'.$fila, $arraytarMIA[2])
           ->setCellValue('R'.$fila, $arraytarMIA[3])
           ->setCellValue('S'.$fila, $arraytarMMA[1])
           ->setCellValue('T'.$fila, $arraytarMMA[2])
           ->setCellValue('U'.$fila, $arraytarMMA[3])
					 ->setCellValue('V'.$fila, $plataforma_consulta)
           ->setCellValue('W'.$fila, $dependencia)
           ->setCellValue('X'.$fila, $liga_documento);
           $fila++;
        }
      }
    }
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);



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

               $objPHPExcel->setActiveSheetIndex(0)
               ->setCellValue('A'.$fila, $estado)
               ->setCellValue('B'.$fila, $municipio)
               ->setCellValue('C'.$fila, $arraycla[0])
               ->setCellValue('D'.$fila, $arraysubcla[0])
               ->setCellValue('E'.$fila, $arraymodSer[0])
               ->setCellValue('F'.$fila, $arrayperCob[0])
               ->setCellValue('G'.$fila, $arrayunicon[0])
               ->setCellValue('H'.$fila, $arrayunitaf[0])               ->setCellValue('I'.$fila, $arraymedser[0])
               ->setCellValue('J'.$fila, $arrayobs[0])
               ->setCellValue('L'.$fila, $arraytarP[1])
               ->setCellValue('L'.$fila, 'S/n')

               ->setCellValue('M'.$fila, 'S/n')
               ->setCellValue('N'.$fila, 'S/n')
               ->setCellValue('O'.$fila, $arraytarP[2])
               ->setCellValue('P'.$fila, $arraytarPIA[1])
               ->setCellValue('Q'.$fila, $arraytarPIA[2])
               ->setCellValue('R'.$fila, $arraytarPIA[3])
               ->setCellValue('S'.$fila, $arraytarPMA[1])
               ->setCellValue('T'.$fila, $arraytarPMA[2])
               ->setCellValue('U'.$fila, $arraytarPMA[3])
							 ->setCellValue('V'.$fila, $plataforma_consulta)
               ->setCellValue('W'.$fila, $dependencia)
               ->setCellValue('X'.$fila, $liga_documento);
               $fila++;


             }
           }
   }
   // Renombrar Hoja
   $objPHPExcel->getActiveSheet()->setTitle('Tarifas');
   // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
   $objPHPExcel->setActiveSheetIndex(0);
   // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.

   header('Content-Disposition: attachment;filename="'.$clave.'_'.$añodigit.'.xlsx"');
   header('Cache-Control: max-age=0');
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
   $objWriter->save('php://output');
   exit;




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








</table>
</body>
</html>
