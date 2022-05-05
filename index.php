<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeightChallenge</title>


    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="script.js" type="application/javascript" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
</head>
<body onload="inizializzaStorageUtente()">
    <div class="header  rounded-bottom" >
        <div class="titolo text-warning">WeightChallenge</div>
        <div class="input-group" style="width:400px;margin:auto" id="gruppo_bottoni" >
          <input type="search"  id="search_text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"  />
          <button type="button" id="search_button" class="btn btn-outline-warning" onclick="search()" >search</button>
          <!-- Example single danger button -->
          

      </div>
      </div> 
    <div class="center">
        <div id="tavola" class="board  ">
            <?php
                
                //Connessione postgres
            
            $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
                port=5432 user=postgres password=postgres");


            //verifica dati
            $query = "select * from animal where utente is null";
            $result = pg_query($dbconn, $query);
            $arr = pg_fetch_all($result);
            foreach($arr as $animal){
                echo '<div class="cell border border-2 border-warning" >
                <img src="'.$animal["foto"].'" id="'.$animal["nome_scientifico"].'" draggable=true ondragstart="drag(event)"
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