<?php
require_once "config/conexion.php";

$totalLibros = $pdo->query(
    "SELECT COUNT(*) FROM libros"
)->fetchColumn();

$totalEjemplares = $pdo->query(
    "SELECT COALESCE(SUM(cantidad), 0) FROM libros"
)->fetchColumn();

$totalSalidas = $pdo->query(
    "SELECT COUNT(*) FROM salidas"
)->fetchColumn();


$totalLibros = $pdo->query(
    "SELECT COUNT(*) FROM libros"
)->fetchColumn();


$totalEjemplares = $pdo->query(
    "SELECT COALESCE(SUM(cantidad), 0) FROM libros"
)->fetchColumn();


$totalSalidas = $pdo->query(
    "SELECT COUNT(*) FROM salidas"
)->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookReport | Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>


<header>
    <nav class="navbar bg-dark navbar-dark">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">Mundo de historias</a>
            <span class="navbar-text text-white">
                Sistema de biblioteca
            </span>
        </div>
    </nav>
</header>


<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 col-lg-2 sidebar p-3">
            <h6 class="text-secondary mb-3">MENÚ</h6>
            <a href="index.php" class="activo">Inicio</a>
            <a href="reporte.php">Salida de libros</a>
            <a href="reportes.php">Historial de salidas</a>
            <a href="nuevo_libro.php">Nuevo libro</a>
            <a href="libros.php">Libros</a>
        </aside>


        <main class="col-md-9 col-lg-10 contenido">
            <h1 class="h3 mb-2">Panel principal</h1>
            <p class="text-secondary">
                Bienvenido al sistema de gestión de la biblioteca.
            </p>


            <div class="row g-3 mt-2">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-secondary">Libros registrados</p>
                            <h2><?= $totalLibros ?></h2>
                            <a href="libros.php">Consultar libros</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-secondary">Ejemplares disponibles</p>
                            <h2><?= $totalEjemplares ?></h2>
                            <a href="nuevo_libro.php">Registrar libro</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-secondary">Salidas registradas</p>
                            <h2><?= $totalSalidas ?></h2>
                            <a href="reportes.php">Ver historial</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <h2 class="h5">Accesos rápidos</h2>
                    <a href="nuevo_libro.php"
                       class="btn btn-dark me-2 mb-2">
                        Registrar nuevo libro
                    </a>
                    <a href="reporte.php"
                       class="btn btn-outline-dark mb-2">
                        Registrar salida
                    </a>
                </div>
            </div>
        </main>
    </div>
</div>


<footer class="text-center py-3 bg-white border-top">
    CECyTE Plantel Pomuch | Técnico en Programación
</footer>


</body>
</html>