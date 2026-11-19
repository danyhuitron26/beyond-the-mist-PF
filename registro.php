<?php
// 7º Archivo creado
require_once __DIR__ . '/conexion.php';

// Variables iniciales
$errores = [];
$registroExitoso = false;

$nombre = "";
$correo = "";

// Comprobar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recuperar los datos del formulario
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $confirmarContrasena = $_POST['confirmar_contrasena'];

    // Validar los campos
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Ingresa un correo electrónico válido.";
    }

    if (strlen($contrasena) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    }

    if ($contrasena !== $confirmarContrasena) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    // Comprobar si el correo ya está registrado
    if (empty($errores)) {

        $consulta = $bd->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $consulta->execute([$correo]);

        if ($consulta->fetch()) {
            $errores[] = "Este correo electrónico ya está registrado.";
        }
    }

    // Guardar el usuario si no existen errores
    if (empty($errores)) {

        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

        $consulta = $bd->prepare(
            "INSERT INTO usuarios (nombre, correo, contrasena)
             VALUES (?, ?, ?)"
        );

        $consulta->execute([
            $nombre,
            $correo,
            $contrasenaHash
        ]);

        $registroExitoso = true;

        // Limpiar los campos
        $nombre = "";
        $correo = "";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Crear cuenta | Beyond the Mist</title>

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

    <!-- Registro -->
    <section class="registro-section">
        <div class="container">

            <div class="registro-card">

                <div class="text-center mb-4">
                    <h2>Únete a Beyond the Mist</h2>

                    <p>
                        Crea tu cuenta y comienza a descubrir
                        los misterios que esconden estas tierras.
                    </p>
                </div>

                <!-- Mensaje de registro exitoso -->
                <?php if ($registroExitoso): ?>

                    <div class="alert alert-success text-center">
                        ¡Tu cuenta ha sido creada correctamente!

                        <p class="mb-0 mt-2">
                            <a href="login.php">Iniciar sesión</a>
                        </p>
                    </div>

                <?php endif; ?>

                <!-- Mostrar errores -->
                <?php if (!empty($errores)): ?>

                    <div class="alert alert-danger">
                        <?php foreach ($errores as $error): ?>
                            <p class="mb-1">
                                <?= htmlspecialchars($error) ?>
                            </p>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>

                <!-- Formulario -->
                <form action="registro.php" method="POST">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            value="<?= htmlspecialchars($nombre) ?>"
                            placeholder="Tu nombre"
                            required
                        />
                    </div>

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

                    <div class="mb-3">
                        <label for="contrasena" class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            id="contrasena"
                            name="contrasena"
                            placeholder="Mínimo 8 caracteres"
                            minlength="8"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label for="confirmar_contrasena" class="form-label">
                            Confirmar contraseña
                        </label>

                        <input
                            type="password"
                            class="form-control"
                            id="confirmar_contrasena"
                            name="confirmar_contrasena"
                            placeholder="Repite tu contraseña"
                            required
                        />
                    </div>

                    <button type="submit" class="btn btn-registro w-100">
                        Crear cuenta
                    </button>

                </form>

                <p class="text-center mt-4 mb-0">
                    ¿Ya tienes una cuenta?
                    <a href="login.php">Inicia sesión</a>
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