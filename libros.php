<?php
require_once "config/conexion.php";

$sql = "SELECT * FROM libros ORDER BY titulo";
$libros = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca | Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>

<nav class="navbar bg-dark navbar-dark">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Mundo de historias</a>
        <span class="navbar-text text-white">Biblioteca</span>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 col-lg-2 sidebar p-3">
            <h6 class="text-secondary mb-3">MENÚ</h6>
            <a href="index.php">Inicio</a>
            <a href="reporte.php">Salida de libros</a>
            <a href="reportes.php">Historial de salidas</a>
            <a href="nuevo_libro.php">Nuevo libro</a>
            <a href="libros.php" class="activo">Libros</a>
        </aside>

        <main class="col-md-9 col-lg-10 contenido">
            <div class="d-flex justify-content-between align-items-center
                        flex-wrap gap-2 mb-4">
                <div>
                    <h1 class="h3">Libros de la biblioteca</h1>
                    <p class="text-secondary">
                        Consulta los libros y sus existencias.
                    </p>
                </div>
                <a href="nuevo_libro.php" class="btn btn-dark">
                    + Nuevo libro
                </a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Categoría</th>
                                    <th>Disponibles</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (count($libros) > 0): ?>
                                <?php foreach ($libros as $libro): ?>
                                    <tr>
                                        <td>
                                            <?= htmlspecialchars($libro["codigo"]) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($libro["titulo"]) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($libro["autor"]) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($libro["categoria"]) ?>
                                        </td>
                                        <td><?= (int)$libro["cantidad"] ?></td>
                                        <td>
                                            <?php if ($libro["cantidad"] > 0): ?>
                                                <span class="badge text-bg-success">
                                                    Disponible
                                                </span>
                                            <?php else: ?>
                                                <span class="badge text-bg-danger">
                                                    Agotado
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6"
                                        class="text-center text-secondary py-4">
                                        No hay libros registrados.
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<footer class="text-center py-3 border-top">
    CECyTE Plantel Pomuch | Técnico en Programación
</footer>
</body>
</html>