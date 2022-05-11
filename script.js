//user manager

function inizializzaStorageUtente(){
  var s  = "";
  if (typeof(localStorage.utente) == "undefined" || localStorage.utente =="") {
    localStorage.utente="";
    s += `
    <div class="btn-group" >
      <button type="button" class="btn btn-success ms-3 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
        + new Animal
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="user/login/login.html">Log in</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="user/registrazione/registrazione.html">New Account</a></li>
      </ul>
    </div>
    `;
  }else{
    s += `
      <div class="btn-group" >
        <button type="button"  class="btn btn-success ms-3 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
          `+localStorage.utente+`
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="form/form.html">+ add Animal</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="index.php" onclick="resetStorageUtente()">Log out</a></li>
        </ul>
      </div> 
    `;}
    $.ajax({
      data: 'name_utente=' +localStorage.utente,
      url: 'caricamento.php',
      method: 'GET', // or GET
      success: function(msg) {
        document.getElementById("machebelloilcarosello").innerHTML+=msg;
        
        
  
      }
     });
  
  document.getElementById("gruppo_bottoni").innerHTML +=s;


}
function resetStorageUtente(){
  localStorage.utente="";
}

//Select animal

var counter = 0;
function select_animal(ev){
  counter++;
  var animale = ev.target;
  if(counter%2==0){
    document.getElementById("animal_image_2").src=animale.src;
    document.getElementById("animal_image_2").value = animale.id;
    document.getElementById("animal_image_2").utente = animale.utente;
  }else{
    document.getElementById("animal_image_1").src=animale.src;
    document.getElementById("animal_image_1").value = animale.id;
    document.getElementById("animal_image_1").utente = animale.utente;
  }
  
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
  var animale = document.getElementById(data);
  var box = ev.target;
  box.src=animale.src;
  box.value = animale.id;
   
  /*
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
  }
   */

}
function confronta(){
  var animale1 = document.getElementById("animal_image_1").value;
  var animale2 = document.getElementById("animal_image_2").value;

  var temp_id=animale1.split("_by_");
  animale1=temp_id[0];
  var utente1=temp_id[1];

  var temp_id=animale2.split("_by_");
  animale2=temp_id[0];
  var utente2=temp_id[1];


  if(!(animale1=="plus") && !(animale2=="plus")){

    $.ajax({
      data: 'id_animal1=' + animale1+'&utente_animal1='+utente1+'&id_animal2='+animale2+'&utente_animal2='+utente2,
      url: 'prova.php',
      method: 'GET', // or GET
      success: function(msg) {
        document.getElementById("sfida").innerHTML=msg;
      }
     });
  }
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

//animazione div
  




