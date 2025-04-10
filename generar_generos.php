<?php
$origen = __DIR__ . '/Data/datos.txt';
$salida = __DIR__ . '/Data/generos.dat';

$lineas = file($origen);
$generosUnicos = [];

foreach ($lineas as $linea) {
    $campos = explode('|', trim($linea));
    $genero = isset($campos[5]) ? strtoupper(trim($campos[5])) : 'SIN DATOS';
    if ($genero === '') $genero = 'SIN DATOS';

    if (!in_array($genero, $generosUnicos)) {
        $generosUnicos[] = $genero;
    }
}

$archivo = fopen($salida, 'w');
foreach ($generosUnicos as $i => $genero) {
    fwrite($archivo, ($i + 1) . '|' . $genero . PHP_EOL);
}
fclose($archivo);
echo 'Archivo Generos.Dat generado.';
