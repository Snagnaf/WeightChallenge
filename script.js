//Per selezione animali
var animale1="";
var animale2=""; 
var utente1="";
var utente2="";
var choosing=false;
 
$(document).ready(function (){
  
  //Gestione utente
  
  console.log(localStorage.utente);
  if (typeof(localStorage.utente) == "undefined") {
    localStorage.setItem("utente","");
    sessionStorage.setItem("utente","");
  }else{
    if(localStorage.utente!="")
      sessionStorage.setItem("utente",localStorage.utente);
  }
  if (sessionStorage.utente !=""){
    $("#addAnimal").text(sessionStorage.utente);
    $("#addAnimal_login").text("add Animal");
    $("#addAnimal_desc").text("");
    $("#addAnimal_login").attr("href", "form/form.html");
    $("#addAnimal_signup").text("Logout");
    $("#addAnimal_signup").attr('href','index.html' );
    $("#addAnimal_signup").attr('onclick','resetUtente()');
  }
  
  

  //Caricamento degli elementi
  $.get("caricamento.php",
    {
      name_utente: sessionStorage.utente
    },
    function(data,status){
      if(status){
        $("#ilcarosello").html(data);
        $(".cell").each(new_position);
      }
      else
        $("#ilcarosello").html("<br><br><br><h1>problemi di connessione</h1>");
    });
    


  //Ricerca
  $("#idpd").click(search());


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



//Posizionamento celle e animali

  $("#carouselExampleControls").carousel();
  $("#carouselExampleControls").on('slid.bs.carousel', new_position);
});

$(window).resize(new_position);

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function new_position(){
  var cells = $("div.carousel-item.active > div.board > div.cell").length;
  var column = Math.floor($("div.carousel-item.active > div.board").width()/$(".cell").outerWidth());
  var row = Math.floor($("div.carousel-item.active > div.board").height()/$(".cell").outerHeight());
  var left= -1;
  var top = 0;
  var free = [];
  for(var i=0; i<row; i++) {
    free[i] = [];
    for(var j=0; j<column; j++) {
        free[i][j] = true;
    }
  }
  $("div.carousel-item.active > div.board > div.cell").each(function(){
    if(cells<column*row){
      $(".board").css({"overflow":"visible"});
      do{
        left = getRandomInt(0,column-1);
        top = getRandomInt(0,row-1);
      }while(!free[top][left]);
      free[top][left]=false;
    }else{
      $(".board").css({"overflow":"scroll"});
      if(left == column-1){
        left=0;
        top+=1;
      }else
        left+=1;
    }
    $(this).css({"left":left*$(".cell").outerWidth()+"px"});
    $(this).css({"top":top*$(".cell").outerHeight()+"px"});
    $(this).css({"trasition":"left 1s,top 1s"});
  });
  
}



//Log out utente
function resetUtente(){
  console.log("perchee?");
  localStorage.utente="";
  sessionStorage.utente="";
}

//Selezione animali
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
      cell = img.parentElement;
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
  