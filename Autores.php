<?php
function generar_tabla_pivote($archivo_entrada, $archivo_salida, $indice_campo)
{
  $archivo = fopen($archivo_entrada, "r");
  if (!$archivo) {
    die("No se pudo abrir el archivo.");
  }
  
  $valores_unicos = [];
  
  while (($linea = fgets($archivo)) !== false) {
    $campos = explode("|", trim($linea));
    
    if (count($campos) < 7) {
      continue;
    }
    
    if (isset($campos[$indice_campo])) {
      $valor = trim($campos[$indice_campo]);
      if ($valor === '') {
        $valor = "SIN DATOS";
      } else {
        $valor = strtoupper($valor);
      }
      
      if (!isset($valores_unicos[$valor])) {
        $valores_unicos[$valor] = count($valores_unicos) + 1;
      }
    } else {
      if (!isset($valores_unicos["SIN DATOS"])) {
        $valores_unicos["SIN DATOS"] = count($valores_unicos) + 1;
      }
    }
  }
  fclose($archivo);
  
  $archivo_pivote = fopen($archivo_salida, "w");
  if (!$archivo_pivote) {
    die("No se pudo abrir el archivo de salida.");
  }
  
  foreach ($valores_unicos as $valor => $id) {
    fwrite($archivo_pivote, str_pad($id, 7, "0", STR_PAD_LEFT) . "|" . $valor . PHP_EOL);
  }
  
  fclose($archivo_pivote);
}

generar_tabla_pivote("Data/datos.txt", "Data/Autores.Dat", 4);
echo "\033[32mArchivo Autores.Dat creado exitosamente\033[0m";