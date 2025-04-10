<?php
$origen = __DIR__ . '/Data/datos.txt';
$salida = __DIR__ . '/Data/editoriales.dat';

$lineas = file($origen);
$editorialesUnicas = [];

foreach ($lineas as $linea) {
    $campos = explode('|', trim($linea));
    $editorial = isset($campos[6]) ? strtoupper(trim($campos[6])) : 'SIN DATOS';
    if ($editorial === '') $editorial = 'SIN DATOS';

    if (!in_array($editorial, $editorialesUnicas)) {
        $editorialesUnicas[] = $editorial;
    }
}

$archivo = fopen($salida, 'w');
foreach ($editorialesUnicas as $i => $editorial) {
    fwrite($archivo, ($i + 1) . '|' . $editorial . PHP_EOL);
}
fclose($archivo);
echo 'Archivo editoriales.dat generado.';
