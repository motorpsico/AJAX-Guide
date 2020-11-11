# Working with Cascading Style Sheets with Ajax

Como ya se ha visto en los capítulos anteriores, la razón principal para utilizar el ajax es que permite actualizar las páginas web sin necesidad de volver a cargar la página entera, lo que hace que la actualización de la página sea bastante fluida para el espectador.
Una consideración importante al utilizar esta técnica es cómo se presentan los datos descargados del servidor. Hasta ahora, has estado presentando la descargaron los datos simplemente sobrescribiendo un elemento `<div>`. Como se explica en este capítulo, tienes muchas más opciones disponibles en la forma de presentar esos nuevos datos, lo que le permite atraer la la atención del lector a los cambios.

Porque la forma en que presenta sus datos descargados es una parte tan grande de las aplicaciones de Ajax, que es el tema de este capítulo. Por ejemplo, una pregunta frecuente entre los desarrolladores profesionales de Ajax es, ¿notará el usuario la descarga cuando aparezca en la página? En las páginas que
presentan tablas de datos, donde se actualizan sólo uno o dos elementos, que pueden ser un problema. Como verás, una forma de manejar este problema es mostrar el texto descargado con un flash de color.

También verás que no tienes que mostrar el texto descargado en simples elementos `<div>`.
Puedes mostrar estos datos en cualquier parte de la página, como verás al crear un sistema de menú emergente con texto descargado interactivamente con Ajax, permitiendo que los elementos del menú
ser actualizado en tiempo real.

## Llamar la atención del usuario sobre el texto descargado

Uno de los principales problemas de las aplicaciones de Ajax es también su principal ventaja: no hay actualización de la página cuando se descargan los datos. Eso es genial, pero también puede significar que el usuario se pierda las actualizaciones de datos, especialmente en páginas con mucho contenido.

Hay varias maneras de abordar este problema, pero la solución más fácil es simplemente hacer los datos recién mostrados destacan de alguna manera. Por ejemplo, puedes ampliar ese texto, o colorear ...en un momento, cuando está recién exhibida. Esta sección presenta un ejemplo, attentionGetter .html, que muestra el texto en rojo durante medio segundo después de ser descargado. Después de ese tiempo, el el texto recién descargado vuelve a ser negro. Hacer que los datos recién descargados parpadeen de esta manera es una gran manera de hacer que esos datos se noten en las aplicaciones de Ajax.

Podemos crear este ejemplo con una combinación de CSS y JavaScript. Iniciamos attentionGetter.html con un botón que, al ser pulsado, llama a una función llamada getData, pidiéndole que descargue un archivo llamado message.txt y muestre su contenido en un elemento <div> con el ID targetDiv. Cuando el texto se cargue lo hará en color rojo y gradualmente tomará el color del texto normal. Mirar el archivo `attentionGetter.html`

## Estilizando el texto con css

Además de hacer que el texto recién descargado tenga un flash de otro color, tienes la opción de otros efectos CSS para llamar la atención del usuario sobre ese texto. Por ejemplo, puedes ampliarlo temporalmente, mostrarlo en negrita o usar otro estilo.

