
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Capturador de datos</title>


    <!-- CSS -->
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

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
      <td class="HeadBgImage" valign="baseline" height="17" colspan="3">
          <div id="menuContainer">
                      <nav class="navbar navbar-inverse sub-navbar navbar-fixed-top">
                          <div class="container">
                              <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subenlaces">
                                  <span class="sr-only">Interruptor de Navegación</span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="/">IMTA</a>
                              </div>
                              <div class="collapse navbar-collapse" id="subenlaces">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="maquetado.xlsx" style="border-radius: 0 5px 0 0" download="maquetado.xlsx"><span class="glyphicon glyphicon-file"></span>&nbsp;Archivo </a></li>
                                    <li><a href="contacto.php" style="border-radius: 0 5px 0 0"><span class="glyphicon glyphicon-envelope"></span>&nbsp; Contacto</a></li>
                                    <li><a href="manual.pdf" style="border-radius: 0 5px 0 0" download="manual.pdf"><span class="glyphicon glyphicon-book"></span>&nbsp;Manual de usuario</a></li>
                                  <div class="collapse navbar-collapse" style="vertical-align:text-bottom"  >

                                  </div>

                                </ul>

                              </div>
                          </div>
                     </nav>
                  </div>
                </td>
      <div class="container" >
      <div class="container">
        <div class="box-form"><!--seccion de formulario-->
          <div class="container1">

            <ol class="breadcrumb" style="max-height: 30px;">
              <li><a href="../index.html"><i class="icon icon-home"></i></a></li>
              <li class=""><a href="../index.html">Inicio</a></li>
              <li class="active"><a href="index.php">Administrador</a></li>
            </ol>
            <div class="row">
              <div class="col-md-8 pull-left">
                <h2>Administrador</h2>
                <hr class="red">
              </div>
            </div>

            <div class="formulario" style="margin-bottom:80px;">
              <form role="form" action="inspeccion.php" method="post" class="form" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label">Usuario: </label>
    <input class="form-control" type="text" name="usuario" required>
  </div>

  <div class="form-group">
    <label class="control-label">Contraseña: </label>
    <input class="form-control" type="password" name="pass" required>
  </div>

  <div class="form-group">
    <label class="control-label" for="file-01">Cargar archivo:</label>
    <input   type="file" name="archivo"  class="form-file"><!--entrada de archivo -->
  </div>

  <button type="submit" name="enviar" class="form-buton btn btn-primary pull-right active" > Subir archivos</a></button>
  <input style="display:none;" type="submit" name="enviar" value="Subirarchivo" class="form-buton btn btn-primary pull-right"><!--boton -->
</form>



            </div>

          </div>
        </div>
      </div>
    </main>

    <!-- JS -->
    <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

  </body>
</html>
