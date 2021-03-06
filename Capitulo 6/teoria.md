# Manejando XML con Ajax

## Escribiendo algo de XML

Escribir XML es parecido a escribir HTML, porque se utilizan etiquetas elementos y atributos. La diferencia radica en ud hace sus propios elementos. Por ejemplo el sig. doc. te permite almacenar un registro de tus amigos:

    <?xml version="1.0">
    <friends>
        <friend>
            <first_name>Cary</first_name>
            <last_name>Grant</last_name>
        </friend>
        <friend>
            <first_name>Myrna</first_name>
            <last_name>Loy</last_name>
        </friend>
        <friend>
            <first_name>James</first_name>
            <last_name>Stewart</last_name>
        </friend>
    </friends>

Eres libre de usar tus propios nombres de elementos en XML, siempre y cuando sean nombres de elementos legales sintácticamente. Hay dos caras de la moneda: mientras que los navegadores pueden ser programados para entender los elementos HTML y mostrar su documento HTML en consecuencia, usted tiene que tomar medidas adicionales con XML. Es decir, los documentos XML tratan de almacenar datos, no de presentarlos visualmente (como el HTML), y eso significa que hay que proporcionar una forma de extraer esos datos y trabajar con ellos por sí mismo.

Ahí es donde JavaScript va a entrar en juego en este capítulo, vas a ver cómo usar JavaScript para leer y navegar a través de los documentos XML en este capítulo. Utilizando su propia programación (un paso que no es necesario con el HTML), puede extraer los datos de un documento XML y hacer uso de esos datos.

Primero, debes iniciar todos los documentos XML con una declaración XML, que tiene este aspecto:

`<?xml version="1.0">`

Esta es una declaración XML, no un elemento XML, y debe ser la primera línea de su documento XML. El atributo "version" es necesario, y puedes ponerlo en "1.0" (la versión más común, y la que usaremos) o "1.1".

Además del atributo de version, también puedes incluir el atributo standalone (poner "no" si este documento incluye otros documentos XML en él, "yes" en caso contrario). Y el atributo encoding que indica la codificación de carácteres que se esta utilizando.

`<?xml version="1.0" standalone="yes" encoding="utf-8"?>`

Lo siguiente en un documento XML son los elementos que contienen los datos en el documento. Usted crear sus porpios nombres de eituqeta en XML, pero hay algunas reglas sobre qué nombres de etiqueta son válidos. Los nombres de etiqueta no pueden comenzar con un número, no pueden contener espacios y no pueden contener otros caracteres especiales como comillas o espacios.

El primer elemento de un documento es el *document element*. En los documentos XML , un elemento encierra todos los demás elementos ese es el *document element*. En el caso de nuestro ejemplo de la fiesta del día de la nieve, podríamos llamar al elemento de documento `<parties>` para que podamos dar seguimiento a nuestras fiestas.

    <?xml version="1.0"?>
    <parties>
    .
    .
    .
    </parties>

Todos los demás elementos del documento XML deben estar contenidos dentro de este elemento de documento, así, por ejemplo, si se quiere hacer un seguimiento a tres fiestas diferentes, se puede tener tres elementos <party> encerrados dentro del elemento <party>:

    <?xml version="1.0"?>
    <parties>
    <party>
    .
    .
    .
    </party>
    <party>
    .
    .
    .
    </party>
    <party>
    .
    .
    .
    </party>
    </parties>

Los elementos XML pueden contener otros elementos XML. De hecho, también puede tener elementos vacíos, como en HTML(el elemento img). Los elementos vacíos no tiene contenido: no hay elementos anidados, no hay texto anindado.
En nuestro ejemplo podríamos poner un elemento `<afternoon />` o `<evening />`
para indicar un horario aprox en el que se desarrolló la fiesta.

    <?xml version="1.0"?>
    <parties>
    <party>
    <afternoon />
    .
    .
    .
    </party>
    <party>
    <evening />
    .
    .
    .
    </party>
    <party>
    <afternoon />
    .
    .
    .
    </party>
    </parties>

Los elementos XML también pueden tener atributos. Los atributos pueden aparecer en elementos abiertos o vacíos, son pares nombre/valor. Por ejemplo digamos que queremos darle al elemento `<party>` un atributo de tipo. Indicando que la fiesta es una fiesta de invierno se puede hacer lo sig:

    <?xml version="1.0"?>
        <parties>
            <party type="winter">
            .
            .
            .
            </party>
       </parties>

