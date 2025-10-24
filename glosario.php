<!DOCTYPE html>
<html lang="en">

<!-- Incluir el encabezado -->
<?php include 'head.html';
include("connection/functions.php"); ?>
<title>Glosario El Verde</title>

<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/glosario_styles.css">

<body>

    <main>
        <section class="glosario-container">
            <h3 class="caption-title">
                Glosario
            </h3>
            <section class="glosario-description">
                <p> Esta es una compilación de los términos botánicos usados en las descripciones de este sitio. Las definiciones han sido tomadas mayormente de Font Quer (1982) y Harris & Harris (2001). Para mayor información sobre alguno de los términos, o para buscar alguno que quizás haya sido omitido, favor de referirse a estas publicaciones. </p>
            </section>

            <div class="filter-container">
                <div class="square selected">ALL</div>
                <div class="square">A</div>
                <div class="square">B</div>
                <div class="square">C</div>
                <div class="square">D</div>
                <div class="square">E</div>
                <div class="square">F</div>
                <div class="square">G</div>
                <div class="square">H</div>
                <div class="square">I</div>
                <div class="square">J</div>
                <div class="square">K</div>
                <div class="square">L</div>
                <div class="square">M</div>
                <div class="square">N</div>
                <div class="square">O</div>
                <div class="square">P</div>
                <div class="square">Q</div>
                <div class="square">R</div>
                <div class="square">S</div>
                <div class="square">T</div>
                <div class="square">U</div>
                <div class="square">V</div>
                <div class="square">W</div>
                <div class="square">X</div>
                <div class="square">Y</div>
                <div class="square">Z</div>
            </div>
        <?php
        // Selecciona todo lo que hay en la tabla de Glosario y organizarlo por el nombre del término
        $consulta = "SELECT termino, definicion FROM glosario ORDER BY termino";

        // Realizar la consulta a la base de datos
        $resultado = mysqli_query($conn, $consulta);

        // Verificar si hay resultados
        if (mysqli_num_rows($resultado) > 0) {
            echo '<section clas="glosario-list">';
            
            // Iterar sobre los resultados
            while ($fila = mysqli_fetch_assoc($resultado)) {

                $termino = ucfirst($fila['termino']);

                $description = ucfirst($fila['definicion']);
                echo '<div class="word-contianer">';
                echo '<div class="word-title">';
                echo '<h3 id="titulo">' . $termino . '</h3>';
                echo '<div class="word-description">';
                echo '<p id="description">' . $description . '</p>';
                // Mensaje de no encontrar nada cuando se busque
                echo '<p class="no-results-message" style="display: none; justify-content: center; align-items: center; height: 20vh">No se han encontrado resultados</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            
            echo '</section>';
        } else {
            echo 'No se encontraron resultados.';
        }
            
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        ?>
            <script>
                // Obtener todos los elementos square
                const squares = document.querySelectorAll('.square');

                //////////////////////////////////////////////////////////////////////////////////////////
                // Función para filtrar los word-container
                function filterWordContainers(letter) {
                // Verificar la letra seleccionada
                // console.log(letter);

                // Obtener todos los elementos con id "titulo"
                const tituloElements = document.querySelectorAll('#titulo');
                const descriptionElements = document.querySelectorAll('#description');

                // Ocultar el mensaje de "No se han encontrado resultados"
                const noResultsMessage = document.querySelector('.no-results-message');
                noResultsMessage.style.display = 'none';

                let resultadosEncontrados = false;
                // Iterar sobre los tituloElements
                for (let i = 0; i < tituloElements.length; i++) {
                const tituloElement = tituloElements[i];
                const descriptionElement = descriptionElements[i];

                // Obtener el contenido del título
                const titulo = tituloElement.textContent;

                // Convertir la letra seleccionada a mayúscula
                const selectedLetter = letter.toUpperCase();

                // Mostrar u ocultar el tituloElement según la letra seleccionada
                if (selectedLetter === 'ALL' || titulo.startsWith(selectedLetter)) {
                    tituloElement.style.display = 'block';
                    descriptionElement.style.display = 'block';
                    resultadosEncontrados = true;
                } else {
                    tituloElement.style.display = 'none';
                    descriptionElement.style.display = 'none';
                }
                }
                if (!resultadosEncontrados) {
                    noResultsMessage.style.display = 'flex';
                }
                const abecedario = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                const inicialesFaltantes = [];

                abecedario.split('').forEach(letra => {
                const tituloIniciaConLetra = Array.from(tituloElements).some(titulo => {
                    const tituloText = titulo.textContent.trim();
                    return tituloText.startsWith(letra);
                });
                
                if (!tituloIniciaConLetra) {
                    inicialesFaltantes.push(letra);
                }
                });

                // console.log(inicialesFaltantes);

                // Cambiar la clase a 'notselectable' de los squares que contienen las letras faltantes
                squares.forEach(square => {
                const squareText = square.textContent.trim();
                if (inicialesFaltantes.includes(squareText)) {
                    square.classList.add('notselectable');
                }
                });
                }

                //////////////////////////////////////////////////////////////////////////////////////////
                // Función para manejar el evento de clic en los squares
                function handleSquareClick() {
                // Verificar si el square tiene la clase 'notselectable'
                if (this.classList.contains('notselectable')) {
                    return; // Salir de la función si el square es 'notselectable'
                }
                
                // Obtener la letra seleccionada
                const selectedLetter = this.textContent;
                
                // Remover la clase 'selected' de todos los squares
                squares.forEach(square => {
                    square.classList.remove('selected');
                });
                
                // Agregar la clase 'selected' al square seleccionado
                this.classList.add('selected');
                
                // Filtrar los word-container según la letra seleccionada
                filterWordContainers(selectedLetter);
                }

                // Agregar un evento de clic a cada square
                squares.forEach(square => {
                square.addEventListener('click', handleSquareClick);
                });
                // Filtrar los word-container por defecto al cargar la página
                filterWordContainers('ALL');
                

                    var links = document.querySelectorAll(".nav-list a");
                    
                    // Recorre los enlaces y verifica si el contenido coincide con "Home"
                    for (var i = 0; i < links.length; i++) {
                    if (links[i].textContent === "Recursos ▼") {
                    links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
                    }
                }

            </script>
        </section>
    </main>
</body>
<footer>
    <!-- Incluir el encabezado -->
    <?php include 'footer.php'; ?>
</footer>

</html>