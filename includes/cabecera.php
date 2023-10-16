<?php require_once 'conexion.php'; ?>
<?php require_once 'helpers.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Blog de videojuegos</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>

<body>
    <header id="cabecera">
        <img src="./assets/img/control.jpg" id="logo-control">
        <div id="logo">
            <a href="index.php">
                Blog de videojuegos
            </a>
        </div>

        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <?php
                $categorias = conseguirCategorias($db);
                if (!empty($categorias)) :
                    while ($categoria = mysqli_fetch_assoc($categorias)) :  ?>
                        <li>
                            <a href="categoria.php?id=<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></a>
                        </li>
                <?php
                    endwhile;
                endif; ?>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>
    <div id="contenedor">