<?php
  print_r($_POST);
  if(!isset($_POST['codigo'])) {
    header('Location: crud.php?mensaje=error');
  }
  
  include 'model/conexion.php';
  $codigo = $_POST['codigo'];
  $unidad = $_POST['txtUnidad'];
  $cargo = $_POST['txtCargo'];
  $nombre = $_POST['txtNombre'];
  $apellido = $_POST['txtApellido'];
  $correo = $_POST['txtEmail'];

  $sentencia = $bd->prepare("UPDATE datos SET unidad = ?, cargo = ?, nombre = ?, apellido = ?, email = ? WHERE codigo = ?;");
  $resultado = $sentencia->execute([$unidad, $cargo, $nombre, $apellido, $correo, $codigo]);

  if ($resultado === TRUE) {
    header('Location: crud.php?mensaje=editado');
  } else {
    header('Location: crud.php?mensaje=error');
    exit();
  }
  
?>