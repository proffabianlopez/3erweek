<?php
function generarPivote($archivoEntrada, $archivoSalida, $indiceCampo) {
    // Abre el archivo de entrada
    $file = fopen($archivoEntrada, "r");
    if (!$file) {
        die("No se pudo abrir el archivo.");
    }

    // Abre el archivo de salida (sobrescribe si ya existe)
    $pivotFile = fopen($archivoSalida, "w");
    if (!$pivotFile) {
        fclose($file);
        die("No se pudo abrir el archivo de salida.");
    }

    $id = 0;
    $valoresUnicos = [];

    // Procesa cada línea del archivo
    while (($line = fgets($file)) !== false) {
        $fields = explode("|", trim($line)); // Divide por "|"
        
        // Verifica que el campo con ese índice exista
        if (isset($fields[$indiceCampo])) {
            $valor = trim($fields[$indiceCampo]);

            // Verifica si ese valor ya fue registrado
            if (!isset($valoresUnicos[$valor])) {
                fwrite($pivotFile, $id . "|" . $valor . "\n");
                $valoresUnicos[$valor] = true;
                $id++;
            }
        }
    }

    // Cierra archivos
    fclose($file);
    fclose($pivotFile);

}

generarPivote("data/datos.txt", "data/autores.dat", 4);
generarPivote("data/datos.txt", "data/generos.dat", 5);
generarPivote("data/datos.txt", "data/editoriales.dat", 6);

echo "\033[32mArchivo creado exitosamente";
?>
