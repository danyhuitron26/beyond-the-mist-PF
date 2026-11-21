# Beyond the Mist

**Beyond the Mist** es un sistema web dedicado a explorar lugares, criaturas, leyendas y tradiciones misteriosas de Irlanda, Escocia y Gales. Su propósito es acercar a los usuarios al folclore y la riqueza cultural de estos países mediante historias acompañadas de imágenes y contenido informativo, que además les permite crear colecciones personales y guardar contenido de su interés.

## Características principales

- **Explorar historias:** consultar un catálogo de historias organizado por país y categoría.
- **Filtrar contenido:** explorar las historias de Irlanda, Escocia o Gales.
- **Consultar detalles:** acceder a una página individual con la descripción, historia e imágenes de cada contenido.
- **Registro e inicio de sesión:** crear una cuenta e ingresar al sitio de manera personal.
- **Colecciones personales:** crear, consultar, editar y eliminar colecciones.
- **Guardar historias:** añadir historias a las colecciones personales y quitarlas cuando se desee.
- **Diseño adaptable:** interfaz que se ajusta a diferentes tamaños de pantalla, como computadoras, tabletas y celulares.

## Tecnologías utilizadas

- **HTML5:** estructura de las páginas.
- **CSS:** estilos y diseño visual.
- **Bootstrap:** componentes y diseño adaptable.
- **JavaScript:** interacciones de la interfaz.
- **PHP:** procesamiento de información y funcionalidades del sitio.
- **SQLite:** almacenamiento de usuarios, historias y colecciones.

## Estructura del proyecto

- `index.php`: página principal.
- `explorar.php`: catálogo de historias y filtros.
- `historia.php`: detalle de cada historia.
- `registro.php`: registro de usuarios.
- `login.php`: inicio de sesión.
- `logout.php`: cierre de sesión.
- `colecciones.php`: administración de colecciones personales.
- `ver_coleccion.php`: consulta de una colección y sus historias.
- `editar_coleccion.php`: edición de colecciones.
- `eliminar_coleccion.php`: eliminación de colecciones.
- `guardar_coleccion.php`: guarda historias en una colección.
- `quitar_historia.php`: elimina una historia de una colección.
- `conexion.php`: conexión con la base de datos.
- `crear_bd.php`: creación de la estructura de la base de datos.
- `agregar_historias.php`: inserción de las historias iniciales.
- `css/`: hojas de estilo.
- `js/`: archivos JavaScript.
- `assets/`: imágenes y recursos gráficos.

## Instalación y ejecución

### Requisitos

Para ejecutar el proyecto localmente se necesita:

- Un servidor web local: **MAMP para macOS** o **WampServer para Windows**.
- PHP con soporte para SQLite (PDO_SQLite).
- Un navegador web.

### En macOS (MAMP)

1. Instalar MAMP e iniciar los servicios de Apache.
2. Descargar o clonar el repositorio.
3. Colocar la carpeta `beyond-the-mist` dentro del directorio `htdocs` de MAMP, normalmente ubicado en `/Applications/MAMP/htdocs/`.
4. Abrir el navegador y acceder a:

   `http://localhost:8888/beyond-the-mist/`

### En Windows (WampServer)

1. Instalar WampServer e iniciar los servicios de Apache.
2. Descargar o clonar el repositorio.
3. Colocar la carpeta `beyond-the-mist` dentro del directorio `www` de WampServer, normalmente ubicado en `C:\wamp64\www\`.
4. Abrir el navegador y acceder a:

   `http://localhost/beyond-the-mist/`

   *Si Apache utiliza un puerto diferente, se deberá ajustar la dirección.*

### Configuración inicial de la base de datos

Una vez colocado el proyecto en el servidor local:

1. Verificar que PHP tenga habilitada la extensión **PDO_SQLite**.
2. Abrir en el navegador la dirección del proyecto y ejecutar `crear_bd.php`. Por ejemplo:

   - MAMP: `http://localhost:8888/beyond-the-mist/crear_bd.php`
   - WampServer: `http://localhost/beyond-the-mist/crear_bd.php`

3. Después, ejecutar `agregar_historias.php` para insertar las historias iniciales.
4. Finalmente, regresar a la página principal del proyecto (`index.php`).

La base de datos SQLite se creará automáticamente en la carpeta del proyecto al ejecutar el archivo correspondiente.

## Base de datos

El proyecto utiliza SQLite para almacenar la información. Está organizado en cuatro tablas principales:

- `usuarios`: almacena los datos de las cuentas registradas.
- `contenido`: contiene las historias disponibles en el sitio.
- `colecciones`: almacena las colecciones creadas por los usuarios.
- `coleccion_contenido`: relaciona las historias guardadas con sus respectivas colecciones.

## Autora

Daniela Huitrón

Proyecto desarrollado como parte de la asignatura **Programación Web 2026B**.
