

// Drag and drop


//Caricamento
/*
function loadAnimals(){
    for (let i = 0; i < 60; i++) {
        var cell = `
          <div class="cell border border-2 border-warning" 
          
            >
            `;
        var animal = `
          <img src="elephant.png" id="elephant`+i+`" draggable=true ondragstart="drag(event)"
           ondragover="allowDrop(event)" ondrop="drop(event)"
            height="60" width="60">
            `;
        cell+=animal;
        cell+='</div>';
        
        document.getElementById('tavola').innerHTML+= cell;
        
      }
}
*/