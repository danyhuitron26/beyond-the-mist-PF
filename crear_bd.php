<?php
// 3º Archivo creado
// Crear o conectar con la base de datos
$bd = new PDO('sqlite:' . __DIR__ . '/beyond_the_mist.db');

// Crear la tabla de contenido
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

// Ejecutar la instrucción
$bd->exec($sql);

// 6ºC modificado
// Crear tabla de usuarios
$sqlUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    correo TEXT NOT NULL UNIQUE,
    contrasena TEXT NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
)";

$bd->exec($sqlUsuarios);

// Tabla de colecciones
$sqlColecciones = "CREATE TABLE IF NOT EXISTS colecciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER NOT NULL,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
)";
$bd->exec($sqlColecciones);


// Tabla que relaciona colecciones con historias
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

echo "Base de datos, tabla de contenido y tabla de usuarios creadas correctamente.";
?>
