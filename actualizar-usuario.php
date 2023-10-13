<?php

if(isset($_POST)){
    require_once 'includes/conexion.php';
    
    $nombre =isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) :false;    
    $apellidos= isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']):false;        
    $email=isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])):false;   
}
    $errores=[];

    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado=true;
    }else{
      $nombre_validado=false;
      $errores['nombre']="El nombre es invalido";
    }
    
        if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validado=true;
    }else{
      $apellidos_validado=false;
        $errores['apellidos']="El apellido es invalido";
    }
    
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado=true;
    }else{
      $email_validado=false;
        $errores['email']="El email es invalido";
    }
    
    $guardar_usuario=false;
    
   if(count($errores)==0){
    $guardar_usuario=true;

    //comprobar si el usuario existe
    $usuario = $_SESSION['usuario'];
    $sql = "UPDATE usuarios SET nombre='$nombre',apellidos='$apellidos',email='$email' WHERE id = ".$usuario['id'];
    $guardar=mysqli_query($db, $sql);

    $sql= "SELECT id, email FROM usuarios WHERE email = '$email'";
    $isset_email = mysqli_query($db,$sql);
    $isset_user = mysqli_fetch_assoc($isset_email);

    if($isset_user['id']== $usuario['id'] || empty($isset_user)){
       if ($guardar){
        $_SESSION['usuario']['nombre']=$nombre;
        $_SESSION['usuario']['apellidos']=$apellidos;
        $_SESSION['usuario']['email']=$email;
        $_SESSION['completado'] = "Tus datos se han actualizado correctamente";
       }else {
           $_SESSION['errores']['general']="Fallo al guardar actualizar!!"; 
       }
    }else {
        $_SESSION['errores']['general'] = "El usuario ya existe";
    }

    
       
   }else{
       $_SESSION['errores']= $errores;
       
   }
header('Location:mis-datos.php');