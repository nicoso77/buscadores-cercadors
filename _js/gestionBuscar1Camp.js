const btncercar = document.querySelector('#btncercar');
const txtcercar = document.querySelector('#txtcercar');
const cleartext = document.getElementsByClassName('cleartext')[0];
const listxtcer = document.querySelector('#listxtcerca');
const listcerca = document.querySelector('.galeria');
let text = [];

/*
Solicitud mediante ajax para obtener un nuevo listado a partir de la coincidennciia con el termino/s ( variable 'text') enviado.  
*/
const cercarItems = () => {
    let ajaxcerca = new XMLHttpRequest();
    let URLcerca = 'resultadosbusqueda1.php';

    ajaxcerca.onreadystatechange = function() {
        if (ajaxcerca.readyState == 4 && ajaxcerca.status == 200){
            listcerca.innerHTML = ajaxcerca.responseText; //
        } else {
            listcerca.innerHTML = 'En proceso'; // 
        }
    }
    
    ajaxcerca.open('POST', URLcerca, true); // sendForm;

    let paramspostcerca  = { textcerca : text }
    ajaxcerca.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    ajaxcerca.send( JSON.stringify(paramspostcerca) );
}

/*
Funció que gestiona varias acciones:
    -Mostrar  o ocultar el campo donde introducir el texto a buscar.
    -Crear listado de palabras, a partir del texto introducido en la busqueda (se visualitzaran si hi hay mas de'una); esto permitirá eliminar los terminos seleccionados, por separado.
    -Con cada eliminación de un termino se realiza una nueva búsqueda con los terminos restantes.
*/
let gestioCampTxtCerca = () => {
    if(btncercar.className != 'escribir') { // 
        txtcercar.className = (txtcercar.className == 'hide') ? 'show' : 'hide';
        btncercar.className = (txtcercar.className == 'hide') ? 'desactivado mostra' : 'desactivado amaga'; 
    }

    if(btncercar.className == 'escribir') {
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
                    let arrterms = document.getElementsByClassName('boxtxtcerca');
                    for (let iarrtrms = 0; iarrtrms < arrterms.length; iarrtrms++) {
                        let txtcercanew = document.getElementsByClassName('termecerca')[iarrtrms].innerHTML;
                        espai = (iarrtrms == 0) ? '' : ' ';
                        newtxtcerca += espai + txtcercanew;
                    }

                    txtcercar.value = newtxtcerca;
                    text[1] = txtcercar.value;
                    cercarItems();
                });
            });
        }

        cercarItems();
    }
}

btncercar.addEventListener('click', gestioCampTxtCerca);

/* Al escribir el primer caracter si activa la opción de buscar el termino escrito y la de eliminar el texto introducido */
txtcercar.addEventListener('keyup', () => { // keydown
    btncercar.className = 'escribir';
    cleartext.className = 'cleartext show';
})

/* Al hacer click en el icono X, mostrado dentro del input al escribir el primer carácter, se elimina el texto introducido y se desactiva la opción de solicitar una busqueda */
cleartext.addEventListener('click', () => { 
    cleartext.className = 'cleartext hide'; 
    txtcercar.value = ''; 
    btncercar.className = 'desactivado amaga';
});