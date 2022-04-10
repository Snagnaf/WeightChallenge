<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
    if(!isset($_POST["submitButton"])){
        header("Location: .."); //header della connessione http
    }else{
        //Connessione
        $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
            port=5432 user=postgres password=postgres");


        //verifica dati
        $animal = $_POST["inputAnimal"];
        $query = "select * from animal where animale=$1";
        $result = pg_query_params($dbconn, $query, array($animal));
        if($tuple = pg_fetch_array($result,null,PGSQL_ASSOC)){
            echo "<h1>Registrazione fallita</h3><br>";
            echo "Nel nostro sito essere un animale uguale da prima<br>";
            echo"Riprova a crearne un altro <a href='form.html'> qui</a> !";
        }else{
            $name = $_POST["inputName"];
            $image = $_POST["inputImage"];
            $weight = $_POST["inputWeight"];
            $volume = $_POST["inputVolume"];
            $height = $_POST["inputHeight"];
            $life = $_POST["inputLife"];
            $query2 = 'insert into animal values ($1,$2,$3,$4,$5,$6,$7)';
            $result = pg_query_params($dbconn, $query2, array($animal, $image, $name, $weight, $volume, $height, $life));
            if(!$tuple=pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo "<h2>Inserimento andato a buon fine</h2><br>";
                echo "Vai <a href='../index.php'> qui</a> per continuare!";
            }else{
                echo"<h1 >ERROOREEEEE</h1>";
                echo "riprova <a href='form.php'> qui</a>!";
            }
        }
    }

?>

    
</body>
</html>