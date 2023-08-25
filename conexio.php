<?php

// Creación del objeto BD
$bd = new mysqli();

// Apertura de conexión
$bd->connect('localhost', 'root', ''); 

// Comprobacion de errores y finalizacion del script.
if ( $bd->connect_errno != 0 ) { 
	die("Error n." . $bd->connect_errno ." : " . $bd->connect_error);
} else {
	$conexioOk = "Conexion establecida con " . $bd->host_info;
}

/* cambiar el conjunto de caracteres a utf8 */
if (!$bd->set_charset("utf8")) {
	printf("Error cargando el conjunto de caracteres utf8: %s\n", $bd->error);
	exit();
} else {
	printf("", $bd->character_set_name());
}

$bd->select_db("buscadores_cercadors") or die("1. Error de acceso a base de datos: ".$bd->errno.":".$bd->error); //
$bdOk = "2. Conexion establecida con " . $bd->host_info;

$errorBD = "3. Error de acceso a base de datos: ".$bd->errno." : ".$bd->error;