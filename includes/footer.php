<?php
/*
 * footer.php
 * Pie de página común. Usa el arreglo $integrantes definido en config.php.
 */
?>
</main>
<footer class="pie">
    <p><strong>Equipo:</strong> <?php echo implode(' · ', $integrantes); ?></p>
    <p><?php echo INSTITUTO; ?> · <?php echo MATERIA; ?> · <?php echo date('Y'); ?></p>
    <p class="pie__generado">Página generada por PHP <?php echo PHP_VERSION; ?> el <?php echo date('d/m/Y \a \l\a\s H:i:s'); ?></p>
</footer>
</body>
</html>