En XML (a diferencia de HTML), siempre tienes que asignar a los atributos un valor - en este ejemplo, type es el nombre del atributo, y "winter" es el valor del atributo. El valor del atributo siempre debe estar entre comillas.

Además de otros elementos, puedes encerrar texto dentro de elementos XML. Esto es lo que podría parecer en nuestro ejemplo de fiesta completa (esto es party.xml):

    <?xml version="1.0"?>
    <parties>
        <party type="winter">
            <party_title>Snow Day</party_title>
            <party_number>63</party_number>
            <subject>No school today!</subject>
            <date>2/2/2009</date>
            <people>
                <person attendance="present">
                    <first_name>Ralph</first_name>
                    <last_name>Kramden</last_name>
                </person>
                <person attendance="absent">
                    <first_name>Alice</first_name>
                    <last_name>Kramden</last_name>
                </person>
                <person attendance="present">
                    <first_name>Ed</first_name>
                    <last_name>Norton</last_name>
                </person>
            </people>
        </party>
    </parties>

Ahora te haces una idea. XML es en realidad bastante simple de construir, pero hay trampas. El documento XML que hemos construido es un ejemplo del llamado documento XML bien formado. Sin embargo, es fácil cometer un desliz, haciendo que su documento XML no esté bien formado...
y el software que conoce el XML, como los navegadores, le dará errores si su XML no está bien formado

No anidar correctamente los elementos XML es el principal error de buena formación. Por ejemplo, esta versión de nuestro documento XML de ejemplo, donde un elemento `<persona>` no ha terminado antes de que otro comience, no sería leído por un navegador debido al error de anidación:

    <?xml version="1.0"?>
        <parties>
            <party type="winter">
                <party_title>Snow Day</party_title>
                <party_number>63</party_number>
                <subject>No school today!</subject>
                <date>2/2/2009</date>
                <people>
                    <person attendance="present">
                    <first_name>Ralph</first_name>
                    <last_name>Kramden</last_name>
                    <person attendance="absent">
                    </person>
                    <first_name>Alice</first_name>
                    <last_name>Kramden</last_name>
                    </person>
                    <person attendance="present">
                    <first_name>Ed</first_name>
                        <last_name>Norton</last_name>
                    </person>
                </people>
            </party>
        </parties>

El error es que el atributo de attendance fue escrito como "attendence" en el primer elemento `<person>`. El documento está bien formado, pero no es correcto.. Así que además de bien formado, los documentos XML también pueden ser comprobados en cuanto a su validez.

Para comprobar si un documento XML es válido, hay que especificar la sintaxis lícita de su documento. Por ejemplo ¿Puede un elemento `friend` contener un elemento `people`? ¿Qué atributos tiene un elemento `<partie>`
Y así sucesivamente.

