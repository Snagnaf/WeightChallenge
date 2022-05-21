
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

    $tabella = '<table class="container-fluid justify-content-center">
    <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">'.$animal1["nome"].'</th>
    <th scope="col">'.$animal2["nome"].'</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <th scope="row">Foto</th>
    <td><img src="data:image/'.$animal1["type"].';base64,'.$animal1["foto"].'" height="80px" width="80px"></td>
    <td><img src="data:image/'.$animal2["type"].';base64,'.$animal2["foto"].'" height="80px" width="80px"></td>
    </tr>
    <tr>
    <th scope="row">Nome</th>
    <td>'.$animal1["nome_scientifico"].'</td>
    <td>'.$animal2["nome_scientifico"].'</td>
    </tr>
    <tr>
    <th scope="row" >Peso</th>';

    if($animal1["peso"]>$animal2["peso"]){
        $tabella .= 
        '<td class="greater">'.$animal1["peso"].'</td>
        <td class="smaller">'.$animal2["peso"].'</td>';
    } else {
        $tabella .= 
        '<td class="smaller">'.$animal1["peso"].'</td>
        <td class="greater">'.$animal2["peso"].'</td>';
    }
    $tabella .= '</tr>
    <tr>
    <th scope="row" >Velocita</th>';
    if($animal1["velocita"]>$animal2["velocita"]){
        $tabella .= 
        '<td class="greater">'.$animal1["velocita"].'</td>
        <td class="smaller">'.$animal2["velocita"].'</td>';
    } else {
        $tabella .= 
        '<td class="smaller">'.$animal1["velocita"].'</td>
        <td class="greater">'.$animal2["velocita"].'</td>';
    }
    $tabella .= '</tr>
    <tr>
    <th scope="row" >Altezza</th>';
    if($animal1["altezza"]>$animal2["altezza"]){
        $tabella .= 
        '<td class="greater">'.$animal1["altezza"].'</td>
        <td class="smaller">'.$animal2["altezza"].'</td>';
    } else {
        $tabella .= 
        '<td class="smaller">'.$animal1["altezza"].'</td>
        <td class="greater">'.$animal2["altezza"].'</td>';
    }
    $tabella .= '</tr>
    <tr>
    <th scope="row" >Habitat</th>';
    
    $tabella .= 
        '<td>'.$animal1["habitat"].'</td>
        <td>'.$animal2["habitat"].'</td>';

    $tabella.='</tr>
    </tbody>
    </table>
    <br>';
    
    echo $tabella;

?>