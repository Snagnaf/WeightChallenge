

// Drag and drop

function allowDrop(ev) {
    ev.preventDefault();
  }
  
  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }
  
  function drop(ev) {
    ev.preventDefault();
    var data= ev.dataTransfer.getData("text");
    var animal1 = document.getElementById(data);
    var animal2 = ev.target;
    var parent = animal2.parentElement;
    parent.innerHTML="";
    parent.appendChild(animal1);

    var s = `
    <table class="table table-primary table-striped">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">`+animal1.id+`</th>
<th scope="col">`+animal2.id+`</th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">Image</th>
<td><img src="`+animal1.src+`" height="80px" width="80px"></td>
<td><img src="`+animal2.src+`" height="80px" width="80px"></td>
</tr>
<tr>
<th scope="row">Name</th>
<td>Jacob</td>
<td>Thornton</td>
</tr>
<tr>
<th scope="row" >Weight</th>
<td class="smaller">10000kg</td>
<td class="greater">11000kg</td>
</tr>
<tr>
<th scope="row" >Volume</th>
<td class="greater">Mark</td>
<td class="smaller">Otto</td>
</tr>
<tr>
<th scope="row">Height</th>
<td class="greater">3,96m</td>
<td class="smaller">3,20m</td>
</tr>
<tr>
<th scope="row">Life</th>
<td class="greater">40</td>
<td class="smaller">25</td>
</tr>
</tbody>
</table>
<br>
      `;


    document.getElementById("sfida").innerHTML=s;
    window.scrollTo(0,window.innerHeight);
}


//Caricamento
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