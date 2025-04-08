<?php
$archivoCsv = './Data/BIBLIO.TXT';
$archivoSalida = './Data/Biblio.dat';
$delimitador = ','; 

$entrada = fopen($archivoCsv, 'r');
$salida = fopen($archivoSalida, 'w');

$autores = cargarPivote("./Data/Autores.dat");
$rubros = cargarPivote("./Data/Rubros.dat");
$editoriales = cargarPivote("./Data/Editoriales.dat");

if ($entrada && $salida) {
    while (($data = fgetcsv($entrada, 0, $delimitador)) !== false) {
        if (count($data) < 11) {
            continue;
        }

        $autor = trim($data[4]);
        $rubro = trim($data[5]);
        $editorial = trim($data[6]);
        
        var_dump($data[2]);

        $idAutor = $autores[$autor] ?? 0;
        $idRubro = $rubros[$rubro] ?? 0;
        $idEditorial = $editoriales[$editorial] ?? 0;

        // Reemplazar los campos de texto por los IDs
        $data[4] = $idAutor;
        $data[5] = $idRubro;
        $data[6] = $idEditorial;

        // Escribir como línea separada por |
        $linea = implode('|', $data) . PHP_EOL;
        fwrite($salida, $linea);
    }

    fclose($entrada);
    fclose($salida);
    echo "Archivo Biblio.dat generado correctamente.\n";
} else {
    echo "No se pudo abrir el archivo de entrada o salida.\n";
}

function cargarPivote($archivo) {
    $mapa = [];
    $handle = fopen($archivo, 'r');
    if ($handle) {
        while (($linea = fgets($handle)) !== false) {
            $partes = explode('|', trim($linea));
            if (count($partes) === 2) {
                $codigo = (int) trim($partes[0]);
                $nombre = trim($partes[1]);
                $mapa[$nombre] = $codigo;
            }
        }
        fclose($handle);
    }
    return $mapa;
}