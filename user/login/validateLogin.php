<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelogin.css" type="text/css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
    <script src="../../bootstrap/js/bootstrap.js" type="application/javascript" ></script>
    <script src="rememberMe.js" type="application/javascript" ></script>
    <title>Response</title>
</head>
<body onload="effettuata()">
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
                echo "Nel nostro sito non è presente questo utente!";
                echo "Vai <a href='../registrazione/registrazione.html'> qui</a> per registrarti!";
            }else{
                $password = md5($_POST["inputPassword"]); // Codifica
                $query2 = 'select * from utente where name=$1 and psswrd=$2';
                $result = pg_query_params($dbconn, $query2, array($name, $password));
                if($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)){
                    $name = $tuple['name'];
                    echo "Bentornato <h3 id='nome' >$name</h3>";
                    echo "il login andato a essere buona fine";
                }else{
                    echo "<h1>Ops!</h1><h3 id='nome'></h3>";
                    echo "Qualcosa è andato storto, riprova <a href='login.html'> qui</a>!";
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
