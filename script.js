

// Drag and drop
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();

  document.getElementById("tail").classList.add("grow");
      
      setTimeout(function(){
        document.getElementById("tail").className = "tail";
    }, 1000);
    document.getElementById("tail").style.top = "40vh";
    document.getElementById("tail").style.height = "60vh";
    document.getElementById("tail").style.padding = "20px";
    document.getElementById("close_button").value="close";
    document.getElementById("close_button").textContent="close";
  
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

function close_tail(ev){
  if(document.getElementById("close_button").value=="close"){
  document.getElementById("tail").classList.add("shrink");
      
  setTimeout(function(){
    document.getElementById("tail").className = "tail";
}, 1000);

  document.getElementById("tail").style.top = "95vh";
  document.getElementById("tail").style.height = "5vh";
  document.getElementById("tail").style.padding = "0px";
  document.getElementById("close_button").value="open";
  document.getElementById("close_button").textContent="open";
  document.getElementById("close_button").value="open";
  }else{
  document.getElementById("tail").classList.add("grow");
      
      setTimeout(function(){
        document.getElementById("tail").className = "tail";
    }, 1000);
    document.getElementById("tail").style.top = "40vh";
    document.getElementById("tail").style.height = "60vh";
    document.getElementById("tail").style.padding = "20px";
    document.getElementById("close_button").value="close";
    document.getElementById("close_button").textContent="close";
  }
}


//Search
function search(){
    var animal = document.getElementById("search_text").value;
    var picture = document.getElementById(animal); 
    if(picture!=null){
      var cell = picture.parentElement;
      cell.classList.add("blink-bg");
      //lo scroll non funge
      $("center").scrollTo = picture.top;
      $("center").scrollTo = picture.left;
      
      setTimeout(function(){
        cell.className = "cell border border-2 border-warning";
    }, 2000);
    }
}





function makeNewPosition(){
  
  // Get viewport dimensions (remove the dimension of the div)
  var h = $(tavola).height() - $('.cell').height();
  var w = $(tavola).width() - $('.cell').height();
  
  var nh = Math.floor(Math.random()*h);
  var nw = Math.floor(Math.random()*w);
  
  return [nh,nw];    
  
}

function animateDiv(myclass){
  var newq = makeNewPosition();
  $(myclass).animate({ top: newq[0], left: newq[1] }, 5000,   function(){
    animateDiv(myclass);        
  });
  
};