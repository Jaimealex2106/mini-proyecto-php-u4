<?php
/*
 * menu.php
 * Menú de navegación común. Se genera con un arreglo asociativo y foreach,
 * marcando como activa la página en la que se encuentra el usuario.
 */
$opcionesMenu = [
    'index.php'         => 'Inicio',
    'variables.php'     => 'Variables',
    'condicionales.php' => 'Condicionales',
    'bucles.php'        => 'Bucles',
    'arreglos.php'      => 'Arreglos',
    'sesiones.php'      => 'Sesiones',
];
?>
<nav class="menu">
    <ul>
        <?php foreach ($opcionesMenu as $archivo => $texto): ?>
            <li>
                <a href="<?php echo $archivo; ?>"
                   class="<?php echo ($archivo === $paginaActual) ? 'activo' : ''; ?>">
                    <?php echo $texto; ?>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="menu__accion"><a href="index.php?accion=reiniciar">⟳ Reiniciar sesión</a></li>
        <li class="menu__accion menu__accion--salir"><a href="index.php?accion=salir">Salir</a></li>
    </ul>
</nav>
