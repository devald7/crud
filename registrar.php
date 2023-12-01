<?php 
  print_r($_POST);
  if(empty($_POST["oculto"]) || empty($_POST["txtUnidad"]) || empty($_POST["txtCargo"]) || empty($_POST["txtNombre"]) || empty($_POST["txtApellido"]) || empty($_POST["txtEmail"])){
    header('location: crud.php?mensaje=falta');
    exit();
}

  include_once 'model/conexion.php';
  $unidad = $_POST["txtUnidad"];
  $cargo = $_POST["txtCargo"];
  $nombre = $_POST["txtNombre"];
  $apellido = $_POST["txtApellido"];
  $email = $_POST["txtEmail"];

try {
  $sentencia = $bd ->prepare("CALL insertarDatos(?, ?, ?, ?, ?);");
  $sentencia->bindParam(1, $unidad, PDO::PARAM_STR);
  $sentencia->bindParam(2, $cargo, PDO::PARAM_STR);
  $sentencia->bindParam(3, $nombre, PDO::PARAM_STR);
  $sentencia->bindParam(4, $apellido, PDO::PARAM_STR);
  $sentencia->bindParam(5, $email, PDO::PARAM_STR);

  if ($sentencia->execute()) {
    header('Location: crud.php?mensaje=registrado');
  } else {
    header('Location: crud.php?mensaje=error: '). $sentencia->errorInfo()[2];
  }
}catch (PDOException $ex) {
  echo "Error: ".$ex->getMessage();
}

$bd = null;
?>