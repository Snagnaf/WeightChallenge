<?php
            //Connessione
            $name = $_GET['name_utente'];

            $dbconn = pg_connect("host=localhost dbname=WeightChallengeDB
                port=5432 user=postgres password=postgres");


            //verifica dati
            $query = "select * from animal where utente='".$name."' OR utente='admin'";
            $result = pg_query($dbconn, $query);
            $arr = pg_fetch_all($result);
            
            /*arr_habitat(
                    nome_habitat  => html per realizzarlo,
                    'Savana' => ' <div class="carousel..." ...',
                    'Foresta' => ' <div class="carousel..." ...',
                    ...
            )*/
            $arr_habitat = [];
            $active = true;
            foreach($arr as $animal){
              if(!array_key_exists($animal["habitat"], $arr_habitat)){
                //un carosello deve essere attivo
                if($active){
                  $arr_habitat[$animal["habitat"]] = '<div class="carousel-item active"  data-bs-interval="none">
                  <div id="'.$animal["habitat"].'" class="board " style="width: 100vw; height: 100vh; ">';
                  $active=false;
                }else{
                  $arr_habitat[$animal["habitat"]] = '<div class="carousel-item"  data-bs-interval="none">
                  <div id="'.$animal["habitat"].'" class="board " style="width: 100vw; height: 100vh; ">';
                }
                
              }
              $arr_habitat[$animal["habitat"]] .= '<div class="cell border border-2 border-warning">
                <img src="data:'.$animal["type"].';base64,'.$animal["foto"].'" id="'.$animal["nome_scientifico"].'" draggable=true ondragstart="drag(event)"
                ondragover="allowDrop(event)" ontouchstart="select_animal(event)"
                height="80" width="80"> 
                
                </div>
                ';
            }

            $str="";
            foreach($arr_habitat as $boards){
                $str.=$boards;
                $str.='</div></div>';
            }
            pg_close($dbconn);
            echo $str;
?>
