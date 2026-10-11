<!DOCTYPE html>
<html lang="en">

<!-- Importación de encabezado -->
<head><?php 
include 'head.html';
include("connection/config.php");
$especie = $_GET['especie']; 
$especie = openssl_decrypt($especie, AES, KEY, 0);
?></head>
<?php header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html>
<html><title>Información de ' . $especie . '</title>';

// Abre conexión con la base de datos
include("connection/functions.php"); ?>

<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/info_especifica_styles.css">
<link rel="stylesheet" type="text/css" href="assets/stylesheets/lightbox.css">
<script src="jquery/lightbox-plus-jquery.min.js"></script>

<body>
  <?php 
  
      // Consulta para recibir toda la información concerniente a la especie
      $consulta = "SELECT e.nombre_cientifico, e.familia, e.codigo, e.nombre_comun, e.sinonimos, e.author1, e.habito, e.tallos, e.hojas, e.inflorescencia, e.frutos, e.soros, e.distribucion, e.nota, efv.photo_name, ef.collector, ef.id, ef.number, efv.comment
      FROM especies e 
      LEFT JOIN especies_fotos_vivas efv ON e.nombre_cientifico = efv.species 
      LEFT JOIN especimenes_fotos ef ON e.nombre_cientifico = ef.species
      WHERE e.nombre_cientifico = '$especie' 
      ORDER BY e.nombre_cientifico ASC";

      $resultado = $conn->query($consulta);
      $fila = $resultado->fetch_assoc();

      echo '<section class="history-hero">';
      echo '<div class="caption-container">';
      echo '<h3 class="caption-title">';
      echo '<a href="familias.php" style="color: white;">Familia</a> / ';
      echo '<a href="familias.php?famref='. urlencode($fila['familia']) .'" style="color: white;">' . $fila['familia'] . '</a> / ';
      echo '<a href="especies.php" style="color: white;">Especie</a>';
      echo '</h3>';
      echo '</div>';
      echo '</section>';

      $resultado->data_seek(0); // Reiniciar el puntero del resultado al inicio

      // Encabezado de la página
      // echo '<div class="CentradoRectangulo">';
      echo '<div class="info-card-container">';
      echo '<div class="text-column-info">';
      echo '<h2> ' . ($especie) . '</h2>'; 


      if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado); // Obtiene la primera fila del resultado
        // Impresión de la información dependiendo de la que se encuentre
        foreach ($fila as $nombreCampo => $valorCampo) {
            if ($nombreCampo !== 'nombre_cientifico' && $nombreCampo !== 'photo_name' && $nombreCampo !== 'collector' && $valorCampo !== NULL && $nombreCampo !== 'id'  && $nombreCampo !== 'number'  && $nombreCampo !== 'comment') {
                // echo ucfirst($nombreCampo) . ": " . $valorCampo . "<br>";
                switch ($nombreCampo) {
                  case 'codigo':
                      echo '<p class="card-text"><strong>Código de estación:</strong> ' . $valorCampo . '</p>';
                      break;
                  case 'nombre_comun':
                      echo '<p class="card-text"><strong>Nombre común:</strong> ' . utf8_decode($valorCampo) . '</p>';
                      break;
                  case 'sinonimos':
                      echo '<p class="card-text"><strong>Sinónimos:</strong> ' . utf8_decode($valorCampo) . '</p>';
                      break;
                  case 'author1':
                      echo '<p class="card-text"><strong>Autor:</strong> ' . $valorCampo . '</p>';
                      break;
                  case 'habito':
                      echo '<p class="card-text"><strong>Hábito:</strong> ' . utf8_decode($valorCampo) . '</p>';
                      break;
                  case 'distribucion':
                      echo '<p class="card-text"><strong>Distribución:</strong> ' . utf8_decode($valorCampo) . '</p>';
                      break;
                  default:
                      echo '<p class="card-text"><strong>' . ucfirst($nombreCampo) . ':</strong> ' . utf8_decode($valorCampo) . '</p>';
              }
            }
        }
    } else {
        echo "No se encontraron resultados.";
    }

  // Indexación de las fotos y los collector
  $resultado->data_seek(0); // Reiniciar el puntero del resultado al inicio

  $collectors = [];
  $photos = [];
  $ids = [];
  $authors = [];
  $numbers = [];

  while ($fila = $resultado->fetch_assoc()) {
    $collector = $fila['collector'];
    $photo_name = $fila['photo_name'];
    $author = $fila["comment"];
    $id = $fila['id'];
    $number = $fila['number'];

    if (!is_null($collector)) {
        // Guardar el coleccionista en el arreglo asociativo utilizando el id como clave
        $collectors[$id] = $collector;
    }

    if (!is_null($photo_name)) {
        $photos[] = $photo_name;
    }

    if(!is_null($collector)){
      $ids[] = $id;
    }

    if(!is_null($author)){
      $authors[] = $author;
    }
    if(!is_null($number)){
      $numbers[$id] = $number;
    }
}

  // Impresión de la lista de colectores
  if (!empty($collectors)) {
    echo '<p class="card-text"><strong>Especímenes:</strong></p>';
    echo '<div class="especies-container" style="column-count: 3;">';
    echo '<ol style="margin: 0; padding: 1;">';
    foreach ($collectors as $id => $collector) {
      $id_E = openssl_encrypt($id, AES, KEY, 0);
      $especie_E = openssl_encrypt($especie, AES, KEY, 0);
      $collector_E = openssl_encrypt($collector, AES, KEY, 0);
      $num_E = openssl_encrypt($numbers[$id], AES, KEY, 0);
      echo '<li class="card-text" style="color: #4FA858;;"><a href="info_especimen.php?especimen=' . urlencode($collector_E) . '&especie=' . urlencode($especie_E) . '&id=' . urlencode($id_E) . '&num=' . urlencode($num_E) . '" class="card-link">' . $collector . ' - ' . $numbers[$id]. '</a></li>';
    }

  echo '</ol>';
  echo '</div>';
  }

  echo '</div>';
  echo '</div>';

  // Carousel de fotos_vivas
  echo '<section class="carousel-container">';
  echo '<div class="gallery">';
  echo '<div class="title">Fotos de Especie:</div>';
  echo '<div class="arrow-container">';
  echo '<div class="arrow left" onclick="prevSlide()"></div>';
  echo '<div class="arrow right" onclick="nextSlide()"></div>';
  echo '</div>';
  echo '<div class="carousel">';

 // Eliminar elementos duplicados del array $photos
