<!DOCTYPE html>
<html lang="en">

<!-- Importación de encabezado -->
<head><?php include 'head.html'; ?></head>
<?php header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html>
<html><title>Literatura</title>';
// Abre conexión con la base de datos
include("connection/functions.php"); ?>


<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/info_especifica_styles.css">


<body class="body">
  <!-- <div class="CentradoRectangulo"> -->
    <div class="info-card-container">
      <div class="text-column-info">
      <?php echo '<h2>Literatura citada</h2>'; ?>
      <?php 
        // Consulta para recibir toda la información de literatura citada
        $consulta = "SELECT citada FROM literatura ORDER BY id ASC";

        $resultados = $conn->query($consulta);

        if ($resultados->num_rows > 0) {
            while ($row = $resultados->fetch_assoc()) {
                $cita = $row['citada'];
                echo '<p class="card-text"> ' . $cita . '</p><br>';
            }
        } else {
            echo "No se encontraron resultados";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);

      ?>
      </div>
    </div>
  <!-- </div> -->
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
  <!-- Incluir el pie de página -->
  <?php include 'footer.php'; ?>
</footer>
</html>