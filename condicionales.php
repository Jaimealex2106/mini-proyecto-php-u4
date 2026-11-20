<?php
$titulo = 'Estructuras condicionales';
include __DIR__ . '/includes/header.php';

// Datos reales que se evaluarán con las condicionales
$alumnos = [
    ['nombre' => 'Ana López',      'calificacion' => 95],
    ['nombre' => 'Carlos Ruiz',    'calificacion' => 82],
    ['nombre' => 'María Gómez',    'calificacion' => 74],
    ['nombre' => 'Luis Hernández', 'calificacion' => 58],
    ['nombre' => 'Sofía Martínez', 'calificacion' => 100],
];

$diaSemana = (int) date('N');   // 1 = lunes ... 7 = domingo
?>

<section class="tarjeta" id="if">
    <h3>1. if · elseif · else</h3>
    <p class="explicacion">
        La estructura <code>if</code> evalúa una condición booleana; si es verdadera ejecuta su bloque. Con
        <code>elseif</code> se agregan más condiciones que se revisan en orden, y <code>else</code> se ejecuta cuando
        ninguna se cumplió. Aquí se recorre un arreglo de alumnos y se decide su desempeño según su calificación.
    </p>
    <table class="tabla">
        <thead><tr><th>Alumno</th><th>Calificación</th><th>Desempeño</th><th>Estado</th></tr></thead>
        <tbody>
        <?php foreach ($alumnos as $alumno):
            $cal = $alumno['calificacion'];

            if ($cal == 100) {
                $desempeno = 'Excelente (perfecto)';
                $clase = 'etiqueta--excelente';
            } elseif ($cal >= 90) {
                $desempeno = 'Excelente';
                $clase = 'etiqueta--excelente';
            } elseif ($cal >= 80) {
                $desempeno = 'Bueno';
                $clase = 'etiqueta--bueno';
            } elseif ($cal >= 70) {
                $desempeno = 'Suficiente';
                $clase = 'etiqueta--regular';
            } else {
                $desempeno = 'Insuficiente';
                $clase = 'etiqueta--malo';
            }

            // Operador ternario: forma corta de if/else
            $estado = ($cal >= 70) ? 'Aprobado' : 'Reprobado';
        ?>
            <tr>
                <td><?php echo $alumno['nombre']; ?></td>
                <td><?php echo $cal; ?></td>
                <td><span class="etiqueta <?php echo $clase; ?>"><?php echo $desempeno; ?></span></td>
                <td><?php echo $estado; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    // if simple con la hora actual
    $horaActual = (int) date('G');
    if ($horaActual >= 7 && $horaActual < 14) {
        $turno = 'matutino';
    } else {
        $turno = 'vespertino / nocturno';
    }
    ?>
    <p class="nota">Son las <?php echo date('H:i'); ?> → el sistema determina que es turno <strong><?php echo $turno; ?></strong>.</p>
</section>

<section class="tarjeta" id="switch">
    <h3>2. switch</h3>
    <p class="explicacion">
        <code>switch</code> compara una misma variable contra varios valores posibles (<code>case</code>). Cuando
        encuentra coincidencia ejecuta ese bloque hasta el <code>break</code>; si no coincide ninguno se ejecuta
        <code>default</code>. Es más legible que muchos <code>elseif</code> cuando se compara un solo valor.
    </p>

    <?php
    // Ejemplo 1: día de la semana real obtenido con date('N')
    switch ($diaSemana) {
        case 1:
            $nombreDia = 'Lunes';
            $actividad = 'Inicio de semana: revisar pendientes.';
            break;
        case 2:
        case 4:
            $nombreDia = ($diaSemana == 2) ? 'Martes' : 'Jueves';
            $actividad = 'Clase de Programación Web.';
            break;
        case 3:
            $nombreDia = 'Miércoles';
            $actividad = 'Trabajo en equipo del mini proyecto.';
            break;
        case 5:
            $nombreDia = 'Viernes';
            $actividad = 'Entrega de avances.';
            break;
        default:
            $nombreDia = ($diaSemana == 6) ? 'Sábado' : 'Domingo';
            $actividad = 'Fin de semana: descanso.';
    }
    ?>
    <div class="salida">
        <p><strong>date('N')</strong> devolvió <code><?php echo $diaSemana; ?></code> → hoy es <strong><?php echo $nombreDia; ?></strong>.</p>
        <p>Actividad del día: <?php echo $actividad; ?></p>
    </div>

    <h4>switch aplicado a un arreglo de pedidos</h4>
    <?php
    $pedidos = [
        ['folio' => 'A-101', 'estado' => 'pendiente'],
        ['folio' => 'A-102', 'estado' => 'enviado'],
        ['folio' => 'A-103', 'estado' => 'entregado'],
        ['folio' => 'A-104', 'estado' => 'cancelado'],
        ['folio' => 'A-105', 'estado' => 'desconocido'],
    ];
    ?>
    <table class="tabla">
        <thead><tr><th>Folio</th><th>Estado</th><th>Mensaje generado por switch</th></tr></thead>
        <tbody>
        <?php foreach ($pedidos as $pedido):
            switch ($pedido['estado']) {
                case 'pendiente':
                    $msg = '🕒 En espera de pago';
                    break;
                case 'enviado':
                    $msg = '🚚 Va en camino';
                    break;
                case 'entregado':
                    $msg = '✅ Recibido por el cliente';
                    break;
                case 'cancelado':
                    $msg = '❌ Pedido cancelado';
                    break;
                default:
                    $msg = '⚠ Estado no reconocido';
            }
        ?>
            <tr>
                <td><?php echo $pedido['folio']; ?></td>
                <td><?php echo $pedido['estado']; ?></td>
                <td><?php echo $msg; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
