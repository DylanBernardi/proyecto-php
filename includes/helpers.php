<?php

function mostrarError($errores, $campo)
{
    $alerta = '';

    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
    }
    return $alerta;
}

function borrarErrores()
{
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = true;
    }

    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $borrado = true;
    }

    if (isset($_SESSION['errores_entrada'])) {
        $_SESSION['errores_entrada'] = null;
        $borrado = true;
    }
}

function conseguirCategorias($conexion)
{
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    $result = array();

    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $result = $categorias;
    }
    return $result;
}

function conseguirEntrada($db, $id)
{
    $sql = "SELECT e.*, c.nombre as 'categoria', CONCAT(u.nombre,u.apellidos) as usuario FROM entradas e " .
        "INNER JOIN categorias c ON e.categoria_id=c.id " .
        "INNER JOIN usuarios u ON e.usuario_id=u.id " .
        "WHERE e.id = $id";
    $entrada = mysqli_query($db, $sql);
    $resultado = [];
    if ($entrada && mysqli_num_rows($entrada) >= 1) {
        $resultado = mysqli_fetch_assoc($entrada);
    }
    return $resultado;
}


function conseguirCategoria($conexion, $id)
{
    $sql = "SELECT * FROM categorias WHERE id = '$id';";
    $categorias = mysqli_query($conexion, $sql);
    $result = array();

    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $result = mysqli_fetch_assoc($categorias);
    }
    return $result;
}

function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null)
{
    $sql = "SELECT e.*,c.nombre as 'categoria' FROM entradas e
        INNER JOIN categorias c ON e.categoria_id=c.id ";

    if (!empty($categoria)) {
        $sql .= "WHERE e.categoria_id=$categoria ";
    }

    if (!empty($busqueda)) {
        $sql .= "WHERE e.titulo LIKE '%$busqueda%'";
    }

    $sql .= "ORDER BY e.id DESC";

    if ($limit) {
        $sql .= " LIMIT 4";
    }

    $entradas = mysqli_query($conexion, $sql);
    $resultado = [];
    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }
    return $resultado;
}
