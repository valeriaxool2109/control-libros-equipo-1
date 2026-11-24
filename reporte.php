<?php
require_once "config/conexion.php";


$libros = $pdo->query(
    "SELECT id, codigo, titulo, cantidad
     FROM libros
     WHERE cantidad > 0
     ORDER BY titulo"
)->fetchAll();


$mensaje = $_GET["mensaje"] ?? "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca | Salida de libros</title>
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
            <a href="reporte.php" class="activo">Salida de libros</a>
            <a href="reportes.php">Historial de salidas</a>
            <a href="nuevo_libro.php">Nuevo libro</a>
            <a href="libros.php">Libros</a>
        </aside>


        <main class="col-md-9 col-lg-10 contenido">
            <h1 class="h3">Registrar salida de un libro</h1>
            <p class="text-secondary">
                Registra los préstamos o salidas de ejemplares.
            </p>


            <?php if ($mensaje === "ok"): ?>
                <div class="alert alert-success">
                    La salida del libro se registró correctamente.
                </div>
            <?php elseif ($mensaje === "sin_stock"): ?>
                <div class="alert alert-warning">
                    No hay suficientes ejemplares disponibles.
                </div>
            <?php elseif ($mensaje === "error"): ?>
                <div class="alert alert-danger">
                    No se pudo registrar la salida. Verifica los datos.
                </div>
            <?php endif; ?>


            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <?php if (count($libros) > 0): ?>
                        <form action="registrar_salida.php" method="POST">
                            <div class="mb-3">
                                <label for="libro_id" class="form-label">
                                    Seleccionar libro
                                </label>
                                <select name="libro_id" id="libro_id"
                                        class="form-select" required>
                                    <option value="">Selecciona un libro</option>
                                    <?php foreach ($libros as $libro): ?>
                                        <option value="<?= (int)$libro["id"] ?>">
                                            <?= htmlspecialchars(
                                                $libro["codigo"] . " - " .
                                                $libro["titulo"] .
                                                " (Disponibles: " .
                                                $libro["cantidad"] . ")"
                                            ) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="cantidad" class="form-label">
                                    Cantidad de ejemplares
                                </label>
                                <input type="number" name="cantidad"
                                       id="cantidad" class="form-control"
                                       min="1" max="100000" value="1" required>
                            </div>


                            <div class="mb-3">
                                <label for="persona" class="form-label">
                                    Nombre de quien recibe el libro
                                </label>
                                <input type="text" name="persona"
                                       id="persona" class="form-control"
                                       maxlength="120" required>
                            </div>


                            <div class="mb-3">
                                <label for="motivo" class="form-label">
                                    Motivo u observaciones
                                </label>
                                <textarea name="motivo" id="motivo"
                                          class="form-control" rows="3"
                                          maxlength="255"></textarea>
                            </div>


                            <button type="submit" class="btn btn-dark">
                                Registrar salida
                            </button>
                            <a href="reportes.php"
                               class="btn btn-outline-secondary">
                                Ver historial
                            </a>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-info mb-0">
                            No hay ejemplares disponibles para prestar.
                            <a href="nuevo_libro.php">Registrar un libro</a>.
                        </div>
                    <?php endif; ?>
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