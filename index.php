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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
</head>
<body >
    <div class="header ">
        <div class="titolo text-warning">WeightChallenge</div>
        <div class="input-group" style="width:400px;margin:auto">
          <input type="search"  id="search_text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"  />
          <button type="button" id="search_button" class="btn btn-outline-warning" onclick="search()" >search</button>
          <button class="btn btn-warning" onclick="window.location.href='form/form.html'" style="margin-left:20px">+ new Animals</button>
      </div>
      </div> 

    <div id="center" class="center">
      <div id="tavola" class="board " alt="zoom"  onmousedown="prendiSfondo(event)" panning="false" onmouseup="lasciaSfondo(event)" onmousemove="muoviSfondo(event)" onwheel="zoomSfondo(event)">
            <?php
                //Connessione
            $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
                port=5432 user=postgres password=postgres");


            //verifica dati
            $query = "select * from animal";
            $result = pg_query($dbconn, $query);
            $arr = pg_fetch_all($result);
            foreach($arr as $animal){
                echo '<div class="cell border border-2 border-warning '.$animal["animale"].'" >
                <img src="'.$animal["foto"].'" id="'.$animal["animale"].'" draggable=true  ondragstart="drag(event)"
                ondragover="allowDrop(event)" ondrop="drop(event)"
                onmousedown="distrai(event)" panning="false" onmouseup="distrai(event)" onmousemove="distrai(event)"  onwheel="zoomSfondo(event)"
                height="'.$animal["altezza"].'" width="'.$animal["altezza"].'" class="oanimal">
                <script>
                $(document).ready(function(){
  animateDiv(".'.$animal["animale"].'");
});
</script>
                </div>
              ';
            }
            pg_close($dbconn);
            ?>
            
            

      </div>
    </div>
    <script>
        
     
    </script>
        
    <!--
    <div id="center" class="center">
        <div id="tavola" class="board ">
            <?php /*
                //Connessione
            $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
                port=5432 user=postgres password=postgres");


            //verifica dati
            $query = "select * from animal";
            $result = pg_query($dbconn, $query);
            $arr = pg_fetch_all($result);
            foreach($arr as $animal){
                echo '<div class="cell border border-2 border-warning '.$animal["animale"].'">
                <img src="'.$animal["foto"].'" id="'.$animal["animale"].'" draggable=true ondragstart="drag(event)"
                ondragover="allowDrop(event)" ondrop="drop(event)"
                height="80" width="80">
                <script>
                $(document).ready(function(){
  animateDiv(".'.$animal["animale"].'");
});
</script>
                </div>
              ';
            }
            pg_close($dbconn);*/
            ?>
            
            


        </div>
    </div>
        -->
    <div id="tail" class="tail">
        <div class=close_div>
                <button class="close btn btn-warning" id="close_button"  onclick="close_tail()"></button>
            </div>
        <div id="sfida" class="challenge">
            
        </div>
    </div>
</body>
</html>