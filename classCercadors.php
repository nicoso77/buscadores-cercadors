<?php

class cercadors { // 
	private $codi;
    private $galeria;
    private $desp;
    private $test;

    // FRONT END pagina-buscadores-cercadors.php
	public function setCodi($arr = null) {
		global $bd;

        $arrf['html'][0] = "
        <form id='cercartext' name='cercartext'>

            <input type='text' name='txtcercar' id='txtcercar' class='hide' value=''>
            <span class='cleartext hide'></span>

            <a id='btncercar' class='desactivado mostra'></a>
        </form>";

        $arrf['html'][1] = "
        <div id='cercador2d' class=''>
            <a id='btncercar2'></a>
            <div id='boxcercadp' class='hide'>
                <form id='cercartext2' name='cercartext2'>
                    <div id='campcerca1'>
                        <input type='text' name='txtcercar1' id='txtcercar1' class='show' placeholder='Disciplina' value=''>
                    </div>

                    <div id='campcerca2'>
                        <input type='text' name='txtcercar2' id='txtcercar2' class='apagat' placeholder='Eina' value=''>
                    </div>

                    <input type='hidden' name='discid' id='discid' value='0'>
                    <input type='hidden' name='toolid' id='toolid' value='0'>
                </form>
            </div>
            <div id='resultcerc'></div>
        </div>\n";

        $arrf['cojs'] = "		<script src='_js/gestionBuscar1Camp.js'></script>
		<script src='_js/gestionBuscar2Camp.js'></script>";

		$this->codi = $arrf;
	}

	public function getCodi() {
		return $this->codi;
    }
    // FIN FRONT END

    /*
    BACKEND - GENERACIÓN DE LA GALERIA
    Creación del listado de elementos para la galería de imágenes, a partir de la búsqueda realizada tanto con el primer como segundo buscador.
    */
    public function setResultat($arr) {
        global $bd;

        // BUSCADOR 2
        // Si se utiliza el segundo buscador se añaDe este código a la query, que varía segun se envíe un valor coon el primer desplegble o con el primero y el segundo
        $leftjoin1 = '';
        $leftjoin2 = '';
        if(isset($arr['des1'])) {
            $leftjoin1 = "
            LEFT JOIN disciplinasImgs_buscador ON disciplinasImgs_buscador.id_imatge = imgs_buscador.id
            LEFT JOIN disciplinas_buscador ON disciplinas_buscador.id = disciplinasImgs_buscador.disciplina ";
        }
        if(isset($arr['des2']) && $arr['des2'] != 0) {
            $leftjoin2 = "
            LEFT JOIN toolsImgs_buscador ON toolsImgs_buscador.id_imatge = imgs_buscador.id
            LEFT JOIN tools_buscador ON tools_buscador.id = toolsImgs_buscador.tool";
        }
        // FI BUSCADOR 2

        $text = '';
        $querytext = '';
        $despl = '';
        // BUSCADOR 2
        if(isset($arr['des1'])) {
            if(isset($arr['des1'])) {
                $despl .= " AND disciplinas_buscador.id = ?";
            }
            if(isset($arr['des2']) && $arr['des2'] != 0) {
                $despl .= " AND toolsImgs_buscador.tool = ?";
            }
            // BUSCADOR 1
        } elseif(array_key_exists('text', $arr) && $arr['text'] != '') { 
            $text = "%" . strtolower($bd->real_escape_string($arr['text'])) . "%";
            $querytext =  " AND REPLACE(LOWER(`alt`), '<[^>]*>', '') LIKE ?";
        } else {
            $text = "''";
            $querytext = "AND `alt` != ?";
        }
        // FI BUSCADOR 1

        $query = "SELECT DISTINCT(imgs_buscador.`id`), `class`, `href`, `img`, `alt` FROM `imgs_buscador` 
        " . $leftjoin1 . " " . $leftjoin2 . " WHERE imgs_buscador.`visible` = 1 " . $querytext . $despl . " ORDER BY `ordre`";
		$cerca = $bd->stmt_init(); 
		$cerca->prepare($query);
        
        // Introducimos el valor enviado mediante el formulario del primer buscador o del segundo
        // BUSCADOR 2
        if(isset($arr['des1']) && $arr['des2'] == 0) {
		    $cerca->bind_param("i", $arr['des1']) or die("Error: $cerca->errno : " . $cerca->error);
		} elseif(isset($arr['des2']) && $arr['des2'] != 0) {
		    $cerca->bind_param("ii", $arr['des1'], $arr['des2']) or die("Error: $cerca->errno : " . $cerca->error);  
            // FIN BUSCADOR 2
        } elseif(isset($arr['text'])) { // BUSCADOR 1
		    $cerca->bind_param("s", $text) or die("Error: $cerca->errno : " . $cerca->error);
        } else {
		    $cerca->bind_param("s", $arr['text']) or die("Error: $cerca->errno : " . $cerca->error);
            
        } // FI BUSCADOR 1

        // CODIGO COMÚN
        $cerca->execute();
        $result = $cerca->get_result();
        $this->galeria = $result->fetch_all(MYSQLI_ASSOC);
		$result->free();
        // FI CODIGO COMÚN

        $this->test = $query;
    }

