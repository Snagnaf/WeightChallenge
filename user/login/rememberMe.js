
function inizializza(){
    sessionStorage.setItem("ricordami", true);
}

function valida(){
    if(!document.getElementById("rmb").checked){
        sessionStorage.ricordami = false;
        alert(sessionStorage.ricordami);
    }
}
function effettuata(){
    sessionStorage.utente=document.getElementById('nome').innerText;
    if(sessionStorage.ricordami==true) {
        alert(sessionStorage.ricordami);
        localStorage.utente=document.getElementById('nome').innerText;
    }
    sessionStorage.removeItem("ricordami");
    
}