<?php
$titulo = 'Arreglos en PHP';
include __DIR__ . '/includes/header.php';

/* ====== Arreglo indexado ====== */
$lenguajes = ['PHP', 'JavaScript', 'Python', 'Java'];
array_push($lenguajes, 'C#');          // agrega al final
$lenguajesOrdenados = $lenguajes;
sort($lenguajesOrdenados);             // ordena alfabéticamente

/* ====== Arreglo asociativo ====== */
$alumno = [
    'nombre'    => 'José M. Pérez',
    'carrera'   => 'Ingeniería en Sistemas Computacionales',
    'grupo'     => 'S5B',
    'semestre'  => 5,
    'promedio'  => 8.9,
    'activo'    => true,
];
$alumno['correo'] = 'jose.perez@ejemplo.com';   // agregar una nueva clave

/* ====== Arreglo multidimensional ====== */
$inventario = [
    ['codigo' => 'P001', 'producto' => 'Laptop',     'categoria' => 'Cómputo',    'precio' => 15499.00, 'stock' => 8],
    ['codigo' => 'P002', 'producto' => 'Mouse',      'categoria' => 'Accesorios', 'precio' => 249.90,   'stock' => 45],
    ['codigo' => 'P003', 'producto' => 'Monitor 24"', 'categoria' => 'Cómputo',    'precio' => 3299.00,  'stock' => 3],
    ['codigo' => 'P004', 'producto' => 'Teclado',    'categoria' => 'Accesorios', 'precio' => 599.00,   'stock' => 0],
    ['codigo' => 'P005', 'producto' => 'Audífonos',  'categoria' => 'Audio',      'precio' => 899.50,   'stock' => 12],
    ['codigo' => 'P006', 'producto' => 'Bocina BT',  'categoria' => 'Audio',      'precio' => 1199.00,  'stock' => 4],
];
?>

<section class="tarjeta" id="indexado">
    <h3>1. Arreglo indexado</h3>
    <p class="explicacion">
        Un arreglo indexado guarda valores con índices numéricos que comienzan en 0. Se accede con
        <code>$arreglo[0]</code>. Funciones útiles: <code>count()</code>, <code>array_push()</code>,
        <code>sort()</code>, <code>in_array()</code> e <code>implode()</code>.
    </p>
    <div class="dos-columnas">
        <table class="tabla tabla--compacta">
            <thead><tr><th>Índice</th><th>Valor</th><th>¿Es PHP?</th></tr></thead>
            <tbody>
            <?php foreach ($lenguajes as $indice => $lenguaje): ?>
                <tr class="<?php echo ($lenguaje === 'PHP') ? 'fila-resaltada' : ''; ?>">
                    <td>[<?php echo $indice; ?>]</td>
                    <td><?php echo $lenguaje; ?></td>
                    <td><?php if ($lenguaje === 'PHP') { echo '✔ Sí'; } else { echo '—'; } ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <ul class="lista">
            <li><strong>count():</strong> <?php echo count($lenguajes); ?> elementos</li>
            <li><strong>Primer elemento:</strong> <?php echo $lenguajes[0]; ?></li>
            <li><strong>Último elemento:</strong> <?php echo end($lenguajes); ?></li>
            <li><strong>Ordenado con sort():</strong> <?php echo implode(', ', $lenguajesOrdenados); ?></li>
            <li><strong>in_array('Python'):</strong> <?php echo in_array('Python', $lenguajes) ? 'true' : 'false'; ?></li>
        </ul>
    </div>
</section>

<section class="tarjeta" id="asociativo">
    <h3>2. Arreglo asociativo</h3>
    <p class="explicacion">
        En un arreglo asociativo cada valor se identifica con una clave de texto (<code>'nombre' =&gt; 'José'</code>).
        Es ideal para representar un registro con varios campos. Se recorre con
        <code>foreach ($arreglo as $clave =&gt; $valor)</code>.
    </p>
    <table class="tabla tabla--compacta">
        <thead><tr><th>Clave</th><th>Valor</th><th>Tipo</th></tr></thead>
        <tbody>
        <?php foreach ($alumno as $clave => $valor): ?>
            <tr>
                <td><code><?php echo $clave; ?></code></td>
                <td>
                    <?php
                    if (is_bool($valor)) {
                        echo $valor ? 'Sí' : 'No';
                    } elseif ($clave === 'promedio' && $valor >= 8.5) {
                        echo $valor . ' ⭐ (alto)';
                    } else {
                        echo $valor;
                    }
                    ?>
                </td>
                <td><?php echo gettype($valor); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p class="nota">Claves con <code>array_keys()</code>: <?php echo implode(', ', array_keys($alumno)); ?></p>
</section>

<section class="tarjeta" id="multidimensional">
    <h3>3. Arreglo multidimensional</h3>
    <p class="explicacion">
        Un arreglo multidimensional contiene otros arreglos. Aquí <code>$inventario</code> es una lista (indexada) de
        productos (asociativos). Se recorre con <code>foreach</code> y dentro del recorrido se usan condicionales para
        marcar el stock: agotado, bajo o disponible. Se accede a un dato con dos índices:
        <code>$inventario[0]['producto']</code> = <strong><?php echo $inventario[0]['producto']; ?></strong>.
    </p>
    <?php
    $valorTotal   = 0;
    $agotados     = 0;
    ?>
    <table class="tabla">
        <thead>
            <tr><th>Código</th><th>Producto</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Subtotal</th><th>Estado</th></tr>
        </thead>
        <tbody>
        <?php foreach ($inventario as $item):
            $subtotal = $item['precio'] * $item['stock'];
            $valorTotal += $subtotal;

            // Condicionales dentro del recorrido
            if ($item['stock'] == 0) {
                $estado = 'Agotado';
                $clase  = 'etiqueta--malo';
                $agotados++;
            } elseif ($item['stock'] < 5) {
                $estado = 'Stock bajo';
                $clase  = 'etiqueta--regular';
            } else {
                $estado = 'Disponible';
                $clase  = 'etiqueta--excelente';
            }
        ?>
            <tr>
                <td><?php echo $item['codigo']; ?></td>
                <td><?php echo $item['producto']; ?></td>
                <td><?php echo $item['categoria']; ?></td>
                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                <td><?php echo $item['stock']; ?></td>
                <td>$<?php echo number_format($subtotal, 2); ?></td>
                <td><span class="etiqueta <?php echo $clase; ?>"><?php echo $estado; ?></span></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5"><strong>Valor total del inventario</strong></td>
                <td colspan="2"><strong>$<?php echo number_format($valorTotal, 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <?php
    // Agrupar productos por categoría (otro arreglo multidimensional generado dinámicamente)
    $porCategoria = [];
    foreach ($inventario as $item) {
        $porCategoria[$item['categoria']][] = $item['producto'];
    }
    ?>
    <h4>Productos agrupados por categoría</h4>
    <ul class="lista">
        <?php foreach ($porCategoria as $categoria => $productos): ?>
            <li><strong><?php echo $categoria; ?> (<?php echo count($productos); ?>):</strong> <?php echo implode(', ', $productos); ?></li>
        <?php endforeach; ?>
    </ul>
    <p class="nota">
        Total de productos: <?php echo count($inventario); ?> ·
        Agotados: <?php echo $agotados; ?> ·
        Precio más alto (<code>max(array_column())</code>): $<?php echo number_format(max(array_column($inventario, 'precio')), 2); ?>
    </p>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
