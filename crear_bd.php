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

echo "Base de datos y tabla de contenido creadas correctamente.";
?>
