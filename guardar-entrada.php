<?php
if (isset($_POST)) {
  require_once 'includes/conexion.php';
}
$titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
$descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;;
$usuario = $_SESSION['usuario']['id'];

$errores = [];

if (empty($titulo)) {
  $errores['titulo'] = "El titulo es invalido";
}

if (empty($categoria)) {
  $errores['categoria'] = "La categoria es invalida";
}

if (empty($descripcion)) {
  $errores['categoria'] = "La categoria es invalida";
}

if (count($errores) == 0) {
  $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
  $guardar = mysqli_query($db, $sql);
  header("Location:index.php");
} else {
  $_SESSION['errores_entrada'] = $errores;
  header("Location:crear-entrada.php");
}
