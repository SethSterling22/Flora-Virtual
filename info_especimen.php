<!DOCTYPE html>
<html lang="en">

<!-- Importación de encabezado -->

<head><?php
include 'head.html';
include("connection/config.php");
$especimen = $_GET['especimen'];
$especimen = openssl_decrypt($especimen, AES, KEY, 0);
$especie = $_GET['especie']; 
$especie = openssl_decrypt($especie, AES, KEY, 0);
$id = $_GET['id']; 
$id = openssl_decrypt($id, AES, KEY, 0);
$num = $_GET['num']; 
$num = openssl_decrypt($num, AES, KEY, 0);?>
</head>
<?php 
header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html>
<html><title>Información de ' . $especimen . '</title>';
// Abre conexión con la base de datos
include("connection/functions.php"); ?>


<!-- llamar al stylesheet correspondiente -->
<link rel="stylesheet" type="text/css" href="assets/stylesheets/info_especifica_styles.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="assets/stylesheets/jquery.magnify.css" rel="stylesheet">
<script src="jquery/jquery.magnify.min.js"></script>
<script src="jquery/jquery.magnify.js"></script>


<body>
  <!-- <div class="CentradoRectangulo"> -->

      <?php 

        // Consulta para recibir la información del especímen en base al autor específico y nombre de especie
        $consulta = "SELECT photoname, familiy, herb, monthname, division, code, plantdesc, habitat, altitude, geodata, genus, id
        FROM especimenes_fotos
        WHERE collector = '$especimen' AND species = '$especie' AND id = '$id'
        ORDER BY photoname ASC";
        
        $resultados = $conn->query($consulta);
        $fila = $resultados->fetch_assoc();


        echo '<section class="history-hero">';
        echo '<div class="caption-container">';
        echo '<h3 class="caption-title">';
        echo '<a href="familias.php" style="color: white;">Familia</a> / ';
        echo '<a href="familias.php?famref='. $fila['familiy'] . ' " style="color: white;">' . $fila['familiy'] . '</a> / ';
        echo '<a href="especies.php" style="color: white;">Especie</a> / ';
        echo '<a href="info_especie.php?especie='. urlencode(openssl_encrypt($especie, AES, KEY, 0)) . ' " style="color: white;">' . $especie . '</a>';
        echo '</h3>';
        echo '</div>';
        echo '</section>';

        $resultados->data_seek(0); // Reiniciar el puntero del resultado al inicio

        echo '<div class="info-card-container">';
        echo '<div class="text-column-info">';
        echo '<h2>' . $especie . ' - ' . $especimen . ' #'.$num.'</h2>'; 

        // Asignación de las variables con sus determinados parámetros
        if ($resultados->num_rows > 0) {
          while ($row = $resultados->fetch_assoc()) {
            $foto = $row['photoname'] ? "/Images_comp/" . $row['photoname'] : "/elverde/fotos_vivas/no_disp.png";
            $family = $row['family'];
            $herb = $row['herb'];
            $monthname = $row['monthname'];
            $division = $row['division'];
            $code = $row['code'];
            $plantdesc = $row['plantdesc'];
            $habitat = $row['habitat'];
            $altitude = $row['altitude'];
            $geodata = $row['geodata'];
            $genus = $row['genus'];
            $foto_E = $row['photoname'] ? "/Images_elverde/" . $row['photoname'] : "/elverde/fotos_vivas/no_disp.png";
            
            // Impresión de los campos de información recolectados
            echo isset($family) && $family !== NULL ? "<strong>Family: </strong>" . $family . "<br><br>" : "";
            echo isset($herb) && $herb !== NULL ? "<strong>Herb: </strong>" . $herb . "<br><br>" : "";
            echo isset($monthname) && $monthname !== NULL ? "<strong>Monthname: </strong>" . $monthname . "<br><br>" : "";
            echo isset($division) && $division !== NULL ? "<strong>Division: </strong>" . $division . "<br><br>" : "";
            echo isset($code) && $code !== NULL ? "<strong>Code: </strong>" . $code . "<br><br>" : "";
            echo isset($plantdesc) && $plantdesc !== NULL ? "<strong>Plantdesc: </strong>" . $plantdesc . "<br><br>" : "";
            echo isset($altitude) && $altitude !== NULL ? "<strong>Altitud: </strong>" . $altitude . "<br><br>" : "";
            // La función utf8_decode hay que cambiarla para cuando se actualice la versión de PHP (Versión nueva abajo de estas líneas, comentadas)
            echo isset($habitat) && $habitat !== NULL ? "<strong>Habitat: </strong>" . utf8_decode($habitat) . "<br><br>" : "";
            echo isset($geodata) && $geodata !== NULL ? "<strong>Geodata: </strong>" . utf8_decode($geodata) . "<br><br>" : "";

            // // Versión actualizada de PHP
            // echo isset($habitat) && $habitat !== NULL ? "<strong>Habitat: </strong>" . iconv('otra_codificacion', 'UTF-8', $habitat) . "<br><br>" : "";
            // echo isset($geodata) && $geodata !== NULL ? "<strong>Geodata: </strong>" . iconv('otra_codificacion', 'UTF-8', $geodata) . "<br><br>" : "";
            echo isset($genus) && $genus !== NULL ? "<strong>Genus: </strong>" . $genus . "<br><br>" : "";
            
            echo '</div>';


            // Impresión de la foto
            echo '<div class="image-column-info">';
            echo '<div class="image-container">';
            echo '<div class="image-loading">';
            echo '<img src="assets/images/symbols/loading.gif" alt="Cargando...">
            </div>';
            echo '<a data-magnify="gallery" data-caption="' . $especie . ' - ' . $especimen . '" data-group="" href='. $foto_E .'>  ';
            // echo '<a href="zoom_especimen.php?foto='. urlencode($foto_E) .'">';
            echo '<img src='. $foto .' style="cursor: pointer;" alt="Imagen" class="image">';
            echo '<div class="overlay"></div>';
            echo '<div class="magnifier"></div>';
            echo '</a>';
            echo '</div><br>';
            echo "[Presione la imagen para ampliarla]";
            echo '</div><br>';
          }
        }

        // Cierre de Conexión
        mysqli_close($conn);

        ?>
      </div>
    </div>
  </div>
</body>

<script> 

const image = document.querySelector('.image');
const loading = document.querySelector('.image-loading');

image.onload = function() {
  loading.style.display = 'none';
};


  // Invocación de la función para el zoom en "modal"
  $('[data-magnify=gallery]').magnify();

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
