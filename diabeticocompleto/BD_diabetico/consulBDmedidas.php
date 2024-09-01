<?php
    $host ='sql201.infinityfree.com';
    $BD ='if0_37072466_diabetico_goloso';
    $usuario ='si0_37072466';
    $clave ='';

    $hostPDO="mysql:host=$host; dbname=$BD;";
    $tuPDO=new PDO($hostPDO,$usuario,$clave);
    $consulta= $tuPDO->Prepare('SELECT*FROM medidas;');

    $consulta->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD consulta medidas</title>
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
    <h1>BD MEDIDAS</h1>
    <br>
    <p><a class="button" href="crear_medidas.php">Crear</a></p>

    <table>
        <tr>
            <th>CODIGO</th>
            <th>PORCIONES</th>
            <th>INGREDIENTES</th>
            <th>CANTIDADES</th>
            <th colspan="2">ACCIONES</th>
        </tr>
    <?php foreach($consulta as $key =>$valor): ?>
        <tr>
            <td><?= $valor['Codigo']; ?></td>
            <td><?= $valor['Porciones']; ?></td>
            <td><?= $valor['Ingredientes']; ?></td>
            <td><?= $valor['Cantidades']; ?></td>
            <td><a class="button" href="actualizar_medidas.php?Codigo=<?=$valor['Codigo']?>">Actualizar</a></td>
            <td><a class="button" href="borrar_medidas.php?Codigo=<?=$valor['Codigo']?>">Borrar</a></td>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>
