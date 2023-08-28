<?php
include_once("conexio.php");
include_once("classCercadors.php");

$buscador = new cercadors();

$data = json_decode(file_get_contents("php://input"));
$arrposts = $data->textcerca;

if($data) { //
    if($arrposts[0] == 0) {
        $arr['text'] = $arrposts[1];
    } elseif ($arrposts[0] == 1) {
        $arr['des1'] = $arrposts[1];
        $arr['des2'] = $arrposts[2];
    }
    $buscador->setResultat($arr); // $arrposts[1]
    echo $buscador->getResultat();
}
