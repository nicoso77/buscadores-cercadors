<?php
include_once("conexio.php");
include_once("classCercadors.php");
use \ElMeuPortafoli\eines\cercadors;
$objcerca = new cercadors();
$objcerca->setCodi();
$arrcerca = $objcerca->getCodi();
$objcerca->setResultat1($arr = array('text' =>'', 'lang' => 0));
$list = $objcerca->getResultat();

?>

<!DOCTYPE html>
<html lang="ca" class="">
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
		<link rel="stylesheet" href="_css/estils-23051601.css?23082103">
		<link rel="stylesheet" href="_css/responsive-21012101.css">
		<link rel="stylesheet" href="_css/estil-cercadors.css">
		<link rel="stylesheet" href="_css/estil-flex-box.css">

		<style type="text/css">
			.fancybox-margin{margin-right:15px;}
		</style>
	</head>

	<body class="" cz-shortcut-listen="true">
		<header>
			<span class="autorweb">Cercadors</span>
			<span class="logoheader"><img src="_img/logo-nso-blau-21121202.png" alt="logo, segell de Nicolau Suárez Olalla"></span>
			<span class="btnshdmenu"><img src="_img/hamburger_icon_commons.svg" alt="icono mostra amaga menu principal responsive"></span>
			<aside id="submenuheader">
				<div class="right">
					<?php echo $arrcerca['html'][0]; ?>
				</div>
				<aside class="listidiomes right">
					<span class="icolang langca">
						<a href="https://nsuarez.com/galeria.php?lang=0"> </a>
					</span>
					<span class="icolang langes">
						<a href="https://nsuarez.com/galeria.php?lang=1"> </a>
					</span>
				</aside>
				<div class="clear"></div>
			</aside>
			<span class="ofici">Codi d'exemple per a cercadors</span>
			<div class="clear"></div>
		</header>

		<nav class="hdmenu" style="top: 121px;">
			<ul class="botons">
				<li class="btngaleria">
					<a href="https://nsuarez.com/galeria.php">Galeria </a>
				</li>
				<li class='btncerca right'><?php echo $arrcerca['html'][1]; ?></li>
				<li class="clear"></li>
			</ul>
		</nav>

		<div id="blocpag" style="margin-top: 215px;">
			<aside id='listxtcerca'></aside>
			<article>
				<h1>Galeria</h1>
				<div class="galeria">	
					<?php echo $list; ?>
					<div class="clear"></div>
				</div>

				<!--
				<h1 id='title2'>Galeria Flexbox:</h1>
				<div class="contentflox galeria-felx-box-01">	
					<div class="box01"><span class='infocss'>1<br>.galeria-felx-box-01 { display: flex; flex-direction: row; }</span></div>	
					<div class="box01">2</div>	
					<div class="box01">3</div>	
					<div class="box01">4</div>	
					<div class="box01">5</div>	
					<div class="box01">6</div>	
					<div class="box01">7</div>	
					<div class="box01">8</div>	
					<div class="box01">9</div>
				</div>
				<div class="contentflox galeria-felx-box-02">	
					<div class="box01"><span class='infocss'>1<br>.galeria-felx-box-01 { display: flex; flex-direction: row-reverse; }</span></div>	
					<div class="box01">2</div>	
					<div class="box01">3</div>	
					<div class="box01">4</div>	
					<div class="box01">5</div>	
					<div class="box01">6</div>	
					<div class="box01">7</div>	
					<div class="box01">8</div>	
					<div class="box01">9</div>
				</div>
				<div class="contentflox galeria-felx-box-03">	
					<div class='boxs01'>
						<div class="box01">
						.galeria-felx-box-01 { display: flex; flex-direction: }	
							<div class="box02">
								<div class="box01">2</div>	
								<div class="box01">3</div>	
								<div class="box01">4</div>
							</div>	
						</div>	
						<div class="box01">2</div>	
						<div class="box01">3</div>	
						<div class="box01">4</div>	
					</div>
				</div>
				<div class="contentflox galeria-felx-box-04">	
					<div class='boxs01'>
						<div class="box01">1</div>	
						<div class="box01">2</div>	
						<div class="box01">3</div>	
						<div class="box01">4</div>	
					</div>	
				</div>
				-->
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
				<span>
					<img src="_img/ico-ajax.png" alt="PHP i MySQL">	
				</span>
			</aside>

			<span class="autor">Muestra de GitHub de Nicolau Suárez Olalla</span>
			<div class="clear"></div>
		</footer>

		<?php echo $arrcerca['cojs']; ?>
		<script src="_js/shdboxmenuspdate.js"></script>
		<script src="_js/showhide.js"></script><!--  -->

		<script type="text/javascript">

			/* variables javascript */
				'use strict';
				var i, botoMostra, botoAmaga, codiImgs, arrayImgs, quinBloc, numFotos, id, titol, descripcio, 
				dadaid, dadatitol, dadadescripcio,
				idTrue, titolTrue, descripcioTrue, 
				ordre, etiqueta, classe, link, contingut, visible, nivell,
				ordreTrue, etiquetaTrue, classTrue, classeTrue, linkTrue, contingutTrue, visibleTrue, nivellTrue,
				dadaordre, dadaetiqueta, dadaclass, dadalink, dadacontingut, dadavisible, dada, nivell,
				pagina, tancament, pare,
				paginaTrue, tancamentTrue, pareTrue,
				dadapagina, dadatancament, dadapare,
				pestana, dataTrue, dadaDataI, dadaDataF, i, j, k, botoSubmit, botoSubmit2, 
				tipus, contURL, conTipus,
				dadatipus, dadacontURL,
				botoShowHide1, boxElem1,
				seleccio,
				textboxs,
				texte, menuPrin, modClasse, modTexte, modLink,
				url, detalls,
				boxsMenu, txequejar,
				matriuSelc = new Array(),
				arrayJs = []; 
			/* FI variables javascript */

			var ajax = document.getElementsByClassName('load')[0];
			var blocheader = document.getElementsByTagName('header')[0];
			var headerhgt = blocheader.offsetHeight; // MOSTRA AMAGA HEADER
			var headerwdt = blocheader.offsetWidth; 

			var navmenu = document.getElementsByTagName('nav')[0];
			var navhgt = navmenu.offsetHeight; // MOSTRA AMAGA HEADER
			var blocpag = document.getElementById('blocpag');
			
			// MODIFICA POSICIONS DE HEADER, NAV PÀGINA QUAN LOAD O RESIZE
			function adapthead() {
				/* info01: Aquestes variables han de ser a la funció perque s'actualitzin els valors quan es crida la funció */
				headerhgt = blocheader.offsetHeight; // Header
				navhgt = navmenu.offsetHeight; // Nav
				/* fi info01 */
                let blocheadhg = (headerwdt >= 650) ? headerhgt + navhgt : headerhgt;

				navmenu.style.top = headerhgt + 'px';

				btnshdmenu.addEventListener('click', shdenav, false);
			}

			function scrollhead() {
				navhgt = navmenu.offsetHeight;

                let blocheadhg = (headerwdt >= 650) ? headerhgt + navhgt : headerhgt;

				if (window.scrollY >= 20) { // CUIDADO, QUAN ES UN MOVIL I S'HA MOSTRAT EL MENU, AL FER ESCROLL EL MENU ES POSA A LA POSICIÓ 0 I AL PUJAR L'ESCROLL A L'INICI, EL MENU QUEDA RERA EL HEADER 
					blocheader.style.display = 'none';
					navmenu.style.top = 0 + 'px';
					blocpag.style.marginTop = 0 + 'px';

				} else if(window.scrollY < 20) {
					blocheader.style.display = 'block';
					headerhgt = blocheader.offsetHeight;
					navmenu.style.top = headerhgt + 'px';

					
				} else {
					blocheader.style.display = 'block';
					navmenu.style.top = headerhgt + 'px';
				}
			}

			window.addEventListener('scroll', scrollhead);
			window.addEventListener('resize', adapthead);
			window.addEventListener('load', adapthead);
			/* window.addEventListener('load', loadpag, false); */

		</script>

	</body>
</html>