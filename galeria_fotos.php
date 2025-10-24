<!DOCTYPE html>
<html lang="en">

<!-- Incluir el encabezado -->  
<?php include 'head.html';
include("connection/functions.php");
$atributo = $_GET['atributo'];
if ($atributo == 'Gram'){
    echo '<title>Galería de Gramíneas y Ciperácea</title>';
}
else {
echo '<title>Galería de ' . $atributo . '</title>';}?>

<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/claves_styles.css">
<link rel="stylesheet" type="text/css" href="assets/stylesheets/lightbox.css">
<script src="jquery/lightbox-plus-jquery.min.js"></script>

<body>
    <main>
        <section class="claves-hero">
            <div class="caption-container">
                <?php 
                if ($atributo == 'Gram'){
                    echo '<h3 class="caption-title">Galería de Gramíneas y Ciperácea</h3>';
                }
                else {
                echo '<h3 class="caption-title">Galería de ' . $atributo . '</h3>';}?>
            </div>
        </section>
        <!-- Párrafo de inicio de la página -->
        <section class="claves-container">
            <div class="claves_description">
                <p>Las fotos que se incluyen en este sitio son propiedad de sus autores. El uso de éstas queda prohibido sin el consentimiento de los mismos. Por favor, escríbanos si desea hacer uso de alguna foto.</p>
            </div>
            <div class="filter-container" <?php if ($atributo !== 'Flores') { echo 'style="display: none;"'; } ?>>
                <div class="square selected" id="ALL">ALL</div>
                <div class="square" id="floro">Rosadas y Rojas</div>
                <div class="square" id="flobla">Blancas y Verdosas</div>
                <div class="square" id="floazu">Azules y Púrpuras</div>
                <div class="square" id="floama">Amarillas y Anaranjadas</div>
            </div>
            <section class="clave-grid">

                <?php
                // Query que recibe el nombre de la familia y de la foto de la tabla de familias
                switch ($atributo) {
                    case 'Frutos':
                        $consulta = "SELECT species, photo_name, comment FROM especies_fotos_vivas WHERE gallery = 'fru' ORDER BY species ASC";
                        break;
                    case 'Flores':
                        $consulta = "SELECT species, photo_name, gallery, comment FROM especies_fotos_vivas WHERE gallery = 'floro' OR gallery = 'flobla' OR gallery = 'floazu' OR gallery = 'floama' ORDER BY species ASC";
                        break;
                    case 'Cortezas':
                        $consulta = "SELECT species, photo_name, comment FROM especies_fotos_vivas WHERE gallery = 'cor' ORDER BY species ASC";
                        break;
                    case 'Helechos':
                        $consulta = "SELECT species, photo_name, comment FROM especies_fotos_vivas WHERE gallery = 'hel' ORDER BY species ASC";
                        break;
                    case 'Gram':
                        $consulta = "SELECT species, photo_name, comment FROM especies_fotos_vivas WHERE gallery = 'gram' ORDER BY species ASC";
                        break;
                    default:
                        echo 'No hay información que mostrar';
                }
                // $consulta = "SELECT nombre_cientifico, foto FROM especies WHERE frutos IS NOT NULL ORDER BY nombre_cientifico ASC";
                
                $resultado = $conn->query($consulta);

                /// Asociación de la información
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        $titulo = $row['species'];
                        $foto = $row['photo_name'] ? "/elverde/fotos_vivas/" . $row['photo_name'] : "/elverde/fotos_vivas/no_disp.png"; // Ruta de la imagen
                        $gallery = isset($row['gallery'])? $row['gallery'] : null;
                        $author = $row['comment'];
                    
                        // Invocación de las tarjetas con su respectivo link de descarga
                        
                        echo '<div class="grid-item" id="grid">';
                        echo '<div class ="gallery">';
                        echo '<a href='.$foto.' data-lightbox="models" data-title="'.$author.'">';
                        echo '<img src="' . $foto . ' " alt="Image 2"></a>';
                        echo '<h2 id="titulo">' . $titulo . '</h2>';
                        echo '<p id="author" style="color: #45784b">' . $author . '</p>';
                        echo '<div id="filtro" style="display: none;">' . $gallery . '</div>';
                        echo '</div></div>';
                    }
                }
                ?>
            </section>
        </section>
        <script>
            // Función para filtrar los word-container
            function filterWordContainers(letter) {
            // Obtener los elementos de las tarjetas
            const cards = document.querySelectorAll(".grid-item");
            
            // Filtrar las tarjetas según la letra seleccionada
            cards.forEach(card => {
                const filtro = card.querySelector("#filtro");
                const filtros = filtro.textContent;
                // console.log(filtros)
                if (letter === "ALL" || filtros === letter.toLowerCase()) {
                // console.log(letter)
                card.style.display = "block";
                } else {
                // console.log(letter)
                card.style.display = "none";
                }
            });
            }

            // Obtener los objetos de la clase "square"
            const squares = document.querySelectorAll(".square");

            // Agregar el evento de clic a cada objeto de la clase "square"
            squares.forEach(square => {
            square.addEventListener("click", () => {
                // Obtener el id del objeto de la clase "square" seleccionado
                const selectedId = square.id;
                
                // Filtrar los word-container según el id seleccionado
                filterWordContainers(selectedId);
                
                // Remover la clase 'selected' de todos los squares
                squares.forEach(square => {
                square.classList.remove('selected');
                });
                
                // Agregar la clase 'selected' al square seleccionado
                square.classList.add('selected');
            });
            });

            // Filtrar los word-container por defecto al cargar la página
            filterWordContainers('ALL');

            var links = document.querySelectorAll(".nav-list a");

            // Recorre los enlaces y verifica si el contenido coincide con "Home"
            for (var i = 0; i < links.length; i++) {
                if (links[i].textContent === "Galería") {
                links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
                }
            }
            </script>
    </main>
</body>
<footer>
    <!-- Incluir el encabezado -->
    <?php include 'footer.php'; ?>
</footer>

</html>
