# Mini Proyecto 1 · Unidad 4 — Desarrollo Web con PHP

**Variables, Estructuras de Control, Arreglos y Sesiones**

## Integrantes del equipo

- Jaime A. Espinosa
- José M. Pérez
- Julia C. Gordillo

## Materia

**Programación Web** — Unidad 4: Programación del lado del servidor con PHP
Instituto Tecnológico de Tuxtla Gutiérrez · Ingeniería en Sistemas Computacionales · Grupo S5B
Docente: Ing. Jorge Octavio Guzmán Sánchez

## Descripción del proyecto

Sitio web dinámico desarrollado en PHP que demuestra de forma práctica el uso de variables, tipos de datos,
estructuras de control, arreglos y manejo de sesiones. Todas las páginas comparten encabezado, menú y pie de
página mediante `include`, usan una hoja de estilos externa y muestran en todo momento la **hora de inicio de
sesión**, la **hora actual** y el **tiempo activo** del usuario, calculado con `time()` y `$_SESSION`.

No usa base de datos, archivos ni formularios: la información se guarda únicamente en la sesión (memoria temporal).

## Sitio publicado

- 🌐 Sitio: `https://miniproyecto-u4.freedev.app/` 
- 🔗 Repositorio: `https://github.com/Jaimealex2106/mini-proyecto-php-u4` 

## Temas PHP implementados

| Página | Tema | Elementos de PHP utilizados |
|---|---|---|
| `index.php` | Inicio de sesión | `session_start()`, `session_destroy()`, `session_regenerate_id()`, `$_SESSION`, `time()`, `header()`, `$_GET`, `if/elseif/else` |
| `variables.php` | Variables y tipos de datos | `string`, `int`, `float`, `boolean`, `array`, `echo`, `date()`, `count()`, `gettype()`, `var_dump()`, `is_*()`, casting |
| `condicionales.php` | Toma de decisiones | `if`, `else`, `elseif`, `switch`, operador ternario, evaluados con arreglos y `date()` |
| `bucles.php` | Repeticiones | `for` (incluido anidado), `while`, `do...while`, `foreach` generando tablas y listas |
| `arreglos.php` | Manipulación de datos | Arreglo indexado, asociativo y multidimensional, `foreach` con condicionales, `array_push()`, `sort()`, `in_array()`, `array_keys()`, `array_column()`, `implode()` |
| `sesiones.php` | Persistencia en memoria | `$_SESSION`, `session_id()`, cálculo de tiempo activo con `intdiv()` y `%`, contador de visitas por página |

## Estructura

```
/
├── index.php
├── variables.php
├── condicionales.php
├── bucles.php
├── arreglos.php
├── sesiones.php
├── css/
│   └── styles.css
├── includes/
│   ├── config.php
│   ├── header.php
│   ├── menu.php
│   ├── sesion_info.php
│   └── footer.php
└── img/
    └── logo.svg
```

## Ejecutar localmente

```bash
php -S localhost:8000
```

Abrir `http://localhost:8000` y presionar **INICIAR SESIÓN**.
