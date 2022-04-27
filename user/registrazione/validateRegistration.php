

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validateRegistration</title>
</head>
<body>
<?
    if(!isset($_POST["registrationButton"])){
        header("Location: .."); //header della connessione http
    }else{
        //Connessione
        $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
            port=5432 user=postgres password=postgres");


        //verifica dati
        $name = $_POST["inputName"];
        $query = "select * from utente where name=$1";
        $result = pg_query_params($dbconn, $query, array($name));
        if($tuple = pg_fetch_array($result,null,PGSQL_ASSOC)){
            echo "<h1>Registrazione fallita</h3><br>";
            echo "Nel nostro sito essere una name uguale da prima di te<br>";
            echo "Vai <a href='../login/index.html'> qui</a> per loggarti!";
        }else{
            $password = md5($_POST["inputPassword"]); //md5 codifica la password
            $query2 = 'insert into utente values ($1,$2)';
            $result = pg_query_params($dbconn, $query2, array($name, $password));
            if(!$tuple=pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo "<h2>Registrazione andata a buon fine</h2><br>";
                echo "Vai <a href='../login/index.html'> qui</a> per loggarti!";
            }else{
                echo"<h1 >ERROOREEEEE</h1>";
                echo "riprova <a href='index.html'> qui</a>!";
            }
        }
    }
?>
</body>
</html>