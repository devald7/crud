<?php include 'template/header.php'?>

<?php 

  include_once "model/conexion.php";
  $sentencia = $bd -> query("SELECT * FROM datos");
  $datos = $sentencia->fetchAll(PDO::FETCH_OBJ);
  //print_r($datos);

?>

<script src="js/domin.js"></script>

<div class="container">
  <div class="row justify-content-center my-3">
    <div class="col-md-8">
      <!--Inicio Alerta -->
      <?php 
        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){

          ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Error!</strong> Rellena todos los campos.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <?php 
        }
      ?>


      <?php 
        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){

          ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Registrado</strong> Se agregaron los datos satisfactoriamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <?php 
        }
      ?>


      <?php 
        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){

          ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Vuelve a intentarlo.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <?php 
        }
      ?>


      <?php 
        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
          ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Éxito!</strong> Los datos han sido actualizados correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <?php 
        }
      ?>


      <?php 
        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
          ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Los datos han sido eliminados correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <?php 
        }
      ?>
      <!--Fin Alerta -->
      <div class="card">
        <div class="card-header">
          Lista de personas
        </div>
        <div class="p-4">
          <div class="table-responsive">
            <table class="table">
              <thead style="background-color: #004225;">
                <tr class="text-light text">
                  <th scope="col">Unidad</th>
                  <th scope="col">Cargo</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Correo</th>
                  <th scope="col" colspan="2">Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($datos as $dato){
                    //Obtener el nombre de la unidad basado en el numero de la unidad ($dato->unidad)
                    $numeroUnidad = $dato->unidad;
                    $nombreUnidad = ''; //Inicializa la vaiable de nombre de unidad

                    //Realiza una consulta para obtener el nombre de la unidad

                    try {
                      $sentenciaUnidad = $bd->prepare("SELECT nombre FROM directorio WHERE id = :id");
                      $sentenciaUnidad->bindParam(':id', $numeroUnidad, PDO::PARAM_INT);
                      $sentenciaUnidad->execute();
                      $filaUnidad = $sentenciaUnidad->fetch(PDO::FETCH_ASSOC);
                      if ($filaUnidad) {
                        $nombreUnidad = $filaUnidad['nombre'];
                      }
                    } catch (PDOException $ex) {
                      echo "Error en la consulta de unidad: ".$ex->getMessage();
                    }
                ?>
                <tr class="text">
                  <td scope="row"><?php echo$nombreUnidad; ?></td>
                  <td><?php echo$dato->cargo;?></td>
                  <td><?php echo$dato->nombre;?></td>
                  <td><?php echo$dato->apellido;?></td>
                  <td><?php echo$dato->email;?></td>
                  <td><a class="text-success" href="editar.php?codigo=<?php echo$dato->codigo; ?>"><i
                        class="bi bi-pencil-square"></i></a></td>
                  <td><a onclick="return confirm('Estás seguro de eliminar?')" class="text-danger"
                      href="eliminar.php?codigo=<?php echo$dato->codigo; ?>"><i class="bi bi-trash"></i></a></td>
                </tr>
                <?php 
                  }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-header">
          Ingresar Datos
        </div>
        <form class="p-3" method="POST" action="registrar.php">
          <div class="mb-3">
            <label class="form-label">Unidad:</label>
            <select class="form-control" name="txtUnidad" required>
              <option value="">Seleccione...</option>
              <?php
                  try {
                    $sentencia = $bd->prepare("SELECT id, nombre, habilitado FROM directorio;");
                    $sentencia->execute();

                    while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                      $id = $row['id'];
                      $nombre = $row['nombre'];
                      $habilitado = $row['habilitado'];

                      $disabledAttribute = $habilitado ? '' : 'disabled';

                      echo "<option value='$id' $disabledAttribute>$nombre</option>";
                    }
                  } catch (PDOException $ex) {
                    echo "Error en la consulta: ".$ex->getMessage();
                  }
                  ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Cargo:</label>
            <input type="text" class="form-control" name="txtCargo" autofocus required>
          </div>
          <div class="mb-3">
            <label class="form-label">Nombres:</label>
            <input type="text" class="form-control" name="txtNombre" autofocus required>
          </div>
          <div class="mb-3">
            <label class="form-label">Apellidos:</label>
            <input type="text" class="form-control" name="txtApellido" autofocus required>
          </div>
          <div class="mb-3">
            <label class="form-label">Correo:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="txtEmail" autofocus required>
            </div>
          </div>
          <div class="d-grid">
            <input type="hidden" name="oculto" value="1">
            <input type="submit" class="btn btn-primary" value="Registrar">
          </div>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
</div>

<?php include 'template/footer.php'?>