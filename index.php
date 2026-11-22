<!-- 1º Archivo creado -->

<?php
// Inicia o recupera la sesión del usuario.
// Esto permite saber si hay una sesión activa y mostrar las opciones correspondientes en la barra de navegación.
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Define la codificación de caracteres para mostrar correctamente acentos y símbolos -->
        <meta charset="utf-8" />

        <!-- Permite que el sitio se adapte al ancho de la pantalla del dispositivo -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <meta name="description" content="Explora los mitos, leyendas, criaturas y tradiciones de Irlanda, Escocia y Gales en Beyond the Mist." />
        <meta name="author" content="Daniela Huitrón" />

        <!-- Título que aparece en la pestaña del navegador -->
        <title>Beyond the Mist</title>
        <!-- Icono que aparece en la pestaña del navegador (favicon) -->
        <link rel="icon" type="image/png" href="assets/espiralcelta.png" />
        <!-- Carga los iconos de Font Awesome utilizados en la página -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Carga las tipografías de Google Fonts utilizadas en el diseño -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Carga la hoja de estilos principal, que contiene los estilos del tema y Bootstrap -->
        <link href="css/styles.css" rel="stylesheet" />
    </head>

    <!-- page-top identifica el inicio de la página y permite regresar a esta sección -->
    <body id="page-top">

        <!-- BARRA DE NAVEGACIÓN -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <!-- Logotipo del sitio; al hacer clic regresa al inicio de la página. -->
                <a class="navbar-brand" href="#page-top"><img src="assets/img/masthead/logo.png" alt="logo" /></a>

                <!--Este botón de menú desplegable se activa cuando se visualiza en pantallas pequeñas, el menú de "hamburguesa"-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <!-- Contenedor de los enlaces de navegación -->
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">

                        <!-- Enlace para regresar a la página principal -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>

                        <!-- Enlace para consultar el catálogo de historias -->
                        <li class="nav-item">
                            <a class="nav-link" href="explorar.php">Explorar</a>
                        </li>

                        <!-- Comprueba si existe una sesión iniciada -->
                        <?php if (isset($_SESSION['usuario_id'])): ?>

                            <!-- Si el usuario inició sesión, puede acceder a sus colecciones -->
                            <li class="nav-item">
                                <a class="nav-link" href="colecciones.php">Mis colecciones</a>
                            </li>

                            <!-- También se muestra la opción para cerrar sesión -->
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Cerrar sesión</a>
                            </li>

                        <?php else: ?>

                            <!-- Si no hay una sesión activa, se muestra la opción para iniciar sesión -->
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Entrar</a>
                            </li>

                        <?php endif; ?>


                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- ENCABEZADO PRINCIPAL (MASTHEAD) -->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">There are stories hidden in the mist.</div>
                <!-- Nombre principal del proyecto -->
                <div class="masthead-heading text-uppercase">BEYOND THE MIST</div>
                <div class="masthead-subheading2 mb-4">Explora los mitos, leyendas y misterios de Irlanda, Escocia y Gales.</div>
                <!-- Botón que desplaza al usuario hacia la sección "¿Qué es?" -->
                <a class="btn btn-primary btn-xl text-uppercase" href="#que-es">Comenzar a explorar</a>
            </div>
        </header>

        <!-- SECCIÓN: ¿QUÉ ES BEYOND THE MIST? -->
        <section class="page-section" id="que-es"> 
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">¿Qué es Beyond the Mist?</h2>
                    <h3 class="section-subheading text-muted">Hay lugares que parecen guardar algo más que historia.</h3>
                </div>
                <div>
                    <p class="text-muted" style="text-align: center;">Castillos rodeados de niebla, bosques donde nacieron antiguas leyendas, criaturas que habitan lagos y ríos, tradiciones que sobrevivieron durante siglos y relatos que todavía forman parte de la cultura de quienes viven en estas tierras.
                                                <br> Beyond the Mist es un espacio para descubrir esas historias y explorar la magia, el misterio y el folklore de Irlanda, Escocia y Gales.</p>
                    
                    <br>

                    <h4 class="my-3" style="text-align: center;">Choose a path. Follow the mist. Discover the story.</h4>
                </div>   
            </div>
        </section>

        <!-- SECCIÓN: ELECCIÓN DE PAÍS -->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Choose your land</h2>
                    <h3 class="section-subheading text-muted">Elige una tierra y descubre las historias que esconde.</h3>
                </div>

                <div class="row">
                    <!-- TARJETA DE GALES -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="portfolio-item">
                            <!-- Al hacer clic, se abre el catálogo con el filtro de Gales -->
                            <a class="portfolio-link" href="explorar.php?pais=gales">
                                <!-- Efecto visual que aparece al pasar el cursor sobre la imagen -->
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/land/w6.jpg" alt="Imagen representativa de Gales" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Gales</div>
                                <div class="portfolio-caption-subheading text-muted">Tierra de dragones y valles</div>
                            </div>
                        </div>
                    </div>

                    <!-- TARJETA DE IRLANDA -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="explorar.php?pais=irlanda">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/land/i3.jpg" alt="Imagen representativa de Irlanda" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Irlanda</div>
                                <div class="portfolio-caption-subheading text-muted">Tierra de cuentos celtas antiguos</div>
                            </div>
                        </div>
                    </div>

                    <!-- TARJETA DE ESCOCIA -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="explorar.php?pais=escocia">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/land/s3.jpg" alt="Imagen representativa de Escocia" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Escocia </div>
                                <div class="portfolio-caption-subheading text-muted">Tierra de leyendas y castillos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- PIE DE PÁGINA -->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Aviso de derechos de autor -->
                    <div class="col-lg-12 text-lg-center">&copy; 2026 Beyond the mist. All rights reserved.</div>   
                </div>
            </div>
        </footer>

        
        <!-- Bootstrap core JS-->
        <!-- Carga JavaScript de Bootstrap para habilitar componentes interactivos, como el menú móvil. -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <!-- Carga los scripts propios del tema, por ejemplo, el comportamiento de la barra de navegación. -->
        <script src="js/scripts.js"></script>
        <!-- Script adicional incluido originalmente en la plantilla de Start Bootstrap. -->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
