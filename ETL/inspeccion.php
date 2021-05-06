<?php
$pass=1234;


 if (isset($_POST["pass"])){
   $enviar=$_POST["pass"];
if (strcmp($enviar, $pass) == 0) {
  // code...
  if (isset($_POST["usuario"])){
    $enviar=$_POST["usuario"];
  }
     //permite recepcionar la varible  que exista
  require_once("conexion.php");                          //conectar bd
  require_once("function_consul_id.php");
  require_once("ficha_tarifaria.php");
 $cont=0;
  //*****************SUBIENDO Y VERIFIFCANDO ARCHIVO DE TARIFAS*****************


 ?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejemplo de nueva página para GOB.mx</title>


    <!-- CSS -->
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">

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
      <div class="container">
        <div class="container1">
          <ol class="breadcrumb">
            <li><a href="../index.html"><i class="icon icon-home"></i></a></li>
            <li class=""><a href="../index.html">Inicio</a></li>
              <li class=""><a href="index.php">Cargador de datos</a></li>
            <li class="active"><a href="../inspecion.php">Historial</a></li>
          </ol>
          <div class="box">
            <?php
            $archivo = $_FILES["archivo"]["name"]; //variable archibos[nombre del input,recibe el nombre doc]
            $fecha= date("Y-m-d H-i");
            $archivo_copiado = $_FILES["archivo"]["tmp_name"];// almacenado tempral en la carpeta tmp
            $archivo_guardado = "repertorio/copia_".$fecha.$archivo;
            echo "Nombre del archivo -> ".$archivo."<br>";

              if (copy($archivo_copiado,$archivo_guardado)) { //cumplir funcion de copia de archivo en carpeta
                echo $archivo." se copio correctamente<br>";
              }else {
                echo "proceso copiado incorrecto<br>";
              }

            //******************ABRIENDO ARCHIVO SCV****************************************

              if (file_exists($archivo_guardado)) {//verificar si el documento existe
                echo "existe copia<br>";
                $fp = fopen($archivo_guardado,"r");// funcion para abrir archivo
                $rows=0;//variable de fila del archivo CSV
                $id_ficha=""; //variable para almacenar nueva clave
                echo "leyendo filas<br>";
                //*****************SUBIENDO DATOS A LA BASE DE DATOS************************

                while ($datos= fgetcsv($fp,0,";")){// definir numero de columnas a extraer y tipo de separador del CSV
                  $datos[6]=str_pad($datos[6], 2, "0", STR_PAD_LEFT);
                  $id_ficha=$datos[0].$datos[5].$datos[6];// crear id de ficha
                  $Verificacion;
                  $rows++;
                  if(($rows>1)&&(!empty($datos[0]))){ // si es mayor a uno y no esta vacio entonces verificar

                      echo "<p style= 'background-color: #DDDDDD;'>";

                    echo"  [ fila llena No ".$rows." ]->  ";
                    if (empty(consul_idMetadato($datos[0],$datos[5]))) {
                        echo "[ sin metadato ]->";
                      if ($Verificacion=crear_idMetadato($datos[0].$datos[5],$datos[12],$datos[13],
                      $datos[14],$datos[15],$enviar,$datos[0],$datos[5])) {
                        echo "[ Metadato creado  ]->";
                      }else {
                        echo "[ error metadato ]->";
                      }
                    }

                    if(empty(consul_idFichTar($datos[0],$datos[5],$datos[6]))){
                      echo "[ NO existe ficha ]->".$id_ficha;

                      if (crear_ficha_tar($datos[0],$datos[5],$datos[6],$datos[1],$datos[7],
                      $datos[8],$datos[9],$datos[10],$datos[16],$datos[17],$datos[11],$datos[18],
                      $datos[19])) {
                        echo "[ Ficha creada ]-><br>";
                      }else {
                        echo  "[ Ficha error ]-><br>";
                      }

                    }else{
                      echo "[ existente".consul_idFichTar($datos[0],$datos[5],$datos[6]." ]->");

                    }




                    if(!empty(consul_idFichTar($datos[0],$datos[5],$datos[6]))){
                      $datoErroneo="$";
                      $datos[33]=str_replace($datoErroneo, "","$datos[33]");
                      $datos[32]=str_replace($datoErroneo, "","$datos[32]");
                      $datos[31]=str_replace($datoErroneo, "","$datos[31]");
                      $datos[30]=str_replace($datoErroneo, "","$datos[30]");
                      $idTar=$datos[0].$datos[5].$rows;

                      switch (consul_idModServ($datos[7])) {
                        case '1':
                        if (empty(consul_tarFija($idTar))) {
                          if(crear_tarFija($idTar,$datos[33],$id_ficha)){
                            echo "[ cuota fija creada ]-><br>";
                            if(!empty(consul_obser($id_ficha))){
                              if (empty($datos[34])) {
                                crear_observ($datos[34],$id_ficha);
                              }
                            echo "[ consulta observ exitosa ]->";
                          }
                            if(strcasecmp($datos[20],$Verificacion="si") == 0){
                              crear_montoAdi($datos[21],$datos[22],$datos[23],$id_ficha);
                            }
                            if(strcasecmp($datos[24],$Verificacion="si") == 0){
                              crear_montoAdi($datos[25],$datos[26],$datos[27],$id_ficha);
                            }
                          }else {
                            echo "[ error cuota fija ]-><br>";
                          }
                        }else {
                          echo "[ Cuota fija existente ]-><br>";
                        }

                          break;
                        case '2':
                        if (empty(consul_tarMedida($idTar))) {
                          if (crear_tarMedida($idTar,$datos[29],$datos[30],$datos[31],$datos[32],
                        $datos[33],$id_ficha)) {
                              echo "[ servicio medido creado ]-><br>";
                              if(empty(consul_obser($id_ficha))){
                                if (!empty($datos[34])) {
                                  crear_observ($datos[34],$id_ficha);
                                }
                                echo "[ consulta observ exitosa ]->";
                              }
                              if(strcasecmp($datos[20],$Verificacion="si") == 0){
                                crear_montoAdi($datos[21],$datos[22],$datos[23],$id_ficha);
                              }
                              if(strcasecmp($datos[24],$Verificacion="si") == 0){
                                crear_montoAdi($datos[25],$datos[26],$datos[27],$id_ficha);
                              }
                          }else {
                            echo "[ error servicio medido ]-><br>";
                          }
                        }else {
                          echo "[ Cuota servicio medido  existente ]-><br>";
                        }
                        break;
                        case '3':
                        if (empty(consul_tarPipa($idTar))) {
                          if(crear_tarPipa($idTar,$datos[29],$datos[33],$id_ficha)){
                            echo "[ servicio de pipa creado ]-><br>";
                            if(empty(consul_obser($id_ficha))){
                              if (!empty($datos[34])) {
                                crear_observ($datos[34],$id_ficha);
                              }
                              echo "[ consulta observ exitosa ]->";
                            }
                            if(strcasecmp($datos[20],$Verificacion="si") == 0){
                              crear_montoAdi($datos[21],$datos[22],$datos[23],$id_ficha);
                            }
                            if(strcasecmp($datos[24],$Verificacion="si") == 0){
                              crear_ivaAdi($datos[25],$datos[26],$datos[27],$id_ficha);
                            }
                          }else {
                            echo "[ error servicio pipa ]-><br>";
                          }
                        }else {
                          echo "[ Cuota servicio por pipa  existente ]-><br>";
                        }
                        break;
                        default:
                          echo "[ error de TARIFA ]->";
                          break;
                      }
                    }








                }else{
                  echo "[ fila  No ".$rows."  vacia ]-> <br>";
                }
              }//fin while
             }else {
                echo"[ no exixte  copia ]->";
              }
            }else {
            echo '  <!DOCTYPE html>';
            echo '  <html lang="es">';
              echo '  <head>';
                echo '  <meta charset="utf-8">';
                echo '  <meta http-equiv="X-UA-Compatible" content="IE=edge">';
                echo '  <meta name="viewport" content="width=device-width, initial-scale=1">';
                echo '  <title>Ejemplo de nueva página para GOB.mx</title>';



                echo '  <link href="/favicon.ico" rel="shortcut icon">';
                echo '  <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">';

                echo '  <!-- Respond.js soporte de media queries para Internet Explorer 8 -->';
                echo '  <!-- ie8.js EventTarget para cada nodo en Internet Explorer 8 -->';
                  echo '<!--[if lt IE 9]>';
                echo '    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
                echo '    <script src="https://cdnjs.cloudflare.com/ajax/libs/ie8/0.2.2/ie8.js"></script>';
                echo '  <![endif]-->';

                echo '</head>';
              echo '  <body>';

              echo '    <!-- Contenido -->';
              echo '    <main class="page">';
              echo '<img src="../componentes/banner.png" alt=""class="img-responsive"style="width:100%; max-width:1200px;" >';
                echo '    <div class="container">';
                  echo '    <div class="container1">';
                      echo '<ol class="breadcrumb">';
                      echo '<li><a href="../index.html"><i class="icon icon-home"></i></a></li>';
                      echo '<li class=""><a href="../index.html">Inicio</a></li>';
                      echo '<li class=""><a href="index.php">Cargador de datos</a></li>';
                      echo '<li class="active"><a href="../inspecion.php">Historial</a></li>';
                      echo '</ol>';
                    echo '    <div class="box"style="min-height: 500px;">';

echo '<div class="row">';
echo '<div class="col-md-3"></div>';
echo '<div class="col-md-6"><div class="alert alert-danger"> <h6> !Error </h6>Contraseña invalida';
echo '</div>';
echo '</div>';
echo '<div class="col-md-3"></div>';
echo '</div>';
            }
}
echo '<div class="alert alert-info">  <h6>Terminado </h6> Se termino de capturar los datos </div>';

            ?>












</p>

          </div>
        </div>
      </div>
    </main>

    <!-- JS -->
    <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

  </body>
</html>
