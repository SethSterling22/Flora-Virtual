<?php
require("connection.php");

function sanitize($data)
{
	
$data = trim($data);

$data = stripslashes($data);

global $conn; // Variable de conexión global

$data = mysqli_real_escape_string($conn, $data); // Agregar "$conn"

return $data;

}
//Delete entire Directory
function deleteDir($dir){ 
    if (substr($dir, strlen($dir)-1, 1) != '/') 
        $dir .= '/'; 


    if ($handle = opendir($dir)) 
    { 
        while ($obj = readdir($handle)) 
        { 
            if ($obj != '.' && $obj != '..') 
            { 
                if (is_dir($dir.$obj)) 
                { 
                    if (!deleteDir($dir.$obj)) 
                        return false; 
                } 
                elseif (is_file($dir.$obj)) 
                { 
                    if (!unlink($dir.$obj)) 
                        return false; 
                } 
            } 
        } 

        closedir($handle); 

        if (!@rmdir($dir)) 
            return false; 
        return true; 
    } 
    return false; 
}  

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
?>
