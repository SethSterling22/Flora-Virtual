<?php 
include("connection/functions.php"); 
include("connection/config.php");
$num = isset($_POST["inc"]) ? $_POST["inc"] : null;

$q = isset($_POST["query"]) ? $_POST["query"] : "";
$q = str_replace('"', '', $q);
$q = str_replace("'", '', $q);
$resultadosEncontrados = false;

    // Realizar la conexión a la base de datos y ejecutar la consulta
    if($num != null){
    $consulta = "SELECT e.nombre_cientifico, e.familia, e.foto, e.nombre_comun, e.sinonimos, e.author1, ef.collector, ef.id, ef.number
    FROM especies e
    LEFT JOIN especimenes_fotos ef ON e.nombre_cientifico = ef.species
    ORDER BY e.nombre_cientifico ASC
    LIMIT $num";

$resultados = $conn->query($consulta);
    }

    if($q != null){
    $consulta = "SELECT e.nombre_cientifico, e.familia, e.foto, e.nombre_comun, e.sinonimos, e.author1, ef.collector, ef.id, ef.number
    FROM especies e
    LEFT JOIN especimenes_fotos ef ON e.nombre_cientifico = ef.species
    ORDER BY e.nombre_cientifico ASC";

$resultados = $conn->query($consulta);
    
    }

    function startsWith($string, $startString)
    {
      $len = strlen($startString);
      $lowercaseString = strtolower($string);
      $lowercaseStartString = strtolower($startString);
      return substr($lowercaseString, 0, $len) === $lowercaseStartString;
    }

    if ($resultados->num_rows > 0) {
        $especies = array();
        while ($row = $resultados->fetch_assoc()) {
            $especie_nombre = $row['nombre_cientifico'];
        
            if (!isset($especies[$especie_nombre])) {
                $especies[$especie_nombre] = array(
                    'sinonimos' => $row['sinonimos'],
                    'familia' => $row['familia'],
                    'nombre_comun' => $row['nombre_comun'],
                    'foto' => $row['foto'],
                    'author1' => $row['author1'],
                    'collectors' => array(),
                    'id' => array(),
                    'number' => array()
                );
            }
         
            $especies[$especie_nombre]['collectors'][] = $row['collector'] ?: "No hay información";
            $especies[$especie_nombre]['id'][] = $row['id'];
            $especies[$especie_nombre]['number'][] = $row['number'];
        
    }
        foreach ($especies as $especie_nombre => $datos_especie) {
            if (startsWith($especie_nombre, $q)) {
            $sinonimos = $datos_especie['sinonimos'];
            $autores = $datos_especie['author1'];
            $sinonimos_formateados = str_replace("<i>", "<em>", $sinonimos);
            $sinonimos_formateados = str_replace("</i>", "</em>", $sinonimos_formateados);

            $sinonimos_formateados = $sinonimos_formateados ? $sinonimos_formateados : "No hay información.";
            $familia = $datos_especie['familia'] ? $datos_especie['familia'] : "No hay información.";
            $nombre_comun = $datos_especie['nombre_comun'] ? $datos_especie['nombre_comun'] : "No hay información.";
            $especie_nombre_E = openssl_encrypt($especie_nombre, AES, KEY, 0);

            $foto = $datos_especie['foto'] ? "/elverde/fotos_vivas/" . $datos_especie['foto'] : "/elverde/fotos_vivas/no_disp.png"; // Ruta de la imagen
            
            // Impresión de las tarjetas
            echo '<section id="card" class="card">';
            echo '<img src=' . $foto . ' alt="Card Image">';
            echo '<div class="card-content">';
            echo '<em><div class="card-title">' . $especie_nombre . '</div></em><div class="card-title"> - ' . $autores . '</div>';
            echo '<div class="not-seen-title" style="display: none;">'. $especie_nombre_E .'</div>';
            echo '<p class="card-paragraph"><strong>Sinónimos: </strong> ' . $sinonimos_formateados . '</p>';
            echo '<p class="card-paragraph"><strong>Familia: </strong><em>' . $familia . '</em></p>';
            echo '<p class="card-paragraph"><strong>Nombre Común: </strong> ' . $nombre_comun . '</p>';

            // Establecer la dirección de las fotos de los especímenes
            echo '<h1 class="card-subheading">Especímenes:</h1>';
            echo '<ol class="card-elements" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-gap: 10px;">';
            foreach ($datos_especie['collectors'] as $id => $collector) {

                $collector_E = openssl_encrypt($collector, AES, KEY, 0);
                $ID = $datos_especie['id'][$id];
                $id_E = openssl_encrypt($ID, AES, KEY, 0);
                echo '<li class="card-element" style="margin-bottom: 10px; color: #4FA858;"><a href="info_especimen.php?especimen=' . urlencode($collector_E) . '&especie=' . urlencode($especie_nombre_E) . '&id=' . urlencode($id_E) . '" class="card-link">' . $collector . ' - ' . $datos_especie['number'][$id] . '</a></li>';
            }
            echo '</ol>';

            echo '</div>';
            echo '</div>';
            echo '</section>';
            $resultadosEncontrados = true;

            
        } 
    }
    if (!$resultadosEncontrados) {
        echo "<div style='display: flex; justify-content: center; align-items: center;'><div>No se encontraron resultados</div></div>";
    }
    
    } else {
        echo "No se encontraron resultados";
    }
    echo '<br>';
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

?>

