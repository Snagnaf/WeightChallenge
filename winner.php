<?php
    $id_animal1 = $_GET['id_animal1'];
    $id_animal2 = $_GET['id_animal2'];

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
    $query1 = "select * from animal where nome_scientifico='" . $id_animal1."'";
    $result1 = pg_query($dbconn, $query1);
    $animal1 = pg_fetch_array($result1);
    $query2 = "select * from animal where nome_scientifico='" . $id_animal2."'";
    $result2 = pg_query($dbconn, $query2);
    $animal2 = pg_fetch_array($result2);

    if($animal1['peso']>$animal2['peso']){
        echo $id_animal1;
    }else{
        echo $id_animal2;
    }
?>