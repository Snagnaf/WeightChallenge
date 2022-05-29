function valida(){
    if(!controllaNome()){
        alert("errore");
    }
        
}

function controllaNome(){
    const nome = document.myForm.inputNome.value;
    return nome.length <= 40 && !isNaN(cap);
}