<?php
$ruta = __DIR__ . '/BIBLIO.TXT';
$salida = __DIR__ . '/Data/datos.txt';

if (!file_exists($ruta)) {
    die('Archivo BIBLIO.TXT no encontrado.');
}

$lineas = file($ruta);
$archivoSalida = fopen($salida, 'w');

foreach ($lineas as $linea) {
    $linea = trim($linea);
    
    $linea = str_replace('"', '', $linea);
    $campos = str_getcsv($linea, ',');

    $campos = array_pad($campos, 11, 'SIN DATOS');

    $campos = array_map(function($campo) {
        $campo = trim($campo);
        return $campo === '' ? 'SIN DATOS' : $campo;
    }, $campos);

    fwrite($archivoSalida, implode('|', $campos) . PHP_EOL);
}

fclose($archivoSalida);
echo 'Archivo datos.txt generado correctamente.';
