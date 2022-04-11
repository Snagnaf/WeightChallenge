<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeightChallenge</title>

    


    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="script.js" type="application/javascript" ></script>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>

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
      }else{
        parent.appendChild(animale2);
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



  window.scrollTo(0,window.innerHeight);
}

</script>



</head>
<body >
    <div class="header  rounded-bottom">
        <div class="titolo text-warning">WeightChallenge</div>
        <div class="input-group" style="width:400px;margin:auto">
          <input type="search"  class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"  />
          <button type="button" class="btn btn-outline-warning">search</button>
          <button class="btn btn-warning" onclick="window.location.href='form/form.html'" style="margin-left:20px">+ new Animals</button>
      </div>
      </div> 
    <div class="center">
        <div id="tavola" class="board  ">
            <?php
                //Connessione
            $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
                port=5432 user=postgres password=postgres");


            //verifica dati
            $query = "select * from animal";
            $result = pg_query($dbconn, $query);
            $arr = pg_fetch_all($result);
            foreach($arr as $animal){
                echo '<div class="cell border border-2 border-warning" >
                <img src="'.$animal["foto"].'" id="'.$animal["animale"].'" draggable=true ondragstart="drag(event)"
                ondragover="allowDrop(event)" ondrop="drop(event)"
                height="80" width="80"> </div>
              ';
            }
            pg_close($dbconn);
            ?>
        </div>
    </div>
    <div class="tail rounded-top">
        <div id="sfida" class="challenge">
        
        

        </div>
    </div>
</body>
</html>