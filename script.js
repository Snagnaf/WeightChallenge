//Animali selezionati
var animale1="";
var animale2=""; 
var utente1="";
var utente2="";
var choosing=false;

$(document).ready(function (){
  //Gestione utente
  var s  = "";
  
  if (typeof(localStorage.utente) == "undefined" || localStorage.utente =="") {
    localStorage.utente="";
    if(typeof(sessionStorage.utente) == "undefined" || sessionStorage.utente ==""){
      sessionStorage.utente="";
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
          `+sessionStorage.utente+`
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="form/form.html">+ add Animal</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="index.html" onclick="resetStorageUtente()">Log out</a></li>
        </ul>
      </div> 
    `;
    }
    
    
  }else{
    sessionStorage.utente=localStorage.utente;
    s += `
      <div class="btn-group" >
        <button type="button"  class="btn btn-success ms-3 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
          `+sessionStorage.utente+`
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="form/form.html">+ add Animal</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="index.html" onclick="resetStorageUtente()">Log out</a></li>
        </ul>
      </div> 
    `;
  }

  //Caricamento degli elementi
  $.get("caricamento.php",
    {
      name_utente: sessionStorage.utente
    },
    function(data,status){
      if(status)
        $("#machebelloilcarosello").html(data);
      else
        $("#machebelloilcarosello").html("<br><br><br><h1>problemi di connessione</h1>");
    });
    
  document.getElementById("gruppo_bottoni").innerHTML +=s;


  //Confronto tra gli animali selezionati
  $("#confronta_button").click( function(){
    if((animale1=="") || (animale2 == "")) return;
      $.get("confronta.php",
        {
          id_animal1: animale1,
          utente_animal1: utente1,
          id_animal2: animale2,
          utente_animal2: utente2,
        },
        function(data,status){
          if(status)
            $("#sfida").html(data);
          else
            $("#sfida").html("<h3>Problemi di connessione</h3>");
        });
    }
  );

  //Selezione animali
  $("#animal_image_1,#animal_image_2").click(function(){
    if(choosing)return;
    choosing=true;
    $(this).addClass("blink-bg");
    $(".cell").each(function(){
      $(this).addClass("blink-bg");
    });
  });

});

//Log out utente
function resetStorageUtente(){
  localStorage.utente="";
  sessionStorage.utente="";
}

//select with touch
function select_touch(ev){
  if(!choosing) return;
    choosing=false;
    console.log(ev.target);
    var box = $("img.blink-bg")[0];
    
    box.src=ev.target.src;
    console.log(box);
    $(box).removeClass("blink-bg");
    $(".cell").each(function(){
      $(this).removeClass("blink-bg");
    });

    var temp_id=ev.target.id.split("_by_");
    if(box.id =="animal_image_1"){
      animale1=temp_id[0];
      utente1=temp_id[1];
    }else{
      animale2=temp_id[0];
      utente2=temp_id[1];
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
  if(!choosing) return;
  choosing=false;
  $(ev.target).removeClass("blink-bg");
  $(".cell").each(function(){
    $(this).removeClass("blink-bg");
  });
  $(ev.target).addClass("");
  ev.preventDefault();
  var data= ev.dataTransfer.getData("text");
  var elem_animale = document.getElementById(data);
  var box = ev.target;
  box.src=elem_animale.src;

  var temp_id=data.split("_by_");
  
  if(box.id =="animal_image_1"){
    animale1=temp_id[0];
    utente1=temp_id[1];
  }else{
    animale2=temp_id[0];
    utente2=temp_id[1];
  }
}

//Search
const delay = millis => new Promise((resolve, reject) => {
  setTimeout(_ => resolve(), millis)
});

async function search(){
  var animal = document.getElementById("search-text").value;
  if(animal=="") return;
  var habitat = null;
  var cell = null;
  $("*").each(function() { 
    if (this.id) {
      var temp_id = this.id.toLowerCase();
      if(temp_id.match(animal.toLowerCase())){
        habitat= this.parentElement.parentElement.id;
        var picture = document.getElementById(this.id); 
        cell = picture.parentElement;
      }
      return;
    }
  });
  if(habitat==null) {
    alert("Nessuna corrispondenza!");
    return;
  }
    //Carousel moving  
  var carousel = $("div.carousel-item.active").children()[0].id;
  while(habitat!=carousel){
    $('.carousel').carousel("next"); 
    await delay(1000);
    carousel = $("div.carousel-item.active").children()[0].id;
  }

    //Blinking background
  cell.classList.add("blink-bg");
  setTimeout(function(){
    cell.className = "cell border border-2 border-warning";
  }, 2000);
}
  




