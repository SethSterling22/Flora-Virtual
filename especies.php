<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/elverde/assets/stylesheets/familias_styles.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Importación de encabezado -->
<head><?php include 'head.html'; ?></head>
<title>Especies</title>

<!-- Abre conexión con la base de datos -->
<?php 
include("connection/functions.php"); 
include("connection/config.php");
?>

<body>
    
    <main>
        <!-- herobanner-->
        <section class="especies_hero_banner">
            <h1 class="captiontitle">
                    ESPECIES
            </h1>        
        </section>

        <!-- Barra de búsqueda -->
        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input oninput="handleSearchChange()" placeholder="Buscar Especie" type="search-esp" name="search-esp" id="search-esp" class="input">
        </div>
        <br>
        <section class="especies-excluidas">
                <p>La siguiente lista incluye todas las especies cuya presencia en el  área ha sido documentada con al menos un espécimen de herbario, excepto en algunos casos donde la especie ha sido observada pero no ha sido posible colectarla (e.g. Cocos nucifera, Ceiba pentadora). Para ver la lista de las especies excluídas <a href="esp_excluidas.php">Presione Aquí</a>.
                </p>
            </section>

        <!-- Iniciar búsqueda de familias -->
        <!-- <div class="card-category-2" id="cardContainer"> -->
            <section class="cards-container">
            
            <!-- Invocación de las tarjetas de especie -->
            <div id="resultado" class="resultado"></div>
                <?php
                // Traer el número total de especies a mostrar
                $consulta = "SELECT COUNT(*) AS total_lineas FROM especies";
                $resultados = $conn->query($consulta);

                if ($resultados && $resultados->num_rows > 0) {
                    $fila = $resultados->fetch_assoc();
                    $totalLineas = $fila['total_lineas'];
                
                    // Convertir el arreglo a JSON
                    $resultadoJSON = json_encode($totalLineas);
                
                    // Cerrar la conexión a la base de datos
                    mysqli_close($conn);
                }
            ?>
        <!-- Botón para cargar más tarjetas -->
        <button id="boton-cargar-mas">Cargar más</button>
        
        <!-- Cierre de la sección de tarjetas de contenido -->
        </section>
        <br>


        <script>
            // Mostrar seleccionado en navbar
            var links = document.querySelectorAll(".nav-list a");

            // Recorre los enlaces y verifica si el contenido coincide con "Home"
            for (var i = 0; i < links.length; i++) {
                if (links[i].textContent === "Especies") {
                links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
                }
            }

            // Cargar las primeras 20 tarjetas
            document.addEventListener("DOMContentLoaded", load(20, 1));
        

            /////////////////////////////// Script de búsqueda alfabética /////////////////////////////// 
            function handleSearchChange() {
                var searchTerm = document.getElementById('search-esp').value;
                var cardCategory = document.getElementsByClassName('cards-container')[0];
                var cards = cardCategory.getElementsByClassName('card');
                var botonCargarMas = document.getElementById('boton-cargar-mas');

                // Filtrar los resultados en tiempo real
                var resultadosEncontrados = false; // Variable para verificar si se encontraron resultados
                if(searchTerm.length >= 1){
                    // console.log(searchTerm);
                    load(null, searchTerm)
                    botonCargarMas.style.display = 'none';
                for (var i = 0; i < cards.length; i++) {
                    // console.log(cards.length);
                    var cardTitle = cards[i].getElementsByClassName('card-title')[0];
                    var titleText = cardTitle.innerHTML.toLowerCase();

                    if (titleText.startsWith(searchTerm.toLowerCase())) {
                        cards[i].style.display = 'flex'; // Mostrar el resultado
                        resultadosEncontrados = true; // Se encontró al menos un resultado
                    } else {
                        cards[i].style.display = 'none'; // Ocultar el resultado
                    }
                }
                    
                }
                    else {
                        load(20, 1);
                        botonCargarMas.style.display = 'block';
                    }
            }

            ////////////////////////// Cargar más tarjetas ///////////////////////////
            // Cantidad de tarjetas
            var CardsToIncrement = 0;
            

            var botonCargarMas = document.getElementById('boton-cargar-mas');
            
            // Número total de tarjetas a ser mostradas
            const CARDSTOSHOW = <?php echo $resultadoJSON; ?>;
            var dec = Math.floor(CARDSTOSHOW / 10);

            botonCargarMas.addEventListener('click', function() {
                
                // Recoger la cantidad de tarjetas actuales
                var cards = document.getElementsByClassName('card');
                var totalCards = cards.length;

                // Incrementar la cantidad de tarjetas para mostrar
                CardsToIncrement += dec;
                load(CardsToIncrement, 1);
                
                // Ocultar el botón "Cargar más" si se han mostrado todas las tarjetas
                if (CARDSTOSHOW <= totalCards) {
                    botonCargarMas.style.display = 'none';
                }
            });

            function load(increment, query) {
                // console.log(query);
                var queryStr = JSON.stringify(query);
                if(increment == null){
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("resultado").innerHTML = this.responseText;
                            resultado.style.display = "block";
                            CardsEvent();
                        }
                    };

                    xhttp.open("POST", "cargar_esp.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    // Crear la cadena de consulta con el valor "inc" y su respectivo valor
                    var querys = "query=" + encodeURIComponent(queryStr);
                    xhttp.send(querys);

                }
                if(query == 1){
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("resultado").innerHTML = this.responseText;
                            resultado.style.display = "block";
                            CardsEvent();
                        }
                    };

                    xhttp.open("POST", "cargar_esp.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    // Crear la cadena de consulta con el valor "inc" y su respectivo valor
                    var query = "inc=" + encodeURIComponent(increment);
                    xhttp.send(query);
                }
            }

            ////////////////////////// Evento de click en las tarjetas ///////////////////////////
            function CardsEvent() {
                var cards = document.getElementsByClassName('card');
                
                for (var i = 0; i < cards.length; i++) {
                    cards[i].addEventListener('click', handleCardClick);
                    cards[i].addEventListener('mouseenter', handleMouseEnter);
                    cards[i].addEventListener('mouseleave', handleMouseLeave);
                }

                function handleMouseEnter(event) {
                    event.target.style.cursor = 'pointer';
                }

                function handleMouseLeave(event) {
                    event.target.style.cursor = 'default';
                }

                function handleCardClick(event) {
                    var target = event.target;

                    // Verificar si se hizo clic en un enlace dentro de la tarjeta
                    if (target.tagName === 'A' && target.classList.contains('card-link')) {
                        return; // Dejar que el enlace se maneje normalmente
                    }

                    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

                    var tarjeta = target.closest('.card');
                    var especieNombreElement = tarjeta.querySelector('.not-seen-title');
                    
                    if (especieNombreElement) {
                        var especieNombre = especieNombreElement.textContent;

                        // Redirigir a la página con el título como argumento
                        window.location.href = 'info_especie.php?especie=' + encodeURIComponent(especieNombre);
                    }
                }
            }
        </script>
    </main>
</body>
<footer>
    <!-- Incluir el pie de página -->
    <?php include 'footer.php'; ?>
</footer>
</html>