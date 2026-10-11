<!DOCTYPE html>
<html lang="en">

<head><?php include 'head.html'; ?></head>
<title>Nosotros</title>

<?php
// Abre conexión con la base de datos
include("connection/functions.php");
?>

<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/nosotros_styles.css">

<body>
    <main>
        <section class=nosotros-hero>
            <div class="captioncontainer">
                <h3 class="captiontitle">
                    Nuestro Equipo
                </h3>
            </div>
        </section>

        <section class="nosotros-cards">
    <div class="basic-card basic-card-light">
        <img src="https://placehold.co/600x400" alt="Herbario UPR Rio Piedras">
        <div class="card-content">
            <span class="card-title">Herbario UPR Rio Piedras</span>
            <p class="card-text">
                El herbario de la Universidad de Puerto Rico en Rio Piedras (UPRRP) alberga la colección más grande de especímenes de plantas en Puerto Rico. Con aproximadamente 54,000 ejemplares, se especializa en la flora de la isla pero también contiene una buena representación de otras islas vecinas. Desde su creación, el herbario ha llevado a cabo diversos proyectos florísticos, sistemáticos y de ecología y conservación.
            </p>
        </div>
    </div>

    <div class="basic-card basic-card-light">
        <img src="https://placehold.co/600x400" alt="Estación Biológica El Verde">
        <div class="card-content">
            <span class="card-title">Estación Biológica El Verde</span>
            <p class="card-text">
                La Flora Virtual de El Verde ha sido financiada por el programa FIPI (Fondo Institucional para la Investigación) del Decanato de Estudios Graduados de la Universidad de Puerto Rico-Rio Piedras, y por CATEC(Centro de Ecología Tropical Aplicada y Conservación). El proyecto también ha sido posible gracias al apoyo del personal de la estación, especialmente de Seth Rifikin, Christopher Nytch, Francisco Perez y Jess Zimmerman. Se agradece además a Franklin Axelrod, curador de colección del herbario UPRRP, y a los estudiantes Julio Lazcano y Jaileen Merced.
            </p>
        </div>
    </div>
</section>


        <section class="nosotros-container">
            <!-- Column 1 -->
            <div class="grid-item">
                <img src="/elverde/assets/images/nosotros/avatar.png" alt="Image 2">
                <h1>Fabiola Areces Berazain</h1>
                <h2>Estudiante Doctoral - Herbario UPRRP </h2>
                <p>Departamento de Biología </p>
                <p> Universidad de Puerto Rico-Río Piedras</p>
            </div>

            <!-- Column 2 -->
            <div class="grid-item">
                <img src="/elverde/assets/images/nosotros/avatar.png" alt="Image 2">
                <h1>Victor J. Vega López</h1>
                <h2>Estudiante doctoral
                </h2>
                <p>Departamento de Biología </p>
                <p> Universidad de Puerto Rico-Río Piedras</p>
            </div>

            <!-- Column 3 -->
            <div class="grid-item">
                <img src="/elverde/assets/images/nosotros/avatar.png" alt="Image 2">
                <h1>Kristopher Bonefont Flores</h1>
                <h2>Tecnico de laboratorio de Botánica</h2>
                <p>Departamento de Biología </p>
                <p> Universidad de Puerto Rico-Río Piedras</p>
            </div>

            <!-- Column 4 -->
            <div class="grid-item">
                <img src="/elverde/assets/images/nosotros/avatar.png" alt="Image 2">
                <h1>James D. Ackerman</h1>
                <h2>Profesor y director del Herbario UPRRP</h2>
                <p>Departamento de Biología </p>
                <p> Universidad de Puerto Rico-Río Piedras</p>
            </div>


        </section>

        <section class="catec-container">
            <div class="nosotros-card-container">
                <div class="image-column">
                    <img src="https://via.placeholder.com/200" alt="Placeholder Image">
                </div>
                <div class="text-column">
                    <h2>Estación Biológica El Verde</h2>
                    <p> La Flora Virtual de El Verde ha sido financiada por el programa FIPI (Fondo Institucional para la Investigacion) del Decanato de Estudios Graduados de la Universidad de Puerto Rico-Rio Piedras, y por CATEC(Centro de Ecologia Tropical Aplicada y Conversacion). El proyecto tabien ha sido posible gracias el apotyo del personal de la estacion, espcialmente de Seth Rifikin, Christopher Nytch, Francisco Perez y Jess Zimmerman. Se agradece admeas a Franklin Axelrod, curador de coleccion del herbario UPRRP, y a los estudiantes Julio Lazcano y Jaileen Merced.</p>
                </div>
            </div>

            <div class="catec-profiles">

                <!-- Column 1 -->
                <div class="grid-item">
                    <img src="/elverde/assets/images/nosotros/avatar.png" alt="Image 2">
                    <h1>Fabiola Areces Berazain</h1>
                    <h2>Estudiante Doctoral - Herbario UPRRP </h2>
                    <p>Departamento de Biología </p>
                    <p> Universidad de Puerto Rico-Río Piedras</p>
                </div>

                <!-- Column 2 -->
                <div class="grid-item">
                    <img src="/elverde/assets/images/nosotros/avatar.png" alt="Image 2">
                    <h1>Victor J. Vega López</h1>
                    <h2>Estudiante doctoral
                    </h2>
                    <p>Departamento de Biología </p>
                    <p> Universidad de Puerto Rico-Río Piedras</p>
                </div>

                <!-- Column 3 -->
                <div class="grid-item">
                    <img src="/elverde/assets/images/nosotros/avatar.png" alt="Image 2">
                    <h1>Kristopher Bonefont Flores</h1>
                    <h2>Tecnico de laboratorio de Botánica</h2>
                    <p>Departamento de Biología </p>
                    <p> Universidad de Puerto Rico-Río Piedras</p>
                </div>

                <!-- Column 4 -->
                <div class="grid-item">
                    <img src="/elverde/assets/images/nosotros/avatar.png" alt="Image 2">
                    <h1>James D. Ackerman</h1>
                    <h2>Profesor y director del Herbario UPRRP</h2>
                    <p>Departamento de Biología </p>
                    <p> Universidad de Puerto Rico-Río Piedras</p>
                </div>
            </div>
        </section>

    </main>
    <script src="script.js"></script>
</body>

<script>
    var links = document.querySelectorAll(".nav-list a");
    
    // Recorre los enlaces y verifica si el contenido coincide con "Home"
    for (var i = 0; i < links.length; i++) {
    if (links[i].textContent === "Nosotros") {
    links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
    }
}
</script>
<footer>
    <!-- Incluir el encabezado -->
    <?php include 'footer.php'; ?>
</footer>

</html>
