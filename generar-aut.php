<?php
$input = file("Data/data/datos1.txt");
$valores = [];
foreach ($input as $line)
 {
    $campos = explode("|", trim($line));
    $Autor = isset($campos[4]) && trim($campos[4]) !== '' ? strtoupper(trim($campos[4])) : "SIN DATOS"; 

    $valores[$Autor] = true;
}

$valores = array_keys($valores);
sort($valores);
$output = fopen("autores.dat", "w");
$id = 1; // id =1 
foreach ($valores as $valor)
{
    fwrite($output, $id . "|" . $valor . PHP_EOL);
    $id++;
}
fclose($output);
?>