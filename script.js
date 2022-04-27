//user manager

function inizializzaStorageUtente(){
  var s  = "";
  if (typeof(localStorage.utente) == "undefined" || localStorage.utente =="") {
    localStorage.utente="";
    s += `
    <div class="btn-group" >
<button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
  + new Animal
</button>
<ul class="dropdown-menu">
  <li><a class="dropdown-item" href="user/login/index.html">Log in</a></li>
  <li><hr class="dropdown-divider"></li>
  <li><a class="dropdown-item" href="user/registrazione/index.html">New Account</a></li>
</ul>
</div>
    `;
  }else{
    s += `
    <div class="btn-group" >
                <button type="button"  class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                `+localStorage.utente+`
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="form/form.html">+ add Animal</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="index.php" onclick="resetStorageUtente()">Log out</a></li>
                </ul>
              </div> 
    `;
    $.ajax({
      data: 'name_utente=' +localStorage.utente,
      url: 'caricamento.php',
      method: 'GET', // or GET
      success: function(msg) {
        document.getElementById("tavola").innerHTML+=msg;
  
      }
     });
  }
  document.getElementById("gruppo_bottoni").innerHTML +=s;

  console.log(localStorage.utente);
}
function resetStorageUtente(){
  localStorage.utente="";
  console.log(localStorage.utente);
}




// Drag and drop
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data= ev.dataTransfer.getData("text");
  var animale1 = document.getElementById(data);
  var animale2 = ev.target;
  var parent = animale2.parentElement;
      parent.innerHTML="";
      
  $.ajax({
    data: 'id_animal1=' + animale1.id+'&id_animal2='+animale2.id,
    url: 'winner.php',
    method: 'GET', // or GET
    success: function(msg) {
      if(animale1.id==msg){
        parent.appendChild(animale1);
        parent.classList.add("eat_true");
      
      setTimeout(function(){
        parent.className = "cell border border-2 border-warning";
    }, 2000);
      }else{
        parent.appendChild(animale2);
        parent.classList.add("eat_false");
      
      setTimeout(function(){
        parent.className = "cell border border-2 border-warning";
    }, 2000);
      }
    }
   });


  $.ajax({
    data: 'id_animal1=' + animale1.id+'&id_animal2='+animale2.id,
    url: 'prova.php',
    method: 'GET', // or GET
    success: function(msg) {
      document.getElementById("sfida").innerHTML=msg;

    }
   });

   setTimeout(function(){
    document.getElementById("sfida").scrollIntoView();
}, 1000);
   
  
}


//Search
function search(){
    var animal = document.getElementById("search_text").value;
    var picture = document.getElementById(animal); 
    if(picture!=null){
      var cell = picture.parentElement;
      cell.classList.add("blink-bg");
      cell.scrollIntoView();
      
      setTimeout(function(){
        cell.className = "cell border border-2 border-warning";
    }, 2000);
    }
}