<?php
include("connection/functions.php");

// Verificar si la extensión GD está cargada
if (!extension_loaded('gd')) {
    // Cargar la extensión GD
    if (!dl('gd.so')) {
        // No se pudo cargar la extensión GD
        die('La extensión GD no está habilitada');
    }
}

// Consulta para recibir la información del especímen en base al autor específico y nombre de especie
$consulta = "SELECT photoname FROM especimenes_fotos ORDER BY photoname ASC";
$resultados = $conn->query($consulta);

if ($resultados->num_rows > 0) {
    while ($row = $resultados->fetch_assoc()) {
        $foto = $row['photoname'] ? "/Images_elverde/" . $row['photoname'] : "/elverde/fotos_vivas/no_disp.png";

        // Ruta de la imagen comprimida
        $imagenComprimida = '/assets/images/especimen_thumbnail';

        // Cargar la imagen original
        $img = imagecreatefromjpeg($foto);

        // Obtener las dimensiones originales de la imagen
        $anchoOriginal = imagesx($img);
        $altoOriginal = imagesy($img);

        // Definir el nuevo tamaño de la imagen
        $nuevoAncho = $anchoOriginal * 0.5;
        $nuevoAlto = $altoOriginal * 0.5;

        // Crear una nueva imagen con el nuevo tamaño
        $nuevaImagen = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

        // Redimensionar la imagen original a la nueva imagen
        imagecopyresampled($nuevaImagen, $img, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $anchoOriginal, $altoOriginal);

        // Guardar la imagen comprimida
        imagejpeg($nuevaImagen, $imagenComprimida, 80); // 80 es la calidad de compresión (0-100)

        // Liberar memoria
        imagedestroy($img);
        imagedestroy($nuevaImagen);
    }
}

?>