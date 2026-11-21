<?php
// 5º Archivo creado

try {
    // Conectar con la base de datos SQLite
    $bd = new PDO('sqlite:' . __DIR__ . '/beyond_the_mist.db');

    // Configurar el manejo de errores
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // (Esto permite que SQLite respete las relaciones entre las tablas.)
    // Activa la revisión de claves foráneas, ya que SQLite suele tenerlas desactivadas, por lo que esta línea obliga 
    // a respetar las relaciones entre tablas (por ejemplo, impide borrar un registro si otra tabla depende de él).
    $bd->exec("PRAGMA foreign_keys = ON");

} catch (PDOException $error) {
    die("Error al conectar con la base de datos: " . $error->getMessage());
}

?>
