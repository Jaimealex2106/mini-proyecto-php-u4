<?php
$titulo = 'Estructuras repetitivas (bucles)';
include __DIR__ . '/includes/header.php';

$numero = 7;     // número para la tabla de multiplicar
$limite = 10;
?>

<section class="tarjeta" id="for">
    <h3>1. Ciclo for</h3>
    <p class="explicacion">
        <code>for</code> se usa cuando se conoce cuántas veces se repetirá algo. Tiene tres partes: inicialización
        (<code>$i = 1</code>), condición (<code>$i &lt;= $limite</code>) e incremento (<code>$i++</code>). Aquí genera
        dinámicamente la tabla de multiplicar del <?php echo $numero; ?> y una tabla de potencias con un for anidado.
    </p>
    <div class="dos-columnas">
        <table class="tabla tabla--compacta">
            <thead><tr><th colspan="2">Tabla del <?php echo $numero; ?></th></tr></thead>
            <tbody>
            <?php for ($i = 1; $i <= $limite; $i++): ?>
                <tr>
                    <td><?php echo "$numero × $i"; ?></td>
                    <td><strong><?php echo $numero * $i; ?></strong></td>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>

        <table class="tabla tabla--compacta">
            <thead>
                <tr>
                    <th>n</th>
                    <?php for ($p = 1; $p <= 4; $p++) { echo "<th>n<sup>$p</sup></th>"; } ?>
                </tr>
            </thead>
            <tbody>
            <?php for ($n = 1; $n <= 6; $n++): ?>
                <tr>
                    <td><strong><?php echo $n; ?></strong></td>
                    <?php for ($p = 1; $p <= 4; $p++): ?>
                        <td><?php echo $n ** $p; ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="tarjeta" id="while">
    <h3>2. Ciclo while</h3>
    <p class="explicacion">
        <code>while</code> repite su bloque mientras la condición sea verdadera; se usa cuando no se sabe de antemano
        cuántas vueltas dará. Ejemplo: un ahorro semanal de $150 que crece 10% cada semana hasta alcanzar la meta de $2,000.
    </p>
    <?php
    $meta    = 2000;
    $ahorro  = 0;
    $deposito = 150;
    $semana  = 0;
    $registros = [];

    while ($ahorro < $meta) {
        $semana++;
        $ahorro += $deposito;
        $registros[] = ['semana' => $semana, 'deposito' => $deposito, 'acumulado' => $ahorro];
        $deposito = round($deposito * 1.10, 2);   // el depósito aumenta 10%
    }
    ?>
    <table class="tabla tabla--compacta">
        <thead><tr><th>Semana</th><th>Depósito</th><th>Acumulado</th></tr></thead>
        <tbody>
        <?php
        $j = 0;
        while ($j < count($registros)): ?>
            <tr>
                <td><?php echo $registros[$j]['semana']; ?></td>
                <td>$<?php echo number_format($registros[$j]['deposito'], 2); ?></td>
                <td>$<?php echo number_format($registros[$j]['acumulado'], 2); ?></td>
            </tr>
        <?php
            $j++;
        endwhile; ?>
        </tbody>
    </table>
    <p class="nota">El ciclo terminó después de <strong><?php echo $semana; ?> semanas</strong>, cuando el ahorro llegó a $<?php echo number_format($ahorro, 2); ?>.</p>

    <h4>do...while</h4>
    <?php
    $contador = 5;
    $cuenta = [];
    do {
        $cuenta[] = $contador;
        $contador--;
    } while ($contador > 0);
    ?>
    <p>Cuenta regresiva (se ejecuta al menos una vez): <strong><?php echo implode(' → ', $cuenta); ?> → 🚀</strong></p>
</section>

<section class="tarjeta" id="foreach">
    <h3>3. Ciclo foreach</h3>
    <p class="explicacion">
        <code>foreach</code> está diseñado para recorrer arreglos elemento por elemento sin manejar índices
        manualmente. Puede obtener solo el valor (<code>as $valor</code>) o también la clave
        (<code>as $clave =&gt; $valor</code>).
    </p>
    <?php
    $materias = ['Programación Web', 'Bases de Datos', 'Redes de Computadoras', 'Ingeniería de Software', 'Sistemas Operativos'];
    $horario = [
        'Lunes'     => '07:00 - 09:00',
        'Martes'    => '09:00 - 11:00',
        'Miércoles' => '11:00 - 13:00',
        'Jueves'    => '07:00 - 09:00',
        'Viernes'   => '13:00 - 15:00',
    ];
    ?>
    <div class="dos-columnas">
        <div>
            <h4>Lista de materias (solo valor)</h4>
            <ol class="lista">
                <?php foreach ($materias as $materia): ?>
                    <li><?php echo $materia; ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
        <div>
            <h4>Horario de Programación Web (clave => valor)</h4>
            <table class="tabla tabla--compacta">
                <thead><tr><th>Día</th><th>Horario</th></tr></thead>
                <tbody>
                <?php foreach ($horario as $dia => $hora): ?>
                    <tr><td><?php echo $dia; ?></td><td><?php echo $hora; ?></td></tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
