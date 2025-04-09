<?php
$input = file("Data/data/datos1.txt");
$valores = []; 
foreach ($input as $line) 
 {
    $campos = explode("|", trim($line)); 
    $Edit = isset($campos[6]) && trim($campos[6]) !== '' ? strtoupper(trim($campos[6])) : "SIN DATOS"; 
    $valores[$Edit] = true; 
}

$valores = array_keys($valores); 
sort($valores);
$output = fopen("editoriales.dat", "w"); 
$id = 1; // id =1 
foreach ($valores as $valor) 
{
    fwrite($output, $id . "|" . $valor . PHP_EOL); 
    $id++;
}
fclose($output);
?>