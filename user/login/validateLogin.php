<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validateLogin</title>
</head>
<body>
    <?
        if(!isset($_POST["loginButton"])){
            header("Location: ..");
        }else{
            $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
                port=5432 user=postgres password=postgres");
            $name = $_POST["inputName"];
            $query = "select * from utente where name=$1";
            $result = pg_query_params($dbconn, $query, array($name));
            if(!$tuple = pg_fetch_array($result,null,PGSQL_ASSOC)){
                echo "Login fallito<h3 id='nome'></h3>";
                echo "Nel nostro sito non essere questa name";
                echo "Vai <a href='../registration/index.html'> qui</a> per registrarti!";
            }else{
                $password = md5($_POST["inputPassword"]); // Codifica
                $query2 = 'select * from utente where name=$1 and psswrd=$2';
                $result = pg_query_params($dbconn, $query2, array($name, $password));
                if($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)){
                    $name = $tuple['name'];
                    echo "Bentornato <h3 id='nome'>".$name."</h3>";
                    echo "<h2>il login andato a essere buona fine</h2>";
                    echo "clicca <a href='../../index.php'> qui</a> per accedere al sito ";
                }else{
                    echo "<h1>Errorrrreeeeeeeeeee</h1><h3 id='nome'></h3>";
                    echo "riprova <a href='index.html'> qui</a>!";
                }
            }




            
        }
    ?>
    <script>
        localStorage.utente=document.getElementById("nome").innerText;
    </script>
</body>
</html>