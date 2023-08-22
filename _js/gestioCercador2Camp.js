
const btncercar2 = document.querySelector('#btncercar2');
const cercador2d = document.querySelector('#cercador2d');
const boxcercadp = document.querySelector('#boxcercadp')
const txtcercar1 = document.querySelector('#txtcercar1');
const txtcercar2 = document.querySelector('#txtcercar2');
const valudiscid = document.querySelector('#discid');
const valutoolid = document.querySelector('#toolid');
const listcerca2 = document.querySelector('.galeria');
let xhr = new XMLHttpRequest();
let res = [];
//let xhttp = new XMLHttpRequest();

btncercar2.addEventListener('click', (event) => {
    let estat = (boxcercadp.className == 'hide') ? 'show' : 'hide';
    boxcercadp.className = estat;
});

const creardesplegable = (e) => {
    if (!document.querySelector('#llistacerc' + e)) {
        ul = document.createElement('ul');
        ul.setAttribute('id', 'llistacerc' + e);
        ul.setAttribute('class', 'llistacerca');
        let onposarllista = document.querySelector('#txtcercar' + e);
        onposarllista.after(ul); // campcerca1.after(ul);
    }
}

const crearllistat = (res, i, a, list) => {
    let id = res.datos[i].id;
    let nombre = res.datos[i].nom;

    li = document.createElement('li');
    li.setAttribute('class', 'item' + a + '_' + res.datos[i].id);
    li.innerHTML = nombre; // res.datos[i].nombre;
    list.prepend(li);

    return id;
};

const crearselecgaleria = () => {
    // Crida Ajax
    let selec1 = valudiscid.value;
    let selec2 = valutoolid.value;
    let desple = [];
    desple[0] = 1;
    desple[1] = selec1;
    desple[2] = selec2;

    let ajaxcerca = new XMLHttpRequest();
    let URLcerca = 'resultatscerca1.php';

    ajaxcerca.onreadystatechange = function() {
        if (ajaxcerca.readyState == 4 && ajaxcerca.status == 200){
            listcerca2.innerHTML = ajaxcerca.responseText; //
        } else {
            listcerca2.innerHTML = 'Búsqueda en proceso'; // En proces
        }
    }

    ajaxcerca.open('POST', URLcerca, true); // sendForm;

    let paramspostcerca  = { textcerca : desple }
    ajaxcerca.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    ajaxcerca.send( JSON.stringify(paramspostcerca) );
    // FI crida Ajax 
}

txtcercar1.addEventListener('keyup', (event) => {
    // create List if not exist
    creardesplegable(1);
    
    //var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState < 4) {}
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            res = JSON.parse(this.responseText);

            //document.querySelector('#campcerca1').innerHTML = res.datos[0].nom;
            // remove elements
            lista1 = document.querySelector('#llistacerc1');
            lista1.innerHTML = ''

            if (!res.error && res.datos.length > 0) {
                for (var i = 0; i < res.datos.length; i++) {
                    let id = crearllistat(res, i, '1', lista1);
                    let nombre = res.datos[i].nom;
                    let ideina = res.datos[i].id;
                    document.querySelector('.item1_' + id).addEventListener('click', () => {
                        lista1.remove();
                        txtcercar2.className = 'activat';
                        txtcercar1.value = nombre; // nombre
                        valudiscid.value = ideina;
                        //listcerca2
                        crearselecgaleria();
                    })/*  */
                }
            }
        }
    }

    xhr.open('post', 'resultatscerca2.php', true);
    // form data
    let form = document.querySelector('#cercartext2');
    if(txtcercar1.value!= '') {
        data = new FormData(form);
        xhr.send(data);
    }
})

txtcercar2.addEventListener('keyup', (event) => {
    // create List if not exist
    creardesplegable(2);
    
    /*  */
    //var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState < 4) {}
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            res = JSON.parse(this.responseText);

            // remove elements
            lista2 = document.querySelector('#llistacerc2');
            lista2.innerHTML = ''

            if (!res.error) {
                for (i = 0; i < res.datos.length; i++) {

                    let id = crearllistat(res, i, '2', lista2);
                    let nombre = res.datos[i].nom;
                    let idtool = res.datos[i].id;
                    document.querySelector('.item2_' + id).addEventListener('click', () => {
                        lista2.innerHTML = '';
                        lista2.remove();
                        txtcercar2.value = nombre;
                        valutoolid.value = idtool;
                        crearselecgaleria();
                    })
                }
            }
        }
    }

    xhr.open('post', 'resultatscerca2.php', true);
    // form data
    if(txtcercar2.value!= '') {
        let form = document.querySelector('#cercartext2');
        data = new FormData(form);
        xhr.send(data);
    }
})