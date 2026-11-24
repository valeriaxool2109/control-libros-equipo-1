<?php
require_once "config/conexion.php";


$sql = "SELECT s.id, l.codigo, l.titulo, s.cantidad,
               s.persona, s.motivo, s.fecha_salida
        FROM salidas s
        INNER JOIN libros l ON l.id = s.libro_id
        ORDER BY s.fecha_salida DESC";


$reportes = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca | Historial de salidas</title>
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
            <a href="reportes.php" class="activo">Historial de salidas</a>
            <a href="nuevo_libro.php">Nuevo libro</a>
            <a href="libros.php">Libros</a>
        </aside>


        <main class="col-md-9 col-lg-10 contenido">
            <div class="d-flex justify-content-between align-items-center
                        flex-wrap gap-2 mb-4">
                <div>
                    <h1 class="h3">Historial de salidas</h1>
                    <p class="text-secondary">
                        Consulta los movimientos registrados.
                    </p>
                </div>
                <a href="reporte.php" class="btn btn-dark">
                    + Registrar salida
                </a>
            </div>


            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Libro</th>
                                    <th>Cantidad</th>
                                    <th>Persona</th>
                                    <th>Motivo</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (count($reportes) > 0): ?>
                                <?php foreach ($reportes as $reporte): ?>
                                    <tr>
                                        <td><?= (int)$reporte["id"] ?></td>
                                        <td>
                                            <?= htmlspecialchars($reporte["codigo"]) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($reporte["titulo"]) ?>
                                        </td>
                                        <td>
                                            <?= (int)$reporte["cantidad"] ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($reporte["persona"]) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($reporte["motivo"] ?? "—") ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($reporte["fecha_salida"]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7"
                                        class="text-center text-secondary py-4">
                                        Todavía no hay salidas registradas.
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