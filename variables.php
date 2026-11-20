<?php
$titulo = 'Variables y tipos de datos';
include __DIR__ . '/includes/header.php';

/* ====== 1. Declaración de variables ======
 * En PHP una variable inicia con $ y no se declara su tipo:
 * el tipo se asigna automáticamente según el valor (tipado dinámico).
 */
$nombre       = 'Julia';              // string
$edad         = 20;                   // int
$promedio     = 9.35;                 // float
$esEstudiante = true;                 // boolean
$materias     = ['PHP', 'HTML', 'CSS', 'JavaScript']; // array
$semestre     = 5;
$fechaHoy     = date('d/m/Y');        // función date()
$horaHoy      = date('H:i:s');
$totalMaterias = count($materias);    // función count()

// Concatenación de strings con el operador punto (.)
$mensaje = 'Hola, soy ' . $nombre . ' y estoy en ' . $semestre . 'º semestre.';

// Operaciones aritméticas con variables numéricas
$edadEnMeses  = $edad * 12;
$promedioRedondeado = round($promedio, 1);
?>

<section class="tarjeta" id="declaracion">
    <h3>1. Declaración de variables</h3>
    <p class="explicacion">
        En PHP una variable se crea al asignarle un valor con el signo <code>=</code>. Su nombre siempre comienza con
        <code>$</code>, distingue mayúsculas de minúsculas y no necesita declarar el tipo: PHP lo decide según el
        valor (<em>tipado dinámico</em>). Para mostrar su contenido se usa <code>echo</code>.
    </p>
    <div class="salida">
        <?php
        echo '<p><strong>Mensaje:</strong> ' . $mensaje . '</p>';
        echo '<p><strong>Edad en meses:</strong> ' . $edad . ' × 12 = ' . $edadEnMeses . '</p>';
        echo '<p><strong>Promedio redondeado:</strong> ' . $promedioRedondeado . '</p>';
        echo "<p><strong>Interpolación con comillas dobles:</strong> $nombre tiene $edad años.</p>";
        echo '<p><strong>Fecha con date():</strong> ' . $fechaHoy . ' — <strong>Hora:</strong> ' . $horaHoy . '</p>';
        echo '<p><strong>Total de materias con count():</strong> ' . $totalMaterias . '</p>';
        ?>
    </div>
</section>

<section class="tarjeta" id="tipos">
    <h3>2. Tipos de datos</h3>
    <p class="explicacion">
        PHP maneja tipos escalares (<code>string</code>, <code>int</code>, <code>float</code>, <code>boolean</code>) y
        compuestos (<code>array</code>). La función <code>gettype()</code> indica el tipo de una variable y
        <code>var_dump()</code> muestra tipo y valor. Las funciones <code>is_*</code> permiten validar el tipo.
    </p>
    <table class="tabla">
        <thead>
            <tr><th>Variable</th><th>Valor mostrado con echo</th><th>gettype()</th><th>Validación</th></tr>
        </thead>
        <tbody>
            <tr>
                <td><code>$nombre</code></td>
                <td><?php echo $nombre; ?></td>
                <td><?php echo gettype($nombre); ?></td>
                <td><?php echo is_string($nombre) ? 'is_string() = true' : 'false'; ?></td>
            </tr>
            <tr>
                <td><code>$edad</code></td>
                <td><?php echo $edad; ?></td>
                <td><?php echo gettype($edad); ?></td>
                <td><?php echo is_int($edad) ? 'is_int() = true' : 'false'; ?></td>
            </tr>
            <tr>
                <td><code>$promedio</code></td>
                <td><?php echo $promedio; ?></td>
                <td><?php echo gettype($promedio); ?></td>
                <td><?php echo is_float($promedio) ? 'is_float() = true' : 'false'; ?></td>
            </tr>
            <tr>
                <td><code>$esEstudiante</code></td>
                <td><?php echo $esEstudiante ? 'true (echo imprime 1)' : 'false'; ?></td>
                <td><?php echo gettype($esEstudiante); ?></td>
                <td><?php echo is_bool($esEstudiante) ? 'is_bool() = true' : 'false'; ?></td>
            </tr>
            <tr>
                <td><code>$materias</code></td>
                <td><?php echo implode(', ', $materias); ?></td>
                <td><?php echo gettype($materias); ?></td>
                <td><?php echo is_array($materias) ? 'is_array() = true' : 'false'; ?></td>
            </tr>
        </tbody>
    </table>

    <h4>var_dump() de cada variable</h4>
    <pre class="codigo"><?php
        var_dump($nombre);
        var_dump($edad);
        var_dump($promedio);
        var_dump($esEstudiante);
        var_dump($materias);
    ?></pre>
</section>

<section class="tarjeta" id="conversion">
    <h3>3. Conversión de tipos (casting)</h3>
    <p class="explicacion">
        Se puede forzar el tipo de una variable anteponiendo el tipo entre paréntesis. Esto es útil cuando un dato
        llega como texto y se necesita operar como número.
    </p>
    <?php
    $textoNumero = '45.8';
    $comoEntero  = (int) $textoNumero;
    $comoFlotante = (float) $textoNumero;
    $comoBooleano = (bool) $textoNumero;
    ?>
    <ul class="lista">
        <li><code>'45.8'</code> (<?php echo gettype($textoNumero); ?>) → <code>(int)</code> = <?php echo $comoEntero; ?> (<?php echo gettype($comoEntero); ?>)</li>
        <li><code>'45.8'</code> → <code>(float)</code> = <?php echo $comoFlotante; ?> (<?php echo gettype($comoFlotante); ?>)</li>
        <li><code>'45.8'</code> → <code>(bool)</code> = <?php echo var_export($comoBooleano, true); ?> (<?php echo gettype($comoBooleano); ?>)</li>
    </ul>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
