<?php
// Incluir conexión a la base de datos y configuración para variables de enciptación
include("connection/connection.php");
include("connection/config.php");

// Verificar si se han recibido los parámetros y asignarles valor por defecto
$codigo = isset($_POST["code"]) ? $_POST["code"] : null;
$especie = isset($_POST["species"]) ? $_POST["species"] : null;
$division = isset($_POST["division"]) ? $_POST["division"] : null;
$familia = isset($_POST["familiy"]) ? $_POST["familiy"] : null;
$genero = isset($_POST["genus"]) ? $_POST["genus"] : null;
$colector = isset($_POST["collector"]) ? $_POST["collector"] : null;


// Parámetro que establece a qué query entrará
$query =  isset($_POST["query"]) ? $_POST["query"] : null;

////////////////////////// Consulta para llevar las tarjetas de especimen //////////////////////////

// Comprobación que al menos un parámetro no sea NULL
if ($codigo != null || $especie != null || $division != null || $familia != null || $genero != null || $colector != null) {
$consulta = "SELECT id, photoname, species, collected, collector, geodata, number FROM especimenes_fotos WHERE 1=1";

if ($codigo !== null) {
    $consulta .= " AND code = '$codigo'";
}
if ($especie !== null) {
    $consulta .= " AND species = '$especie'";
}
if ($division !== null) {
    $consulta .= " AND division = '$division'";
}
if ($familia !== null) {
    $consulta .= " AND familiy = '$familia'";
}
if ($genero !== null) {
    $consulta .= " AND genus = '$genero'";
}
if ($colector !== null) {
    $consulta .= " AND collector = '$colector'";
}

// Realizar la consulta a la base de datos y obtener los resultados
$resultado = $conn->query($consulta);
$count = mysqli_num_rows($resultado);

echo '<p id="mensaje" style="justify-content: center; text-align:center;">Hay '. $count .' especímenes con estas características</p>';

// Cierre de Conexión
mysqli_close($conn);

// Asignar los resultados a variables individuales
while ($fila = mysqli_fetch_assoc($resultado)) {
    $id = $fila['id'];
    $species = $fila['species'];
    $collected = $fila['collected'];
    $detby = $fila['collector'];
    $geodata = $fila['geodata'];
    $number = $fila['number'];
    $geodata =  utf8_decode($geodata); 
    $foto = $fila['photoname'] ? "/Images_elverde/thumb/JPEG/" . $fila['photoname'] : "/elverde/fotos_vivas/no_disp.png";
    $number_E = openssl_encrypt($number, AES, KEY, 0);
    $especie_E = openssl_encrypt($species, AES, KEY, 0);
    $id_E = openssl_encrypt($id, AES, KEY, 0);
    $collector_E = openssl_encrypt($detby, AES, KEY, 0);

echo '<section class="cards-container">';
echo '<section class="card" style="cursor: pointer;" onclick="redirigir(\'' . $id_E . '\', \'' . $especie_E . '\', \'' . $collector_E . '\', \'' . $number_E . '\')">';
echo '<img src="' . $foto . '" alt="Card Image" style="max-width: 150px; max-height: 200px">';
echo '<div class="card-content">';
echo '<em><div class="card-title">'. $species .'</em></div>';
echo '<p class="card-paragraph"><strong>Colector principal:</strong> '. $detby .'  - #'. $number .'</p>';
echo '<p class="card-paragraph"><strong>Fecha:</strong> '. $collected .'</p>';
echo '<p class="card-paragraph"><strong>Localidad:</strong> '. $geodata .'</p>';
echo '</div>'; // Cierre de contenedor
echo '</section></section>'; 
}}

?>
