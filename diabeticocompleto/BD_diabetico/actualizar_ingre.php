<?php
     $host ='127.0.0.1';
     $BD ='diabetico_goloso';
     $usuario ='root';
     $clave ='';

        $Codigo=isset($_REQUEST['Codigo']) ? $_REQUEST['Codigo']: null;
        $Ingredientes=isset($_REQUEST['Ingredientes']) ? $_REQUEST['Ingredientes']: null;
        $Medidas=isset($_REQUEST['Medidas']) ? $_REQUEST['Medidas']: null;
        $Precios=isset($_REQUEST['Precios']) ? $_REQUEST['Precios']: null;

    $hostPDO="mysql:host=$host;dbname=$BD;";
    $tuPDO=new PDO($hostPDO,$usuario,$clave);

    if($_SERVER['REQUEST_METHOD'] == "POST" ) {
        $actualizar = $tuPDO-> prepare('UPDATE ingredientes SET Ingredientes = :Ingredientes, Medidas = :Medidas, Precios = :Precios WHERE Codigo = :Codigo');

        $actualizar-> execute(
            [
                'Codigo'=>$Codigo,
                'Ingredientes'=>$Ingredientes,
                'Medidas'=>$Medidas,
                'Precios'=>$Precios
            ]
            );
            header('Location:consulBDingre.php');
    } else {
        
        $consulta = $tuPDO -> prepare(
            'SELECT * FROM ingredientes WHERE Codigo = :Codigo;'
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
            <label for ="Ingredientes">Ingredientes</label>
            <input id="Ingredientes" type="text" name="Ingredientes" value="<?=$resultado['Ingredientes']?>">
            <label for ="Medidas">Medidas<label>
            <input id="Medidas" type="text" name="Medidas" value="<?=$resultado['Medidas']?>">
            <label for ="Precios">Precios<label>
            <input id="Precios" type="text" name="Precios" value="<?=$resultado['Precios']?>">
            <input type="submit" value="Guardar">
    </form>
</body>
</html>

