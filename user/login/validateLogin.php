<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="rememberMe.js" type="application/javascript" ></script>
    <title>validateLogin</title>
</head>
<body>
    <?
        if(!isset($_POST["loginButton"])){
            header("Location: ..");
        }else{
            //MySQL
            /*
            $name = $_POST["inputName"];
        $db_host = "localhost";
                $db_user = "weightchallenge";
                $db_name = "my_weightchallenge";
                $db_password = "hwfWkYSg22VN";
                $conn = mysqli_connect($db_host, $db_user, $db_password,$db_name);
                if ($conn == FALSE)
                die ("Errore nella connessione:".mysqli_connect_error());
                
            $query = "select * from utente where name='$name'";
            
				$result = mysqli_query($conn,$query);

            if(!$tuple = mysqli_fetch_array($result)){
                echo "Login fallito<h3 id='nome'></h3>";
                echo "Nel nostro sito non essere questa name";
                echo "Vai <a href='../registrazione/index.html'> qui</a> per registrarti!";
            }else{
                $password = md5($_POST["inputPassword"]); // Codifica
                $query2 = "select * from utente where name='$name' and psswrd='$password'";
                $result2 = mysqli_query($conn,$query2);
                if($tuple2=mysqli_fetch_array($result2)){
                    $name = $tuple2['name'];
                    echo "Bentornato <h3 id='nome'>".$name."</h3>";
                    echo "<h2>il login andato a essere buona fine</h2>";
                    echo "clicca <a href='../../index.php'> qui</a> per accedere al sito ";
                }else{
                    echo "<h1>Errorrrreeeeeeeeeee</h1><h3 id='nome'></h3>";
                    echo "riprova <a href='index.html'> qui</a>!";
                }
            }
            */

            //PostgreSQL
            $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
                port=5432 user=postgres password=postgres");
            $name = $_POST["inputName"];
            $query = "select * from utente where name=$1";
            $result = pg_query_params($dbconn, $query, array($name));
            if(!$tuple = pg_fetch_array($result,null,PGSQL_ASSOC)){
                echo "Login fallito<h3 id='nome'></h3>";
                echo "Nel nostro sito non essere questa name";
                echo "Vai <a href='../registrazione/registrazione.html'> qui</a> per registrarti!";
            }else{
                $password = md5($_POST["inputPassword"]); // Codifica
                $query2 = 'select * from utente where name=$1 and psswrd=$2';
                $result = pg_query_params($dbconn, $query2, array($name, $password));
                if($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)){
                    $name = $tuple['name'];
                    echo "Bentornato <h3 id='nome' >$name</h3>";
                    echo "<h2>il login andato a essere buona fine</h2>";
                    echo "clicca <a href='../../index.php' > qui</a> per accedere al sito ";
                }else{
                    echo "<h1>Errorrrreeeeeeeeeee</h1><h3 id='nome'></h3>";
                    echo "riprova <a href='login.html'> qui</a>!";
                }
            }

        }
    ?>
    <script>
        localStorage.utente=document.getElementById('nome').innerText;
    </script>
</body>
</html>