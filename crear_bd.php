<?php
// 3º Archivo creado
// CREACIÓN O CONEXIÓN CON LA BASE DE DATOS
// Si el archivo no existe, SQLite lo crea automáticamente.
$bd = new PDO('sqlite:' . __DIR__ . '/beyond_the_mist.db');

// TABLA CONTENIDO
// Almacena las historias que aparecen en el catálogo.
$sql = "CREATE TABLE IF NOT EXISTS contenido (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titulo TEXT NOT NULL,
    pais TEXT NOT NULL,
    categoria TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    historia TEXT NOT NULL,
    imagen TEXT,
    fuentes TEXT
)";

// Ejecuta la instrucción SQL
$bd->exec($sql);

// 6ºC modificado
// TABLA USUARIOS
// Almacena la información de las personas registradas.
$sqlUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    correo TEXT NOT NULL UNIQUE,
    contrasena TEXT NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
)";

$bd->exec($sqlUsuarios);

// TABLA COLECCIONES
// Almacena las colecciones personales de cada usuario.
$sqlColecciones = "CREATE TABLE IF NOT EXISTS colecciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER NOT NULL,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
)";

$bd->exec($sqlColecciones);


// TABLA COLECCION_CONTENIDO
// Relaciona las colecciones con las historias guardadas en ellas.
$sqlColeccionContenido = "CREATE TABLE IF NOT EXISTS coleccion_contenido (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    coleccion_id INTEGER NOT NULL,
    contenido_id INTEGER NOT NULL,
    fecha_guardado DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (coleccion_id, contenido_id),
    FOREIGN KEY (coleccion_id) REFERENCES colecciones(id) ON DELETE CASCADE,
    FOREIGN KEY (contenido_id) REFERENCES contenido(id) ON DELETE CASCADE
)";
$bd->exec($sqlColeccionContenido);

// Muestra un mensaje cuando termina la creación de las tablas.
echo "Base de datos y sus cuatro tablas creadas correctamente.";
?>
