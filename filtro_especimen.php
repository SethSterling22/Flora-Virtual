<!DOCTYPE html>
<html lang="en">

<?php
  // Consulta sobre la información de los filtros
  $consulta = "SELECT code, familiy, species, genus, collector, division FROM especimenes_fotos";
  $resultado = $conn->query($consulta);

  // Array asociativo para almacenar los campos únicos
$camposUnicos = array(
  'code' => array(),
  'familiy' => array(),
  'species' => array(),
  'genus' => array(),
  'collector' => array(),
  'division' => array(),
);

// Obtener los valores únicos de cada campo
while ($fila = $resultado->fetch_assoc()) {
  foreach ($camposUnicos as $campo => $valoresUnicos) {
    $camposUnicos[$campo][] = $fila[$campo];
  }
}

$camposUnicosJSON = json_encode($camposUnicos);

// Cierre de Conexión
mysqli_close($conn);
?>

<script>
const camposUnicosBU = <?php echo $camposUnicosJSON; ?>;
var camposUnicos = camposUnicosBU;

document.addEventListener('DOMContentLoaded', function() {
// console.log(camposUnicos)
for (const campo in camposUnicos) {
    // console.log(campo);
    const container = document.getElementById(`${campo}-values-container`);
    // console.log(container);
    container.innerHTML = '';
    

    const uniqueValues = [...new Set(camposUnicos[campo])];
    uniqueValues.sort();

    uniqueValues.forEach(val => {
      const p = document.createElement('p');
      p.style.cursor = 'pointer';
      p.textContent = val;
      p.onclick = () => selectValue(campo, val);
      container.appendChild(p);
    });
  }
});

/////////////////////////// Organizar dinámicamente todos los campos de filtro ///////////////////////////
function organizar(inputId, value) {
  const camposFiltrados = {};

  // Entrar en la función de ordenar los filtros dependiendo de los valores seleccionados
  if (value != ''){

    // Filtrar los valores en base al input //
    for (const campo in camposUnicos) {
      if (campo !== inputId) {
        camposFiltrados[campo] = camposUnicos[campo].filter((val, index) => {
          // console.log(camposUnicos);
          return camposUnicos[inputId][index] === value;
        });
      }
    }
  
    // console.log(camposFiltrados);

    camposUnicos = camposFiltrados;

  // Actualizar la lista de valores únicos en cada campo
  for (const campo in camposFiltrados) {
    // console.log(campo);
    const container = document.getElementById(`${campo}-values-container`);
    container.innerHTML = '';
    

    const uniqueValues = [...new Set(camposFiltrados[campo])];
    uniqueValues.sort();

    uniqueValues.forEach(val => {
      const p = document.createElement('p');
      p.style.cursor = 'pointer';
      p.textContent = val;
      p.onclick = () => selectValue(campo, val);
      container.appendChild(p);
    });
  }
}

  else { 
    camposUnicos = camposUnicosBU;

    // console.log(camposUnicos)
    for (const campo in camposUnicos) {
    // console.log(campo);
    const container = document.getElementById(`${campo}-values-container`);
    container.innerHTML = '';
    

    const uniqueValues = [...new Set(camposUnicos[campo])];
    uniqueValues.sort();

    uniqueValues.forEach(val => {
      const p = document.createElement('p');
      p.style.cursor = 'pointer';
      p.textContent = val;
      p.onclick = () => selectValue(campo, val);
      container.appendChild(p);
    });
  }
    return camposUnicos;
  }
}

</script>

