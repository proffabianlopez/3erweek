<?php
    $archivo = fopen("data/datos.TXT","r");

    $id = 0;
    $i  = 0;
    $aunic =[];
    
    $autores = fopen("data/autores.dat","w"); 
    
    while ( ( $linea = fgets($archivo)) !== false ){
        $campo = explode("|",$linea);
        $aIndiv = $campo[4];
        if (!isset($aunic[$aIndiv])){ 

    fwrite($autores,$id . "|" . $campo[4]."\n");
            $aunic[$aIndiv] = true;
            $id++;
        }   
} 
    fclose($autores);

    fclose($archivo);

    //script editoriales

    $archivo = fopen("data/datos.TXT","r");

    $id = 0;
    $i  = 0;
    $editorialesU =[];
    
    $editoriales = fopen("data/editoriales.dat","w"); 
    
    while ( ( $linea = fgets($archivo)) !== false ){
        $campo = explode("|",$linea);
        $editorialesI = $campo[5];
        if (!isset($editorialesU [$editorialesI])){ 

    fwrite($editoriales,$id . "|" . $campo[5]."\n");
            $editorialesU [$editorialesI] = true;
            $id++;
        }   
} 
    fclose($editoriales);

    fclose($archivo);


    // script generos


    $archivo = fopen("data/datos.TXT","r");

    $id = 0;
    $i  = 0;
    $generosunicos = [];
    
    $generos  = fopen("data/generos.dat","w"); 
    
    while ( ( $linea = fgets($archivo)) !== false ){
        $campo = explode("|",$linea);
        $generosI = $campo[3];
        if (!isset($generosunicos [$generosI])){ 

    fwrite($generos,$id . "|" . $campo[3]."\n");
            $generosunicos [$generosI] = true;
            $id++;
        }   
} 
    fclose($generos);
    fclose($archivo);

?>