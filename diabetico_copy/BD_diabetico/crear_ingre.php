<?php
        $host ='sql311.infinityfree.com';
        $username ='if0_37008929';
        $password='Diabetic0G';
        $dbname='if0_37008929_diabetico_goloso';

        
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $Codigo=isset($_REQUEST['Codigo']) ? $_REQUEST['Codigo']: null;
        $Ingredientes=isset($_REQUEST['Ingredientes']) ? $_REQUEST['Ingredientes']: null;
        $Medidas=isset($_REQUEST['Medidas']) ? $_REQUEST['Medidas']: null;
        $Precios=isset($_REQUEST['Precios']) ? $_REQUEST['Precios']: null;

        $hostPDO="mysql:host=$host;dbname=$dbname;";
        $tuPDO=new PDO($hostPDO,$username,$password);

        $insertar=$tuPDO->prepare('INSERT INTO ingredientes(Codigo,Ingredientes, Medidas, Precios)
        VALUES(:Codigo,:Ingredientes,:Medidas,:Precios)');
        
        $insertar->execute(array(
                            'Codigo'=>$Codigo,
                            'Ingredientes'=>$Ingredientes,
                            'Medidas'=>$Medidas,
                            'Precios'=>$Precios
                            )
        );

        header('Location:consulBDingre.php');

    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Crear</title>
</head>
<body>
    <h1>Crear</h1>
    <form action = " " method="post">
            <label for ="Codigo">Codigo<label>
            <input id="Codigo" type="text" name="Codigo">
            <label for ="Ingredientes">Ingredientes</label>
            <input id="Ingredientes" type="text" name="Ingredientes">
            <label for ="Medidas">Medidas<label>
            <input id="Medidas" type="text" name="Medidas">
            <label for ="Precios">Precios<label>
            <input id="Precios" type="text" name="Precios">
            <input type="submit" value="Guardar">
    </form>
</body>
</html>