<?php
function generar_pivote($archivo_entrada, $archivo_salida, $indice_campo)
{
  $file = fopen($archivo_entrada, "r");
  if (!$file) {
    die("No se pudo abrir el archivo.");
  }

  $pivot_file = fopen($archivo_salida, "w");
  if (!$pivot_file) {
    fclose($file);
    die("No se pudo abrir el archivo de salida.");
  }
  $id = 0;
  $valores_unicos = [];

  while (($line = fgets($file)) !== false) {
    $fields = explode("|", trim($line));

    if (isset($fields[$indice_campo])) {
      $valor = trim($fields[$indice_campo]);

      if (!isset($valores_unicos[$valor])) {
        fwrite($pivot_file, $id . "|" . $valor . "\n");
        $valores_unicos[$valor] = true;
        $id++;
      }
    }
  }

  fclose($file);
  fclose($pivot_file);
}

generar_pivote("Data/datos.txt", "Data/Editoriales.dat", 6);
echo "\033[32mArchivo Editoriales.dat creado exitosamente\033[0m";
