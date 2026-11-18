<?php
// 4º Archivo creado 
// Conectar con la base de datos
$bd = new PDO('sqlite:' . __DIR__ . '/beyond_the_mist.db');
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Historias que se guardarán en la base de datos
$historias = [

    // IRLANDA
    [
        "Hill of Tara",
        "Irlanda",
        "Lugar",
        "Una colina histórica relacionada con los antiguos reyes de Irlanda y rodeada de leyendas.",
        "En el corazón del condado de Meath se alza la colina de Tara, un lugar que durante miles de años fue considerado el corazón espiritual y político de Irlanda. Sus antiguos monumentos son anteriores a las grandes pirámides egipcias y guardan una conexión fascinante con el cielo: el corredor de una de sus tumbas prehistóricas está orientado hacia el amanecer de Samhain, la antigua festividad que marcaba el inicio del invierno. Pero su mayor misterio se encuentra en la Lia Fáil, la legendaria Piedra del Destino. Según la mitología irlandesa, esta piedra era uno de los cuatro tesoros de los sobrenaturales Tuatha Dé Danann y poseía el poder de reconocer al verdadero rey: cuando un soberano digno la tocaba, emitía un poderoso rugido que anunciaba su llegada. Se cuenta que incluso sus sonidos podían revelar el destino de futuras generaciones de reyes. Hoy, entre túmulos y verdes colinas, Tara conserva el recuerdo de un tiempo en el que se creía que el poder de gobernar Irlanda no pertenecía solamente a los hombres, sino también a las antiguas fuerzas de la tierra.",
        "assets/img/historias/hill-of-tara.jpg",
        "Heritage Ireland: https://heritageireland.ie/visit/places-to-visit/hill-of-tara/"
    ],

    [
        "The Púca",
        "Irlanda",
        "Criatura o leyenda",
        "Una criatura cambiante del folclore irlandés que puede adoptar distintas formas animales y aparecer durante la noche.",
        "Cuando cae la noche sobre los antiguos caminos de Irlanda, no todas las sombras pertenecen a los árboles. Según el folclore irlandés, entre los campos y senderos puede aparecer el Púca, una criatura sobrenatural capaz de transformarse en caballo, cabra, perro, toro o incluso águila. Su forma más temida es la de un majestuoso caballo negro de ojos brillantes que ofrece llevar a los viajeros sobre su lomo, solo para arrastrarlos en una carrera salvaje hacia lugares desconocidos. Sin embargo, no siempre es malvado: algunos relatos cuentan que puede ayudar a los humanos, mientras que otros advierten sobre sus engaños. Su presencia se vuelve especialmente temida durante Samhain, cuando se creía que el mundo de los vivos y el de los espíritus se encontraban más cerca. Incluso existe una curiosa tradición según la cual el Púca escupe sobre las moras silvestres después de Halloween, por lo que nadie debería comerlas. ¿Te atreverías a subir al lomo de un caballo que aparece solo en medio de la oscuridad?",
        "assets/img/historias/the-puca.jpg",
        "Ireland.ie: https://api.ireland.ie/en/halloween/spirits-of-samhain/"
    ],

    [
        "Samhain",
        "Irlanda",
        "Tradición",
        "Una antigua festividad irlandesa que marcaba el comienzo del invierno y estaba relacionada con el mundo de los espíritus.",
        "Mucho antes de que Halloween iluminara las calles con calabazas y disfraces, Irlanda celebraba una noche en la que se creía que los límites entre el mundo de los vivos y el de los muertos se desvanecían: Samhain. Esta antigua festividad marcaba el final de las cosechas y el comienzo del invierno, pero también era considerada un momento en el que los espíritus de los difuntos y las criaturas del Otro Mundo podían regresar a la tierra de los humanos. Se encendían grandes hogueras para proteger a las comunidades, se compartían alimentos y se realizaban juegos para intentar descubrir lo que deparaba el futuro. Algunos dejaban comida para recibir a sus seres queridos fallecidos, mientras otros evitaban los caminos solitarios por temor a encontrarse con seres como el Púca o la Banshee. Con el paso de los siglos, Samhain se convirtió en una de las raíces de Halloween. Pero detrás de sus disfraces y celebraciones permanece una antigua creencia: durante una noche al año, el mundo de los espíritus podía estar mucho más cerca de lo que imaginamos.",
        "assets/img/historias/samhain.jpg",
        "National Museum of Ireland: https://source.museum.ie/en-IE/Collections-Research/Folklife-Collections/Folklife-Collections-List-%281%29/Religion-and-Calendar-Customs/Hallowe-en-Samhain"
    ],

    // ESCOCIA
    [
        "Crathes Castle / Green Lady",
        "Escocia",
        "Lugar",
        "Un castillo escocés del siglo XVI conocido por la leyenda de una misteriosa dama vestida de verde.",
        "Entre las torres y los jardines de Crathes Castle, en Escocia, existe una habitación que guarda una de las leyendas más inquietantes del país: la de la Dama Verde. Según los relatos, el espíritu de una joven mujer vestida de verde aparece junto a una chimenea, sosteniendo a un bebé entre sus brazos. La historia tomó un giro escalofriante cuando, durante unas renovaciones en el siglo XIX, se encontraron restos óseos de un niño bajo la piedra del hogar, alimentando las especulaciones sobre una antigua tragedia. Incluso se cuenta que la reina Victoria llegó a presenciar una misteriosa aparición en el castillo. Nadie ha logrado descubrir quién fue realmente aquella mujer ni cuál es la historia detrás de los restos encontrados. Pero su habitación continúa llevando su nombre, como si la Dama Verde todavía esperara junto al fuego el regreso de alguien que nunca llegó.",
        "assets/img/historias/crathes-castle.jpg",
        "National Trust for Scotland: https://www.nts.org.uk/stories/ghosts-of-the-trust"
    ],

    [
        "The Kelpie",
        "Escocia",
        "Criatura o leyenda",
        "Un espíritu acuático del folclore escocés que suele adoptar la forma de un caballo para atraer a las personas al agua.",
        "En los lagos y ríos de Escocia, las leyendas advierten sobre una criatura que puede adoptar la apariencia de un hermoso caballo para atraer a los viajeros hacia las aguas: el Kelpie. A primera vista parece un animal tranquilo e inofensivo, pero basta con montar sobre su lomo para descubrir su verdadera naturaleza: su piel se vuelve imposible de soltar y arrastra a su víctima hacia las profundidades. En otras versiones, puede adoptar la forma de un hombre atractivo, aunque las algas entre su cabello o sus extrañas pezuñas pueden delatarlo. Algunas historias incluso hablan de una brida mágica capaz de someter a la criatura y obligarla a trabajar para los humanos. Estas leyendas servían como advertencia ante los peligros de las aguas escocesas, pero su misterio sigue vivo hasta nuestros días. En Falkirk, dos enormes esculturas de caballos de 30 metros rinden homenaje a estas criaturas. Porque, según las antiguas historias, nunca se sabe qué puede esconderse bajo la superficie de un lago.",
        "assets/img/historias/the-kelpie.jpg",
        "VisitScotland: https://www.visitscotland.com/es-es/things-to-do/culture-history/myths-legends"
    ],

    [
        "Up Helly Aa",
        "Escocia",
        "Tradición",
        "Un festival de las islas Shetland que ilumina el invierno con antorchas, vestimentas inspiradas en los vikingos y la quema de un barco.",
        "Cada invierno, cuando la oscuridad cubre las islas Shetland, Escocia, miles de antorchas transforman la noche en un espectáculo de fuego y antiguas tradiciones. Es Up Helly Aa, un festival en el que los habitantes se visten como guerreros vikingos y recorren las calles acompañando una enorme embarcación ceremonial. Al frente marcha el Guizer Jarl, líder de la procesión, mientras cientos de llamas iluminan el camino hasta el momento más esperado: la quema de la galera, que termina envuelta en fuego mientras el cielo nocturno se llena de humo y resplandor. Aunque su forma actual nació en el siglo XIX y no es una ceremonia vikinga antigua, la celebración rinde homenaje a la profunda herencia nórdica de las Shetland. Durante una noche, entre antorchas, tambores y llamas, parece que los antiguos navegantes han regresado para reclamar las islas que alguna vez fueron su hogar.",
        "assets/img/historias/up-helly-aa.jpg",
        "Sitio oficial de Up Helly Aa: https://www.uphellyaa.org/about-up-helly-aa/ | Shetland Museum and Archives: https://www.shetlandmuseumandarchives.org.uk/blog/up-helly-aa-has-a-most-interesting-history"
    ],

    // GALES
    [
        "Pistyll Rhaeadr",
        "Gales",
        "Lugar",
        "Una impresionante cascada galesa que desciende por una pared rocosa en medio de un paisaje natural.",
        "Entre las montañas Berwyn de Gales se encuentra Pistyll Rhaeadr, una impresionante cascada rodeada de niebla y antiguas leyendas. Se cuenta que, en un lago situado sobre sus aguas, habitaba Gwybr, un temible dragón alado que descendía por el valle para llevarse personas y animales. Cansados de vivir aterrorizados, los habitantes idearon una trampa: colocaron la imagen de otro dragón rodeada de púas ocultas y, cuando la criatura se lanzó contra su supuesto rival, terminó atravesada por ellas. Pero el dragón no es el único ser fantástico relacionado con este paisaje. Otra leyenda habla del gigante Cawr Berwyn, quien, acompañado de su esposa y una doncella, dejó caer tres enormes piedras junto a la cascada, cada una con su propio nombre en galés. Incluso se cuenta que fue el propio gigante quien creó la caída de agua al golpear la montaña con su bastón. Hoy, entre el estruendo del agua y la bruma que envuelve las montañas, todavía parece posible imaginar que aquellos seres extraordinarios alguna vez habitaron este rincón de Gales.",
        "assets/img/historias/pistyll-rhaeadr.jpg",
        "Visit Mid Wales: https://www.visitmidwales.co.uk/things-to-do/pistyll-rhaeadr-waterfalls-p1728151"
    ],

    [
        "Y Ddraig Goch",
        "Gales",
        "Criatura o leyenda",
        "Una mítica colina galesa que esconde bajo sus montañas la legendaria batalla entre dos dragones revelada por Merlín, origen del símbolo que hoy ondea en la bandera nacional.",
        "En las montañas de Gales se encuentra Dinas Emrys, una colina que, según una antigua leyenda, oculta un secreto bajo sus entrañas: dos dragones que permanecían dormidos en un lago subterráneo. La historia cuenta que el rey Vortigern intentaba construir allí una fortaleza, pero sus muros se derrumbaban misteriosamente cada noche. Fue entonces cuando un joven llamado Merlín reveló la existencia de las criaturas ocultas bajo la montaña. Al ser liberados, un dragón rojo y otro blanco comenzaron una feroz batalla que estremeció la tierra, hasta que el rojo consiguió vencer. Merlín interpretó aquel enfrentamiento como una profecía: el dragón rojo representaba a los antiguos habitantes britanos y el blanco a los invasores sajones. Con el paso de los siglos, Y Ddraig Goch se convirtió en el símbolo de la identidad, la resistencia y el orgullo de Gales. Hoy su figura continúa ondeando en la bandera del país, como el recuerdo de una batalla legendaria que, según la tradición, tuvo lugar bajo las montañas galesas.",
        "assets/img/historias/y-ddraig.goch.jpg",
        "Welsh Government: https://www.wales.com/es/acerca-de-gales/historia-y-patrimonio/por-que-hay-un-dragon-en-la-bandera-de-gales"
    ],

    [
        "Mari Lwyd",
        "Gales",
        "Tradición",
        "Una antigua costumbre invernal galesa en la que una figura de caballo decorada visita las casas acompañada de cantos y juegos de rimas.",
        "Cuando las noches de invierno cubren los pueblos de Gales, una extraña figura comienza a recorrer sus calles: la Mari Lwyd, una misteriosa yegua construida tradicionalmente con una calavera de caballo, ojos brillantes, cintas de colores y una tela blanca que oculta a quien la sostiene. Entre Navidad y Año Nuevo, aparece acompañada de un grupo de cantores que visita las casas para desafiar a sus habitantes a un peculiar duelo llamado pwnco: un intercambio de canciones, versos y rimas en galés, donde ambos grupos intentan superar al otro hasta que finalmente se les permite entrar. Una vez dentro, la Mari corretea, chasquea sus mandíbulas y provoca pequeños sustos, mientras recibe comida y bebida a cambio de su visita. Se cree que permitirle entrar atrae la buena fortuna para el año siguiente. Su nombre suele traducirse como «Yegua Gris» y algunos la relacionan con los antiguos caballos sobrenaturales de la mitología celta, capaces de cruzar entre el mundo de los vivos y el Otro Mundo. Nadie conoce con certeza su verdadero origen, pero cada invierno esta peculiar visitante vuelve a recorrer Gales, recordándonos que algunas de sus tradiciones más extrañas también son las más fascinantes.",
        "assets/img/historias/mari-lwyd.jpg",
        "Wales.com: https://www.wales.com/about/history-and-heritage/welsh-traditions-myths-and-legends/mari-lwyd"
    ]
];

// Preparar la instrucción para insertar una historia
$sql = "INSERT INTO contenido
        (titulo, pais, categoria, descripcion, historia, imagen, fuentes)
        SELECT ?, ?, ?, ?, ?, ?, ?
        WHERE NOT EXISTS (
            SELECT 1 FROM contenido
            WHERE titulo = ? AND pais = ?
        )";

$consulta = $bd->prepare($sql);

$insertadas = 0;
$existentes = 0;

// Recorrer e insertar las historias
foreach ($historias as $historia) {
    $consulta->execute([
        $historia[0],
        $historia[1],
        $historia[2],
        $historia[3],
        $historia[4],
        $historia[5],
        $historia[6],
        $historia[0],
        $historia[1]
    ]);

    if ($consulta->rowCount() > 0) {
        $insertadas++;
    } else {
        $existentes++;
    }
}

echo "Proceso terminado.<br>";
echo "Historias agregadas: " . $insertadas . "<br>";
echo "Historias que ya existían: " . $existentes;
?>
