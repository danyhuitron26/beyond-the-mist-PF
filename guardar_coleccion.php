<?php
// 12º Archivo creado
// Este archivo recibirá la historia y la colección seleccionada para relacionarlas en la base de datos.
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

// Comprueba que el archivo haya recibido información mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtiene los ID de la colección y de la historia enviados por el formulario y valida que sean números enteros
    $coleccionId = filter_input(INPUT_POST, 'coleccion_id', FILTER_VALIDATE_INT);
    $contenidoId = filter_input(INPUT_POST, 'contenido_id', FILTER_VALIDATE_INT);

    // Comprueba que ambos ID sean válidos
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

        // Si se encuentra la colección, continua
        if ($consulta->fetch()) {

            // Comprueba que la historia exista
            $consulta = $bd->prepare(
                "SELECT id FROM contenido WHERE id = ?"
            );

            $consulta->execute([$contenidoId]);

            // Si se encuentra la historia, continua
            if ($consulta->fetch()) {

                // Guarda la relación entre la colección y la historia, 
                // pero si ya existe, ignora la inserción para evitar duplicados
                $consulta = $bd->prepare(
                    "INSERT OR IGNORE INTO coleccion_contenido
                    (coleccion_id, contenido_id)
                    VALUES (?, ?)"
                );

                $consulta->execute([
                    $coleccionId,
                    $contenidoId
                ]);

                // Regresa a la historia mostrando el mensaje de confirmación
                header("Location: historia.php?id=" . $contenidoId . "&guardada=1");
                exit;
            }
        }
    }
}

header("Location: explorar.php");
exit;
?>