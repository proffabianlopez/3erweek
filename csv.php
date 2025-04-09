<?php
$archivoCsv = "./data/EXPORTED.TXT";
$archivoSalida = './data/export_modificado.txt';
$logErrores = './data/errores.log';
if (is_readable($archivoCsv)) {
    $copiaArchivo = fopen($archivoCsv, "r");
    if ($copiaArchivo) {
        $lineas = [];
        $numeroLinea=0;
        while (!feof($copiaArchivo)) {
            $linea = fgets($copiaArchivo);
            $numeroLinea++;
            if ($linea === false) {
                $timestamp = date("Y-m-d H:i:s");
                file_put_contents(
                    $logErrores,
                    "Error al leer línea".$numeroLinea." desde $archivoCsv\n",
                    FILE_APPEND
                );
                continue;
            }
            $linea = preg_replace('/,(?=")/', '|', $linea); // reemplaza coma si luego hay comilla
            $linea = str_replace('"', '', $linea); // elimina comillas dobles
            $linea = str_replace('�', 'N', $linea); // reemplaza caracter especial
            $lineas[] = $linea;
        }
        fclose($copiaArchivo);
        file_put_contents($archivoSalida, implode('', $lineas));
        echo "Archivo procesado y guardado como '$archivoSalida'.\n";
    } else {
        echo "No se pudo abrir el archivo '$archivoCsv'.\n";
    }
} else {
    echo "El archivo original '$archivoCsv' no existe o no es legible.\n";
}
