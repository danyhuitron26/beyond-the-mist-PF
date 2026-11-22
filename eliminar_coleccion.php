<?php
// 11º Archivo creado
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtiene el ID enviado por el formulario y valida que sea un entero
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Comprueba que el ID sea válido
    if ($id) {

    // Prepara la consulta SQL para eliminar la colección
        $consulta = $bd->prepare(
            "DELETE FROM colecciones
             WHERE id = ? AND usuario_id = ?"
        );

        // Ejecuta la eliminación usando el ID de la colección y el ID del usuario que inició sesión
        $consulta->execute([
            $id,
            $_SESSION['usuario_id']
        ]);
    }
}

// Regresa a la página de colecciones mostrando el mensaje de confirmación
header("Location: colecciones.php?eliminada=1");
exit;
?>