const btncercar = document.querySelector('#btncercar');
const txtcercar = document.querySelector('#txtcercar');
const cleartext = document.getElementsByClassName('cleartext')[0];
const listxtcer = document.querySelector('#listxtcerca');
const listcerca = document.querySelector('.galeria');
let text = [];

const cercarItems = () => {
    // Crida Ajax
    let ajaxcerca = new XMLHttpRequest();
    let URLcerca = 'resultatscerca1.php';

    ajaxcerca.onreadystatechange = function() {
        if (ajaxcerca.readyState == 4 && ajaxcerca.status == 200){
            listcerca.innerHTML = ajaxcerca.responseText; //
        } else {
            listcerca.innerHTML = 'En proces'; // 
        }
    }
    
    ajaxcerca.open('POST', URLcerca, true); // sendForm;

    let paramspostcerca  = { textcerca : text }
    ajaxcerca.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    ajaxcerca.send( JSON.stringify(paramspostcerca) );
    // FI crida Ajax 
}

let gestioCampTxtCerca = () => {
    if(btncercar.className != 'escriure') { // 
        txtcercar.className = (txtcercar.className == 'hide') ? 'show' : 'hide';
        btncercar.className = (txtcercar.className == 'hide') ? 'desactivat mostra' : 'desactivat amaga'; 
    }

    if(btncercar.className == 'escriure') {
        // Generar llistat termes cerca
        text[0] = 0;
        text[1] = txtcercar.value;
        let arrtxtcerca = text[1].split(' ');

        if(arrtxtcerca.length > 1) {
            let listbtnscerca = '';
            arrtxtcerca.forEach(function(terme, index) {
                listbtnscerca += "<div id='boxtxtcerca" + index + "' class='boxtxtcerca'><span class='termecerca'>" + terme + "</span> <a id='btntxtanca_" + index + "' class='btntxtanca'>X</a></div>";
                
                /* document.querySelector('#btntxtanca_' + index).addEventListener('click', () => { document.querySelector('#boxtxtcerca' + index).remove(); }); */
            });

            listxtcer.innerHTML = listbtnscerca;

            arrtxtcerca.forEach(function(terme, index) {
                document.querySelector('#btntxtanca_' + index).addEventListener('click', () => { 
                    document.querySelector('#boxtxtcerca' + index).remove();

                    let newtxtcerca = '';
                    let espai;
                    //let arrterms = document.querySelector('.boxtxtcerca');
                    let arrterms = document.getElementsByClassName('boxtxtcerca');
                    for (let iarrtrms = 0; iarrtrms < arrterms.length; iarrtrms++) {
                        let txtcercanew = document.getElementsByClassName('termecerca')[iarrtrms].innerHTML;
                        espai = (iarrtrms == 0) ? '' : ' ';
                        newtxtcerca += espai + txtcercanew;
                    }

                    txtcercar.value = newtxtcerca; //  + ' ' + arrterms.length
                    text[1] = txtcercar.value;
                    cercarItems();
                    /* funció: recorre array creada amb  document.querySelector('.boxtxtcerca');
                    va captuant els termes amb innerHTML y creant nou text per a la cerca. Aquest text s'inserta en el value de 'txtcercar' txtcercar.value = text, i s'executa la funció 'cercarItems()'
                    */
                });
            });
        }
        // Fi Generar llistat

        /* let textcerca = txtcerca.join('+');
        txtcercar.value = textcerca;
        cleartext.className = 'cleartext show';
        btncercar.className = 'desactivat amaga'; */

        cercarItems();
    }
}

btncercar.addEventListener('click', gestioCampTxtCerca);

cleartext.addEventListener('click', () => { 
    cleartext.className = 'cleartext hide'; 
    txtcercar.value = ''; 
    btncercar.className = 'desactivat amaga';
    // listcerca.innerHTML = ''; // Descomentar para eliminar el listado obtenido con la busqueda
});

txtcercar.addEventListener('keyup', () => { // keydown
    btncercar.className = 'escriure';
    cleartext.className = 'cleartext show';

    /* let ajaxcerca = new XMLHttpRequest();
    let URLcerca = 'retornaresultatscerca.php'; */
})

/*
Es genera llistat de paraula/paraules que es visualitci si hi ha mes de dos, per poder eliminar un o varis dels termes separats. Cada cap que s'elimini un dels termes, botons amb x, es recopilaran els termes restants, s'insentaran com a value en el input 'txtcercar' i es fará submit del formulari 'cercarform' perque faci la cerca amb els termes restants.
*/