<?php
/*
 * header.php
 * Encabezado común. Inicia (o reanuda) la sesión, registra la visita a la
 * página actual e incluye el menú y el panel de información de sesión.
 */
require_once __DIR__ . '/config.php';

// Si la sesión todavía no está abierta en esta petición, se inicia / reanuda
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo       = $titulo ?? 'Inicio';          // cada página define su $titulo
$paginaActual = basename($_SERVER['PHP_SELF']); // ej. "bucles.php"

// Contador de visitas por página guardado en la sesión (solo si hay sesión iniciada)
if (isset($_SESSION['inicio'])) {
    if (!isset($_SESSION['visitas'][$paginaActual])) {
        $_SESSION['visitas'][$paginaActual] = 0;
    }
    $_SESSION['visitas'][$paginaActual]++;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo . ' | ' . NOMBRE_SITIO; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header class="encabezado">
    <div class="encabezado__contenido">
        <img src="img/logo.svg" alt="Logo del sitio" class="encabezado__logo">
        <div>
            <h1>Desarrollo Web con PHP</h1>
            <p><?php echo MATERIA; ?> · <?php echo NOMBRE_SITIO; ?></p>
        </div>
    </div>
</header>
<?php include __DIR__ . '/menu.php'; ?>
<?php include __DIR__ . '/sesion_info.php'; ?>
<main class="contenido">
    <h2 class="titulo-pagina"><?php echo $titulo; ?></h2>
