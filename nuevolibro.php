<?php
$mensaje = $_GET["mensaje"] ?? "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookReport | Nuevo libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<nav class="navbar bg-dark navbar-dark">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">BookReport</a>
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
            <a href="nuevo_libro.php" class="activo">Nuevo libro</a>
            <a href="libros.php">Libros</a>
        </aside>

        <main class="col-md-9 col-lg-10 contenido">
            <h1 class="h3">Registrar nuevo libro</h1>
            <p class="text-secondary">
                Ingresa la información del libro que deseas agregar.
            </p>

            <?php if ($mensaje === "existe"): ?>
                <div class="alert alert-warning">
                    Ya existe un libro con ese código.
                </div>
            <?php elseif ($mensaje === "error"): ?>
                <div class="alert alert-danger">
                    No se pudo registrar el libro. Verifica los datos.
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="registrar_nuevo_libro.php"
                          method="POST">

                        <div class="mb-3">
                            <label for="codigo" class="form-label">
                                Código del libro
                            </label>
                            <input type="text" class="form-control"
                                   id="codigo" name="codigo"
                                   maxlength="30" required>
                        </div>

                        <div class="mb-3">
                            <label for="titulo" class="form-label">
                                Título del libro
                            </label>
                            <input type="text" class="form-control"
                                   id="titulo" name="titulo"
                                   maxlength="150" required>
                        </div>

                        <div class="mb-3">
                            <label for="autor" class="form-label">
                                Autor
                            </label>
                            <input type="text" class="form-control"
                                   id="autor" name="autor"
                                   maxlength="120" required>
                        </div>

                        <div class="mb-3">
                            <label for="categoria" class="form-label">
                                Categoría
                            </label>
                            <select class="form-select" id="categoria"
                                    name="categoria" required>
                                <option value="">Selecciona una categoría</option>
                                <option>Novela</option>
                                <option>Ciencia</option>
                                <option>Historia</option>
                                <option>Educación</option>
                                <option>Tecnología</option>
                                <option>Literatura</option>
                                <option>Infantil</option>
                                <option>Otra</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">
                                Cantidad de ejemplares
                            </label>
                            <input type="number" class="form-control"
                                   id="cantidad" name="cantidad"
                                   min="0" max="100000" value="1" required>
                        </div>

                        <button type="submit" class="btn btn-dark">
                            Registrar libro
                        </button>
                        <a href="libros.php"
                           class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                    </form>
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
