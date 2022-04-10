
<?php

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
    
    echo '<table class="table table-primary table-striped">
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
<br>"';
?>