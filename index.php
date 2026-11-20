<?php
/*
 * index.php
 * Página de inicio. Aquí se INICIA la sesión del sistema.
 * Si ya existe una sesión, se destruye para poder iniciar nuevamente
 * con una nueva hora de inicio.
 *
 * Acciones (por URL, sin formularios):
 *   index.php?accion=iniciar   -> inicia sesión (si existía, la destruye primero)
 *   index.php?accion=reiniciar -> destruye la sesión actual y crea una nueva hora inicial
 *   index.php?accion=salir     -> destruye la sesión y deja al usuario fuera
 */
require_once __DIR__ . '/includes/config.php';
session_start();

$accion = $_GET['accion'] ?? '';

if ($accion === 'iniciar' || $accion === 'reiniciar') {
    // 1) Si existe una sesión previa se destruye
    $_SESSION = [];          // vacía las variables de sesión
    session_destroy();       // elimina la sesión del servidor

    // 2) Se inicia una sesión nueva con un ID nuevo
    session_start();
    session_regenerate_id(true);

    // 3) Se registra la hora de inicio con time()
    $_SESSION['inicio']   = time();
    $_SESSION['visitas']  = [];
    $_SESSION['reinicios'] = ($accion === 'reiniciar') ? 1 : 0;

    // Redirección para limpiar la URL (evita reiniciar al recargar)
    header('Location: index.php?estado=' . $accion);
    exit;
}

if ($accion === 'salir') {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php?estado=salir');
    exit;
}

$estado = $_GET['estado'] ?? '';
$titulo = 'Inicio';
include __DIR__ . '/includes/header.php';

// Saludo dinámico según la hora del día
$hora = (int) date('G');
if ($hora < 12) {
    $saludo = 'Buenos días';
} elseif ($hora < 19) {
    $saludo = 'Buenas tardes';
} else {
    $saludo = 'Buenas noches';
}
?>

<?php if ($estado === 'iniciar'): ?>
    <div class="alerta alerta--exito">✔ Sesión iniciada correctamente a las <?php echo date('H:i:s', $_SESSION['inicio']); ?>.</div>
<?php elseif ($estado === 'reiniciar'): ?>
    <div class="alerta alerta--info">⟳ La sesión anterior se destruyó con <code>session_destroy()</code> y se creó una nueva hora inicial.</div>
<?php elseif ($estado === 'salir'): ?>
    <div class="alerta alerta--aviso">Has salido del sistema. La sesión fue destruida. Debes <strong>reiniciar la sesión</strong> para continuar.</div>
<?php endif; ?>

<section class="tarjeta">
    <h3><?php echo $saludo; ?> 👋</h3>
    <p>
        Bienvenido al mini proyecto de la <strong>Unidad 4 – Programación del lado del servidor con PHP</strong>.
        Este sitio demuestra el uso de variables, tipos de datos, estructuras de control, arreglos y sesiones.
        Todo el contenido que ves se genera dinámicamente en el servidor.
    </p>

    <?php if (isset($_SESSION['inicio'])): ?>
        <p>Tu sesión está activa. Navega por el menú: en cada página verás tu hora de inicio, la hora actual y el tiempo activo.</p>
        <a class="boton boton--secundario" href="index.php?accion=reiniciar">⟳ Reiniciar sesión</a>
        <a class="boton boton--peligro" href="index.php?accion=salir">Salir</a>
    <?php else: ?>
        <p>Para comenzar, inicia la sesión. Se guardará tu hora de inicio con <code>time()</code> dentro de <code>$_SESSION</code>.</p>
        <a class="boton" href="index.php?accion=iniciar">▶ INICIAR SESIÓN</a>
    <?php endif; ?>
</section>

<section class="tarjeta">
    <h3>Contenido del sitio</h3>
    <div class="rejilla">
        <?php
        // Arreglo asociativo con la descripción de cada página
        $temas = [
            'variables.php'     => ['Variables', 'Tipos de datos, cómo se crean y funciones como date() y count().'],
            'condicionales.php' => ['Condicionales', 'if, else, elseif y switch para tomar decisiones.'],
            'bucles.php'        => ['Bucles', 'for, while y foreach para realizar repeticiones.'],
            'arreglos.php'      => ['Arreglos', 'Indexados, asociativos y multidimensionales.'],
            'sesiones.php'      => ['Sesiones', 'Persistencia de datos en memoria con $_SESSION.'],
        ];
        foreach ($temas as $archivo => $info): ?>
            <a class="rejilla__item" href="<?php echo $archivo; ?>">
                <strong><?php echo $info[0]; ?></strong>
                <span><?php echo $info[1]; ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="tarjeta">
    <h3>¿Cómo funciona el inicio de sesión?</h3>
    <p>
        Al presionar <em>Iniciar sesión</em>, PHP ejecuta <code>session_start()</code>. Si ya existía una sesión,
        primero se vacía <code>$_SESSION</code> y se destruye con <code>session_destroy()</code>; después se abre una
        sesión nueva y se guarda la hora actual en <code>$_SESSION['inicio']</code> usando <code>time()</code>, que
        devuelve los segundos transcurridos desde el 1 de enero de 1970 (timestamp Unix).
    </p>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
