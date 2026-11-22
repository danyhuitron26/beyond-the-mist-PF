<?php
// 13º Archivo creado
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/conexion.php';

// Obtiene el ID de la colección desde la URL y validarlo
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Si no se recibe un ID válido, regresa a las colecciones
if (!$id) {
    header("Location: colecciones.php");
    exit;
}

// Busca la colección y comprueba que pertenezca al usuario
$consulta = $bd->prepare(
    "SELECT * FROM colecciones
     WHERE id = ? AND usuario_id = ?"
);

// Ejecuta la consulta con el ID de la colección y el usuario
$consulta->execute([$id, $_SESSION['usuario_id']]);
// Obtiene los datos de la colección
$coleccion = $consulta->fetch(PDO::FETCH_ASSOC);

// Si la colección no existe o no pertenece al usuario, regresa
if (!$coleccion) {
    header("Location: colecciones.php");
    exit;
}

// Obtiene las historias guardadas en esa colección
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

// Ejecuta la consulta utilizando el ID de la colección
$consultaHistorias->execute([$id]);
// Recupera todas las historias encontradas
$historias = $consultaHistorias->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Muestra el nombre de la colección en el título de la pestaña -->
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

            <!-- Enlace para regresar a la lista de colecciones -->
                <a href="colecciones.php" class="volver-explorar">
                    ← Volver a mis colecciones
                </a>

            </div>

            <!-- Mostrar un mensaje cuando se haya quitado una historia -->
            <?php if (isset($_GET['quitada'])): ?>

                <div class="alert alert-success text-center">
                    La historia se quitó de tu colección correctamente.
                </div>

            <?php endif; ?>


            <div class="text-center mb-5">

                <!-- Muestra el nombre de la colección -->
                <h2 class="titulo-colecciones">
                    <?= htmlspecialchars($coleccion['nombre']) ?>
                </h2>

                <!-- Muestra la descripción de la colección -->
                <p>
                    <?= htmlspecialchars($coleccion['descripcion'] ?? '') ?>
                </p>

                <!-- Muestra la cantidad de historias guardadas -->
                <p>
                    <strong>
                        <?= count($historias) ?>
                        <?= count($historias) == 1 ? 'historia guardada' : 'historias guardadas' ?>
                    </strong>
                </p>

            </div>


            <!-- Comprueba si la colección tiene historias guardadas -->
            <?php if (count($historias) > 0): ?>

                <!-- Distribuye las tarjetas en columnas adaptables -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                <!-- Recorre todas las historias de la colección -->
                    <?php foreach ($historias as $historia): ?>

                        <div class="col">

                            <div class="card historia-card h-100">

                                <!-- Muestra la imagen de la historia -->
                                <img
                                    src="<?= htmlspecialchars($historia['imagen']) ?>"
                                    class="card-img-top historia-imagen"
                                    alt="<?= htmlspecialchars($historia['titulo']) ?>"
                                >

                                <div class="card-body d-flex flex-column">

                                    <!-- Muestra el país y la categoría -->
                                    <small class="text-muted mb-2">
                                        <?= htmlspecialchars($historia['pais']) ?>
                                        ·
                                        <?= htmlspecialchars($historia['categoria']) ?>
                                    </small>

                                    <!-- Muestra el título -->
                                    <h5 class="card-title">
                                        <?= htmlspecialchars($historia['titulo']) ?>
                                    </h5>

                                    <!-- Muestra la descripción -->
                                    <p class="card-text">
                                        <?= htmlspecialchars($historia['descripcion']) ?>
                                    </p>

                                    
                                    <!-- Enlace para consultar la historia completa -->
                                    <a
                                        href="historia.php?id=<?= $historia['id'] ?>"
                                        class="btn btn-historia mt-auto"
                                    >
                                        Leer historia
                                    </a>

                                    <!-- Formulario para quitar la historia de esta colección -->
                                    <form
                                        action="quitar_historia.php"
                                        method="POST"
                                        class="mt-2"
                                        onsubmit="return confirm('¿Deseas quitar esta historia de la colección?');"
                                    >

                                        <!-- Enviar el ID de la colección -->
                                        <input
                                            type="hidden"
                                            name="coleccion_id"
                                            value="<?= $coleccion['id'] ?>"
                                        >

                                        <!-- Enviar el ID de la historia -->
                                        <input
                                            type="hidden"
                                            name="contenido_id"
                                            value="<?= $historia['id'] ?>"
                                        >

                                        <!-- Botón para ejecutar la acción -->
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

                <!-- Mensaje que aparece cuando la colección está vacía -->
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