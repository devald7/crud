<?php 

require_once("model/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $contrasena = $_POST["contrasena"];

  $query = "SELECT id FROM sesion WHERE nombre=? AND contrasena = ?";
  $sentencia = $bd->prepare($query);
  $sentencia->execute([$nombre, $contrasena]);
  $usuario = $sentencia->fetch();

  if ($usuario) {
    header("Location: crud.php");
    exit();
  } else {
    echo "Credenciales incorrectas. Por favor, intente nuevamente.";
  }
}

?> 