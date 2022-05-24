<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesignup.css" type="text/css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
    <script src="../../bootstrap/js/bootstrap.js" type="application/javascript" ></script>
    <title>Response</title>
</head>
<body>
    <nav class="navbar justify-content-center fixed-top bg-dark navbar-dark">
        <div class="container">
            <a href="../../index.html" class="navbar-brand d-flex w-50 me-auto">ANIMAL SIZE</a>
            
           
                <ul class="nav navbar-nav justify-content-end py-1">
                    <li class="nav-item">
                      <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#aboutus">ABOUT US</a>
                    </li>
                </ul>
            </div>
        </div>
        
      </nav>
    

      <div class="modal fade" id="aboutus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">CHI SIAMO</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
               <p>Ciao! Siamo Eugenio e Matteo, studenti rispettivamente di Ingegneria Informatica ed Informatica. Questo è il nostro progetto per l'esame di LTW!</p>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
             </div>
          </div>
        </div>
      </div>



    <div class="form">
        <div class="form-panel one">
          <div class="form-header">
            <h1>AnimalSize</h1>
          </div>
          <div class="form-content">
          <?
    if(!isset($_POST["registrationButton"])){
        header("Location: .."); //header della connessione http
    }else{
        //MySQL
        /*
        $db_host = "localhost";
                $db_user = "weightchallenge";
                $db_name = "my_weightchallenge";
                $db_password = "hwfWkYSg22VN";
                $conn = mysqli_connect($db_host, $db_user, $db_password,$db_name);
                if ($conn == FALSE)
                die ("Errore nella connessione:".mysqli_connect_error());
                
        //verifica dati
        $name = $_POST["inputName"];
        $query = "select * from utente where name=".$name;
        $result = mysqli_query($conn,$query);
        if($tuple = mysqli_fetch_array($result)){
            echo "<h1>Registrazione fallita</h3><br>";
            echo "Nel nostro sito essere una name uguale da prima di te<br>";
            echo "Vai <a href='../login/index.html'> qui</a> per loggarti!";
        }else{
            $password = md5($_POST["inputPassword"]); //md5 codifica la password
            $query2 = "INSERT INTO utente(name,psswrd) VALUES ('$name','$password')";
            $result2 = mysqli_query($conn,$query2);
            if($result2){
                echo "<h2>Registrazione andata a buon fine</h2><br>";
                echo "Vai <a href='../login/index.html'> qui</a> per loggarti!";
            }else{
                echo"<h1 >ERROOREEEEE</h1>";
                echo "riprova <a href='index.html'> qui</a>!";
            }
        }
        */

        //PostgresSQL
        $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
            port=5432 user=postgres password=postgres");


        //verifica dati
        $name = $_POST["inputName"];
        $query = "select * from utente where name=$1";
        $result = pg_query_params($dbconn, $query, array($name));
        if($tuple = pg_fetch_array($result,null,PGSQL_ASSOC)){
            echo "<h1>Registrazione fallita</h3><br>";
            echo "Nel nostro sito essere una name uguale da prima di te<br>";
            echo "Vai <a href='../login/login.html'> qui</a> per loggarti!";
        }else{
            $password = md5($_POST["inputPassword"]); //md5 codifica la password
            $query2 = 'insert into utente values ($1,$2)';
            $result = pg_query_params($dbconn, $query2, array($name, $password));
            if(!$tuple=pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo "<h2>Registrazione andata a buon fine</h2><br>";
                echo "Vai <a href='../login/login.html'> qui</a> per loggarti!";
            }else{
                echo"<h1 >ERROOREEEEE</h1>";
                echo "riprova <a href='registrazione.html'> qui</a>!";
            }
        }
    }
?>
          </div>
        </div>
        <div class="form-group">
          <button type="button" class="backbutt" onclick="document.location='../../index.html'">TORNA ALLA HOME</button>
        </div>
      </div>
      
</body>
</html>
