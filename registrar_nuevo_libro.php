<?php
require_once "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: nuevo_libro.php");
    exit;
}

$codigo = trim($_POST["codigo"] ?? "");
$titulo = trim($_POST["titulo"] ?? "");
$autor = trim($_POST["autor"] ?? "");
$categoria = trim($_POST["categoria"] ?? "");
$cantidad = filter_var(
    $_POST["cantidad"] ?? null,
    FILTER_VALIDATE_INT
);

if (
    $codigo === "" ||
    $titulo === "" ||
    $autor === "" ||
    $categoria === "" ||
    $cantidad === false ||
    $cantidad === null ||
    $cantidad < 0 ||
    $cantidad > 100000 ||
    mb_strlen($codigo) > 30 ||
    mb_strlen($titulo) > 150 ||
    mb_strlen($autor) > 120 ||
    mb_strlen($categoria) > 80
) {
    header("Location: nuevo_libro.php?mensaje=error");
    exit;
}

try {
    $sql = "INSERT INTO libros
            (codigo, titulo, autor, categoria, cantidad)
            VALUES (?, ?, ?, ?, ?)";

    $consulta = $pdo->prepare($sql);
    $consulta->execute([
        $codigo,
        $titulo,
        $autor,
        $categoria,
        $cantidad
    ]);

    header("Location: libros.php?registro=ok");
    exit;

} catch (PDOException $e) {
    if ($e->getCode() === "23000") {
        header("Location: nuevo_libro.php?mensaje=existe");
        exit;
    }

    error_log($e->getMessage());
    header("Location: nuevo_libro.php?mensaje=error");
    exit;
}
?>
