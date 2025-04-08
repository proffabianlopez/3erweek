<?php
function generar_pivote($archivo_entrada, $archivo_salida, $indice_campo)
{
  $file = fopen($archivo_entrada, "r");
  if (!$file) {
    die("No se pudo abrir el archivo.");
  }
  
  $valores_unicos = [];
  
  while (($line = fgets($file)) !== false) {
    $fields = explode("|", trim($line));
    if (isset($fields[$indice_campo])) {
      $valor = trim($fields[$indice_campo]);

      if ($valor === '') {
        $valor = "SIN DATOS";
      } else {
        $valor = strtoupper($valor);
      }
      $valores_unicos[$valor] = true;
    } else {
      $valores_unicos["SIN DATOS"] = true;
    }
  }
  fclose($file);
  
  $valores = array_keys($valores_unicos);
  sort($valores);
  
  $pivot_file = fopen($archivo_salida, "w");
  if (!$pivot_file) {
    die("No se pudo abrir el archivo de salida.");
  }
  
  $id = 1;
  
  foreach ($valores as $valor) {
    fwrite($pivot_file, $id . "|" . $valor . PHP_EOL);
    $id++;
  }
  
  fclose($pivot_file);
}

generar_pivote("Data/datos.txt", "Data/Generos.Dat", 5);
echo "\033[32mArchivo Generos.Dat creado exitosamente\033[0m";