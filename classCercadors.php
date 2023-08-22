<?php
namespace ElMeuPortafoli\eines;
/* include_once "classBDSelect.php";
use \ElMeuPortafoli\BDSelect\selectBD; */

/*
FRONT
BACKEND
*/
class cercadors { // 
	private $codi;
	private $lang;
    private $galeria;
    private $desp;
    private $test;

	/* public function __construct($arr) {
		$this->resultats = parent::__construct($arr);
	} */

	public function setCodi($arr = null) {
		global $bd;

        $arrf['html'][0] = "
        <!-- <form id='cercarform' name='cercarform'> -->
        <form id='cercartext' name='cercartext'>

            <input type='text' name='txtcercar' id='txtcercar' class='hide' value=''>
            <input type='hidden' name='lang' id='lang' class='hide' value='0'>
            <span class='cleartext hide'></span>

            <a id='btncercar' class='desactivat mostra'></a>
        </form>";

        $arrf['html'][1] = "
        <div id='cercador2d' class=''>
            <a id='btncercar2'></a> <!--  class='desactivat' -->
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
                    <input type='hidden' name='lang' id='lang' value='0'>
                </form>
            </div>
            <div id='resultcerc'></div>
        </div>\n";

        $arrf['cojs'] = "		<script src='_js/gestioCercador1Camp.js'></script>
		<script src='_js/gestioCercador2Camp.js'></script>";

		$this->codi = $arrf;
	}

	public function getCodi() {
		return $this->codi;
    }

    public function setResultat1($arr) {
        global $bd;

        $this->lang = $arr['lang'];

        // CERCADOR 2
        // Si se utiliza el segundo buscador se añae este código a la query, que varía segun se envíe un valor coon el primer desplegble o con el primero y el segundo
        // CERCADOR 2
        $leftjoin1 = '';
        $leftjoin2 = '';
        if(isset($arr['des1'])) {
            $leftjoin1 = "
            LEFT JOIN disciplinesImgs_cercador ON disciplinesImgs_cercador.id_imatge = imatges_cercador.id
            LEFT JOIN disciplines_cercador ON disciplines_cercador.id = disciplinesImgs_cercador.disciplina ";
        }
        if(isset($arr['des2']) && $arr['des2'] != 0) {
            $leftjoin2 = "
            LEFT JOIN einesImgs_cercador ON einesImgs_cercador.id_imatge = imatges_cercador.id
            LEFT JOIN eines_cercador ON eines_cercador.id = einesImgs_cercador.tool";
        }
        // FI CERCADOR 2

        $text = '';
        $querytext = '';
        $despl = '';
        // CERCADOR 2
        if(isset($arr['des1'])) {
            if(isset($arr['des1'])) {
                $despl .= " AND disciplines_cercador.id = ?"; //" AND ";
            }
            if(isset($arr['des2']) && $arr['des2'] != 0) {
                $despl .= " AND einesImgs_cercador.tool = ?";
            }
            // FI CERCADOR 2
        } elseif(array_key_exists('text', $arr) && $arr['text'] != '') { // CERCADOR 1
            $text = "%" . strtolower($bd->real_escape_string($arr['text'])) . "%";
            $querytext =  " AND REPLACE(LOWER(`alt`), '<[^>]*>', '') LIKE ?";
        } else {
            $text = "''";
            $querytext = "AND `alt` != ?";
        }
        // FI CERCADOR 1

        $query = "SELECT DISTINCT(imatges_cercador.`id`), `class`, `href`, `img`, `alt`, `peu` FROM `imatges_cercador` 
        " . $leftjoin1 . " " . $leftjoin2 . " WHERE imatges_cercador.`visible` = 1 " . $querytext . $despl . " ORDER BY `ordre`";

        //echo '--------- ' . $query . ' - ' . $arr['text'] . ' - ' . $arr['des1'] . ' - ' . $arr['des2'] . ' ------';

		$cerca = $bd->stmt_init(); 
		$cerca->prepare($query);
        
        // Introducimos el valor enviado mediante el formulario del primer buscador o del segundo
        // CERCADOR 2
        if(isset($arr['des1']) && $arr['des2'] == 0) {
		    $cerca->bind_param("i", $arr['des1']) or die("Error: $cerca->errno : " . $cerca->error);
		} elseif(isset($arr['des2']) && $arr['des2'] != 0) {
		    $cerca->bind_param("ii", $arr['des1'], $arr['des2']) or die("Error: $cerca->errno : " . $cerca->error);  // FIN CERCADOR 2
        } elseif(isset($arr['text'])) {
            // CERCADOR 1
		    $cerca->bind_param("s", $text) or die("Error: $cerca->errno : " . $cerca->error);
            // FI CERCADOR 1
        } else {
            // CERCADOR 1
		    $cerca->bind_param("s", $arr['text']) or die("Error: $cerca->errno : " . $cerca->error);
            // FI CERCADOR 1
        }

        // CODI COMÚ
        $cerca->execute();
        $result = $cerca->get_result();
        $this->galeria = $result->fetch_all(MYSQLI_ASSOC);
		$result->free();
        // FI CODI COMÚ

        $this->test = $query;
    }

    public function getResultat() {
        $list = "";
        foreach ($this->galeria as $value) { // $key =>
			$title = str_replace( '"', "&quot;", $value['peu'] );
			$title = str_replace( "'", "&#39;", $title );
			$alt = str_replace( '"', "&quot;", $value['alt'] );
			$alt = str_replace( "'", "&#39;", $alt );

            $list .= "            <a class='fancybox-buttons imgarticle' title='" . $title . "' data-fancybox-group='button'>			
                <span>			
                    <img class='" . $value['class'] . "' src='_img/" . $value['img'] . "' alt='" . $alt . "'>					
                </span>	
            </a>";
        }

        if(count($this->galeria) == 0) { 
            $noimgs = ($this->lang == 0) ? 'No hi ha imatges seleccionades' : 'No hay imágenes seleccionadas';
            $list = "<p>" . $noimgs . "</p>"; 
        }

        unset($this->galeria);
        
        return $list;
    }

    public function setDesplegable($arr) {
        global $bd;

        $txt1 = "%" . strtolower($bd->real_escape_string($arr['des1'])) . "%";
        if(isset($arr['des1']) && $arr['des1'] != '') { //
            $query = "SELECT `id`, `disciplina` AS nom FROM `disciplines_cercador` WHERE `disciplina` LIKE ? ORDER BY `nom`";
            $bpar = 1;
        }
        if(isset($arr['des2']) && $arr['des2'] != '') {
            $txt2 = "%" . strtolower($bd->real_escape_string($arr['des2'])) . "%";

            $query = "SELECT DISTINCT(eines_cercador.`id`), eines_cercador.`tool` AS nom FROM `imatges_cercador` 
            
            LEFT JOIN disciplinesImgs_cercador ON disciplinesImgs_cercador.id_imatge = imatges_cercador.id
            LEFT JOIN disciplines_cercador ON disciplines_cercador.id = disciplinesImgs_cercador.disciplina 

            LEFT JOIN einesImgs_cercador ON einesImgs_cercador.id_imatge = imatges_cercador.id
            LEFT JOIN eines_cercador ON eines_cercador.id = einesImgs_cercador.tool

            WHERE imatges_cercador.`visible` = 1 AND disciplines_cercador.disciplina LIKE ? AND eines_cercador.tool LIKE ? ORDER BY eines_cercador.tool ASC";

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