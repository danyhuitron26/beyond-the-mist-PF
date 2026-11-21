<?php
// 9º Archivo creado
session_start();

// Comprobar que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

$errores = [];
$nombre = "";
$descripcion = "";

// Crear una nueva colección
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (empty($nombre)) {
        $errores[] = "El nombre de la colección es obligatorio.";
    }

    if (empty($errores)) {

        $consulta = $bd->prepare(
            "INSERT INTO colecciones (usuario_id, nombre, descripcion)
             VALUES (?, ?, ?)"
        );

        $consulta->execute([
            $_SESSION['usuario_id'],
            $nombre,
            $descripcion
        ]);

        header("Location: colecciones.php?creada=1");
        exit;
    }
}

// Obtener las colecciones del usuario actual
$consulta = $bd->prepare(
    "SELECT * FROM colecciones
     WHERE usuario_id = ?
     ORDER BY fecha_creacion DESC"
);

$consulta->execute([$_SESSION['usuario_id']]);
$colecciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mis colecciones | Beyond the Mist</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/styles.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                <img src="assets/img/masthead/logo.png" alt="Beyond the Mist">
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
                Menú
                <i class="fas fa-bars ms-1"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="explorar.php">Explorar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="colecciones.php">Mis colecciones</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar sesión</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <!-- Mis colecciones -->
    <section class="colecciones-section">

        <div class="container">

            <div class="text-center mb-5">
                <h2 class="titulo-colecciones">Mis colecciones</h2>

                <p>
                    Guarda tus descubrimientos y reúne las historias
                    que más te interesen.
                </p>
            </div>


            <!-- Mensajes de éxito -->
            <?php if (isset($_GET['creada'])): ?>

                <div class="alert alert-success text-center">
                    ¡Tu colección se creó correctamente!
                </div>

            <?php elseif (isset($_GET['editada'])): ?>

                <div class="alert alert-success text-center">
                    ¡Tu colección se actualizó correctamente!
                </div>

            <?php elseif (isset($_GET['eliminada'])): ?>

                <div class="alert alert-success text-center">
                    La colección se eliminó correctamente.
                </div>

            <?php endif; ?>


            <!-- Formulario para crear colección -->
            <div class="formulario-coleccion">

                <h4>Nueva colección</h4>

                <?php if (!empty($errores)): ?>

                    <div class="alert alert-danger">
                        <?php foreach ($errores as $error): ?>
                            <p class="mb-0">
                                <?= htmlspecialchars($error) ?>
                            </p>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>


                <form method="POST" action="colecciones.php">

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
                            placeholder="Ej. Historias de fantasmas"
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
                            placeholder="Describe brevemente tu colección..."
                        ><?= htmlspecialchars($descripcion) ?></textarea>
                    </div>


                    <button type="submit" class="btn btn-coleccion">
                        Crear colección
                    </button>

                </form>

            </div>


            <!-- Colecciones existentes -->
            <div class="mt-5">

                <h3 class="titulo-lista-colecciones mb-4">
                    Mis colecciones creadas
                </h3>

                <?php if (count($colecciones) > 0): ?>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                        <?php foreach ($colecciones as $coleccion): ?>

                            <div class="col">

                                <div class="card tarjeta-coleccion h-100">

                                    <div class="card-body">

                                        <h5 class="card-title">
                                            <?= htmlspecialchars($coleccion['nombre']) ?>
                                        </h5>

                                        <p class="card-text">
                                            <?= htmlspecialchars($coleccion['descripcion'] ?? '') ?>
                                        </p>

                                        <small>
                                            Creada el:
                                            <?= date('d/m/Y', strtotime($coleccion['fecha_creacion'])) ?>
                                        </small>



                                        <div class="mt-4 d-flex gap-2">

                                            <a
                                                href="ver_coleccion.php?id=<?= $coleccion['id'] ?>"
                                                class="btn btn-sm btn-coleccion"
                                            >
                                                Ver colección
                                            </a>

                                            <a
                                                href="editar_coleccion.php?id=<?= $coleccion['id'] ?>"
                                                class="btn btn-sm btn-volver"
                                            >
                                                Editar
                                            </a>

                                            <form
                                                action="eliminar_coleccion.php"
                                                method="POST"
                                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta colección?');"
                                            >
                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= $coleccion['id'] ?>"
                                                >

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="mensaje-vacio text-center">
                        <p>
                            Todavía no tienes colecciones.
                            ¡Crea la primera para comenzar a guardar tus historias!
                        </p>
                    </div>

                <?php endif; ?>

            </div>

        </div>

    </section>


    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="text-center">
                <span class="copyright">
                    Copyright &copy; Beyond the Mist 2026
                </span>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>