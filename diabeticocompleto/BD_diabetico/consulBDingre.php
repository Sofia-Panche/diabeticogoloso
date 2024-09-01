<?php
    $host ='sql201.infinityfree.com';
    $BD ='if0_37072466_diabetico_goloso';
    $usuario ='si0_37072466';
    $clave ='';
    
    $hostPDO="mysql:host=$host; dbname=$BD;";
    $tuPDO=new PDO($hostPDO,$usuario,$clave);
    $consulta= $tuPDO->Prepare('SELECT*FROM ingredientes;');

    $consulta->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD consulta ingredientes</title>
        <style>
            table{
                border-collapse: collase;
                width:100%;
            }
            table td{
                border:1px solid #8eefe5;
                text-align: center;
                padding:1.3rem;
            }
            .button{
                border-radius:.5rem;
                color: white;
                background-color: #bd9439;
                padding:1rem;
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
    <?php foreach($consulta as $key =>$valor): ?>
        <tr>
            <td><?= $valor['Codigo']; ?></td>
            <td><?= $valor['Ingredientes']; ?></td>
            <td><?= $valor['Medidas']; ?></td>
            <td><?= $valor['Precios']; ?></td>
            <td><a class="button" href="actualizar_ingre.php?Codigo=<?=$valor['Codigo']?>">Actualizar</a></td>
            <td><a class="button" href="borrar_ingre.php?Codigo=<?=$valor['Codigo']?>">Borrar</a></td>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>
