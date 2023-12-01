<?php
//Incluye el archivo de conexión a la base de datos
require_once("model/conexion.php");

try {
  // Realiza la consulta para obtener las opciones del menú desplegable
  $consulta = "SELECT id, nombre, tipo FROM directorio WHERE habilitado = TRUE";
  $sentencia = $bd->prepare($consulta);
  $sentencia->execute();

  //Inicializa dos arrays para almacenar las opciones de Dependencia y Facultad
  $dependencias = array();
  $facultades = array();

  while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $nombre = $row['nombre'];
    $tipo = $row['tipo'];

    //Almacena las opciones correspondientes según el tipo
    if ($tipo == 'Dependencia') {
      $dependencias[] = "<option value='$id'>$nombre</option>";
    } elseif ($tipo == 'Facultad') {
      $facultades[] = "<option value='$id'>$nombre</option>";
    }
  }
} catch (PDOException $ex) {
  echo "Error en la consulta a la base de datos: " .$ex->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Directorio telefónico UNAP</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<!-- Favicon -->

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

<body onload="limpiar()">

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
								<li><a href="">Telefonía</a></li>
								<li><a href="">Correo</a></li>
								<li><a href="vistalogin/login.php" id="mostrar-iniciar-sesion">Iniciar Sesión</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<div class="sectionPrincipal">
				<div class="content_principal">
					<div class="formulario">
						<div class="headerForm">Ver directorio por:</div>
						<div class="panelForm">
							<form id="form1" name="form1" action="directorio.php" method="POST" onsubmit="return validarFormulario()">
								<div class="content_radio">
									<div class="radioform"><label for="radio1"><input type="radio" name="selectorTipo" id="radio1"
												value="dependencia"><span>Dependencia</span></label></div>
									<div class="radioform"><label for="radio2"><input type="radio" name="selectorTipo" id="radio2"
												value="facultad"><span>Facultad</span></label></div>
								</div>

								<select name="dep" id="comboDep" class="selectStyle">
                  <option value="">Seleccione</option>
                  <?php 
                  //Genera las opciones del menú desplegable de Dependencia desde el array
                  foreach ($dependencias as $opcion) {
                    echo $opcion;
                  }
                  ?>  
								</select>

									<!-- AQUI COMIENZA LAS FACULTADES -->

									<select name="fac" id="comboFac" class="selectStyle">
                    <option value="">Seleccione</option>
                    <?php
                    //Genera las opciones del menú desplegable de Facultad desde el array
                    foreach ($facultades as $opcion) {
                      echo $opcion;
                    }
                    ?>
                  </select>
								</div>
								<input type="hidden" name="variable" id="variableForm1" value="">
								<div class="btnform"><input type='submit' value='Mostrar' class="btn btnLarge"></div>
							</form>
						</div>
					</div>
					<div class="content_principal">
					<div class="formulario">
						<div class="headerForm">Búsqueda por criterios</div>
						<div class="panelForm">
							<form id="form2" name="form2" action="directorio.php" method="POST" onsubmit="return validarFormulario2()">
								<div class="componentForm"><input type='text' name='nombre' id="nombre" placeholder='Nombres'
										class="textForm"></div>
								<div class="componentForm"><input type='text' name='apellido' id="apellido" placeholder='Apellidos'
										class="textForm"></div>
								<div class="btnform"><input type='submit' value='Buscar' class="btn btnLarge"></div>
							</form>
						</div><!-- panelForm-->
					</div><!-- formulario-->
				</div><!-- content_principal-->
			</div><!-- sectionPrincipal-->

		</div>
	</div><!-- Div wrapper-->
</div>

	
  <?php include 'template/footer.php'?>

	<!-- JavaScript para validar el formulario antes de enviarlo -->
<script type="text/javascript">
    function validarFormulario() {
        if (!$("input[name='selectorTipo']").is(":checked") || (!$("select[name='dep']").val() && !$("select[name='fac']").val())) {
            alert("Debe seleccionar una opción válida antes de realizar la consulta.");
            return false;
        }
        return true;
    }
</script>

<script type="text/javascript">
    function validarFormulario2() {
			var nombre = $("input[name='nombre']").val();
			var apellido = $("input[name='apellido']").val();

			if (!nombre || !apellido) {
				alert("Debe ingresar un nombre y apellido antes de realizar la búsqueda.");
				return false;
			}
			return true;
		}
</script>
	
	<script type="text/javascript">
		$(document).ready(function () {
			$("#mostrar-iniciar-sesion").click(function () {
				$("#formulario-inicio-sesion").toggle();
			});
		});

	</script>
	
	<script type="text/javascript">
		$("#radio1").click(function () {

			$("#comboDep").show();
			$("#comboFac").hide();


		});

		$("#radio2").click(function () {

			$("#comboDep").hide();
			$("#comboFac").show();


		});


	</script>


</body>

</html>