<?php
                //Connessione
            $name = $_GET['name_utente'];

            $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
                port=5432 user=postgres password=postgres");


            //verifica dati
            $query = "select * from animal where utente='".$name."'";
            $result = pg_query($dbconn, $query);
            $arr = pg_fetch_all($result);
            foreach($arr as $animal){
                echo '<div class="cell border border-2 border-warning" >
                <img src="'.$animal["foto"].'" id="'.$animal["nome_scientifico"].'" draggable=true ondragstart="drag(event)"
                ondragover="allowDrop(event)" ondrop="drop(event)"
                height="80" width="80"> </div>
              ';
            }
            pg_close($dbconn);
?>