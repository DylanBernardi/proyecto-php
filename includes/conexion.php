<?php

$servidor = 'localhost';
$usuario = 'Dylan29';
$password = '29841';
$database = 'blog';
$db = mysqli_connect($servidor, $usuario, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

if (!isset($_SESSION)) {
    session_start();
}
