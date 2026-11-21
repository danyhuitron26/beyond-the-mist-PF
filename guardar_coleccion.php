<?php
// 12º Archivo creado
// Este archivo recibirá la historia y la colección seleccionada para relacionarlas en la base de datos.
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

            // Comprobar que la historia exista
            $consulta = $bd->prepare(
                "SELECT id FROM contenido WHERE id = ?"
            );

            $consulta->execute([$contenidoId]);

            if ($consulta->fetch()) {

                // Guardar la historia en la colección
                $consulta = $bd->prepare(
                    "INSERT OR IGNORE INTO coleccion_contenido
                    (coleccion_id, contenido_id)
                    VALUES (?, ?)"
                );

                $consulta->execute([
                    $coleccionId,
                    $contenidoId
                ]);

                header("Location: historia.php?id=" . $contenidoId . "&guardada=1");
                exit;
            }
        }
    }
}

header("Location: explorar.php");
exit;
?>