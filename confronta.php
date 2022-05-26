
<?php
$id_animal1 = $_GET['id_animal1'];
$id_animal2 = $_GET['id_animal2'];
$utente_animal1 = $_GET['utente_animal1'];
$utente_animal2 = $_GET['utente_animal2'];

//Connessione MySQL
/*
    $db_host = "localhost";
    $db_user = "weightchallenge";
    $db_name = "my_weightchallenge";
    $db_password = "hwfWkYSg22VN";
    $dbconn = mysqli_connect($db_host, $db_user, $db_password,$db_name);
    if ($dbconn == FALSE)   
    die ("Errore nella connessione:".mysqli_connect_error());
*/

    $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
    port=5432 user=postgres password=postgres");


    //verifica dati
    $query1 = "select * from animal where nome_scientifico='".$id_animal1."' AND utente='".$utente_animal1."'";
    $result1 = pg_query($dbconn, $query1);
    $animal1 = pg_fetch_array($result1);
    $query2 = "select * from animal where nome_scientifico='".$id_animal2."'AND utente='".$utente_animal2."'";
    $result2 = pg_query($dbconn, $query2);
    $animal2 = pg_fetch_array($result2);


    $tabella = '
      <table class="table table-striped">
        <thead>
        <tr>
          <th class="d-flex justify-content-between">
                <p>'.$animal1["nome"].'</p>
                <p>'.$animal2["nome"].'</p>
          </th>
        </tr>
      </thead>
      <thead>
        <tr>
          <th>Foto</th>
        </tr>
      </thead>
      <tr>
        <td class="d-flex justify-content-between">
            <img src="data:image/'.$animal1["type"].';base64,'.$animal1["foto"].'" height="80px" width="80px">
            <img src="data:image/'.$animal2["type"].';base64,'.$animal2["foto"].'" height="80px" width="80px">
        </td>
      </tr>
      
      <thead>
        <tr>
          <th>Nome scientifico</th>
        </tr>
      </thead>
      <tr>
        <td class="d-flex justify-content-between">
          <p>'.$animal1["nome_scientifico"].'</p>
          <p>'.$animal2["nome_scientifico"].'</p>
        </td>
      </tr>
      <thead>
        <tr>
          <th>Peso</th>
        </tr>
      </thead>  
        <tr>
          <td class="d-flex justify-content-between">
            <p>'.$animal1["peso"].' kg <br> '.($animal1["peso"]*2.20462).' pounds'.'</p>
            <p>'.$animal2["peso"].' kg <br> '.($animal2["peso"]*2.20462).' pounds'.'</p>
          </td>
        </tr>
        <thead>
          <tr>
            <th>Velocità</th>
          </tr>
        </thead>
        <tr>
          <td class="d-flex justify-content-between">
            <p>'.$animal1["velocita"].' k/h <br> '.($animal1["velocita"]*0.621371).' m/h'.'</p>
            <p>'.$animal2["velocita"].' k/h <br> '.($animal2["velocita"]*0.621371).' m/h'.'</p>
          </td>
        </tr>
        <thead>
          <tr>
            <th>Altezza</th>
          </tr>
        </thead>
        <tr>
          <td class="d-flex justify-content-between">
            <p>'.$animal1["altezza"].' m <br> '.($animal1["altezza"]*3.28084).' feet'.'</p>
            <p>'.$animal2["altezza"].' m <br> '.($animal2["altezza"]*3.28084).' feet'.'</p>
          </td>
        </tr>
        <thead>
          <tr>
            <th>Habitat</th>
          </tr>
        </thead>
        <tr>
          <td class="d-flex justify-content-between">
            <p>'.$animal1["habitat"].'</p>
            <p>'.$animal2["habitat"].'</p>
          </td>
        </tr>
      </table>
             
    ';
 
    echo $tabella;

?>