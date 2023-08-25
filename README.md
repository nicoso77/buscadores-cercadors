# cercadors

Esta pequeño proyecto se ha creado con los lenguajes: PHP, Javascript y HTML5 y CSS3, además de utilizar varias tablas de Base de datos (MySQL) por lo que es necesario instalar

Muestra de dos buscadores
En este repositorio encontraras una pagina simple de PHP con una galería de imágenes y dos buscadores para localizar o seleccionar imágenes mediante dos métodos distintos:
-El primer buscador permite seleccionar una o varias imágenes buscando la concidencía del texto introducido, en las descripciónes (de una part o toda), utilizadas para la etiqueta "alt" y que se encuentran en la tabla "***" de una base de datos.
-El segundo buscador permite hacer la selección mediante uno o dos campos. Ambos generan un desplegable autocompletable a medida que se escribe en el campo de texto seleccionado. Al hacer click en una de las opciones se hace la selección de imágenes. Con el primer desplegable **. Con el segundo ** 

Esta muestra de buscadores está compuesta porvarios ficheros: 
-Este dcumento explicativo .md.
-Siete archivos PHP, incluida la página principal "pagina-buscadores-cercadors.php".
-*** archivos CSS3 (en la carpeta _css).
-*** imágenes (en la carpeta _img).
-Dos archivos Javascript.
-Un archivo SQL para la cración de la tabla con los datos asociados a las imágenes de la galería.

Para poder ejecutar el código y abrir la página necesita instalar un "**"; como XAMPP o VAMPP, crear una base de datos e insertar las dos tablas datos ** y **.

En todos los archivos de código hay algunos comentarios para facilitar la lectura de estos.

Ambos buscadores pueden funcionar de manera independiente. Aunque hay tener en cuenta que los archivos:
-classCercadors.php
-conexio.php
-pagina-cercadors.php
-**
Contienen código de ambos buscadores; si sólo se utiliza uno se puede identificar el cádigo o archivos del otro buscador y eliminarlos.

Loa rchivos asociados a uno u otro buscador son:
Buscador 1:
gestionBuscar1Camp.js
Buscador 2:
gestionBuscar2Camp.js


/busca el texto escrito en la descripción de la imagen utilizada para el campo "alt"/