$photos = array_unique($photos);
// $authors = array_unique($authors);

// Recorrer el array $photos y mostrar las imágenes
foreach ($photos as $index => $photo_name) {
  // $author = isset($authors[$index]) ? $authors[$index] : '';
  
  echo '<a href="/elverde/fotos_vivas/'. $photo_name .'" data-lightbox="models" data-title="'.$authors[$index].'">';
  echo '<img src="/elverde/fotos_vivas/' . $photo_name . '"></a>';
}

  echo '</div></div>';
  echo '</section>';
  // echo '</div>';
  // Cierre de información

  // echo '<script src="script.js"></script>';

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
?>
</body>
<script>
  var links = document.querySelectorAll(".nav-list a");

  // Recorre los enlaces y verifica si el contenido coincide con "Home"
  for (var i = 0; i < links.length; i++) {
      if (links[i].textContent === "Especies") {
      links[i].classList.add("selected"); // Agrega la clase "selected" al enlace con el contenido "Home"
      }
  }

  let currentIndex = 0;
const slidesToShow = 3; // Number of slides to show at once

function showSlide(index) {
  const carousel = document.querySelector('.carousel');
  const totalSlides = carousel.children.length;

  if (index < 0) {
    index = totalSlides - slidesToShow; // Show the last set of slides
  } else if (index >= totalSlides - slidesToShow + 1) {
    index = 0; // Show the first set of slides
  }

  const transformValue = -index * (300 + 10) + 'px'; // Adjust for image width and spacing
  carousel.style.transform = 'translateX(' + transformValue + ')';
  currentIndex = index;
}

function nextSlide() {
  showSlide(currentIndex + slidesToShow);
}

function prevSlide() {
  showSlide(currentIndex - slidesToShow);
}

// Initially show the first set of slides
showSlide(0);

</script>
<footer>
  <!-- Incluir el pie de página -->
  <?php include 'footer.php'; ?>
</footer>

</html>
