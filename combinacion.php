<?php
$fileCsv= "./Data/datos.txt";
$fileRubro = "./File/rubros.txt";
$fileEditorial = "./File/editoriales.txt";
$fileAutor = "./File/autores.txt";

$archivo = fopen($fileCsv, "r");

if (!$archivo) {
    die("No se pudo abrir el archivo datos.txt");
    exit;
}

$autores = [];
$rubros = [];
$editoriales = [];
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
    $rubro = trim($campos[5]);
    $editorial = trim($campos[6]);
    if ($autor === "") $log[] = "Línea $line_error: Autor vacío";
    if ($rubro === "") $log[] = "Línea $line_error: Rubro vacío";
    if ($editorial === "") $log[] = "Línea $line_error: Editorial vacío";

    // Generar ID
    if (!in_array($autor, $autores)) {
        $autores[] = $autor;
    }
    $id_autor = array_search($autor, $autores);//busca un valor determinado en un array y devuelve la primera clave correspondiente en caso de éxito //si el valor no esta en la lista lo agrega y busca su indice como id
    if (!in_array($rubro, $rubros)) {
        $rubros[] = $rubro;
    }
    $id_rubro = array_search($rubro, $rubros);
    if (!in_array($editorial, $editoriales)) {
        $editoriales[] = $editorial;
    }
    $id_editorial = array_search($editorial, $editoriales);

    // Reemplazar los valores por IDs
    $campos[4] = $id_autor;
    $campos[5] = $id_rubro;
    $campos[6] = $id_editorial;
    $salida[] = implode("|", $campos);
}
fclose($archivo);

// Escribir archivo transformado
$salida_archivo = fopen("./File/datos_transformados.txt", "w");
foreach ($salida as $linea) {
    fwrite($salida_archivo, $linea . PHP_EOL);
}
fclose($salida_archivo);
file_put_contents("$fileAutor", implode(PHP_EOL, $autores));
file_put_contents("$fileRubro", implode(PHP_EOL, $rubros));
file_put_contents("$fileEditorial", implode(PHP_EOL, $editoriales));

if (!empty($log)) {
    file_put_contents("./File/log_errores.txt", implode(PHP_EOL, $log));
}


echo "✅ Archivos generados correctamente:\n";
echo "- datos_transformados.txt\n";
echo "- autores.txt\n";
echo "- rubros.txt\n";
echo "- editoriales.txt\n";
if (!empty($log)) {
    echo "- log_errores.txt (con advertencias)\n";
}
?>
