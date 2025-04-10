<?php
$origen = __DIR__ . '/Data/datos.txt';
$salida = __DIR__ . '/Data/autores.dat';

$lineas = file($origen);
$autoresUnicos = [];

foreach ($lineas as $linea) {
    $campos = explode('|', trim($linea));
    $autor = isset($campos[4]) ? strtoupper(trim($campos[4])) : 'SIN DATOS';
    if ($autor === '') $autor = 'SIN DATOS';

    if (!in_array($autor, $autoresUnicos)) {
        $autoresUnicos[] = $autor;
    }
}

$archivo = fopen($salida, 'w');
foreach ($autoresUnicos as $i => $autor) {
    fwrite($archivo, ($i + 1) . '|' . $autor . PHP_EOL);
}
fclose($archivo);
echo 'Archivo autores.Dat generado.';
