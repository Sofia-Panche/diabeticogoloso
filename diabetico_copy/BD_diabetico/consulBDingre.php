<?php
    $host = 'sql311.infinityfree.com';
    $username = 'if0_37008929';
    $password = 'Diabetic0G';
    $dbname = 'if0_37008929_diabetico_goloso';

    $hostPDO = "mysql:host=$host;dbname=$dbname;";
    $tuPDO = new PDO($hostPDO, $username, $password);
    $consulta = $tuPDO->prepare('SELECT * FROM ingredientes;');

    $consulta->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Consulta Ingredientes</title>
    <style>
    
        /* Estilos para los encabezados */
        h1{
        text-align: center;
        background-color:#71e5f5 ;
        margin: 0;
        font-size: 394%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td {
            border: 1px solid #8eefe5;
            text-align: center;
            padding: 1.3rem;
        }
        .button {
            border-radius: .5rem;
            color: white;
            background-color: #bd9439;
            padding: 1rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>BD INGREDIENTES</h1>
    <br>
    <p><a class="button" href="crear_ingre.php">Crear</a></p>

    <table>
        <tr>
            <th>CODIGO</th>
            <th>INGREDIENTES</th>
            <th>MEDIDAS</th>
            <th>PRECIOS</th>
            <th colspan="2">ACCIONES</th>
        </tr>
        <?php foreach($consulta as $key => $valor): ?>
            <tr>
                <td><?= $valor['Codigo']; ?></td>
                <td><?= $valor['Ingredientes']; ?></td>
                <td><?= $valor['Medidas']; ?></td>
                <td><?= $valor['Precios']; ?></td>
                <td><a class="button" href="actualizar_ingre.php?Codigo=<?= $valor['Codigo'] ?>">Actualizar</a></td>
                <td><a class="button" href="borrar_ingre.php?Codigo=<?= $valor['Codigo'] ?>">Borrar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
