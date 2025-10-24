<!DOCTYPE html>
<html lang="en">

<!-- Importación de encabezado -->
<link rel="stylesheet" href="/elverde/assets/stylesheets/familias_styles.css">
<head><?php 
include 'head.html';
include("connection/config.php");
$famref = isset($_GET['famref'])? $_GET['famref'] : null; 
?>
</head>
<title>Familias</title>

<!-- Abre conexión con la base de datos -->
<?php include("connection/functions.php"); ?>

<!-- llamar al stylesheet correspondiente -->

<body>
    <main>
        <!-- herobanner-->
        <section class="familia_hero_banner">
        <!--<img src='/elverde/assets/images/familias/familias_hero_img.png' alt="Hero Banner Image Placeholder"> -->
    
        <h1 class="captiontitle">
                FAMILIA
        </h1>         
        </section>

        <!-- Barra de búsqueda -->
        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input oninput="handleSearchChange()" placeholder="Buscar Familia" type="search" name="search" id="search" class="input" value="<?php echo $famref ?? ''; ?>">
        </div>        

        <!-- Iniciar búsqueda de familias -->

        <!-- <div class="card-category-2"> -->
        <br><br><br><br>
        <section class="cards-container">
        <?php
        // Realizar la conexión a la base de datos y ejecutar la consulta
        $consulta = "SELECT familia, descripcion, foto FROM familias ORDER BY familia ASC";
        $resultados = $conn->query($consulta);

        if ($resultados->num_rows > 0) {
            while ($row = $resultados->fetch_assoc()) {
                $familia = $row['familia'];

                // Obtener las especies correspondientes a la familia actual
                $consultaEspecies = "SELECT nombre_cientifico FROM especies WHERE familia = '" . $row['familia'] . "'";
                $resultadoEspecies = $conn->query($consultaEspecies);

                $especies = array();
                if ($resultadoEspecies->num_rows > 0) {
                    while ($rowEspecies = $resultadoEspecies->fetch_assoc()) {
                        $especies[] = $rowEspecies['nombre_cientifico'];
                    }
                }
                $descripcion = $row['descripcion'];
                // Decodificar el string
                //$descripcion = utf8_decode($descripcion);
                $descripcion_red = substr($descripcion, 0, 350);

                $foto = ($row['foto'] === NULL) ? "/elverde/fotos_vivas/no_disp.png" : "/elverde/fotos_vivas/" . $row['foto'];

        echo '<section class="card">';
        echo '<img src=' . $foto . ' alt="Card Image">';
        echo '<div class="card-content">';
        echo '<em><div class="card-title">' . $familia . '</div></em>';
        echo '<p class="card-paragraph" data-full-description="' . $descripcion . '  " data-initial-description="' . $descripcion_red . ' ... <em><u>[Leer más]</u></em>">' . $descripcion_red . ' ... <em><u>[Leer más]</u></em></p>';
    
        // Impresión de todas las especies en esa familia
        echo '<h1 class="card-subheading">Especies:</h1>';

        echo '<ol class="card-elements" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-gap: 10px;">';
        
        foreach ($especies as $key => $especie) {
            if ($key < 2) {
                $especie_E = openssl_encrypt($especie, AES, KEY, 0);
                echo '<li class="card-element" style="color: #4FA858;"><a href="info_especie.php?especie=' . urlencode($especie_E) . '" class="card-link" data-info="' . $especie . '"><em>' . $especie . '</em></a>   </li>';
            } else {
                break; // Detener el bucle después de mostrar los dos primeros elementos
            }
        }
        echo '</ol>';

        echo '<ol class="card-elements show-all" style="display: none; grid-template-columns: repeat(2, 1fr); grid-gap: 10px;">';
        foreach ($especies as $key => $especie) {
            $especie_E = openssl_encrypt($especie, AES, KEY, 0);
            echo '<li class="card-element" style="color: #4FA858;"><a href="info_especie.php?especie=' . urlencode($especie_E) . '" class="card-link" data-info="' . $especie . '"><em>' . $especie . '</em></a></li>';
        }

        echo '</ol>';

        echo '</div>'; // Cierre de contenedor
        echo '</section>';    

        }
        } else {
            echo "No se encontraron resultados";
        }
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        ?>
        </section>
        <br>
        <!-- </div> -->

        <!-- Script de búsqueda alfabética -->
        <script>
            // Hacer que se despliegue más o menos texto
            function handleCardClick(event) {
                var cardText = event.currentTarget.getElementsByClassName('card-paragraph')[0];
                var colList = event.currentTarget.getElementsByClassName('card-elements show-all')[0];
                var colElement = event.currentTarget.getElementsByClassName('card-elements')[0];
                
                var descriptionText = cardText.dataset.fullDescription;
                var initialDescription = cardText.dataset.initialDescription;

                if (cardText.innerHTML === initialDescription) {
                    cardText.innerHTML = descriptionText;
                    colList.style.display = 'grid';
                    colElement.style.display = 'none';
                } else {
                    cardText.innerHTML = initialDescription;
                    colList.style.display = 'none';
                    colElement.style.display = 'grid';
                }
            }

            function handleSearchChange() {
                var searchTerm = document.getElementById('search').value;
                var cardCategory = document.getElementsByClassName('cards-container')[0];
                var cards = cardCategory.getElementsByClassName('card');

                // Filtrar los resultados en tiempo real
                var resultadosEncontrados = false; // Variable para verificar si se encontraron resultados

                for (var i = 0; i < cards.length; i++) {
                    var cardTitle = cards[i].getElementsByClassName('card-title')[0];
                    var titleText = cardTitle.innerHTML.toLowerCase();

                    if (titleText.startsWith(searchTerm.toLowerCase())) {
                        cards[i].style.display = 'flex'; // Mostrar el resultado
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
                        noResultsMessage.style.textAlign = 'center';
                        cardCategory.appendChild(noResultsMessage);
                    }
                } else {
                    // Eliminar el mensaje si se encontraron resultados
                    if (noResultsMessage) {
                        cardCategory.removeChild(noResultsMessage);
                    }
                }
            }

            // Agregar evento de click a las tarjetas
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

            // Obtener el valor del parámetro de la URL
            const urlParams = new URLSearchParams(window.location.search);
            const famref = urlParams.get('famref');

            // Establecer el valor del campo de búsqueda
            document.getElementById('search').value = famref;

            // Realizar la búsqueda automáticamente si el valor del campo de búsqueda no está vacío
            if (famref !== '') {
            handleSearchChange();
            }


            document.querySelector('.show-all').addEventListener('click', function() {
                var elements = document.querySelectorAll('.card-element');
                elements.forEach(function(element) {
                    element.style.display = 'block';
                });
            });

            var links = document.querySelectorAll(".nav-list a");

            // Recorre los enlaces y verifica si el contenido coincide con "Home"
            for (var i = 0; i < links.length; i++) {
                if (links[i].textContent === "Familias") {
                links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
                }
            }
        </script>
    </main>
</body>
<br><br><br>
<footer>
    <!-- Incluir el pie de página -->
    <?php include 'footer.php'; ?>
</footer>
</html>
