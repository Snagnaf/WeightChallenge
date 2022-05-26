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
      if(status){
        $("#machebelloilcarosello").html(data);
        
        $(".cell").each(function(){
          $(this).css({"left":Math.random()*$(".board").width()+"px"});
          $(this).css({"top":Math.random()*$(".board").height()+"px"});
        });
      }
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

//select cell
$(document).on("click",".cell",select);

function select(){
  target = this.children[0];
  if(!choosing) return;
    choosing=false;
    var box = $("img.blink-bg")[0];
    
    box.src=target.src;
    $(box).removeClass("blink-bg");
    $(".cell").each(function(){
      $(this).removeClass("blink-bg");
    });

    var temp_id=target.id.split("_by_");
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
  var data= ev.dataTransfer.getData("text");
  var animale1_drop = document.getElementById(data);
  var animale2_drop = ev.target;
  var parent = animale2_drop.parentElement;
  parent.innerHTML="";

  var temp_id=animale1_drop.id.split("_by_");
  var animale1_ns=temp_id[0];
  var animale1_us=temp_id[1];

  temp_id=animale2_drop.id.split("_by_");
  var animale2_ns=temp_id[0];
  var animale2_us=temp_id[1];
      
  $.get("winner.php",
  {
    id_animal1: animale1_ns,
    utente_animal1: animale1_us,
    id_animal2: animale2_ns,
    utente_animal2: animale2_us,
  },
  function(data,status){
    if(status){
      if(animale1_drop.id==data){
        parent.appendChild(animale1_drop);
        parent.classList.add("eat_true");
      
        setTimeout(function(){
          parent.className = "cell border border-2 border-warning";
        }, 2000);
      }else{
        parent.appendChild(animale2_drop);
        parent.classList.add("eat_false");
      
        setTimeout(function(){
          parent.className = "cell border border-2 border-warning";
        }, 2000);
      }
    }
  });

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
  $(".cell").each(function() { 
    var img = $(this).children()[0];
    var temp_id = img.id.toLowerCase();
    if(temp_id.match(animal.toLowerCase())){
      habitat= this.parentElement.id;
      var picture = document.getElementById(img.id); 
      cell = picture.parentElement;
    }
    return;
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
  