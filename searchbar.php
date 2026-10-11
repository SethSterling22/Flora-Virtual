<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<?php  // Crear el query que traiga todos los nombres de las familias y las especies con sus respectivas relaciones
    $consulta = "SELECT especies.nombre_cientifico, familias.familia FROM especies, familias";

    $resultados = $conn->query($consulta);
    echo '<section class="search-bar">';
    if ($resultados->num_rows > 0) {
        $familias = array();
        $especies = array();
    
        // Obtener todas las familias
        $consultaFamilias = "SELECT DISTINCT familia FROM familias";
        $resultadosFamilias = $conn->query($consultaFamilias);
        while ($row = $resultadosFamilias->fetch_assoc()) {
            $familias[] = $row['familia'];
        }
    
        // Obtener todas las especies
        $consultaEspecies = "SELECT DISTINCT nombre_cientifico FROM especies";
        $resultadosEspecies = $conn->query($consultaEspecies);
        while ($row = $resultadosEspecies->fetch_assoc()) {
            $especies[] = $row['nombre_cientifico'];
        }
    
        // Desplegar la barra de búsqueda
        
        echo '<label class="input-search">';
        echo '<input type="text" placeholder="Busca por familia o especie..." id="searchInput" />';
        echo '<div class="search-btn">';
        echo '<i class="fa fa-search" style="color: #9e9ea7;"></i></div>';
        echo '<div class="search-menu" id="searchMenu">';
        echo '<div class="columns" id="columns">';
        // Desplegar el menú de búsqueda con sus dos columnas
        echo '<div class="column" id="column">';
        echo '<h2>Familias</h2>';
        foreach ($familias as $familia) {
            echo '<a href="familias.php?famref=' . urlencode($familia) . '"><p>' . $familia . '</p></a>';
        }
        echo '</div>';
        echo '<div class="column">';
        echo '<h2>Especies</h2>';
        foreach ($especies as $especie) {
            echo '<a href="info_especie.php?especie=' . urlencode(openssl_encrypt($especie, AES, KEY, 0)) . '"><p>' . $especie . '</p></a>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</label>';
        echo '</section>';
    } else {
        echo "<p style='margin: 10px; margin-left: 20px; text-align: center;'>No se encontraron resultados</p>";
    }

// Cerrar la conexión a la base de datos
mysqli_close($conn);

?>

<script>
function handleSearchChange() {
    var searchTerm = document.getElementById('searchInput').value.toLowerCase();
    var columnFamilias = document.querySelector('.column:nth-child(1)');
    var columnEspecies = document.querySelector('.column:nth-child(2)');
    var familias = columnFamilias.getElementsByTagName('p');
    var especies = columnEspecies.getElementsByTagName('p');

    // Convertir los elementos HTMLCollection en arrays para poder utilizar el método sort()
    familias = Array.from(familias);
    especies = Array.from(especies);

    // Ordenar los elementos alfabéticamente
    familias.sort(function(a, b) {
        return a.innerHTML.toLowerCase().localeCompare(b.innerHTML.toLowerCase());
    });

    especies.sort(function(a, b) {
        return a.innerHTML.toLowerCase().localeCompare(b.innerHTML.toLowerCase());
    });

    // Filtrar los resultados en tiempo real
    var resultadosEncontrados = false; // Variable para verificar si se encontraron resultados

    for (var i = 0; i < familias.length; i++) {
        var fieldValue = familias[i].innerHTML.toLowerCase();

        if (fieldValue.startsWith(searchTerm)) {
            familias[i].style.display = 'block'; // Mostrar el resultado
            resultadosEncontrados = true; // Se encontró al menos un resultado
        } else {
            familias[i].style.display = 'none'; // Ocultar el resultado
        }
    }

    for (var i = 0; i < especies.length; i++) {
        var fieldValue = especies[i].innerHTML.toLowerCase();

        if (fieldValue.startsWith(searchTerm)) {
            especies[i].style.display = 'block'; // Mostrar el resultado
            resultadosEncontrados = true; // Se encontró al menos un resultado
        } else {
            especies[i].style.display = 'none'; // Ocultar el resultado
        }
    }

    // Mostrar mensaje de "No se han encontrado resultados" si no se encontraron resultados
    var searchMenu = document.querySelector('.search-menu');
    var noResultsMessage = searchMenu.getElementsByClassName('no-results-message')[0];

    if (!resultadosEncontrados) {
        // Verificar si el mensaje ya está presente antes de agregarlo
        if (!noResultsMessage) {
            noResultsMessage = document.createElement('p');
            noResultsMessage.classList.add('no-results-message');
            noResultsMessage.innerHTML = ".\tNo se han encontrado resultado";
            searchMenu.appendChild(noResultsMessage);
        }
    } else {
        // Eliminar el mensaje si se encontraron resultados
        if (noResultsMessage) {
            searchMenu.removeChild(noResultsMessage);
        }
    }
}

document.getElementById('searchInput').addEventListener('input', handleSearchChange);

</script>
