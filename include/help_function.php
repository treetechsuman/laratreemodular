<?php

function copyr($source, $dest) 
{ 
    // Simple copy for a file 
    if (is_file($source)) { 
        return copy($source, $dest); 
    } 
  
    // Make destination directory 
    if (!is_dir($dest)) { 
        mkdir($dest); 
    } 
  
    // Loop through the folder 
    $dir = dir($source); 
    while (false !== $entry = $dir->read()) { 
        // Skip pointers 
        if ($entry == '.' || $entry == '..') { 
            continue; 
        } 
  
        // Deep copy directories 
        if ($dest !== "$source/$entry") { 
            copyr("$source/$entry", "$dest/$entry"); 
        } 
    } 
  
    // Clean up 
    $dir->close(); 
    return true; 
} 
?>