<!-- ///////////////////////////////////////////////////// Comienzo de la parte de las secciones de los filtros  /////////////////////////////////////////////////////  -->
<div class="container">
  <!-- /// Categorías de búsqueda /// -->
  <!-- Código de estación -->
  <div class="category">
    Código de Estación
    <div class="subcategory">
      <div class="selection" id="selection-code">

      <section class="search-bar">
        <label class="input-search">
        <span class="clear-icon" id="xboton" name="code"></span>
          <input type="text" placeholder="Filtrar..." id="code" />
            <div class="search-menu" id="searchMenu">
              <div class="columns" id="columns">
                <div class="column" id="column">

                <!-- Espacio de impresión de las opciones de code -->
                <div id="code-values-container"></div>

                <div class="column" id="column">
              </div>
            </div>
          </label>
        </section>

      </div>
    </div>
  </div>

  <!-- Colector principal -->
  <div class="category">
    Colector
    <div class="subcategory">
      <div class="selection" id="selection-collector">

      <section class="search-bar">
        <label class="input-search">
        <span class="clear-icon" id="xboton" name="collector"></span>
          <input type="text" placeholder="Filtrar..." id="collector" />
            <div class="search-menu" id="searchMenu">
              <div class="columns" id="columns">
                <div class="column" id="column">

                <!-- Espacio de impresión de las opciones de colector -->
                <div id="collector-values-container"></div>

                <div class="column" id="column">
              </div>
            </div>
          </label>
        </section>

      </div>
    </div>
  </div>

  <!-- Divisón -->
  <div class="category">
    División
    <div class="subcategory">
      <div class="selection" id="selection-division">

      <section class="search-bar">
        <label class="input-search">
        <span class="clear-icon" id="xboton" name="division"></span>
          <input type="text" placeholder="Filtrar..." id="division" />
            <div class="search-menu" id="searchMenu">
              <div class="columns" id="columns">
                <div class="column" id="column">

                <!-- Espacio de impresión de las opciones de división -->
                <div id="division-values-container"></div>

                <div class="column" id="column">
              </div>
            </div>
          </label>
        </section>

      </div>
    </div>
  </div>

    <!-- Familia -->
  <div class="category">
    Familia
    <div class="subcategory">
      <div class="selection" id="selection-familiy">

      <section class="search-bar">
        <label class="input-search">
        <span class="clear-icon" id="xboton" name="familiy"></span>
          <input type="text" placeholder="Filtrar..." id="familiy" />
            <div class="search-menu" id="searchMenu">
              <div class="columns" id="columns">
                <div class="column" id="column">

                <!-- Espacio de impresión de las opciones de familia -->
                <div id="familiy-values-container"></div>

                <div class="column" id="column">
              </div>
            </div>
          </label>
        </section>

      </div>
    </div>
  </div>

    <!-- Género -->
  <div class="category">
    Género
    <div class="subcategory">
      <div class="selection" id="selection-genus">

      <section class="search-bar">
        <label class="input-search">
        <span class="clear-icon" id="xboton" name="genus"></span>
          <input type="text" placeholder="Filtrar..." id="genus" />
            <div class="search-menu" id="searchMenu">
              <div class="columns" id="columns">
                <div class="column" id="column">

                <!-- Espacio de impresión de las opciones de género -->
                <div id="genus-values-container"></div>
                  
                <div class="column" id="column">
              </div>
            </div>
          </label>
        </section>

      </div>
    </div>
  </div>

    <!-- Especie -->
  <div class="category">
    Especie
    <div class="subcategory">
      <div class="selection" id="selection-species">

      <section class="search-bar">
        <label class="input-search">
        <span class="clear-icon" id="xboton" name="species"></span>
          <input type="text" placeholder="Filtrar..." id="species" />
            <div class="search-menu" id="searchMenu">
              <div class="columns" id="columns">
                <div class="column" id="column">

                <!-- Espacio de impresión de las opciones de especie -->
                <div id="species-values-container"></div>
                  
                <div class="column" id="column">
              </div>
            </div>
          </label>
        </section>
      </div>
    </div>
  </div>
    <div class="button-esp" id="boton-limpiar">Limpiar</div>
    <div class="button-esp"  onclick="filter(true, 2)" id="boton-cargar-mas">Buscar</div>
</div>

<!-- ///////////////////////////////////////////////////// Comienzo de la parte de script para búsqueda  /////////////////////////////////////////////////////  -->

<br>
<p id="mensaje" style="justify-content: center; text-align:center;">Seleccione al menos un campo</p>

<!-- Div para desplegar el resultado de la selección del filtro -->
<div id="resultado"></div>

  <!-- Script para los menús desplegables y realizar los filtros -->
  <script>

