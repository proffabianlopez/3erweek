<?php
function buscarIdenArchivo($archivo, $valorBuscado) {
    $handle = fopen($archivo, 'r');
    if ($handle) {
        while (($linea = fgets($handle)) !== false) {
            $partes = explode('|', trim($linea));
            if (count($partes) === 2) {
                $codigo = trim($partes[0]);
                $nombre = trim($partes[1]);
                if ($nombre === $valorBuscado) {
                    fclose($handle);
                    return $codigo;
                }
            }
        }
        fclose($handle);
    }
    return 0; 
}

$archivoCsv = './Data/BIBLIO.TXT';   
$archivoSalida = './Data/Biblio.dat';
$delimitador = ',';                 

$entrada = fopen($archivoCsv, 'r');
$salida = fopen($archivoSalida, 'w');

if ($entrada && $salida) {
    while (($data = fgetcsv($entrada, 0, $delimitador)) !== false) {
        if (count($data) < 11) {
            continue;
        }

        $autor     = trim($data[4]);
        $rubro     = trim($data[5]);
        $editorial = trim($data[6]);
        var_dump($data[2]);
        $idAutor     = buscarIdenArchivo("./Data/Autores.dat", $autor);
        $idRubro     = buscarIdenArchivo("./Data/Rubros.dat", $rubro);
        $idEditorial = buscarIdenArchivo("./Data/Editoriales.dat", $editorial);

        $data[4] = $idAutor;
        $data[5] = $idRubro;
        $data[6] = $idEditorial;

        // Escribir línea en formato pipe separado
        $linea = implode('|', $data) . PHP_EOL;
        fwrite($salida, $linea);
    }

    fclose($entrada);
    fclose($salida);
    echo "Archivo Biblio.dat generado correctamente.\n";
} else {
    echo "No se pudo abrir el archivo de entrada o salida.\n";
}
