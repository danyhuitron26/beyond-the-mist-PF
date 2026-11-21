<?php
// 10º Archivo modificado
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

$errores = [];

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: colecciones.php");
    exit;
}

// Buscar la colección y comprobar que pertenezca al usuario
$consulta = $bd->prepare(
    "SELECT * FROM colecciones
     WHERE id = ? AND usuario_id = ?"
);

$consulta->execute([$id, $_SESSION['usuario_id']]);
$coleccion = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$coleccion) {
    header("Location: colecciones.php");
    exit;
}

$nombre = $coleccion['nombre'];
$descripcion = $coleccion['descripcion'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (empty($nombre)) {
        $errores[] = "El nombre de la colección es obligatorio.";
    }

    if (empty($errores)) {

        $consulta = $bd->prepare(
            "UPDATE colecciones
             SET nombre = ?, descripcion = ?
             WHERE id = ? AND usuario_id = ?"
        );

        $consulta->execute([
            $nombre,
            $descripcion,
            $id,
            $_SESSION['usuario_id']
        ]);

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

    <section class="colecciones-section">

        <div class="container">

            <div class="formulario-coleccion">

                <h2 class="titulo-colecciones mb-4">Editar colección</h2>

                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errores as $error): ?>
                            <p class="mb-0">
                                <?= htmlspecialchars($error) ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

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