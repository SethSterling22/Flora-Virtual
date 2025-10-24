<!DOCTYPE html>
<html lang="en">

<head><?php include 'head.html'; ?></head>
<title>Galeria</title>

<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/galeria_styles.css">

<body>
    <main>
        <section class="galeria-hero">
            <div class="caption-container">
                <h3 class="caption-title">
                    Galeria
                </h3>
            </div>
        </section>

        <section class="galeria-container">

            <section class="galeria-description">
                <!--<p>Explore a captivating visual journey through our gallery, where each image tells a unique story. Our carefully curated collection showcases the beauty of nature, the richness of diverse ecosystems, and the fascinating details of plant life. From vibrant landscapes to intricate close-ups, these images capture the essence of our botanical world. Immerse yourself in the colors, textures, and forms that make each species distinctive. Whether you're a nature enthusiast or a curious observer, our gallery invites you to appreciate the intricate wonders of our planet through stunning visual narratives.</p> -->
            </section>

            <ul class="cards">

                <li class="cards-item">
                    <a href="galeria_fotos.php?atributo=<?php $atributo = "Flores"; echo urlencode($atributo); ?>">
                        <div class="card">
                            <div class="card_image">
                                <img src="/elverde/fotos_vivas/graptopic4.jpg" style="width: 500px; height: 300px;">
                            </div><!-- DIV CIERRA "CARD_IMAGE" -->

                            <div class="card_content">
                            <?php 
                            echo '<h2><a href="galeria_fotos.php?atributo=' . urlencode($atributo) . '" class="card-link">' . $atributo . '</a></h2>';
                            ?>
                            </div><!-- DIV CIERRA "card_content" -->
                        </div>
                    </a>
                </li>

                
                <li class="cards-item">
                    <a href="galeria_fotos.php?atributo=<?php $atributo = "Frutos"; echo urlencode($atributo); ?>">
                        <div class="card">
                            <div class="card_image">
                                <img src="/elverde/fotos_vivas/hymelat3.jpg" style="width: 500px; height: 300px;">
                            </div><!-- DIV CIERRA "CARD_IMAGE" -->

                            <div class="card_content">
                            <?php 
                            echo '<h2><a href="galeria_fotos.php?atributo=' . urlencode($atributo) . '" class="card-link">' . $atributo . '</a></h2>';
                            ?>
                            </div><!-- DIV CIERRA "card_content" -->
                        </div>
                    </a>
                </li>

                <li class="cards-item">
                    <a href="galeria_fotos.php?atributo=<?php $atributo = "Cortezas"; echo urlencode($atributo); ?>">
                        <div class="card">
                            <div class="card_image">
                                <img src="/elverde/fotos_vivas/guacar.jpg" style="width: 500px; height: 300px;">
                            </div><!-- DIV CIERRA "CARD_IMAGE" -->

                            <div class="card_content">
                            <?php 
                            echo '<h2><a href="galeria_fotos.php?atributo=' . urlencode($atributo) . '" class="card-link">' . $atributo . '</a></h2>';
                            ?>
                            </div><!-- DIV CIERRA "card_content" -->
                        </div>
                    </a>
                </li>

                <li class="cards-item">
                    <a href="galeria_fotos.php?atributo=<?php $atributo = "Helechos"; echo urlencode($atributo); ?>">
                        <div class="card">
                            <div class="card_image">
                                <img src="/elverde/fotos_vivas/aspleau2.jpg" style="width: 500px; height: 300px;">
                            </div><!-- DIV CIERRA "CARD_IMAGE" -->

                            <div class="card_content">
                            <?php 
                            echo '<h2><a href="galeria_fotos.php?atributo=' . urlencode($atributo) . '" class="card-link">' . $atributo . '</a></h2>';
                            ?>
                            </div><!-- DIV CIERRA "card_content" -->
                        </div>
                    </a>
                </li>

                <li class="cards-item">
                    <a href="galeria_fotos.php?atributo=<?php $atributo = "Gram"; echo urlencode($atributo); ?>">
                        <div class="card">
                            <div class="card_image">
                                <img src="/elverde/fotos_vivas/rhynrad2.jpg" style="width: 500px; height: 300px;">
                            </div><!-- DIV CIERRA "CARD_IMAGE" -->

                            <div class="card_content">
                            <?php 
                            echo '<h2><a href="galeria_fotos.php?atributo=' . urlencode($atributo) . '" class="card-link">Gramíneas y Ciperáceas</a></h2>';
                            ?>
                            </div><!-- DIV CIERRA "card_content" -->
                        </div>
                    </a>
                </li>
            </ul>
        </section>
    </main>
</body>

<script>
    var links = document.querySelectorAll(".nav-list a");
    
    // Recorre los enlaces y verifica si el contenido coincide con "Home"
    for (var i = 0; i < links.length; i++) {
    if (links[i].textContent === "Galería") {
    links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
    }
}
</script>
<footer>
    <!-- Incluir el encabezado -->
    <?php include 'footer.php'; ?>
</footer>

</html>