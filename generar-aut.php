<?php
$input = file("Data/data/datos1.txt");// ruta del archivo dato
$valores = []; // array para guardar  los datos
foreach ($input as $line) // ectrutura de repeticion para  leer  el archivo linea por linea
 {
    $campos = explode("|", trim($line)); //  variable que explora  los campos en las lineas por  |
    $Genero = isset($campos[4]) && trim($campos[4]) !== '' ? strtoupper(trim($campos[4])) : "SIN DATOS"; //guarda en variable genero  cada campo  que le solicito y si no esta  da sin datos 
    $valores[$Genero] = true; // validacion para que no se repita  los datos
}

$valores = array_keys($valores); // vuelvo asociativo el array
sort($valores);//ordeno alfabeticamente
$output = fopen("autores.dat", "w"); // creo el  archivo genero.dat
$id = 1; // id =1 
foreach ($valores as $valor) // ciclo de repeticion para leer  el array
{
    fwrite($output, $id . "|" . $valor . PHP_EOL); // recorre y agrega ||
    $id++;// incrementa el id 
}
fclose($output);// se cierra el archivo genero.dat
?>