    public function getResultat() {
        $list = "";
        foreach ($this->galeria as $value) { // 
			$alt = str_replace( '"', "&quot;", $value['alt'] );
			$alt = str_replace( "'", "&#39;", $alt );

            $list .= "		
            <div class='box01' title='" . $alt . "'>			
                <img class='" . $value['class'] . "' src='_img/" . $value['img'] . "' alt='" . $alt . "'>					
            </div>	";
        }

        if(count($this->galeria) == 0) { 
            $list = "<p>No hay imágenes seleccionadas</p>"; 
        }

        unset($this->galeria);
        
        return $list;
    }

    /*
    DESPLEGABLES BUSCADOR 2
    Creación del listado de elementos para el primer o segundo desplegable del segundo buscador.
    */
    public function setDesplegable($arr) {
        global $bd;

        $txt1 = "%" . strtolower($bd->real_escape_string($arr['des1'])) . "%";
        if(isset($arr['des1']) && $arr['des1'] != '') { //
            $query = "SELECT `id`, `disciplina` AS nom FROM `disciplinas_buscador` WHERE `disciplina` LIKE ? ORDER BY `nom`";
            $bpar = 1;
        }
        if(isset($arr['des2']) && $arr['des2'] != '') {
            $txt2 = "%" . strtolower($bd->real_escape_string($arr['des2'])) . "%";

            $query = "SELECT DISTINCT(tools_buscador.`id`), tools_buscador.`tool` AS nom FROM `imgs_buscador` 
            
            LEFT JOIN disciplinasImgs_buscador ON disciplinasImgs_buscador.id_imatge = imgs_buscador.id
            LEFT JOIN disciplinas_buscador ON disciplinas_buscador.id = disciplinasImgs_buscador.disciplina 

            LEFT JOIN toolsImgs_buscador ON toolsImgs_buscador.id_imatge = imgs_buscador.id
            LEFT JOIN tools_buscador ON tools_buscador.id = toolsImgs_buscador.tool

            WHERE imgs_buscador.`visible` = 1 AND disciplinas_buscador.disciplina LIKE ? AND tools_buscador.tool LIKE ? ORDER BY tools_buscador.tool ASC";

            $bpar = 2;

        }
		$cerca = $bd->stmt_init(); 
		$cerca->prepare($query);
        if(isset($arr['des1']) && $bpar == 1) {
		    $cerca->bind_param("s", $txt1) or die("Error: $cerca->errno : " . $cerca->error);
		} elseif (isset($arr['des2']) && $bpar == 2) {
		    $cerca->bind_param("ss", $txt1, $txt2) or die("Error: $cerca->errno : " . $cerca->error); 
        }

        $cerca->execute();
        $result = $cerca->get_result();
        $this->desp = $result->fetch_all(MYSQLI_ASSOC);
		$result->free();
        /*  */

    }

    public function getDesplegable() {

        $count = count($this->desp);
        if($count > 0) {
            foreach ($this->desp as $value) {
                $datos[] = [
                    "id" => $value['id'],
                    "nom" => $value['nom']
                ];
            }
            $error = false;
        } else {
            $error = false;
            $datos = array(0 => array('id' => 0, 'nom' => 'No hay datos'));
        }
        
        return array('datos' => $datos, 'error' => $error);
    }
}