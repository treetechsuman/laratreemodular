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

function enum_select( $table , $field ){
    $con=mysqli_connect(Host,User,Password,Db);
    $query = " SHOW COLUMNS FROM `$table` LIKE '$field' ";
    $result = mysqli_query($con, $query ) or die( 'error getting enum field ' . mysql_error() );
    $row = mysqli_fetch_array( $result );
    #extract the values
    #the values are enclosed in single quotes
    #and separated by commas
    $regex = "/'(.*?)'/";
    preg_match_all( $regex , $row[1], $enum_array );
    $enum_fields = $enum_array[1];
    return( $enum_fields );
}
?>