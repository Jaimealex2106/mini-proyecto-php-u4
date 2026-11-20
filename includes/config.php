<?php
/*
 * config.php
 * Configuración general del sistema. Se carga en todas las páginas con require_once.
 */

// Zona horaria para que date() muestre la hora local de Chiapas / CDMX
date_default_timezone_set('America/Mexico_City');

// Constantes con datos generales del proyecto
define('NOMBRE_SITIO', 'Mini Proyecto 1 · Unidad 4');
define('MATERIA', 'Programación Web');
define('INSTITUTO', 'Instituto Tecnológico de Tuxtla Gutiérrez');

// Integrantes del equipo (arreglo indexado reutilizado en el footer)
$integrantes = ['Jaime A. Espinosa', 'José M. Pérez', 'Julia C. Gordillo'];
