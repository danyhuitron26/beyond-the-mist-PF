<?php
// 10º Archivo modificado
session_start();

// Comprueba que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

$errores = [];

// Obtiene el ID de la colección desde la URL y valida que sea un número entero
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Si no se recibe un ID válido, regresa a la página de colecciones
if (!$id) {
    header("Location: colecciones.php");
    exit;
}

// Busca la colección y comprueba que pertenezca al usuario
$consulta = $bd->prepare(
    "SELECT * FROM colecciones
     WHERE id = ? AND usuario_id = ?"
);

// Ejecuta la consulta con el ID de la colección y el ID del usuario
$consulta->execute([$id, $_SESSION['usuario_id']]);
// Obtiene los datos de la colección encontrada
$coleccion = $consulta->fetch(PDO::FETCH_ASSOC);

// Si no existe la colección o no pertenece al usuario, regresa a colecciones
if (!$coleccion) {
    header("Location: colecciones.php");
    exit;
}

// Colocar los datos actuales en las variables para mostrarlos en el formulario
$nombre = $coleccion['nombre'];
$descripcion = $coleccion['descripcion'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtiene los nuevos datos y elimina espacios al inicio y al final
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (empty($nombre)) {
        $errores[] = "El nombre de la colección es obligatorio.";
    }

    // Si no hay errores, actualiza la colección
    if (empty($errores)) {

        // Prepara la consulta SQL para modificar los datos
        $consulta = $bd->prepare(
            "UPDATE colecciones
             SET nombre = ?, descripcion = ?
             WHERE id = ? AND usuario_id = ?"
        );

        // Ejecuta la actualización con los nuevos datos
        $consulta->execute([
            $nombre,
            $descripcion,
            $id,
            $_SESSION['usuario_id']
        ]);

        // Regresa a colecciones.php mostrando el mensaje de éxito
        header("Location: colecciones.php?editada=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Mis colecciones | Beyond the Mist</title>

    <link rel="icon" type="image/png" href="assets/espiralcelta.png" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" />

    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

    <!-- Sección para editar la colección -->
    <section class="colecciones-section">

        <div class="container">

            <div class="formulario-coleccion">

                <h2 class="titulo-colecciones mb-4">Editar colección</h2>

                <!-- Muestra los errores de validación, si existen -->
                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errores as $error): ?>
                            <p class="mb-0">
                                <?= htmlspecialchars($error) ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Formulario para modificar los datos -->
                <form method="POST">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">
                            Nombre de la colección
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            value="<?= htmlspecialchars($nombre) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">
                            Descripción (opcional)
                        </label>

                        <textarea
                            class="form-control"
                            id="descripcion"
                            name="descripcion"
                            rows="3"
                        ><?= htmlspecialchars($descripcion ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-coleccion">
                        Guardar cambios
                    </button>

                    <a href="colecciones.php" class="btn btn-volver ms-2">
                        Cancelar
                    </a>

                </form>

            </div>

        </div>

    </section>

</body>
</html>