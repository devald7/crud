<?php
include_once("model/conexion.php");

// Verificar si se ha seleccionado "dep" o "fac"
if (!empty($_POST['dep'])) {
  $dep = $_POST['dep'];

  try {
    // Realizar consulta a la base de datos para obtener los registros filtrados por "dep" y el nombre correspondiente
    $sentencia = $bd->prepare("SELECT datos.*, directorio.nombre AS unidad FROM datos JOIN directorio ON datos.unidad = directorio.id WHERE datos.unidad = ?");
    $sentencia->execute([$dep]);
    $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $ex) {
    echo "Error en la conexión: " . $ex->getMessage();
    exit;
  }
} elseif (!empty($_POST['fac'])) {
  $fac = $_POST['fac'];


  //Hacer que se visualice el nombre de la unidad, no el número en si
  //Se ejecuta elseif y no el try and catch, revisar eso.
  try {
    // Realizar consulta a la base de datos para obtener los registros filtrados por "fac" y el nombre correspondiente
    $sentencia = $bd->prepare("SELECT datos.*, directorio.nombre AS unidad FROM datos JOIN directorio ON datos.unidad = directorio.nombre WHERE datos.unidad = ?");
    $sentencia->execute([$fac]);
    $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $ex) {
    echo "Error en la conexión: " . $ex->getMessage();
    exit;
  }
} elseif  ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];

  try {
    // Realizar consulta a la base de datos para obtener los registros que coinciden con nombre y apellido
    $sentencia = $bd->prepare('SELECT * FROM datos WHERE nombre = ? AND apellido LIKE ?');
    $apellidoBusqueda = '%'.$apellido.'%';
    $sentencia->execute([$nombre, $apellidoBusqueda]);
    $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $ex) { 
    echo "Error en la conexión: " . $ex->getMessage();
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Directorio</title>

  <link rel='stylesheet' href='css/bootstrap.min.css'>
  <link rel='stylesheet' href='css/estilos.css'>

  <script type='text/javascript' src='js/jquery.js'></script>
  <script type='text/javascript' src='js/bootstrap.js'></script>
  <script type="text/javascript">
  function limpiar() {
    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
    $(':checkbox, :radio').prop('checked', false);
    $("#comboDep").hide();
    $("#comboFac").hide();
  }
  </script>
</head>

<body>
  <div class="wrapper">
    <div id="muestra">
      <div id="cab" class="content_header">
        <div class="fixed">
          <nav class="navbar navbar-inverse colorMenu" role="navigation">
            <div class="navbar-header">
              <a class="enlace" href="https://enlinea.unapiquitos.edu.pe/"><img class="imgescudo" src='image/escudo.png'
                  alt=''></a>
              <a id="adesktop" class="navbar-brand " href="index.php">Directorio telefónico UNAP</a>
              <a id="amovil" class="navbar-brand" href="index.php">Directorio telefónico</a>
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div id="oculta" class="collapse navbar-collapse navbar-ex1-collapse">

              <ul class="nav navbar-nav navbar-right">
                <li><a href=""></a></li>
                <li><a href=""></a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>

      <div class="sectionPrincipal">
        <div class="container">
          <div class="titleTable">Directorio</div>
          <table>
            <thead>
              <tr>
                <th>Unidad</th>
                <th>Cargo</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Verificar si se obtuvieron resultados de la consulta
              if (isset($registros) && count($registros) > 0) {
                // Iterar sobre los registros y mostrarlos en la tabla
                foreach ($registros as $fila) {
                  echo "<tr>";
                  echo "<td>" . $fila['unidad'] . "</td>";
                  echo "<td>" . $fila['cargo'] . "</td>";
                  echo "<td>" . $fila['nombre'] . "</td>";
                  echo "<td>" . $fila['apellido'] . "</td>";
                  echo "<td>" . $fila['email'] . "</td>";
                  echo "</tr>";
                }
              } else {
                // No se encontraron registros para el número de "dep" seleccionado
                echo "<tr><td colspan='5'>No se encontraron registros.</td></tr>";
                // echo "<tr><td colspan='5'>". print_r($_POST). "</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <div id="btnNb" class="btnform">
            <a class="btn btnLarge" href="index.php">Nueva consulta</a>
          </div>
        </div>


      </div>
    </div>
  </div><!-- Div wrapper-->

  <div id="dFooter" class="content_footer">
    <div class="divfooter">
      <strong>© Diseñado y desarrollado por la Oficina de Tecnologías de la Información (OTI) - 2023 <a
          href="http://telematica.unmsm.edu.pe/">OTI UNAP </a></strong>
    </div>
  </div>

</body>
<link rel='stylesheet' href='css/bootstrap.min.css'>
<link rel='stylesheet' href='css/estilos.css'>

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/bootstrap.js'></script>

</html>