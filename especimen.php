<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/elverde/assets/stylesheets/especimen_styles.css">
<link rel="stylesheet" href="/elverde/assets/stylesheets/familias_styles.css">

<!-- Importación de encabezado -->
<head><?php include 'head.html'; ?></head>
<title>Especímenes</title>

<!-- Abre conexión con la base de datos -->
<?php include("connection/functions.php"); ?>

<body>
    <main>
            <!-- herobanner-->    
        <section class="especimen_hero_banner">
        
            <h1 class="captiontitle">
                    ESPECÍMENES
            </h1>
                
        </section>
    <!-- Incluir el filtro de especímen que se sobrepone al banner -->
    <?php include ("filtro_especimen.php"); ?>

        </main>
    <br><br>
</body>

<script> 
    var links = document.querySelectorAll(".nav-list a");

    // Recorre los enlaces y verifica si el contenido coincide con "Home"
    for (var i = 0; i < links.length; i++) {
        if (links[i].textContent === "Especímenes") {
        links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
        }
    }
</script>

<footer>
    <!-- Incluir el pie de página -->
    <?php include 'footer.php'; ?>
</footer>
</html>