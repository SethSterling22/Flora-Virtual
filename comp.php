<?php
// Ruta de las imágenes originales
$rutaOriginal = '../Images_elverde/';
// Ruta de las imágenes comprimidas
$rutaComprimida = '../Images_comp/';
// Calidad de compresión
$calidad = 25;

// Obtener la lista de archivos en la carpeta original
$archivos = glob($rutaOriginal . '*.jpg');

foreach ($archivos as $archivo) {
    echo $archivo;
    // Obtener el nombre del archivo
    $nombreArchivo = basename($archivo);
    
    // Ruta de la imagen original
    $imagenOriginal = $rutaOriginal . $nombreArchivo;

    // Ruta de la imagen comprimida
    $imagenComprimida = $rutaComprimida . $nombreArchivo;

    // Copiar la imagen original a la carpeta de destino
    copy($imagenOriginal, $imagenComprimida);

    // Cargar la imagen original
    $imagen = imagecreatefromjpeg($imagenOriginal);

    // Guardar la imagen comprimida
    imagejpeg($imagen, $imagenComprimida, $calidad);

    // Liberar memoria
    imagedestroy($imagen);

    echo 'Imagen comprimida creada exitosamente: ' . $imagenComprimida . '<br>';
}

echo 'Proceso de compresión de imágenes completado.';
?>