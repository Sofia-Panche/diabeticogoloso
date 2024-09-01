<?php
    $host ='sql201.infinityfree.com';
    $BD ='if0_37072466_diabetico_goloso';
    $usuario ='si0_37072466';
    $clave ='';
    
        $Codigo=isset($_REQUEST['Codigo']) ? $_REQUEST['Codigo']: null;
        $Porciones=isset($_REQUEST['Porciones']) ? $_REQUEST['Porciones']: null;
        $Ingredientes=isset($_REQUEST['Ingredientes']) ? $_REQUEST['Ingredientes']: null;
        $Cantidades=isset($_REQUEST['Cantidades']) ? $_REQUEST['Cantidades']: null;

    $hostPDO="mysql:host=$host;dbname=$BD;";
    $tuPDO=new PDO($hostPDO,$usuario,$clave);

    if($_SERVER['REQUEST_METHOD'] == "POST" ) {
        $actualizar = $tuPDO-> prepare('UPDATE medidas SET Porciones = :Porciones, Ingredientes = :Ingredientes, Cantidades = :Cantidades WHERE Codigo = :Codigo');

        $actualizar-> execute(
            [
                'Codigo'=>$Codigo,
                'Porciones'=>$Porciones,
                'Ingredientes'=>$Ingredientes,
                'Cantidades'=>$Cantidades
            ]
            );
            header('Location:consulBDmedidas.php');
    } else {
        
        $consulta = $tuPDO -> prepare(
            'SELECT * FROM medidas WHERE Codigo = :Codigo;'
        );
        
        $consulta-> execute(
            [
                'Codigo' => $Codigo
            ]);
        }

        $resultado = $consulta->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Actualizar</title>
</head>
<body>
    <h1>Actualizar</h1>
    <form method="post">
            <label for ="Codigo">Codigo<label>
            <input id="Codigo" type="text" name="Codigo" value="<?=$resultado['Codigo']?>">
            <label for ="Porciones">Porcionesentes</label>
            <input id="Porciones" type="text" name="Porciones" value="<?=$resultado['Porciones']?>">
            <label for ="Ingredientes">Ingredientes<label>
            <input id="Ingredientes" type="text" name="Ingredientes" value="<?=$resultado['Ingredientes']?>">
            <label for ="Cantidades">Cantidades<label>
            <input id="Cantidades" type="text" name="Cantidades" value="<?=$resultado['Cantidades']?>">
            <input type="submit" value="Guardar">
    </form>
</body>
</html>
