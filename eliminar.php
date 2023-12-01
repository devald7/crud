<?php 
  if(!isset($_GET['codigo'])){
    header('Location: crud.php?mensaje=error');
    exit();

  }
  
  include 'model/conexion.php';
  $codigo = $_GET['codigo'];

  $sentencia = $bd->prepare("DELETE FROM datos WHERE codigo = ?;");
  $resultado = $sentencia->execute([$codigo]);

  if ($resultado === TRUE) {
    header('Location: crud.php?mensaje=eliminado');
  } else {
    header('Location: crud.php?mensaje=error');
  }

?>