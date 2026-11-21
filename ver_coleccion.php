<?php
// 13º Archivo creado
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

// Obtener el ID de la colección
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

// Obtener las historias guardadas en esa colección
//      La función de INNER JOIN es relacionar la tabla contenido con coleccion_contenido para recuperar únicamente
//      las historias que pertenecen a la colección seleccionada.
$consultaHistorias = $bd->prepare(
    "SELECT contenido.*
     FROM contenido
     INNER JOIN coleccion_contenido
     ON contenido.id = coleccion_contenido.contenido_id
     WHERE coleccion_contenido.coleccion_id = ?
     ORDER BY coleccion_contenido.fecha_guardado DESC"
);

$consultaHistorias->execute([$id]);
$historias = $consultaHistorias->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?= htmlspecialchars($coleccion['nombre']) ?> | Beyond the Mist</title>

    <link rel="icon" type="image/png" href="assets/espiralcelta.png" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" />

    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">

        <div class="container">

            <a class="navbar-brand" href="index.php">
                <img src="assets/img/masthead/logo.png" alt="Beyond the Mist">
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive"
                aria-expanded="false"
                aria-label="Toggle navigation">
                Menú <i class="fas fa-bars ms-1"></i>
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


    <!-- Contenido de la colección -->
    <section class="colecciones-section">

        <div class="container">

            <div class="mb-4">

                <a href="colecciones.php" class="volver-explorar">
                    ← Volver a mis colecciones
                </a>

            </div>

            <?php if (isset($_GET['quitada'])): ?>

                <div class="alert alert-success text-center">
                    La historia se quitó de tu colección correctamente.
                </div>

            <?php endif; ?>


            <div class="text-center mb-5">

                <h2 class="titulo-colecciones">
                    <?= htmlspecialchars($coleccion['nombre']) ?>
                </h2>

                <p>
                    <?= htmlspecialchars($coleccion['descripcion'] ?? '') ?>
                </p>

                <p>
                    <strong>
                        <?= count($historias) ?>
                        <?= count($historias) == 1 ? 'historia guardada' : 'historias guardadas' ?>
                    </strong>
                </p>

            </div>


            <?php if (count($historias) > 0): ?>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                    <?php foreach ($historias as $historia): ?>

                        <div class="col">

                            <div class="card historia-card h-100">

                                <img
                                    src="<?= htmlspecialchars($historia['imagen']) ?>"
                                    class="card-img-top historia-imagen"
                                    alt="<?= htmlspecialchars($historia['titulo']) ?>"
                                >

                                <div class="card-body d-flex flex-column">

                                    <small class="text-muted mb-2">
                                        <?= htmlspecialchars($historia['pais']) ?>
                                        ·
                                        <?= htmlspecialchars($historia['categoria']) ?>
                                    </small>

                                    <h5 class="card-title">
                                        <?= htmlspecialchars($historia['titulo']) ?>
                                    </h5>

                                    <p class="card-text">
                                        <?= htmlspecialchars($historia['descripcion']) ?>
                                    </p>

                                    
                                    
                                    <a
                                        href="historia.php?id=<?= $historia['id'] ?>"
                                        class="btn btn-historia mt-auto"
                                    >
                                        Leer historia
                                    </a>

                                    <form
                                        action="quitar_historia.php"
                                        method="POST"
                                        class="mt-2"
                                        onsubmit="return confirm('¿Deseas quitar esta historia de la colección?');"
                                    >

                                        <input
                                            type="hidden"
                                            name="coleccion_id"
                                            value="<?= $coleccion['id'] ?>"
                                        >

                                        <input
                                            type="hidden"
                                            name="contenido_id"
                                            value="<?= $historia['id'] ?>"
                                        >

                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            Quitar de la colección
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="mensaje-vacio text-center">

                    <h4>Esta colección todavía está vacía</h4>

                    <p>
                        Explora las historias de Irlanda, Escocia y Gales
                        y guarda tus favoritas aquí.
                    </p>

                    <a href="explorar.php" class="btn btn-historia">
                        Explorar historias
                    </a>

                </div>

            <?php endif; ?>

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
    <script src="js/scripts.js"></script>

</body>
</html>