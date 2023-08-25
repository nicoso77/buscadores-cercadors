<?php
include_once("conexio.php");
include_once("classCercadors.php");
use \ElMeuPortafoli\eines\cercadors;
$objsearch = new cercadors();
$objsearch->setCodi();
$arrsearch = $objsearch->getCodi();
$objsearch->setResultat($arr = array('text' => ''));
$list = $objsearch->getResultat();

?>

<!DOCTYPE html>
<html lang="es" class="">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Nicolau Suárez Olalla">
		<meta name="robots" content="index, follow">
		<meta name="geo.placename" content="Barcelona">
		<meta name="keywords" content="Plantilla Buscador / Cercador">
		<meta name="description" content="Pagina de muestra, plantilla para dos buscadores">
		<title>Portafoli</title>
		<link rel="shortcut icon" href="_img/nso-icon.png">
		<link rel="stylesheet" href="_css/style.css?23082505">
		<link rel="stylesheet" href="_css/style-searchers.css?23082505">
		<link rel="stylesheet" href="_css/style-flex-box.css?23082505">
	</head>

	<body class="" cz-shortcut-listen="true">
		<header>
			<span class="autorweb">Buscadores</span>
			<span class="logoheader"><img src="_img/logo-nso-blau-21121202.png" alt="logo de Nicolau Suárez Olalla"></span>
			<aside id="submenuheader">
				<div class="right">
					<?php echo $arrsearch['html'][0]; ?>
				</div>
				<div class="clear"></div>
			</aside>
			<span class="subtitulo">Mini proyecto de buscadores</span>
			<div class="clear"></div>
		</header>

		<nav class="hdmenu" style="top: 121px;">
			<ul class="botons">
				<li class="btngaleria">
					<a href="https://nsuarez.com/galeria.php">Galeria </a>
				</li>
				<li class='btncerca right'><?php echo $arrsearch['html'][1]; ?></li>
				<li class="clear"></li>
			</ul>
		</nav>

		<div id="blocpag" style="margin-top: 215px;">
			<aside id='listxtcerca'></aside>
			<article>
				<h1>Galeria</h1>
				<div class="galeria galeria-flex-box-01">	
					<?php echo $list; ?>
					<div class="clear"></div>
				</div>
			</article>
		</div>
		<div class="clear"></div>

		<footer>
			<span class="llgProg left">Plantilla programada<br>amb els llenguatges</span>
			<aside class="listIcones left">
				<span>
					<img src="_img/ico-html5-css-javascript-01.png" alt="HTML5, CSS3, JavaScript">	
				</span>	
				<span>
					<img src="_img/ico-PHP-i-MySQL-01.png" alt="PHP i MySQL">	
				</span>
			</aside>

			<span class="autor">Muestra de GitHub de Nicolau Suárez Olalla</span>
			<div class="clear"></div>
		</footer>

		<?php echo $arrsearch['cojs']; ?>

	</body>
</html>