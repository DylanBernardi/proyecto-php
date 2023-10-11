<?php 
if (isset($_POST)){
    require_once 'includes/conexion.php';
}
$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']): false;
$descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']): false;;
$categoria = isset($_POST['categoria']) ? $_POST['categoria']: false;;

$errores=[];

    if(!empty($titulo)){
        $titulo_validado=true;
    }else{
      $titulo_validado=false;
      $errores['titulo']="El titulo es invalido";

    } 
      if (count($errores)== 0){
        $sql= "INSERT INTO entradas VALUES(NULL, '$titulo');";
        $guardar=mysqli_query($db, $sql);
      }
    header("Location:index.php");
?>
