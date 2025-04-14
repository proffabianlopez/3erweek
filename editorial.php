<?php
$fileCsv = "./Data/datos.txt";
$fileEditorial = "./File/editorial.dat";
$filePivote = "./File/pivote.dat";

$archivo = fopen($fileCsv, "r");
if (!$archivo) {
    die("No se pudo abrir el archivo pivote.dat");
}

$editoriales = [];
$salida = [];
$log = [];
$line_error = 0;

while (($campos = fgetcsv($archivo, 0, "|")) !== false) {
    $line_error++;
    if (count($campos) < 11) {
        $log[] = "Línea $line_error: Menos de 11 campos.";
        continue;
    }
    $editorial = trim($campos[6]);
    if ($editorial === "") {
        $log[] = "Línea $line_error: Editorial vacía";
    }
    if (!in_array($editorial, $editoriales)) {
        $editoriales[] = $editorial;
    }
    $idEditorial = array_search($editorial, $editoriales);
    $campos[6] = $idEditorial;
    $salida[] = implode("|", $campos);
}
fclose($archivo);

$archivoPivote = fopen($filePivote, "w");
foreach ($salida as $linea) {
    fwrite($archivoPivote, $linea . PHP_EOL);
}
fclose($archivoPivote);

file_put_contents("$fileEditorial", implode(PHP_EOL, $editoriales));
    if (!empty($log)) {
        file_put_contents("./File/ErrorEditoriales.log", implode(PHP_EOL, $log));
    }

echo "✅ Archivos generados correctamente, lista de editoriales\n";

if (!empty($log)) {
echo " ⚠️ Hay archivos que no tienen editorial cargado\n";
}
?>
