<?php
     $host ='127.0.0.1';
     $BD ='diabetico_goloso';
     $usuario ='root';
     $clave ='';

    $hostPDO="mysql:host=$host; dbname=$BD;";
    $tuPDO=new PDO($hostPDO,$usuario,$clave);
    $consulta= $tuPDO->Prepare('SELECT*FROM tortas;');

    $consulta->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD consulta tortas</title>
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
    <h1>BD TORTAS</h1>
    <br>
    <p><a class="button" href="crear_tortas.php">Crear</a></p>

    <table>
        <tr>
            <th>CODIGO</th>
            <th>PORCIONES</th>
            <th>SABORES_TORTAS</th>
            <th>SABORES_RELLENO</th>
            <th>SABORES_CREMAS</th>
            <th>PRECIOS</th>
            <th colspan="2">ACCIONES</th>
        </tr>
    <?php foreach($consulta as $key =>$valor): ?>
        <tr>
            <td><?= $valor['Codigo']; ?></td>
            <td><?= $valor['Porciones']; ?></td>
            <td><?= $valor['Sabores_tortas']; ?></td>
            <td><?= $valor['Sabores_relleno']; ?></td>
            <td><?= $valor['Sabores_crema']; ?></td>
            <td><?= $valor['Precios']; ?></td>
            <td><a class="button" href="actualizar_tortas.php?Codigo=<?=$valor['Codigo']?>">Actualizar</a></td>
            <td><a class="button" href="borrar_tortas.php?Codigo=<?=$valor['Codigo']?>">Borrar</a></td>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>