// Redirige a la página de información del especimen específico al darle click a la tarjeta seleccionado
function redirigir(id, especie, colector, num) {;
  window.location.href = "info_especimen.php?id=" + encodeURIComponent(id) + "&especie=" + encodeURIComponent(especie) + "&especimen=" + encodeURIComponent(colector) + "&num=" + encodeURIComponent(num);
};

// Filtrar los resultados y enviar el request a "resultado_filtro_especimen.php"
function filter(bool, query) {

  // Obtener el elemento con el id "resultado"
  var resultado = document.getElementById("resultado");
  var inputs = document.querySelectorAll("input");
  var values = [];

  // Obtener los valores de todos los inputs
  for (var i = 0; i < inputs.length; i++) {
    var inputId = inputs[i].id;
    var inputValue = inputs[i].value;

    if (inputValue.trim() !== "") {
      values.push({ id: inputId, value: inputValue });
    }
  }

  // revisar lo que está entrando
  // console.log(values);

  // Envío de request para pedir los resultados cuando los campos seleccionados sean mayor a dos
  var mensaje = document.getElementById("mensaje");


  // Entrada de query para mostrar las tarjetas de especímenes cuando el parámetro de query sea igual a "2"
  if (values.length >= 1){
    mensaje.style.display = 'none';
    if(values.length >= 1 && bool && query == 2){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("resultado").innerHTML = this.responseText;
          resultado.style.display = "block";
        }
      };
      xhttp.open("POST", "resultado_filtro_especimen.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

          // Añadir el valor de "query" al arreglo de valores
    values.push({ id: "query", value: query });

      // Convertir el arreglo de valores a una cadena de consulta
      var query = values.map(function(item) {
        return encodeURIComponent(item.id) + "=" + encodeURIComponent(item.value);
      }).join("&");
      
      xhttp.send(query);
    }
  }
  else{
    mensaje.style.display = 'block';
  }
}

///////////// Función de limpiar los filtros ///////////// 

// Obtener el botón "Limpiar"
var botonLimpiar = document.getElementById('boton-limpiar');

// Agregar evento click al botón "Limpiar"
botonLimpiar.addEventListener('click', function() {
  // Obtener todos los campos de entrada
  var camposEntrada = document.querySelectorAll('input[type="text"]');

  // Limpiar el texto de los campos de entrada
  for (var i = 0; i < camposEntrada.length; i++) {
    var campo = camposEntrada[i];
    var id = campo.id;

    campo.value = '';
    selectValue(id, '');
    // Ocultar el contenido estableciendo la propiedad "display" como "none"
    resultado.style.display = "none";
  }
});

