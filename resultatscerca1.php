<?php
include_once("conexio.php");
include_once("classCercadors.php");

use \ElMeuPortafoli\eines\cercadors;
$cercador = new cercadors();
//$arrcerc = $cercador->codi($arr = array());

$data = json_decode(file_get_contents("php://input"));
$arrposts = $data->textcerca;


if($data) { //
    //$arr['lang'] = 0;
    if($arrposts[0] == 0) {
        $arr['lang'] = 0;
        $arr['text'] = $arrposts[1];
    } elseif ($arrposts[0] == 1) {
        $arr['lang'] = 0;
        $arr['des1'] = $arrposts[1];
        $arr['des2'] = $arrposts[2];
    }
    $cercador->setResultat1($arr); // $arrposts[1]
    echo $cercador->getResultat();
}
