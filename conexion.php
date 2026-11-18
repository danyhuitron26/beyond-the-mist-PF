<?php
// 5º Archivo creado

try {
    // Conectar con la base de datos SQLite
    $bd = new PDO('sqlite:' . __DIR__ . '/beyond_the_mist.db');

    // Configurar el manejo de errores
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $error) {
    die("Error al conectar con la base de datos: " . $error->getMessage());
}

?>
