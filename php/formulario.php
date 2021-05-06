<?php require_once("buscar.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultas</title>
    <script src="..\librerias\jQuery v3.5.1.js" ></script>

    <!-- CSS -->
    <link  rel="stylesheet" href="../css/normalize.css" >
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <link  rel="stylesheet" href="../css/style.css" >
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
          <div class="container1">
            <img src="../componentes/banner4.png" alt=""class="img-responsive"style="width:90%; max-width:1200px;" >
            <ol class="breadcrumb">
              <li><a href="../index.html"><i class="icon icon-home"></i></a></li>
              <li ><a href="../index.html">Inicio</a></li>
              <li class="active"><a href="formulario.php">Consulta</a></li>
            </ol>

            <div class="row" style="margin-top:-30px;">
              <div class="col-md-8 pull-left">
                <h3>Consulta</h3>
                <hr class="red">
              </div>
            </div>
            <div class="row" style="padding-right:20%; font-size:14px;">
              <div class="col-md-12">
                <form class="form-horizontal" role="form" action="tarifas.php" method="post">
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="email-03">Estado:</label>
                    <div class="col-sm-9">
                      <select  id="lista1" name="lista1" class="form-control" >
                        <option value="0">ESTADO</option>
                        <option value="1">AGUASCALIENTES</option>
                        <option value="2">BAJA CALIFORNIA</option>
                        <option value="3">BAJA CALIFORNIA SUR</option>
                        <option value="4">CAMPECHE</option>
                        <option value="5">COAHUILA DE ZARAGOZA</option>
                        <option value="6">COLIMA</option>
                        <option value="7">CHIAPAS</option>
                        <option value="8">CHIHUAHUA</option>
                        <option value="9">CIUDAD DE MEXICO</option>
                        <option value="10">DURANGO</option>
                        <option value="11">GUANAJUATO</option>
                        <option value="12">GUERRERO</option>
                        <option value="13">HIDALGO</option>
                        <option value="14">JALISCO</option>
                        <option value="15">MEXICO</option>
                        <option value="16">MICHOACAN DE OCAMPO</option>
                        <option value="17">MORELOS</option>
                        <option value="18">NAYARIT</option>
                        <option value="19">NUEVO LEON</option>
                        <option value="20">OAXACA</option>
                        <option value="21">PUEBLA</option>
                        <option value="22">QUERETARO</option>
                        <option value="23">QUINTANA ROO</option>
                        <option value="24">SAN LUIS POTOS</option>
                        <option value="25">SINALOA</option>
                        <option value="26">SONORA</option>
                        <option value="27">TABASCO</option>
                        <option value="28">TAMAULIPAS</option>
                        <option value="29">TLAXCALA</option>
                        <option value="30">VERACRUZ DE IGNACIO DE LA LLAVE</option>
                        <option value="31">YUCATAN</option>
                        <option value="32">ZACATECAS</option>

                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="password-03">Municipio:</label>
                    <div class="col-sm-9">
                      <div id="selectlista2"> </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="password-03">Año:</label>
                    <div class="col-sm-9">
                      <div id="selectlista3"> </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button class="btn btn-primary pull-right active" type="submit" name="button">Consultar</button>
                    </div>
                  </div>
                </form>

              </div>

            </div>

            <div class="row">

              <div class="col-md10 titulo" style="margin-top: 20px;">
                <p>Registros</p>
              </div>
              <div class="col-md.2"> </div>
            </div>
        <div class="row cuadro" style=" max-height: 200px;padding-right: 10%;font-size: 13.5px; overflow:auto;">
          <div class="col-md-12">
            <?php consulta(); ?>
          </div>

        </div>


        </div>
      </div>
    </main>

    <!-- JS -->
    <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

  </body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    recargarlista();
    recargaraño();
    $('#lista1').change(function(){
      recargarlista();
    });
  })
</script>

<script type="text/javascript">
  function recargarlista(){
    $.ajax({
      type:"POST",
      url:"consulmun.php",
      data:"estado=" + $ ('#lista1').val(),
      success:function(r){
        $('#selectlista2').html(r);
      }
    });
  }
</script>

<script type="text/javascript">
  function recargaraño(){
    $.ajax({
      type:"GET",
      url:"consulyear.php",

      data:$('#lista3').val(),
      success:function(r){
        $('#selectlista3').html(r);
      }
    });
  }
</script>
