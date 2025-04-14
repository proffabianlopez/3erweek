<?php
$fileCsv= "./Data/datos.txt";
$fileRubro = "./File/generos.dat";
$filePivote= "./File/pivote.dat";

$archivo = fopen($fileCsv, "r");

if (!$archivo) {
    die("No se pudo abrir el archivo datos.txt");
    exit;
}

$rubros = [];
$salida = [];
$log = [];
$line_error = 0;

while (($campos = fgetcsv($archivo, 0, "|")) !== false) {
    $line_error++;
    if(count($campos) < 11) {
        $log[] = "Línea $line_error: Menos de 11 campos encontrados.";
        continue;
    }
    $rubro = trim($campos[5]);
    if ($rubro === ""){
        $log[] = "Línea $line_error: Rubro vacío";
    } 
    if (!in_array($rubro, $rubros)) {
        $rubros[] = $rubro;
    }
    $idRubro = array_search($rubro, $rubros);
    $salida[] = implode("|", $campos);
}
fclose($archivo);

$archivoPivote = fopen($filePivote, "w");
foreach ($salida as $linea) {
    fwrite($archivoPivote, $linea . PHP_EOL);
}
fclose($archivoPivote);
file_put_contents("$fileRubro", implode(PHP_EOL, $rubros));
if (!empty($log)) {
    file_put_contents("./File/ErrorRubro.log", implode(PHP_EOL, $log));
}

echo "✅ Archivos generados correctamente, lista de generos\n";
if (!empty($log)) {
echo " ⚠️ Hay archivos que no tienen genero cargado\n";
}
?>