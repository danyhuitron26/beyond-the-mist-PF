<?php
// 6º Archivo creado

session_start();

require_once __DIR__ . '/conexion.php';

// Obtener el ID de la historia desde la URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Busca la historia en la base de datos
$historia = null;
if ($id) {
    $consulta = $bd->prepare("SELECT * FROM contenido WHERE id = ?");
    $consulta->execute([$id]);
    $historia = $consulta->fetch(PDO::FETCH_ASSOC);
}

// Sirve para recuperar las colecciones del usuario
$colecciones = [];

if (isset($_SESSION['usuario_id'])) {

    $consultaColecciones = $bd->prepare(
        "SELECT * FROM colecciones
         WHERE usuario_id = ?
         ORDER BY nombre ASC"
    );

    $consultaColecciones->execute([$_SESSION['usuario_id']]);
    // Ejecuta la consulta y recupera todos los resultados.
    $colecciones = $consultaColecciones->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        <!-- Usa PHP para mostrar el título dinámicamente en caso de que no exista -->
        <?= $historia ? htmlspecialchars($historia['titulo']) : 'Historia no encontrada' ?>
        | Beyond the Mist
    </title>

    <link rel="icon" type="image/png" href="assets/espiralcelta.png" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" />

    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/masthead/logo.png" alt="Beyond the Mist">
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
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

                    <?php if (isset($_SESSION['usuario_id'])): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="colecciones.php">Mis colecciones</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Cerrar sesión</a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Entrar</a>
                        </li>

                    <?php endif; ?>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Comprobar si existe la historia y elegir su imagen -->
    <?php if ($historia): ?>

        <?php
        $rutaImagen = $historia['imagen'];

        if (empty($rutaImagen) || !file_exists(__DIR__ . '/' . $rutaImagen)) {
            $imagenesPais = [
                "Irlanda" => "assets/img/land/i3.jpg",
                "Escocia" => "assets/img/land/s3.jpg",
                "Gales" => "assets/img/land/w6.jpg"
            ];

            $rutaImagen = $imagenesPais[$historia['pais']] ?? 'assets/img/espiralcelta.png';
        }
        ?>

        <!-- Contenido de la historia -->
        <section class="historia-detalle">
            <div class="container">

                <a href="explorar.php" class="btn btn-volver">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver a explorar
                </a>

                <!-- los datos se recuperan de la base de datos y se insertan en el HTML -->
                <div class="text-center mt-4">
                    <p class="historia-categoria">
                        <?= htmlspecialchars($historia['pais']) ?>
                        ·
                        <?= htmlspecialchars($historia['categoria']) ?>
                    </p>

                    <h1 class="titulo-historia">
                        <?= htmlspecialchars($historia['titulo']) ?>
                    </h1>
                </div>

                <img
                    src="<?= htmlspecialchars($rutaImagen) ?>"
                    class="imagen-detalle"
                    alt="<?= htmlspecialchars($historia['titulo']) ?>"
                />

                <div class="texto-historia">
                    <?= htmlspecialchars($historia['historia']) ?>
                </div>

                <!-- comprueba si existen fuentes antes de mostrarlas --> 
                <?php if (!empty($historia['fuentes'])): ?>
                    <div class="fuentes-historia">
                        <h4>Para descubrir más</h4>
                        <p><?= nl2br(htmlspecialchars($historia['fuentes'])) ?></p>
                    </div>
                <?php endif; ?>

                <!-- Si el usuario inició sesión, se muestra la sección para guardar la historia,
                     si no inició sesión, se muestra una invitación para entrar a su cuenta -->
                <?php if (isset($_SESSION['usuario_id'])): ?>

                    <div class="guardar-historia mt-5">

                        <h4>Guardar en una colección</h4>

                        <?php if (isset($_GET['guardada'])): ?>
                            <div class="alert alert-success">
                                ¡Historia guardada correctamente!
                            </div>
                        <?php endif; ?>

                        <!-- Comprueba si tiene colecciones, por lo tanto:
                                si tiene una o más colecciones, aparece el formulario
                                si no tiene ninguna, aparece un mensaje para crear su primera colección -->
                        <?php if (count($colecciones) > 0): ?>

                            <form action="guardar_coleccion.php" method="POST">

                                <!-- este campo transporta el ID de la historia que se quiera guardar -->
                                <input
                                    type="hidden"
                                    name="contenido_id"
                                    value="<?= $historia['id'] ?>"
                                >

                                <div class="mb-3">

                                    <label for="coleccion_id" class="form-label">
                                        Selecciona una colección:
                                    </label>

                                    <!-- permite elegir en qué colección se quiere guardar la historia -->
                                    <select
                                        name="coleccion_id"
                                        id="coleccion_id"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">Elige una colección</option>
                                        <!-- recorre todas las colecciones del usuario y crea una opción por cada una -->
                                        <?php foreach ($colecciones as $coleccion): ?>

                                            <option value="<?= $coleccion['id'] ?>">
                                                <?= htmlspecialchars($coleccion['nombre']) ?>
                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                                <button type="submit" class="btn btn-historia">
                                    Guardar historia
                                </button>

                            </form>

                        <?php else: ?>

                            <p>
                                Todavía no tienes colecciones.
                                <a href="colecciones.php">Crea tu primera colección aquí.</a>
                            </p>

                        <?php endif; ?>

                    </div>


                    <!-- Aquí es cuando el usuario aún no ha iniciado sesión o creado su cuenta -->
                <?php else: ?>

                    <div class="guardar-historia invitacion-login mt-5">

                        <h4>¿Te gustaría guardar esta historia?</h4>

                        <p>
                            <a href="login.php">Inicia sesión</a>
                            para añadirla a tus colecciones personales.
                        </p>

                    </div>

                <?php endif; ?>

                <div class="text-center mt-5">
                    <a href="explorar.php" class="btn btn-historia">
                        Seguir explorando
                    </a>
                </div>

            </div>
        </section>

    <?php else: ?>

        <!-- Mensaje cuando no se encuentra la historia, si el ID no es válido o no existe una historia con ese ID, 
         se muestra este mensaje en lugar de intentar mostrar información inexistente -->
        <section class="historia-detalle text-center">
            <div class="container">
                <h2>Esta historia se ha perdido entre la niebla...</h2>
                <p>No encontramos la historia que buscas.</p>
                <a href="explorar.php" class="btn btn-historia">
                    Volver a explorar
                </a>
            </div>
        </section>

    <?php endif; ?>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    Copyright &copy; Beyond the Mist 2026
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>