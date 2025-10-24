<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/elverde/assets/stylesheets/familias_styles.css">
<!-- Importación de encabezado -->
<head><?php include 'head.html'; ?></head>
<title>Especies</title>

<!-- Abre conexión con la base de datos -->
<?php include("connection/functions.php"); ?>
 
<body>
    
    <main>
        <!-- herobanner-->
        <section class="especies_hero_banner">
        <!--<img src='/elverde/assets/images/familias/familias_hero_img.png' alt="Hero Banner Image Placeholder"> -->
      
         <h1 class="captiontitle">
                  ESPECIES EXCLUIDAS
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

        <!-- Iniciar búsqueda de especies excluidas -->
        <div class="card-category-2" id="cardContainer">
            <?php
            // Realizar la conexión a la base de datos y ejecutar la consulta
            $consulta = "SELECT species_authors, comentario FROM especies_excluidas ORDER BY species_authors ASC";

            $resultados = $conn->query($consulta);

            if ($resultados->num_rows > 0) {
                while ($row = $resultados->fetch_assoc()) {
                    $especie = $row['species_authors'];
                    $comentario = $row['comentario'];

                    // Impresión de las tarjetas
                    echo '<div class="rounded-card rounded-card-light">';
                    echo '<div class="card-content" style="margin: 2%;">';
                    echo '<em><span class="card-title" style="min-width: 600px;">' . $especie . '</span></em>';
                    echo '<p class="card-text">' . $comentario . '</p>';
                    echo '</div>';
                    echo '</div>';
                }

            } else {
                echo "No se encontraron resultados";
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conn);
            ?>
        </div>

        <!-- Script de búsqueda alfabética -->
        <script>
            function handleSearchChange() {
                var searchTerm = document.getElementById('search-esp').value;
                var cardCategory = document.getElementsByClassName('card-category-2')[0];
                var cards = cardCategory.getElementsByClassName('rounded-card rounded-card-light');

                cardCategory.style.display = 'flex';
                cardCategory.style.flexWrap = 'wrap';
                cardCategory.style.justifyContent = 'center';
                cardCategory.style.alignItems = 'center';

                // Filtrar los resultados en tiempo real
                var resultadosEncontrados = false; // Variable para verificar si se encontraron resultados

                for (var i = 0; i < cards.length; i++) {
                    var cardTitle = cards[i].getElementsByClassName('card-title')[0];
                    var titleText = cardTitle.innerHTML.toLowerCase();

                    if (titleText.startsWith(searchTerm.toLowerCase())) {
                        cards[i].style.display = 'block'; // Mostrar el resultado
                        resultadosEncontrados = true; // Se encontró al menos un resultado
                    } else {
                        cards[i].style.display = 'none'; // Ocultar el resultado
                    }
                }

                // Mostrar mensaje de "No se han encontrado resultados" si no se encontraron resultados
                var noResultsMessage = cardCategory.getElementsByClassName('no-results-message')[0];

                if (!resultadosEncontrados) {
                    // Verificar si el mensaje ya está presente antes de agregarlo
                    if (!noResultsMessage) {
                        noResultsMessage = document.createElement('p');
                        noResultsMessage.classList.add('no-results-message');
                        noResultsMessage.innerHTML = 'No se han encontrado resultados';
                        cardCategory.appendChild(noResultsMessage);
                    }
                } else {
                    // Eliminar el mensaje si se encontraron resultados
                    if (noResultsMessage) {
                        cardCategory.removeChild(noResultsMessage);
                    }
                }
            }

            var links = document.querySelectorAll(".nav-list a");

            // Recorre los enlaces y verifica si el contenido coincide con "Home"
            for (var i = 0; i < links.length; i++) {
                if (links[i].textContent === "Especies") {
                links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
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