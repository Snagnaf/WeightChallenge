<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleform.css" type="text/css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js" type="application/javascript" ></script>
    <title>Response</title>
</head>
<body>
    <nav class="navbar justify-content-center fixed-top bg-dark navbar-dark">
        <div class="container">
            <a href="../index.html" class="navbar-brand d-flex w-50 me-auto">ANIMAL SIZE</a>
            
           
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
          <?php
    if(!isset($_POST["submitButton"])){
        header("Location: .."); //header della connessione http
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
                
           


        //verifica dati
        $animal = $_POST["inputAnimal"];
        $query = "select * from animal where animale='$animal'";
        $result = mysqli_query($conn,$query);
        if($tuple = mysqli_fetch_array($result)){
            echo "<h1>Registrazione fallita</h3><br>";
            echo "Nel nostro sito essere un animale uguale da prima<br>";
            echo"Riprova a crearne un altro <a href='form.html'> qui</a> !";
        }else{
            $user = $_POST["inputUser"];
            $name = $_POST["inputName"];
            $weight = $_POST["inputWeight"];
            $volume = $_POST["inputVolume"];
            $height = $_POST["inputHeight"];
            $life = $_POST["inputLife"];
            
            $image = $_FILES['inputImage']['tmp_name'];
    		$info = pathinfo($_FILES['inputImage']['name']);
            $ext = $info['extension']; // get the extension of the file
    		$saveto = "../foto/$animal.$ext";
            move_uploaded_file($image, $saveto);
            
            $query2 = "insert into animal values ('$animal','$saveto','$name','$weight','$volume','$height','$life','$user')";
            $result2 = mysqli_query($conn,$query2);
            
    		
            
            if(!$tuple2=mysqli_fetch_array($result2)){
                echo "<h2>Inserimento andato a buon fine</h2><br>";
                echo "Vai <a href='../index.php'> qui</a> per continuare!";
            }else{
                echo"<h1 >ERROOREEEEE</h1>";
                echo "riprova <a href='form.php'> qui</a>!";
            }
        */


        //PostgreSQL
        $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
            port=5432 user=postgres password=postgres");


        //verifica dati
        $animal = $_POST["inputAnimal"];
        $user = $_POST["inputUser"];
        $query = "select * from animal where nome_scientifico=$1 AND utente=$2";
        $result = pg_query_params($dbconn, $query, array($animal,$user));
        if($tuple = pg_fetch_array($result,null,PGSQL_ASSOC)){
            echo "<h1>Registrazione fallita</h3><br>";
            echo "Nel nostro sito essere un animale uguale da prima<br>";
            echo"Riprova a crearne un altro <a href='form.html'> qui</a> !";
        }else{
            
            $name = $_POST["inputName"];

            //file su database come stringa
            
            $img=file_get_contents($_FILES['inputImage']['tmp_name']);
            $img_data = base64_encode($img);
            $type=$_FILES['inputImage']['type'];

            //caricamento dati e conversione

            $weight = $_POST["inputWeight"];
            if($_POST["peso_unit"]=="pound"){
                $weight*= 0.453592;
            }
            $speed = $_POST["inputSpeed"];
            if($_POST["speed_unit"]=="m/h"){
                $speed*= 1.60934;
            }
            $height = $_POST["inputHeight"];
            if($_POST["altezza_unit"]=="feet"){
                $height*= 0.3048;
            }


            $habitat = $_POST["inputHabitat"];
            $query2 = 'insert into animal values ($1,$2,$3,$4,$5,$6,$7,$8,$9)';
            $result = pg_query_params($dbconn, $query2, array($animal, $img_data, $name, $weight, $speed, $height, $user, $habitat, $type));
            if(!$tuple=pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo "<h2>Inserimento andato a buon fine</h2><br>";
                echo "Vai <a href='../index.html'> qui</a> per continuare!";
            }else{
                echo"<h1 >ERROOREEEEE</h1>";
                echo "riprova <a href='form.html'> qui</a>!";
            }
            pg_close($dbconn);
        }
    }

?>
          </div>
        </div>
        <div class="form-group">
          <button type="button" class="backbutt" onclick="document.location='index.html'">TORNA ALLA HOME</button>
        </div>
      </div>
      
</body>
</html>



