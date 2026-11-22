<?php
// 5º Archivo creado

try {
    // Conectar con la base de datos SQLite
    $bd = new PDO('sqlite:' . __DIR__ . '/beyond_the_mist.db');

    // Configurar el manejo de errores
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // (Esto permite que SQLite respete las relaciones entre las tablas.)
    // Activa la revisión de claves foráneas para que SQLite respete las relaciones entre tablas y evite 
    // que queden registros relacionados apuntando a otros que ya no existen.
    $bd->exec("PRAGMA foreign_keys = ON");

} catch (PDOException $error) {
    // Muestra un mensaje si ocurre un error de conexión
    die("Error al conectar con la base de datos: " . $error->getMessage());
}

?>
