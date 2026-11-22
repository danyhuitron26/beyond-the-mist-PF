<?php
// 14º Archivo creado
session_start();

// Comprueba que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtiene y valida los ID de la colección y de la historia
    $coleccionId = filter_input(INPUT_POST, 'coleccion_id', FILTER_VALIDATE_INT);
    $contenidoId = filter_input(INPUT_POST, 'contenido_id', FILTER_VALIDATE_INT);

    if ($coleccionId && $contenidoId) {

        // Comprobar que la colección pertenezca al usuario
        $consulta = $bd->prepare(
            "SELECT id FROM colecciones
             WHERE id = ? AND usuario_id = ?"
        );

        // Ejecuta la consulta con el ID de la colección y el usuario
        $consulta->execute([
            $coleccionId,
            $_SESSION['usuario_id']
        ]);

        // Si la colección pertenece al usuario, continua
        if ($consulta->fetch()) {

            // Quita la historia de la colección
            $consulta = $bd->prepare(
                "DELETE FROM coleccion_contenido
                 WHERE coleccion_id = ? AND contenido_id = ?"
            );

            $consulta->execute([
                $coleccionId,
                $contenidoId
            ]);
        }

        // Regresa a la colección y muestra el mensaje de confirmación
        header("Location: ver_coleccion.php?id=" . $coleccionId . "&quitada=1");
        exit;
    }
}

// Si la solicitud no es válida, regresa a la página de colecciones
header("Location: colecciones.php");
exit;
?>