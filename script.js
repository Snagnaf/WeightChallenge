

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