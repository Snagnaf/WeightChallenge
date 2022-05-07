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
        $query = "select * from animal where nome_scientifico=$1";
        $result = pg_query_params($dbconn, $query, array($animal));
        if($tuple = pg_fetch_array($result,null,PGSQL_ASSOC)){
            echo "<h1>Registrazione fallita</h3><br>";
            echo "Nel nostro sito essere un animale uguale da prima<br>";
            echo"Riprova a crearne un altro <a href='form.html'> qui</a> !";
        }else{
            $user = $_POST["inputUser"];
            $name = $_POST["inputName"];

            //file su database
            
            $img=file_get_contents($_FILES['inputImage']['tmp_name']);
            $img_data = base64_encode($img);
            $type=$_FILES['inputImage']['type'];

            $weight = $_POST["inputWeight"];
            $speed = $_POST["inputSpeed"];
            $height = $_POST["inputHeight"];
            $habitat = $_POST["inputHabitat"];
            $query2 = 'insert into animal values ($1,$2,$3,$4,$5,$6,$7,$8,$9)';
            $result = pg_query_params($dbconn, $query2, array($animal, $img_data, $name, $weight, $speed, $height, $user, $habitat, $type));
            if(!$tuple=pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo "<h2>Inserimento andato a buon fine</h2><br>";
                echo "Vai <a href='../index.php'> qui</a> per continuare!";
            }else{
                echo"<h1 >ERROOREEEEE</h1>";
                echo "riprova <a href='form.php'> qui</a>!";
            }
            pg_close($dbconn);
        }
    }

?>

    
</body>
</html>