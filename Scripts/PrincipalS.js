
//validacion de ingresion
function valida(a){
    if(vacio(a.nombre.value) == false || vacio(a.precio.value) == false || vacio(a.cantidad.value) == false || vacio(a.fecha.value) == false || vacio(a.categoria.value) == false || vacio(a.descripcion.value) == false){
        alert("faltan campos por llenar")
        return false;
    }else{
        if(precioV(a.precio)== true && cantidadV(a.cantidad) == true && cantidad > 0 && precio > 0){
            return true;
        }else{
            return false;
        }        
    }
}

function vacio(b){
    for(x = 0 ; x < b.length; x++){
        if(b.charAt(x) != " "){
            return true;
        }
    }
    return false;
}

function precioV(d){
    var z = /^(\s*|\d+)$/
    if (d.value.match(z)) {
        return true;
    }else {
        return false;
    }
}

function cantidadV(c){
    var y = /^(\s*|\d+)$/
    if (c.value.match(y)){
        return true;
    }else{
        return false;
    }
}


// validacion de busqueda

function validaB(a){
    if(vacioB(a.Bnombre.value) == false ){
        alert("faltan campos por llenar")
        return false;
    }else{
        return true;        
    }
}

function vacioB(b){
    for(x = 0 ; x < b.length; x++){
        if(b.charAt(x) != " "){
            return true;
        }
    }
    return false;
}

//validacion de eliminacion
function validaE(a){
    if(vacioE(a.Enombre.value) == false ){
        alert("faltan campos por llenar")
        return false;
    }else{
        return true;        
    }
}

function vacioE(b){
    for(x = 0 ; x < b.length; x++){
        if(b.charAt(x) != " "){
            return true;
        }
    }
    return false;
}
