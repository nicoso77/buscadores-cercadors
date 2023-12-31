<?php
header("Content-Type:, 'application/json");

// 3. INCLUDES
include_once("conexio.php");
include_once("classCercadors.php");
$buscador = new cercadors();

$arr['des1'] = filter_input(INPUT_POST, 'txtcercar1');
$error = (strlen($arr['des1']) < 1) ? true : false;

if(filter_input(INPUT_POST, 'txtcercar2') != '') {
    $arr['des2'] = filter_input(INPUT_POST, 'txtcercar2');
    $error = (strlen($arr['des1']) < 1 && strlen($arr['des2']) < 1) ? true : false; 
}

$datos = array();
if (!$error) {
    $buscador->setDesplegable($arr);
    $arrdes = $buscador->getDesplegable();
}
 
echo json_encode([
    "datos" => $arrdes['datos'],
    "error" => $arrdes['error']
]);