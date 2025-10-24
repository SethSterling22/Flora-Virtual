<!DOCTYPE html>
<html lang="en">

<!-- Incluir el encabezado -->
<?php include 'head.html';
include("connection/functions.php") ?>
<title>Clave El Verde</title>

<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/claves_styles.css">

<body>
    <main>
        <section class="claves-hero">
            <div class="caption-container">
                <h3 class="caption-title">
                    Claves
                </h3>
            </div>
        </section>
        <!-- Párrafo de inicio de la página -->
        <section class="claves-container">
            <div class="claves_description">
                <p>Las claves interactivas han sido construidas con DELTA (DEscription Language for TAxonomy) y para poder ser utilizadas es necesario el programa Intkey. Si usted ya tiene instalado Intkey puede hacer click en los enlaces abajo para descargar un archivo compactado con el nombre de la familia. Una vez descompactado, puede abrir el archivo que tiene el nombre de la familia con la extensión .ink. Si usted no tiene instalado Intkey, puede descargar el programa <a href="https://www.delta-intkey.com "target="_blank">aquí</a>. Por el momento, las claves solo incluyen las especies arbustivas y arbóreras de cada familia, pero poco a poco vamos a ir añadiendo de las espceies herbáceas y trepadoras. Además, estamos trabajando en una sola clave que incluirá todas las especies arbustivas y arbóreas.</p>
            </div>
            <section class="clave-grid">

                <?php
                // Query que recibe el nombre de la familia y de la foto de la tabla de familias
                $consulta = "SELECT familia, foto FROM familias WHERE clave_int IS NOT NULL ORDER BY familia ASC";
                $resultado = $conn->query($consulta);

                /// Asociación de la información
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        $foto = $row['foto'];
                        $titulo = $row['familia'];

                        // Invocación de las tarjetas con su respectivo link de descarga
                        echo '<div class="grid-item">';
                        echo '<img src="/elverde/fotos_vivas/' . $foto . ' " alt="Image 2">';
                        echo '<h2>' . $titulo . '</h2>';
                        echo '<h3><a style="color:#4FA858;font-size:12px; margin-top:0px;" href="claves/' . $titulo . '.zip"> Descargar Clave </a></h3>';
                        echo '</div>';
                    }
                }
                ?>
            </section>
        </section>
    </main>
</body>
<script>
    var links = document.querySelectorAll(".nav-list a");
    
    // Recorre los enlaces y verifica si el contenido coincide con "Home"
    for (var i = 0; i < links.length; i++) {
    if (links[i].textContent === "Recursos ▼") {
    links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
    }
}
</script>
<footer>
    <!-- Incluir el encabezado -->
    <?php include 'footer.php'; ?>
</footer>

</html>