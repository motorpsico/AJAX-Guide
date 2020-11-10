<?php
    $filehandle = fopen("https://www.google.com/search?q=meristation+pc", "r");
    while (!feof($filehandle)){
        $download = fgets($filehandle);
        echo $download;
    }
    // $download = fgets($filehandle);
    // echo $download;
    fclose($filehandle);
?>
 