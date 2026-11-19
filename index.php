<!-- 1º Archivo creado -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Beyond the Mist</title>
        <!-- Favicon-->
        <link rel="icon" type="image/png" href="assets/espiralcelta.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/masthead/logo.png" alt="..." /></a>

                <!--Este se activa cuando se visualiza en pantallas pequeñas, el menú de "hamburguesa"-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
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


                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">There are stories hidden in the mist.</div>
                <div class="masthead-heading text-uppercase">BEYOND THE MIST</div>
                <div class="masthead-subheading2 mb-4">Explora los mitos, leyendas y misterios de Irlanda, Escocia y Gales.</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#que-es">Comenzar a explorar</a>
            </div>
        </header>

        <!-- ¿Qué es? -->
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

        <!-- Elige tú país -->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Choose your land</h2>
                    <h3 class="section-subheading text-muted">Elige una tierra y descubre las historias que esconde.</h3>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4"> <!-- class="col-lg-4 col-sm-6 mb-4"  -->
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="explorar.php?pais=gales">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <!--wales3-->
                                <img class="img-fluid" src="assets/img/land/w6.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Gales</div>
                                <div class="portfolio-caption-subheading text-muted">Tierra de dragones y valles</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Portfolio item 2-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="explorar.php?pais=irlanda">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <!--ireland1-->
                                <img class="img-fluid" src="assets/img/land/i3.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Irlanda</div>
                                <div class="portfolio-caption-subheading text-muted">Tierra de cuentos celtas antiguos</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Portfolio item 3-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="explorar.php?pais=escocia">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <!--scotland4-->
                                <img class="img-fluid" src="assets/img/land/s3.jpg" alt="..." />
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

        <!-- Ver si se conserva esta sección -->

        <!-- Team-->
        <section class="page-section" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tonight, follow the mist.</h2>
                    <h3 class="section-subheading text-muted">Cada camino lleva a una historia diferente. ¿Qué descubrirás esta noche?</h3>
                </div>
            
                <div id="carouselExampleContent" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-5">
                      
                      <!-- Slide 1: Azul -->
                      <div class="carousel-item active">
                        <div class="d-flex flex-column justify-content-center bg-primary-subtle text-primary-emphasis p-5 rounded-5" style="min-height: 320px;">
                          <h3>Build anything</h3>
                          <p class="text-secondary mb-3">Compose slides from your own markup—text, buttons, cards, or media.</p>
                          <div><a class="btn btn-primary" href="#">Get started</a></div>
                        </div>
                      </div>
                      
                      <!-- Slide 2: Verde -->
                      <div class="carousel-item">
                        <div class="d-flex flex-column justify-content-center text-center bg-success-subtle text-success-emphasis p-5 rounded-5" style="min-height: 320px;">
                          <h3>Style it your way</h3>
                          <p class="text-secondary mb-3">Use utilities or custom CSS to size and theme each slide however you need.</p>
                          <div><a class="btn btn-success" href="#">Learn more</a></div>
                        </div>
                      </div>
                      
                      <!-- Slide 3: Amarillo/Naranja -->
                      <div class="carousel-item">
                        <div class="d-flex flex-column justify-content-center text-end bg-warning-subtle text-warning-emphasis p-5 rounded-5" style="min-height: 320px;">
                          <h3>Mix and match</h3>
                          <p class="text-secondary mb-3">Combine custom content with controls, indicators, and the overlay layout.</p>
                          <div><a class="btn btn-warning" href="#">Browse examples</a></div>
                        </div>
                      </div>

                      <div class="carousel-item active">
                        <div class="d-flex flex-column justify-content-center text-white p-5 rounded-5" 
                             style="min-height: 320px; 
                                    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('./assets/img/land/ireland1.jpg') no-repeat center center; 
                                    background-size: cover;">
                          <h3>Build anything</h3>
                          <p class="mb-3 text-white-50">Compose slides from your own markup—text, buttons, cards, or media.</p>
                          <div><a class="btn btn-primary" href="#">Get started</a></div>
                        </div>
                      </div>
                      
                
                    </div>
                
                    <!-- Botones de Control Oficiales de Bootstrap (Flechas a los lados) -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleContent" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleContent" data-bs-slide="next">
                      <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
                


            </div>
        </section>

        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 text-lg-center">&copy; 2026 Beyond the mist. All rights reserved.</div>   
                </div>
            </div>
        </footer>

        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
