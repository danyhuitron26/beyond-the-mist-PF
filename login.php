<?php
// 8º Archivo creado
// Iniciar o recuperar la sesión del usuario
session_start();

require_once __DIR__ . '/conexion.php';

// Variables iniciales
$error = "";
$correo = "";

// Comprobar si se envió el formulario mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recuperar los datos enviados desde el formulario
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // Validar que los campos no estén vacíos
    if (empty($correo) || empty($contrasena)) {
        // Guarda mensaje de error
        $error = "Debes completar todos los campos.";

    } else {

        // Busca al usuario por su correo
        $consulta = $bd->prepare(
            "SELECT * FROM usuarios WHERE correo = ?"
        );
        // Ejecuta la consulta utilizando el correo proporcionado
        $consulta->execute([$correo]);

        // Recupera los datos del usuario encontrado
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        // Comprueba que el usuario exista y que su contraseña sea correcta
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {

            // Crea la sesión del usuario, renueva el identificador de la sesión
            session_regenerate_id(true);

            // Guarda los datos del usuario dentro de la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_correo'] = $usuario['correo'];

            // Redirige al usuario
            header("Location: explorar.php");
            // Detiene la ejecución del archivo después de la redirección
            exit;

        } else {
            // Muestra un mensaje si el correo o la contraseña son incorrectos
            $error = "El correo electrónico o la contraseña son incorrectos.";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Iniciar sesión | Beyond the Mist</title>

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
                        <a class="nav-link" href="registro.php">Crear cuenta</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Inicio de sesión -->
    <section class="login-section">
        <div class="container">

            <div class="login-card">

                <div class="text-center mb-4">
                    <h2>Bienvenido de nuevo</h2>

                    <p>
                        Continúa tu viaje y descubre los secretos
                        que esconde la niebla.
                    </p>
                </div>

                <!-- Mostrar errores si existen -->
                <?php if (!empty($error)): ?>

                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error) ?>
                    </div>

                <?php endif; ?>

                <!-- Formulario para iniciar sesión -->
                <!-- Los datos se envían a este mismo archivo mediante POST -->
                <form action="login.php" method="POST">

                    <!-- Campo para ingresar el correo electrónico -->
                    <div class="mb-3">
                        <label for="correo" class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            id="correo"
                            name="correo"
                            value="<?= htmlspecialchars($correo) ?>"
                            placeholder="ejemplo@correo.com"
                            required
                        />
                    </div>

                    <!-- Campo para ingresar la contraseña -->
                    <div class="mb-4">
                        <label for="contrasena" class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            id="contrasena"
                            name="contrasena"
                            placeholder="Ingresa tu contraseña"
                            required
                        />
                    </div>

                    <!-- Botón que envía el formulario -->
                    <button type="submit" class="btn btn-login w-100">
                        Iniciar sesión
                    </button>

                </form>

                <!-- Enlace para las personas que todavía no tienen cuenta -->
                <p class="text-center mt-4 mb-0">
                    ¿Todavía no tienes una cuenta?
                    <a href="registro.php">Regístrate</a>
                </p>

            </div>
        </div>
    </section>

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