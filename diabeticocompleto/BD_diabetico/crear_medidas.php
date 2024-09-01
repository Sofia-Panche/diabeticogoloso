<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $Codigo=isset($_REQUEST['Codigo']) ? $_REQUEST['Codigo']: null;
        $Porciones=isset($_REQUEST['Porciones']) ? $_REQUEST['Porciones']: null;
        $Ingredientes=isset($_REQUEST['Ingredientes']) ? $_REQUEST['Ingredientes']: null;
        $Cantidades=isset($_REQUEST['Cantidades']) ? $_REQUEST['Cantidades']: null;

        $host ='sql201.infinityfree.com';
        $BD ='if0_37072466_diabetico_goloso';
        $usuario ='si0_37072466';
        $clave ='';
        $hostPDO="mysql:host=$host;dbname=$BD;";
        $tuPDO=new PDO($hostPDO,$usuario,$clave);

        $insertar=$tuPDO->prepare('INSERT INTO tortas(Codigo,Porciones, Ingredientes, Cantidades)
        VALUES(:Codigo,:Porciones,:Ingredientes,:Cantidades)');
        
        $insertar->execute(array(
                            'Codigo'=>$Codigo,
                            'Porciones'=>$Porciones,
                            'Ingredientes'=>$Ingredientes,
                            'Cantidades'=>$Cantidades
                            )
        );

        header('Location:consulBDmedidas.php');

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
            <label for ="Porciones">Porcionesentes</label>
            <input id="Porciones" type="text" name="Porciones">
            <label for ="Ingredientes">Ingredientes<label>
            <input id="Ingredientes" type="text" name="Ingredientes">
            <label for ="Cantidades">Cantidades<label>
            <input id="Cantidades" type="text" name="Cantidades">
            <input type="submit" value="Guardar">
    </form>
</body>
</html>