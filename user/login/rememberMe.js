
function inizializza(){
    sessionStorage.setItem("ricordami", "true");
}

function valida(){
    alert(document.getElementById("rmb").checked);
    if(!document.getElementById("rmb").checked){
        sessionStorage.ricordami = "false";
    }
    alert(sessionStorage.ricordami);
}
function effettuata(){
    sessionStorage.utente=document.getElementById('nome').innerText;
    if(sessionStorage.ricordami=="true") {
        localStorage.utente=document.getElementById('nome').innerText;
    }
    sessionStorage.removeItem("ricordami");
}