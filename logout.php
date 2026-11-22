<?php
// Inicia o recupera la sesión del usuario
session_start();

// Vacia todas las variables almacenadas en la sesión
$_SESSION = [];

// Destruye la sesión actual
session_destroy();

// Regresa a la página de inicio
header("Location: index.php");
exit;
?>