<?php
$input = file("Data/data/datos1.txt");
$valores = []; 
foreach ($input as $line) 
 {
    $campos = explode("|", trim($line)); 
    $Genero = isset($campos[5]) && trim($campos[5]) !== '' ? strtoupper(trim($campos[5])) : "SIN DATOS"; 
    $valores[$Genero] = true; 
}

$valores = array_keys($valores); 
sort($valores);
$output = fopen("Genero.dat", "w"); 
$id = 1; 
foreach ($valores as $valor) 
{
    fwrite($output, $id . "|" . $valor . PHP_EOL); 
    $id++;
}
fclose($output);
?>