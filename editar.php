<?php include 'template/header.php' ?>

<?php 
  if(!isset($_GET['codigo'])){
    header('Location: crud.php?mensaje=error');
    exit();
  }

  include_once 'model/conexion.php';

  $codigo = $_GET['codigo'];
  
  $sentencia = $bd->prepare("SELECT * FROM datos WHERE codigo = ?");
  $sentencia->execute([$codigo]);
  $datos = $sentencia->fetch(PDO::FETCH_OBJ);
  //print_r($datos);
?>

<script src="js/domin.js"></script>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4 ">
      <div class="card">
        <div class="card-header">
          Editar Datos:
        </div>
        <form class="p-4" method="POST" action="editarProceso.php">
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
                  
                      // Compara el ID de la unidad con la unidad asociada al usuario
                      $selected = ($id == $datos->unidad) ? "selected" : "";
                      
                      // Aplica el atributo 'disabled' a las opciones deshabilitadas
                      $disabledAttribute = $habilitado ? '' : 'disabled';
                  
                      echo "<option value='$id' $selected $disabledAttribute>$nombre</option>";
                  }
                  
                } catch (PDOException $ex) {
                  echo "Error en la consulta: " . $ex->getMessage();
                }
                ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Cargo:</label>
            <input type="text" class="form-control" name="txtCargo" required value="<?php echo $datos->cargo; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Nombres:</label>
            <input type="text" class="form-control" name="txtNombre" required value="<?php echo $datos->nombre; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Apellidos:</label>
            <input type="text" class="form-control" name="txtApellido" required value="<?php echo $datos->apellido; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Correo:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="txtEmail" required value="<?php echo $datos->email; ?>">
            </div>
          </div>
          <div class="d-grid">
            <input type="hidden" name="codigo" value="<?php echo $datos->codigo; ?>">
            <input type="submit" class="btn btn-primary" value="Guardar">
          </div>
      </div>
    </div>
  </div>
</div>

<?php include 'template/footer.php' ?>