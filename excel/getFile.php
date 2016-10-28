<?php
if (file_exists($file)) { 
    $filename = basename($file); 
    $size = filesize($file); 
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Length: $size"); 
    header("Charset: UTF-8"); 
    header("Content-Type: application/unknown"); 
    if (@readfile($file)) { 
        unlink($file); 
    } 
}
?>