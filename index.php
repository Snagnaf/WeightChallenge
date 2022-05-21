<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Size</title>

    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="script.js" type="application/javascript" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="bootstrap/js/bootstrap.js" type="application/javascript" ></script>
    <script>
      
    </script>
    

</head>

<body onload="inizializzaStorageUtente() " >
  <nav class="navbar navbar-expand-md justify-content-center fixed-top bg-dark navbar-dark">
    <div class="container">
        <a href="#logo" class="navbar-brand d-flex w-50 me-auto">ANIMAL SIZE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
            <ul class="navbar-nav w-100 justify-content-center" id="gruppo_bottoni">
              <div class="input-group w-50">
                <span class="input-group-text" id="basic-addon1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" onclick="search()" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg>
                </span>
                <input type="text" class="form-control" id="search-text" placeholder="Cerca un animale" aria-label="Cerca un animale" aria-describedby="basic-addon1">
              </div>
              
            </ul>
            <ul class="nav navbar-nav ms-auto w-100 justify-content-end">
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

  <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-interval="false">
    <div class="carousel-inner" id="machebelloilcarosello">
      
      <div class="carousel-item" data-bs-interval="none">
        <img src="foto/jungle2.jpg" class="d-block" style="width: 100vw; height: 100vh; ">
        
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="max-width:100px;">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="max-width:100px;">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <nav class="navbar navbar-expand-md justify-content-center fixed-bottom nav2">
    <div class="container">
            <ul class="nav navbar-nav me-auto w-100 justify-content-start p-3">
              <img id="animal_image_1" value="plus" src="foto/icons8-plus-96.png" alt="img1" style="width: 100px; height: 100px;" ondragover="allowDrop(event)" ondrop="drop(event)" >
            </ul>    
            <ul class="navbar-nav w-100 justify-content-center">
              <button type="button" class="btn btn-primary button1"  data-bs-toggle="modal" data-bs-target="#confrontmodal" onclick="confronta()" >Confronta!</button>
            </ul>
            <ul class="nav navbar-nav ms-auto w-100 justify-content-end p-3">
              <img id="animal_image_2" value="plus" src="foto/icons8-plus-96.png" alt="img2" style="width: 100px; height: 100px;" ondragover="allowDrop(event)" ondrop="drop(event)" >
            </ul>
        </div>
    </div>
  </nav> 

  <div class="modal fade" id="confrontmodal" tabindex="-1" aria-labelledby="confrontmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title ms-auto" id="confrontmodal">CONFRONTO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="sfida">
          <div class="container-fluid justify-content-center">
                <table class="w-100">
                  <tr>
                    <td>ciao</td>
                    <td>cacca</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>24</td>
                  </tr>
                  <tr>
                    <td>silvio</td>
                    <td>berlu</td>
                  </tr>
                </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        </div>
      </div>
    </div>
  </div>

  

</body>
</html>