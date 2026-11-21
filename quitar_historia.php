<?php
// 14º Archivo creado
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $coleccionId = filter_input(INPUT_POST, 'coleccion_id', FILTER_VALIDATE_INT);
    $contenidoId = filter_input(INPUT_POST, 'contenido_id', FILTER_VALIDATE_INT);

    if ($coleccionId && $contenidoId) {

        // Comprobar que la colección pertenezca al usuario
        $consulta = $bd->prepare(
            "SELECT id FROM colecciones
             WHERE id = ? AND usuario_id = ?"
        );

        $consulta->execute([
            $coleccionId,
            $_SESSION['usuario_id']
        ]);

        if ($consulta->fetch()) {

            // Quitar la historia de la colección
            $consulta = $bd->prepare(
                "DELETE FROM coleccion_contenido
                 WHERE coleccion_id = ? AND contenido_id = ?"
            );

            $consulta->execute([
                $coleccionId,
                $contenidoId
            ]);
        }

        header("Location: ver_coleccion.php?id=" . $coleccionId . "&quitada=1");
        exit;
    }
}

header("Location: colecciones.php");
exit;
?>