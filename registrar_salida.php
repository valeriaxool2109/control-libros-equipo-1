<?php
require_once "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: reporte.php");
    exit;
}

$libroId = filter_var(
    $_POST["libro_id"] ?? null,
    FILTER_VALIDATE_INT
);
$cantidad = filter_var(
    $_POST["cantidad"] ?? null,
    FILTER_VALIDATE_INT
);
$persona = trim($_POST["persona"] ?? "");
$motivo = trim($_POST["motivo"] ?? "");

if (
    !$libroId || $libroId < 1 ||
    !$cantidad || $cantidad < 1 || $cantidad > 100000 ||
    $persona === "" ||
    mb_strlen($persona) > 120 ||
    mb_strlen($motivo) > 255
) {
    header("Location: reporte.php?mensaje=error");
    exit;
}

try {
    $pdo->beginTransaction();

    // Bloquea el registro para evitar salidas simultáneas
    // que superen las existencias disponibles.
    $consulta = $pdo->prepare(
        "SELECT cantidad FROM libros WHERE id = ? FOR UPDATE"
    );
    $consulta->execute([$libroId]);
    $libro = $consulta->fetch();

    if (!$libro || $libro["cantidad"] < $cantidad) {
        $pdo->rollBack();
        header("Location: reporte.php?mensaje=sin_stock");
        exit;
    }

    $consulta = $pdo->prepare(
        "INSERT INTO salidas (libro_id, cantidad, persona, motivo)
         VALUES (?, ?, ?, ?)"
    );
    $consulta->execute([
        $libroId,
        $cantidad,
        $persona,
        $motivo !== "" ? $motivo : null
    ]);

    $consulta = $pdo->prepare(
        "UPDATE libros SET cantidad = cantidad - ?
         WHERE id = ?"
    );
    $consulta->execute([$cantidad, $libroId]);

    $pdo->commit();

    header("Location: reporte.php?mensaje=ok");
    exit;

} catch (Throwable $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    error_log($e->getMessage());
    header("Location: reporte.php?mensaje=error");
    exit;
}
?>
