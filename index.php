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
  parent.appendChild(animale1);
  const s = `<?php echo stampChallenge("elefante","coccodrillo");?>`; 

document.getElementById("sfida").innerHTML=s;
window.scrollTo(0,window.innerHeight);
}

</script>

<?php

function stampChallenge($id_animal1,$id_animal2){

$animalarray1=array("id"=>$id_animal1,"foto"=>"foto/elephant.png");
$animalarray2=array("id"=>$id_animal2,"foto"=>"foto/crocodile.png");
    $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
    port=5432 user=postgres password=postgres");


    //verifica dati
    $query1 = "select * from animal where animale='" . $animalarray1["id"]."'";
    $result1 = pg_query($dbconn, $query1);
    $animal1 = pg_fetch_array($result1);
    $query2 = "select * from animal where animale='" . $animalarray2["id"]."'";
    $result2 = pg_query($dbconn, $query2);
    $animal2 = pg_fetch_array($result2);
    
    return '<table class="table table-primary table-striped">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">'.$animal1["animale"].'</th>
<th scope="col">'.$animal2["animale"].'</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Image</th>
<td><img src="'.$animal1["foto"].'" height="80px" width="80px"></td>
<td><img src="'.$animal2["foto"].'" height="80px" width="80px"></td>
</tr>
<tr>
<th scope="row">Name</th>
<td>'.$animal1["nome"].'</td>
<td>'.$animal2["nome"].'</td>
</tr>
<tr>
<th scope="row" >Weight</th>
<td class="smaller">'.$animal1["peso"].'</td>
<td class="greater">'.$animal2["peso"].'</td>
</tr>
<tr>
<th scope="row" >Volume</th>
<td class="greater">'.$animal1["volume"].'</td>
<td class="smaller">'.$animal2["volume"].'</td>
</tr>
<tr>
<th scope="row">Height</th>
<td class="greater">'.$animal1["altezza"].'</td>
<td class="smaller">'.$animal2["altezza"].'</td>
</tr>
<tr>
<th scope="row">Life</th>
<td class="greater">'.$animal1["vita"].'</td>
<td class="smaller">'.$animal2["vita"].'</td>
</tr>
</tbody>
</table>
<br>';
}
?>

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