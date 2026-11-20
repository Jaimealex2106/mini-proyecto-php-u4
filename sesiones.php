<?php
$titulo = 'Manejo de sesiones';
include __DIR__ . '/includes/header.php';   // header.php ejecuta session_start()

$haySesion = isset($_SESSION['inicio']);

if ($haySesion) {
    // Cálculo del tiempo activo: hora actual - hora de inicio
    $inicio     = $_SESSION['inicio'];
    $ahora      = time();
    $diferencia = $ahora - $inicio;           // segundos
    $min        = intdiv($diferencia, 60);    // conversión a minutos
    $seg        = $diferencia % 60;           // segundos restantes

    $totalVisitas = array_sum($_SESSION['visitas']);
}
?>

<section class="tarjeta" id="que-es">
    <h3>¿Qué es una sesión y para qué sirve?</h3>
    <p class="explicacion">
        HTTP no guarda memoria entre una página y otra. Una <strong>sesión</strong> permite conservar datos del
        usuario mientras navega: PHP crea un identificador único (<code>session_id()</code>), lo envía al navegador
        en una cookie (<code>PHPSESSID</code>) y guarda los datos en el servidor. Cada página que llama a
        <code>session_start()</code> recupera esos datos a través del arreglo superglobal <code>$_SESSION</code>.
        Así podemos saber a qué hora entró el usuario sin usar base de datos ni archivos propios.
    </p>
</section>

<?php if ($haySesion): ?>
<section class="tarjeta" id="tiempo">
    <h3>Control del tiempo activo</h3>
    <table class="tabla">
        <thead><tr><th>Paso</th><th>Código PHP</th><th>Resultado</th></tr></thead>
        <tbody>
            <tr><td>1. Hora de inicio (guardada en index.php)</td><td><code>$_SESSION['inicio']</code></td><td><?php echo $inicio; ?> → <?php echo date('H:i:s', $inicio); ?></td></tr>
            <tr><td>2. Hora actual</td><td><code>time()</code></td><td><?php echo $ahora; ?> → <?php echo date('H:i:s', $ahora); ?></td></tr>
            <tr><td>3. Diferencia en segundos</td><td><code>$ahora - $inicio</code></td><td><?php echo $diferencia; ?> s</td></tr>
            <tr><td>4. Minutos</td><td><code>intdiv($diferencia, 60)</code></td><td><?php echo $min; ?></td></tr>
            <tr><td>5. Segundos restantes</td><td><code>$diferencia % 60</code></td><td><?php echo $seg; ?></td></tr>
        </tbody>
    </table>
    <p class="resultado-grande">Tiempo activo: <strong><?php echo $min; ?> minutos <?php echo $seg; ?> segundos</strong></p>
</section>

<section class="tarjeta" id="datos">
    <h3>Datos guardados en $_SESSION</h3>
    <div class="dos-columnas">
        <div>
            <ul class="lista">
                <li><strong>ID de sesión:</strong> <code><?php echo session_id(); ?></code></li>
                <li><strong>Nombre de la cookie:</strong> <?php echo session_name(); ?></li>
                <li><strong>Páginas visitadas en esta sesión:</strong> <?php echo $totalVisitas; ?></li>
            </ul>
            <h4>Visitas por página (persisten entre páginas)</h4>
            <table class="tabla tabla--compacta">
                <thead><tr><th>Página</th><th>Visitas</th></tr></thead>
                <tbody>
                <?php foreach ($_SESSION['visitas'] as $pagina => $veces): ?>
                    <tr class="<?php echo ($pagina === 'sesiones.php') ? 'fila-resaltada' : ''; ?>">
                        <td><?php echo $pagina; ?></td><td><?php echo $veces; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
            <h4>print_r($_SESSION)</h4>
            <pre class="codigo"><?php print_r($_SESSION); ?></pre>
        </div>
    </div>
</section>

<section class="tarjeta" id="reinicio">
    <h3>Reiniciar o cerrar la sesión</h3>
    <p class="explicacion">
        <em>Reiniciar sesión</em> vacía <code>$_SESSION</code>, ejecuta <code>session_destroy()</code>, abre una sesión
        nueva y guarda una nueva hora inicial con <code>time()</code>. <em>Salir</em> solo destruye la sesión; para
        volver a usar el sistema hay que iniciarla de nuevo en el index.
    </p>
    <a class="boton boton--secundario" href="index.php?accion=reiniciar">⟳ Reiniciar sesión</a>
    <a class="boton boton--peligro" href="index.php?accion=salir">Salir</a>
</section>
<?php else: ?>
<section class="tarjeta">
    <div class="alerta alerta--aviso">
        No existe <code>$_SESSION['inicio']</code>. Ve al inicio y presiona <strong>Iniciar sesión</strong> para comenzar a medir el tiempo activo.
    </div>
    <a class="boton" href="index.php?accion=iniciar">▶ INICIAR SESIÓN</a>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
