var ricordami = false;
function valida(){
    if(document.getElementById("rmb").checked){
        ricordami = true;

    }
}
function effettuata(nome){
    if(ricordami) {localStorage.utente=nome;console.log("ok");}
}