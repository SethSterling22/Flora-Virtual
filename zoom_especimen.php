<!DOCTYPE html>
<html lang="en">

<!-- Zoom -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>

<!-- Importación de encabezado -->
<head><?php include 'head.html'; ?></head>
<title>Zoom especímen</title>

<!-- Abre conexión con la base de datos -->
<?php 
include("connection/functions.php"); 
include("connection/config.php"); 
$foto = $_GET['foto'];
$foto = openssl_decrypt($foto, AES, KEY, 0);
$foto =  "/Images_elverde/" . $foto;
?>

<script> 
    var links = document.querySelectorAll(".nav-list a");

    // Recorre los enlaces y verifica si el contenido coincide con "Home"
    for (var i = 0; i < links.length; i++) {
        if (links[i].textContent === "Especímenes") {
        links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
        }
    }
</script>

<body>
    <main>

    <style>
    .image-column-info {
        justify-content: center; 
        align-items: center;
        display: flex; /* Utilizar flexbox para mostrar los elementos en línea */
        align-items: center; 
    }
    .floatingdiv {
        background-color: black; 
        height: 400px; 
        width: 400px; 
        opacity: 0.1;
    }
    </style>
    <!-- Incluir el filtro de especímen que se sobrepone al banner -->
    <?php 

    echo '<div class="image-column-info">';
    echo '<img id="zoom" src='.$foto.' style="filter: scale(0.5); width: 35%;" alt="Imagen" data-zoom-image='.$foto.'>';
    echo '<div class="floatingdiv" id="cont"></div>';
    echo '</div>';
    echo '</div>';
    
    ?>

    </main>
</body>

<script> 
    // Zoom

    $('#zoom').ezPlus({
    scrollZoom: true,
    zoomWindowPosition: "cont"
});
</script>
</html>
