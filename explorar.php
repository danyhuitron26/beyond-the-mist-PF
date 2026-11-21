<?php
// 5ºA modificación
// Esto prepara a explorar.php para consultar las historias

session_start();

// Incluir la conexión con SQLite
require_once __DIR__ . '/conexion.php';

// Consultar todas las historias
$consulta = $bd->query("SELECT * FROM contenido ORDER BY id ASC");

// Guardar los resultados en un arreglo
$historias = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Imágenes provisionales por país, por si alguna imagen de historia aún no está disponible
$imagenesPais = [
    "Irlanda" => "assets/img/land/i3.jpg",
    "Escocia" => "assets/img/land/s3.jpg",
    "Gales" => "assets/img/land/w6.jpg"
];

?>


<!-- 2º Archivo creado -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Explorar | Beyond the Mist</title>

    <link rel="icon" type="image/png" href="assets/espiralcelta.png" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" />

    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                <img src="assets/img/masthead/logo.png" alt="Beyond the Mist" />
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




                </ul>
            </div>

        </div>
    </nav>

    <!-- Encabezado -->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Every land holds a secret.</div>
            <div class="masthead-heading text-uppercase">EXPLORE THE UNKNOWN</div>
            <div class="masthead-subheading2 mb-4">
                Descubre los mitos, leyendas y misterios que habitan estas tierras.
            </div>
        </div>
    </header>

    <!-- Catálogo -->
    <section class="page-section" id="explorar">
        <div class="container">

            <div class="text-center">
                <h2 class="section-heading text-uppercase">Choose your land</h2>
                <h3 class="section-subheading text-muted">
                    Selecciona una tierra y comienza tu viaje entre sus historias.
                </h3>
            </div>

            <!-- Filtros -->
            <div class="text-center mb-5">
                <button class="btn btn-primary m-1 filtro active" data-pais="todos">
                    Todos
                </button>

                <button class="btn btn-primary m-1 filtro" data-pais="irlanda">
                    Irlanda
                </button>

                <button class="btn btn-primary m-1 filtro" data-pais="escocia">
                    Escocia
                </button>

                <button class="btn btn-primary m-1 filtro" data-pais="gales">
                    Gales
                </button>
            </div>

            
            <!-- 5ºB modificación-->
            <!-- Historias obtenidas desde SQLite
                 Con esto, PHP recorrerá todas las historias que encontró en SQLite y generará una tarjeta por cada una. -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                <?php foreach ($historias as $historia): ?>

                    <?php
                    // Obtener la imagen registrada en la base de datos
                    $rutaImagen = $historia['imagen'];

                    // Comprobar si la imagen existe
                    if (empty($rutaImagen) || !file_exists(__DIR__ . '/' . $rutaImagen)) {
                        $rutaImagen = $imagenesPais[$historia['pais']] ?? 'assets/img/espiralcelta.png';
                    }
                    ?>

                    <div class="col historia"
                        data-pais="<?= strtolower(htmlspecialchars($historia['pais'], ENT_QUOTES, 'UTF-8')) ?>">

                        <div class="card historia-card h-100">

                            <img
                                src="<?= htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8') ?>"
                                class="card-img-top historia-imagen"
                                alt="Imagen de <?= htmlspecialchars($historia['titulo'], ENT_QUOTES, 'UTF-8') ?>"
                                loading="lazy"
                            />

                            <div class="card-body d-flex flex-column">

                                <p class="historia-categoria mb-2">
                                    <?= htmlspecialchars($historia['pais'], ENT_QUOTES, 'UTF-8') ?>
                                    ·
                                    <?= htmlspecialchars($historia['categoria'], ENT_QUOTES, 'UTF-8') ?>
                                </p>

                                <h5 class="card-title">
                                    <?= htmlspecialchars($historia['titulo'], ENT_QUOTES, 'UTF-8') ?>
                                </h5>

                                <p class="card-text">
                                    <?= htmlspecialchars($historia['descripcion'], ENT_QUOTES, 'UTF-8') ?>
                                </p>

                                <a
                                    href="historia.php?id=<?= (int) $historia['id'] ?>"
                                    class="btn btn-historia mt-auto"
                                >
                                    Leer historia
                                </a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>



        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-lg-center">
                    &copy; 2026 Beyond the Mist. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme JS -->
    <script src="js/scripts.js"></script>

    <!-- Filtros -->
    <script>
        const filtros = document.querySelectorAll(".filtro");
        const historias = document.querySelectorAll(".historia");

        filtros.forEach(function(boton) {

            boton.addEventListener("click", function() {

                const paisSeleccionado = this.dataset.pais;

                filtros.forEach(function(filtro) {
                    filtro.classList.remove("active");
                });

                this.classList.add("active");

                historias.forEach(function(historia) {

                    if (paisSeleccionado === "todos" ||
                        historia.dataset.pais === paisSeleccionado) {

                        historia.style.display = "block";

                    } else {

                        historia.style.display = "none";

                    }

                });
                

            });

        });

        // 6ºB modificación (para que en index lleve a países con filtros aplicados)
        // Revisar si se seleccionó un país desde la página de inicio
        const parametros = new URLSearchParams(window.location.search);
        const paisInicial = parametros.get("pais");

        // Activar el filtro correspondiente
        if (paisInicial) {
            const filtroInicial = Array.from(filtros).find(function(filtro) {
                return filtro.dataset.pais === paisInicial;
            });

            if (filtroInicial) {
                filtroInicial.click();
            }
        }
    </script>

</body>
</html>
