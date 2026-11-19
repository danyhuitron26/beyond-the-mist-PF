<?php
// 6º Archivo creado
require_once __DIR__ . '/conexion.php';

// Obtener el ID de la historia desde la URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Buscar la historia en la base de datos
$historia = null;

if ($id) {
    $consulta = $bd->prepare("SELECT * FROM contenido WHERE id = ?");
    $consulta->execute([$id]);
    $historia = $consulta->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Entrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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

                <?php if (!empty($historia['fuentes'])): ?>
                    <div class="fuentes-historia">
                        <h4>Para descubrir más</h4>
                        <p><?= nl2br(htmlspecialchars($historia['fuentes'])) ?></p>
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

        <!-- Mensaje cuando no se encuentra la historia -->
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