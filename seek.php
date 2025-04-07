<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center text-primary">Buscar Libros</h2>
        <form action="seek.php" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="criterio" class="form-select" required>
                        <option value="">Seleccione criterio</option>
                        <option value="autor">Autor</option>
                        <option value="descripcion">Descripción</option>
                        <option value="editorial">Editorial</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="valor" class="form-control" placeholder="Ingrese el valor a buscar" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>
        <button type="sudmit" id="uno" name="uno">UNO</button>
        
        
            
            

            <h4 class="text-secondary">Resultados en DataTable:</h4>
            <table id="datatable" class="display">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>ISBN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $libro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($libro[0]); ?></td>
                            <td><?php echo htmlspecialchars($libro[2]); ?></td>
                            <td><?php echo htmlspecialchars($libro[4]); ?></td>
                            <td><?php echo htmlspecialchars($libro[6]); ?></td>
                            <td><?php echo htmlspecialchars($libro[9]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        
        <?php
        $input = file("Data/datos.txt");
        $valores = [];
        foreach ($input as $line) {
            $campos = explode("|", trim($line));
            $autor = isset($campos[4]) && trim($campos[4]) !== '' ? strtoupper(trim($campos[4])) : "SIN DATOS";
            $valores[$autor] = true;
        }
        
        $valores = array_keys($valores);
        sort($valores);
        $output = fopen("Autores.Dat", "w");
        $id = 1;
        foreach ($valores as $valor) {
            fwrite($output, $id . "|" . $valor . PHP_EOL);
            $id++;
        }
        fclose($output);
        
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
</body>
</html>
