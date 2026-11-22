<?php
// 5ºA modificación
// Esto prepara a explorar.php para consultar las historias

session_start();

// Incluye el archivo que establece la conexión con la base de datos.
// __DIR__ representa la ruta del directorio donde se encuentra este archivo.
// require_once evita incluir el mismo archivo más de una vez.
require_once __DIR__ . '/conexion.php';

// Ejecuta una consulta SQL para obtener todos los registros de la tabla contenido (las historias)
$consulta = $bd->query("SELECT * FROM contenido ORDER BY id ASC");

// Recupera todos los resultados de la consulta y los guarda en un arreglo, cada elemento representa una historia
$historias = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Imágenes provisionales por país, por si alguna imagen de historia no está disponible
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
    <!-- Configuración básica del documento -->
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

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">

            <!-- Logotipo que permite regresar a la página principal -->
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/masthead/logo.png" alt="Beyond the Mist" />
            </a>

            <!-- Botón que permite abrir y cerrar el menú en pantallas pequeñas -->
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive"
                aria-expanded="false"
                aria-label="Toggle navigation">
                Menú <i class="fas fa-bars ms-1"></i>
            </button>

            <!-- Contenedor de las opciones de navegación -->
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">


                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="explorar.php">Explorar</a>
                    </li>

                    <!-- Comprueba si existe una sesión iniciada -->
                    <?php if (isset($_SESSION['usuario_id'])): ?>

                        <!-- Opciones disponibles para usuarios que iniciaron sesión -->
                        <li class="nav-item">
                            <a class="nav-link" href="colecciones.php">Mis colecciones</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Cerrar sesión</a>
                        </li>

                    <?php else: ?>

                        <!-- Si no hay una sesión iniciada, muestra la opción para entrar -->
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

    <!-- SECCIÓN DEL CATÁLOGO -->
    <section class="page-section" id="explorar">
        <div class="container">

            <div class="text-center">
                <h2 class="section-heading text-uppercase">Choose your land</h2>
                <h3 class="section-subheading text-muted">
                    Selecciona una tierra y comienza tu viaje entre sus historias.
                </h3>
            </div>

            <!-- FILTROS POR PAÍS -->
            <div class="text-center mb-5">

                <!-- Cada botón contiene un atributo personalizado,
                     su valor permite identificar qué país debe mostrarse -->
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

            
            <!-- 5ºB modificación -->
            <!-- Historias obtenidas desde SQLite -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                <!-- Recorre el arreglo $historias.
                     Por cada historia encontrada en la base de datos, genera una tarjeta -->
                <?php foreach ($historias as $historia): ?>

                    <?php
                    // Obtiene la ruta de la imagen almacenada para esta historia.
                    $rutaImagen = $historia['imagen'];

                    // Comprobar si la imagen existe, y si no, utiliza una imagen provisional correspondiente
                    // al país de la historia.
                    // El operador ?? proporciona una imagen alternativa si tampoco se encuentra una imagen
                    // definida para ese país.
                    if (empty($rutaImagen) || !file_exists(__DIR__ . '/' . $rutaImagen)) {
                        $rutaImagen = $imagenesPais[$historia['pais']] ?? 'assets/img/espiralcelta.png';
                    }
                    ?>

                    <!-- La clase historia permite que JavaScript identifique las tarjetas.
                         data-pais guarda el país en minúsculas para compararlo con los filtros -->
                    <div class="col historia"
                        data-pais="<?= strtolower(htmlspecialchars($historia['pais'], ENT_QUOTES, 'UTF-8')) ?>">

                        <!-- crea tarjeta y pone su imagen -->
                        <div class="card historia-card h-100">
                            <img
                                src="<?= htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8') ?>"
                                class="card-img-top historia-imagen"
                                alt="Imagen de <?= htmlspecialchars($historia['titulo'], ENT_QUOTES, 'UTF-8') ?>"
                                loading="lazy"
                            />
                            <!-- Cuerpo de la tarjeta -->
                            <div class="card-body d-flex flex-column">

                                <!-- Muestra el país y la categoría de la historia -->
                                <p class="historia-categoria mb-2">
                                    <?= htmlspecialchars($historia['pais'], ENT_QUOTES, 'UTF-8') ?>
                                    ·
                                    <?= htmlspecialchars($historia['categoria'], ENT_QUOTES, 'UTF-8') ?>
                                </p>

                                <!-- Muestra el título de la historia -->
                                <h5 class="card-title">
                                    <?= htmlspecialchars($historia['titulo'], ENT_QUOTES, 'UTF-8') ?>
                                </h5>

                                <!-- Muestra la descripción breve -->
                                <p class="card-text">
                                    <?= htmlspecialchars($historia['descripcion'], ENT_QUOTES, 'UTF-8') ?>
                                </p>

                                <!-- Enlace a la página de detalle -->
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

    <!-- PIE DE PÁGINA -->
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

    
    <!-- FUNCIONALIDAD DE LOS FILTROS -->
    <script>
        // Obtiene todos los botones que tienen la clase filtro
        const filtros = document.querySelectorAll(".filtro");
        // Obtiene todas las tarjetas que tienen la clase historia
        const historias = document.querySelectorAll(".historia");

        // Recorre cada botón de filtro para agregarle un evento de clic
        filtros.forEach(function(boton) {

            // Se ejecuta cuando el usuario hace clic en uno de los botones
            boton.addEventListener("click", function() {

                // Recupera el valor del atributo del botón seleccionado
                const paisSeleccionado = this.dataset.pais;

                // Quita la clase active de todos los botones
                filtros.forEach(function(filtro) {
                    filtro.classList.remove("active");
                });

                // Agrega la clase active al botón que se acaba de seleccionar
                this.classList.add("active");

                // Recorre todas las tarjetas de historias
                historias.forEach(function(historia) {

                    // Si se seleccionó "todos" o el país de la tarjeta coincide
                    // con el país seleccionado, muestra la tarjeta
                    if (paisSeleccionado === "todos" ||
                        historia.dataset.pais === paisSeleccionado) {

                        historia.style.display = "block";

                    } else {

                        // Si el país no coincide, oculta la tarjeta
                        historia.style.display = "none";

                    }

                });
                

            });

        });

        // 6ºB modificación (para que en index lleve a países con filtros aplicados)
        // Revisar si se seleccionó un país desde la página de inicio

        // Obtiene los parámetros que vienen en la dirección URL
        const parametros = new URLSearchParams(window.location.search);
        // Recupera el valor del parámetro llamado "pais", si existe
        const paisInicial = parametros.get("pais");

        // Comprueba si se recibió un país desde la página anterior
        if (paisInicial) {

            // Busca dentro de los botones de filtro aquel cuyo pais coincida con el país recibido en la URL
            const filtroInicial = Array.from(filtros).find(function(filtro) {
                return filtro.dataset.pais === paisInicial;
            });

            // Si se encontró el botón correspondiente, simula un clic sobre él
            // De esta manera se ejecuta la misma función que al seleccionarlo manualmente
            if (filtroInicial) {
                filtroInicial.click();
            }
        }
    </script>

</body>
</html>
