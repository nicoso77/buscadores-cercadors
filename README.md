# Buscadores Cercadors

Esta pequeño proyecto se ha creado con los lenguajes: PHP, Javascript y HTML5 y CSS3, además de utilizar varias tablas de Base de datos (MySQL) por lo que es necesario trabajar en un servidor local (localhost) que puede proporcionar el software XAMPP o MAMPP.

**Muestra de dos buscadores**
En este repositorio encontraras una pagina simple de PHP con una galería de imágenes y dos buscadores para localizar o seleccionar imágenes mediante dos métodos distintos:
- El primer buscador permite seleccionar una o varias imágenes buscando la concidencía del texto introducido con las descripciónes (de una parte o toda) utilizadas para la etiqueta "alt" y que se encuentran en la tabla "imgs_buscador" de la base de datos.
- El segundo buscador permite hacer la selección mediante uno o dos campos de texto de un formulario. Ambos inputs de texto generan un desplegable autocompletable a medida que se escribe. Se muestra  un desplegabe con un listado variable de opciones; estas se generan a partir de la busqueda del texto escrito en una de las tablas de la base de datso: 1er buscador -> disciplinas (disciplinas_buscador), 2º buscador -> herramientas (tools_buscador). Al hacer click en una de las opciones se actualiza la selección de imágenes en función de la opción elegida en cadda caso, aplicando un filtro. 

**Esta muestra de buscadores está compuesta por varios ficheros:** <br>
  - Este dcumento explicativo .md.<br>
  - 7 archivos PHP, incluida la página principal "pagina-buscadores-cercadors.php".<br>
  - 3 archivos CSS3 (en la carpeta _css).<br>
  - 17 imágenes (en la carpeta _img).<br>
  - 2 archivos Javascript.<br>
  - Un archivo SQL para la cración de la tabla con los datos asociados a las imágenes de la galería.<br>

En todos los archivos de código hay algunos comentarios para facilitar la lectura de estos.

**Dos buscadores: juntos o separados:**
Ambos buscadores pueden funcionar de manera independiente si se elimina el código para el buscador descartado. Aunque hay que tener en cuenta que los siguientes archivos contienen código de ambos buscadores; si sólo se utiliza uno se puede identificar el cádigo o archivos del otro buscador y eliminarlos:
  - classCercadors.php
  - conexio.php
  - pagina-cercadors.php
  - resultadosbusqueda1.php

Loa rchivos asociados a uno u otro buscador son:
  Buscador 1: <br>
    - gestionBuscar1Camp.js<br>
  Buscador 2: <br>
    - resultadosbusqueda1.php<br>
    - gestionBuscar2Camp.js

