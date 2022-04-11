
<?php
$id_animal1 = $_GET['id_animal1'];
$id_animal2 = $_GET['id_animal2'];

    $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
    port=5432 user=postgres password=postgres");


    //verifica dati
    $query1 = "select * from animal where animale='" . $id_animal1."'";
    $result1 = pg_query($dbconn, $query1);
    $animal1 = pg_fetch_array($result1);
    $query2 = "select * from animal where animale='" . $id_animal2."'";
    $result2 = pg_query($dbconn, $query2);
    $animal2 = pg_fetch_array($result2);

    $tabella = '<table class="table table-primary table-striped">
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
    <th scope="row" >Weight</th>';

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
    <th scope="row" >Volume</th>';
    if($animal1["volume"]>$animal2["volume"]){
        $tabella .= 
        '<td class="greater">'.$animal1["volume"].'</td>
        <td class="smaller">'.$animal2["volume"].'</td>';
    } else {
        $tabella .= 
        '<td class="smaller">'.$animal1["volume"].'</td>
        <td class="greater">'.$animal2["volume"].'</td>';
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
    <th scope="row" >Life span</th>';
    if($animal1["vita"]>$animal2["vita"]){
        $tabella .= 
        '<td class="greater">'.$animal1["vita"].'</td>
        <td class="smaller">'.$animal2["vita"].'</td>';
    } else {
        $tabella .= 
        '<td class="smaller">'.$animal1["vita"].'</td>
        <td class="greater">'.$animal2["vita"].'</td>';
    }

    $tabella.='</tr>
    </tbody>
    </table>
    <br>';
    
    echo $tabella;

?>