// Limpia el campo específico de filtro
var xboton = document.querySelectorAll('#xboton');
xboton.forEach(function(element) {
  element.addEventListener('click', function() {
    var name = element.getAttribute('name');

    // Seleccionar el Id del campo al cual se le va a limpiar el input
    var searchMenu = document.querySelector('#' + name + ' + .search-menu');
    setTimeout(function() {
            searchMenu.style.display = 'none';
          }, 0);
    var input = document.getElementById(name);

    // Clear el valor
    input.value = '';

    selectValue(name, '');
    resultado.style.display = "none";
  });
});

  ///////////// Función llamada al dar click en cualquiera de los filtros /////////////

  function selectValue(inputId, value) {

  var input = document.getElementById(inputId);
  
  // Organizar valores para buscar
  if (input && value != "") {
    input.value = value;
    filterValues(inputId, value);
  }

  /////// Llama a la función para organizar los demás filtros ///////

  // Quita el tipo "object" de inputId
  if (typeof inputId === 'string') {
    var inputs = document.querySelectorAll("input");
    var values = [];

    // Obtener los valores de todos los inputs
    for (var i = 0; i < inputs.length; i++) {
      var inputID = inputs[i].id;
      var inputValue = inputs[i].value;

      if (inputValue.trim() !== "") {
        values.push({ id: inputID, value: inputValue });
      }
    }
    if (value == "" && values.length >= 1){
      organizar(inputId, value);
      // console.log(values);
      for (var i = 0; i < values.length; i++) {
        console.log(values[i].id);
        console.log(values[i].value);
      organizar(values[i].id, values[i].value);
      }
    }
  
    // Llama a la función para organizar los demás filtros
    else {
    organizar(inputId, value);
    }
  }
/////////////////////////////////////////////////////////////////

  filter(false, 2);
}

 ///////////////  Filtra los valores de cada filtro específico  /////////////////

  function filterValues(inputId, value) {
    // console.log(inputId, value);
  var elements = document.querySelectorAll('#' + inputId + ' + .search-menu .columns .column p');
  var input = document.getElementById(inputId);
  
  // Filtrar los resultados en tiempo real
  var resultadosEncontrados = false; // Variable para verificar si se encontraron resultados

  // Mostrar mensaje de "No se han encontrado resultados" si no se encontraron resultados
  var searchMenu = document.querySelector('#' + inputId + ' + .search-menu');
  if (searchMenu){
    var noResultsMessage = searchMenu.getElementsByClassName('no-results-message')[0];

    for (var i = 0; i < elements.length; i++) {
      var element = elements[i];
      var text = element.innerText.toLowerCase();
      
      if (text.startsWith(value.toLowerCase())) {
        element.style.display = 'block';
        resultadosEncontrados = true;
      } else {
        element.style.display = 'none';
      }
      if (text == value.toLowerCase()){
        element.style.display = 'none';
        setTimeout(function() {
            searchMenu.style.display = 'none';
          }, 0);
          
        // Llama a la función de selección cuando el valor que se entra sea igual a lo mostrado
        selectValue(input, value);
      }
    }

    if (!resultadosEncontrados) {
            // Verificar si el mensaje ya está presente antes de agregarlo
            if (!noResultsMessage) {
                noResultsMessage = document.createElement('p');
                noResultsMessage.classList.add('no-results-message');
                noResultsMessage.innerHTML = "No se han encontrado resultado";
                searchMenu.appendChild(noResultsMessage);
            }
    }  else {
      // Eliminar el mensaje si se encontraron resultados
      if (noResultsMessage) {
          searchMenu.removeChild(noResultsMessage);
      }
    }
  }
}

  // Separar los eventos de selección para cada tarjeta específica
  document.getElementById('genus').addEventListener('input', function(event) {
    filterValues('genus', event.target.value);
  });

  document.getElementById('species').addEventListener('input', function(event) {
    filterValues('species', event.target.value);
  });

  document.getElementById('division').addEventListener('input', function(event) {
    filterValues('division', event.target.value);
  });

  document.getElementById('familiy').addEventListener('input', function(event) {
    filterValues('familiy', event.target.value);
  });

  document.getElementById('collector').addEventListener('input', function(event) {
    filterValues('collector', event.target.value);
  });

    document.getElementById('code').addEventListener('input', function(event) {
    filterValues('code', event.target.value);
  });


  // Hacer que el search-menu se despliegue

  var inputSearches = document.querySelectorAll(".input-search");
  var searchMenus = document.querySelectorAll(".search-menu");

  // Agrega el evento de clic al documento
  document.addEventListener("click", function(event) {
    var clickedElement = event.target;


    // Verifica si el elemento clicado es un .input-search o está contenido dentro de uno
    var isInsideInputSearch = false;
    for (var i = 0; i < inputSearches.length; i++) {
      if (inputSearches[i].contains(clickedElement)) {
        isInsideInputSearch = true;
        break;
      }
    }

    // Si no es un .input-search o no está contenido dentro de uno, oculta los .search-menu
    if (!isInsideInputSearch) {
      searchMenus.forEach(function(searchMenu) {
        searchMenu.style.display = "none";
      });
    }
  });

  inputSearches.forEach(function(inputSearch) {
    var searchMenu = inputSearch.querySelector(".search-menu");

    inputSearch.addEventListener("click", function() {
        searchMenu.style.display = "block";
    });
  });

  // Agrega el evento de desplegar al input-search
  inputSearches.forEach(function(inputSearch, value) {
    var searchMenu = inputSearch.querySelector(".search-menu");
    var input = inputSearch.querySelector("input");
    
    input.addEventListener("input", function() {
      var inputValue = input.value.toLowerCase();

      // Verifica si el valor del input está vacío para desplegar el menú mienstras escribe en el input-search
      if (inputValue === "") {
        searchMenu.style.display = "none";
      } else {
        searchMenu.style.display = "block";
      }
    });
  });

  </script>