Hay dos métodos para comprobar la validez de los documentos XML: XML Document Type Definitions (DTD) y XML Schema. Cada una permite especificar las reglas sintácticas de su documento XML, y de los dos, XML Schema es el más nuevo y poderoso.


        <?xml version="1.0"?>
        <!DOCTYPE parties [
        <!ELEMENT parties (party*)>
        y_number, subject, date, people*)>
        <!ELEMENT party_title (#PCDATA)>
        <!ELEMENT party_number (#PCDATA)>
        <!ELEMENT subject (#PCDATA)>
        <!ELEMENT date (#PCDATA)>
        <!ELEMENT first_name (#PCDATA)>
        <!ELEMENT last_name (#PCDATA)>
        <!ELEMENT people (person*)>
        name)>
        <!ATTLIST party
            type CDATA #IMPLIED>
        <!ATTLIST person
            attendance CDATA #IMPLIED>
        ]>
        <parties>
            <party type="winter">
                <party_number>63</party_number>
                <date>2/2/2009</date>
                <people>
                    <person attendance="present">
                        <first_name>Ralph</first_name>
                        <last_name>Kramden</last_name>
                    </person>
                    <person attendance="absent">
                        <first_name>Alice</first_name>
                        <last_name>Kramden</last_name>
                    </person>
                    <person attendance="present">
                        <first_name>Ed</first_name>
                        <last_name>Norton</last_name>
                    </person>
                </people>
            </party>
        </parties>

Si está interesado en asegurar la validez de sus documentos XML, consulte un libro de XML que cubre DTDs y Esquema XML.
Bien, eso te da una buena base de XML. Comencemos a manejar XML en JavaScript, como es probable que hagas en las aplicaciones de Ajax.

## Trabajando con XML en Javacript

Javascript ve al XML en términos de nodos. 

    <?xml version="1.0" ?>
    <document>
        <greeting>
            Welcome to XML
        </greeting>
        <text>
            Hello there!
        </text>
    </document>

En este caso el nodo `<document>` tiene dos nodos hijos, `<greeting>` y `<text>`. Estos nodos son hermanos entre ellos. Ambos también tienen hijos en este caso nodos de tipo texto. 

Para javascript un doc. XML está construido por nodos y tiene propiedades incorporadas en el lenguaje para trabajar con ellos.


## Obtener el `Document Element`

Obtener el document element es usualmente el primer paso para trabajar con documentos XML. Para ello hay que descargar el documento XML y utilizar sobre el mismo la propiedad documentElement. 

## Accediendo a cualquier elemento XML

Accediendo al últmo invitado en el archivo de la fiesta:

En nuestro caso tenemos que acceder al arbol del documento recorriendo los distintos nodos:

    function displayGuest (xmldoc)
    {
    var partiesNode, partyNode, peopleNode;
    var firstNameNode, lastNameNode, displayText;

    partiesNode = xmldoc.documentElement;
    partyNode = partiesNode.firstChild;
    peopleNode = partyNode.lastChild;
    personNode = peopleNode.lastChild;
    firstNameNode = personNode.firstChild;
    lastNameNode = firstNameNode.nextSibling;
    displayText = "The third guest was " +
    firstNameNode.firstChild.nodeValue + ' '
    + lastNameNode.firstChild.nodeValue;
    var target = document.getElementById("targetDiv");
    target.innerHTML=displayText;
    }

Probablemente el código anterior no funcione en todos los navegadores dado que javascript toma el identado del archivo xml el que sirve para organizar el código como si fueran nodos de texto. Los que se explica mejor en la sección sig.

## Manejando el espacio en blanco

Cuando se trata de espacios en blanco, Firefox por defecto actúa de manera diferente a Internet Explorer. En Firefox, el espacio en blanco que usas para sangrar los elementos en tu XML cuenta como nodos de texto.
Así que cuando navegamos, tenemos que tener en cuenta todos los nodos de espacios en blanco en Firefox, por defecto.

Digamos que queremos navegar al elemento `<party>` Podrías pensar que utilizando el sig. código funcionaría `partiesNode.firstChild`. Esta expresión tomaría al primer hijo del `parties` y en Firefox como en Chrome
ese es el nodo de texto usado para sangrar el elemento `<party>`.

    <?xml version="1.0"?>
    <parties>
    xxxx<party type="winter">
           <party_title>Snow Day</party_title>
           <party_number>63</party_number>

Así que para llegar al elemento `<party>`, tienes que llegar al siguiente hermano del nodo de texto.

Así que puedes usar las propiedades "nextSibling" y "previousSibling" para navegar por los nodos de texto de los espacios en blanco, pero es un fastidio. Esto es en lo que se convierte la función displayGuest cuando se tiene en cuenta el manejo de espacios en blanco por defecto en Firefox:

    function displayGuest(xmldoc)
    {
    var partiesNode, partyNode, peopleNode;
    var personNode, firstNameNode, lastNameNode, displayText;
    partiesNode = xmldoc.documentElement;
    partyNode = partiesNode.firstChild.nextSibling;
    peopleNode = partyNode.lastChild.previousSibling;
    personNode = peopleNode.firstChild.nextSibling
    .nextSibling.nextSibling.nextSibling.nextSibling;
    firstNameNode = personNode.firstChild.nextSibling;
    lastNameNode = firstNameNode.nextSibling.nextSibling;
    displayText = "The third guest is: " +
    firstNameNode.firstChild.nodeValue + ' '
    + lastNameNode.firstChild.nodeValue;
    var target = document.getElementById("targetDiv");
    target.innerHTML=displayText;
    }

Manejando el espacio en múltiples navegadores
----------------------------------------------

Para solucionar este problema se puede crear una función que remueva todo el espacio en blanco. O esto mismo utilizando una herramienta de internet que minifique los archivos.

## Accediendo a los datos de XML directamente

En realidad puedes buscar en los documentos XML sólo los datos que estás buscando usando el
El método getElementsByTagName del objeto de documento XML, que devuelve una matriz de XML
nodos de elementos
