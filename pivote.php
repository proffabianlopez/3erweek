<?php

$archivoCSV = './Data/BIBLIO.TXT';
$delimitador = ","; 

$archivoAutores = './Data/Autores.dat';
$archivoRubros = './Data/Rubros.dat';
$archivoEditoriales = './Data/Editoriales.dat';

$autores = [];
$rubros = [];
$editoriales = [];

if (($handle = fopen($archivoCSV, "r")) !== false) {
    while (($data = fgetcsv($handle, 0, $delimitador)) !== false) {
        if (count($data) < 7) {
            continue;
        }

        $autor = trim($data[4]);
        $rubro = trim($data[5]);
        $editorial = trim($data[6]);

        if ($autor !== "" && !isset($autores[$autor])) {
            $autores[$autor] = count($autores) + 1;
        }

        if ($rubro !== "" && !isset($rubros[$rubro])) {
            $rubros[$rubro] = count($rubros) + 1;
        }

        if ($editorial !== "" && !isset($editoriales[$editorial])) {
            $editoriales[$editorial] = count($editoriales) + 1;
        }
    }

    fclose($handle);
} else {
    die("No se pudo abrir el archivo CSV.\n");
}

function creoArchivo($nombreArchivo, $datos) {
    $f = fopen($nombreArchivo, 'w');
    foreach ($datos as $nombre => $codigo) {
        fwrite($f, str_pad($codigo,7,"0",STR_PAD_LEFT) . "|" . $nombre . PHP_EOL);
    }
    fclose($f);
}
// Crear archivos pivote
creoArchivo($archivoAutores, $autores);
creoArchivo($archivoRubros, $rubros);
creoArchivo($archivoEditoriales, $editoriales);

echo "Archivos generados:\n- $archivoAutores\n- $archivoRubros\n- $archivoEditoriales\n";
