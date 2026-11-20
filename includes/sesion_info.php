<?php
/*
 * sesion_info.php
 * Panel que aparece en TODAS las páginas con:
 *   - Hora de inicio de sesión (guardada con time() en index.php)
 *   - Hora actual
 *   - Tiempo activo = hora actual - hora de inicio (en minutos y segundos)
 */
if (isset($_SESSION['inicio'])) {
    $horaInicio    = $_SESSION['inicio'];      // timestamp guardado en la sesión
    $horaActual    = time();                   // timestamp de este momento
    $tiempoActivo  = $horaActual - $horaInicio; // diferencia en segundos

    $minutos  = intdiv($tiempoActivo, 60);     // minutos completos
    $segundos = $tiempoActivo % 60;            // segundos restantes
}
?>
<section class="panel-sesion">
    <?php if (isset($_SESSION['inicio'])): ?>
        <div class="panel-sesion__dato">
            <span>Hora inicio sesión</span>
            <strong><?php echo date('H:i:s', $horaInicio); ?></strong>
        </div>
        <div class="panel-sesion__dato">
            <span>Hora actual</span>
            <strong><?php echo date('H:i:s', $horaActual); ?></strong>
        </div>
        <div class="panel-sesion__dato panel-sesion__dato--destacado">
            <span>Tiempo activo</span>
            <strong><?php echo $minutos; ?> minutos <?php echo $segundos; ?> segundos</strong>
        </div>
    <?php else: ?>
        <p class="panel-sesion__aviso">
            No hay una sesión activa.
            <a href="index.php?accion=iniciar">Inicia sesión en la página de inicio</a>
            para registrar tu hora de entrada.
        </p>
    <?php endif; ?>
</section>
