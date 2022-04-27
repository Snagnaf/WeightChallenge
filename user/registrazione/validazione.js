function valida(){
    if(controllaCAP()){
        if(document.getElementById("rmb").checked){
            alert("Hai scelto di essere ricordato!");
        }else{
            alert("Hai scelto di non essere ricordato!");
        }
    }else{
        alert("errore nel CAP");
    }
        
}

function controllaCAP(){
    const cap = document.myForm.inputCap.value;
    return cap.length == 5 && !isNaN(cap)
}