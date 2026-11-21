<?php
// 11º Archivo creado
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id) {

        $consulta = $bd->prepare(
            "DELETE FROM colecciones
             WHERE id = ? AND usuario_id = ?"
        );

        $consulta->execute([
            $id,
            $_SESSION['usuario_id']
        ]);
    }
}

header("Location: colecciones.php?eliminada=1");
exit;
?>