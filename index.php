<!DOCTYPE html>
<html lang="en">

<!-- Incluir el encabezado -->
<?php include 'head.html'; 

// Realiza conexión
include("connection/connection.php");
include("connection/config.php"); ?>
<title>El Verde</title>

<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/homepage_styles.css">

<body>

    <main>
        <!-- herobanner -->
        <section class="hero-banner">
            <div class='heroimage'>
                <div class="captioncontainer">
                    <h1 class="captiontitle">
                        El Verde Field Station
                    </h1>
                    <h2 class="captiontitle">
                        Where Tropical Rainforest Ecosystems are Available
                    </h2>
                    <!-- Incluir el search -->
                    <?php include 'searchbar.php'; ?>
                </div>
            </div>

        </section>

        <!-- cards -->

<section class="card-category">

<div class="homepage-cards">
    <img src="/elverde/assets/images/homepage/Flora.jpg" style="width: 100%; height: 250px;" alt="Flore Virtual">
    <div class="card-content">
        <h3 class="h3-custom">Flora Virtual El Verde</h3>
        <p class="card-description">
            La Flora Virtual de la Estación Biológica El Verde contiene información sobre más de 600 especies de plantas vasculares que han sido registradas para el área. Para casi todas las especies se incluyen fotos en el campo e imágenes de especímenes de herbario, pero solo las especies de árboles y arbustos (más de 200) contienen descripciones completas y se incluyen en las claves interactivas.
        </p>
    </div>
</div>

<div class="homepage-cards">
    <img src="/elverde/assets/images/homepage/Estacion-biologica.jpg" style="width: 100%; height: 250px;" alt="Estación Biológica El Verde">
    <div class="card-content">
        <h3 class="h3-custom">Estación Biológica El Verde</h3>
        <p class="card-description">
            La Estación Biológica El Verde se encuentra en la ladera noroeste del Bosque Nacional El Yunque, en la Sierra de Luquillo. El bosque, localmente conocido como "bosque de tabonuco" es y ha sido objeto de una amplia gama de estudios en ecología tropical. La Estación es manejada por el Instituto para Estudios de Ecosistemas Tropicales (ITES) de la Universidad de Puerto Rico.
        </p>
    </div>
</div>

<div class="homepage-cards">
    <img src="/elverde/assets/images/homepage/Herbario.jpg" style="width: 100%; height: 250px;" alt="Herbario UPRRP">
    <div class="card-content">
        <h3 class="h3-custom">Herbario UPR Río Piedras</h3>
        <p class="card-description">
            El herbario de la Universidad de Puerto Rico en Río Piedras (UPRRP) alberga la colección más grande de especímenes de plantas en Puerto Rico. Con aproximadamente 54,000 ejemplares, se especializa en la flora de la isla, pero también contiene una buena representación de otras islas vecinas. Desde su creación, el herbario ha llevado a cabo diversos proyectos florísticos, sistemáticos, y de ecología y conservación.
        </p>
    </div>
</div>

</section>

        <!-- Logos -->
        <section class="logos-section">
            <img src="/elverde/assets/images/homepage/Catec_new.png" alt="Logo de catec" class="patrocinador">
            <img src="/elverde/assets/images/homepage/Herbario.png" alt="Logo del herbario" class="patrocinador">
            <img src="/elverde/assets/images/homepage/Uprrp.png" alt="Logo de la UPRRP" class="patrocinador">
            <section>

    </main>
    <!-- <script src="script.js"></script> -->
    <script>
    // Obtén la lista de elementos <a> dentro de .nav-list
    var links = document.querySelectorAll(".nav-list a");

    // Recorre los enlaces y verifica si el contenido coincide con "Home"
    for (var i = 0; i < links.length; i++) {
        if (links[i].textContent === "Home") {
        links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
        }
    }
    </script>
    
</body>
<footer>
    <!-- Incluir el encabezado -->
    <?php include 'footer.php'; ?>
</footer>
</html>
