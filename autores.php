<?php
$fileCsv= "./Data/datos.txt";
$fileAutor = "./File/autor.dat";
$filePivote= "./File/pivote.dat";

$archivo = fopen($fileCsv, "r");

if (!$archivo) {
    die("No se pudo abrir el archivo datos.txt");
    exit;
}

$autores = [];
$salida = [];
$log = [];
$line_error = 0;

while (($campos = fgetcsv($archivo, 0, "|")) !== false) {
    $line_error++;
    if(count($campos) < 11) {
        $log[] = "Línea $line_error: Menos de 11 campos encontrados.";
        continue;
    }
    $autor = trim($campos[4]);
    if ($autor === "") {
        $log[] = "Línea $line_error: Autor vacío";
    }
    if (!in_array($autor, $autores)) {
        $autores[] = $autor;
    }
    $idAutor = array_search($autor, $autores);//busca un valor determinado en un array y devuelve la primera clave correspondiente en caso de éxito //si el valor no esta en la lista lo agrega y busca su indice como id
    $campos[4] = $idAutor;
    $salida[] = implode("|", $campos);
}
fclose($archivo);

$filePivote = fopen("./File/pivote.dat", "w");
foreach ($salida as $linea) {
    fwrite($filePivote, $linea . PHP_EOL);
}
fclose($filePivote);
file_put_contents("$fileAutor", implode(PHP_EOL, $autores));
if (!empty($log)) {
    file_put_contents("./File/ErrorAutor.log", implode(PHP_EOL, $log));
}

echo "✅ Archivos generados correctamente, lista de autores:\n";
if (!empty($log)) {
echo " ⚠️ Hay archivos que no tienen autor cargado\n";
}
?>