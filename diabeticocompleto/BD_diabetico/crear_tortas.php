<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $Codigo=isset($_REQUEST['Codigo']) ? $_REQUEST['Codigo']: null;
        $Porciones=isset($_REQUEST['Porciones']) ? $_REQUEST['Porciones']: null;
        $Sabores_tortas=isset($_REQUEST['Sabores_tortas']) ? $_REQUEST['Sabores_tortas']: null;
        $Sabores_relleno=isset($_REQUEST['Sabores_relleno']) ? $_REQUEST['Sabores_relleno']: null;
        $Sabores_crema=isset($_REQUEST['Sabores_crema']) ? $_REQUEST['Sabores_crema']: null;
        $Precios=isset($_REQUEST['Precios']) ? $_REQUEST['Precios']: null;

        $host ='sql201.infinityfree.com';
        $BD ='if0_37072466_diabetico_goloso';
        $usuario ='si0_37072466';
        $clave ='';
        
        $hostPDO="mysql:host=$host;dbname=$BD;";
        $tuPDO=new PDO($hostPDO,$usuario,$clave);

        $insertar=$tuPDO->prepare('INSERT INTO tortas(Codigo,Porciones, Sabores_tortas, Sabores_relleno, Sabores_crema, Precios)
        VALUES(:Codigo,:Porciones,:Sabores_tortas,:Sabores_relleno,:Sabores_crema,:Precios)');
        
        $insertar->execute(array(
                            'Codigo'=>$Codigo,
                            'Porciones'=>$Porciones,
                            'Sabores_tortas'=>$Sabores_tortas,
                            'Sabores_relleno'=>$Sabores_relleno,
                            'Sabores_crema'=>$Sabores_crema,
                            'Precios'=>$Precios
                            )
        );

        header('Location:consulBDtorta.php');

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
            <label for ="Porciones">Porciones</label>
            <input id="Porciones" type="text" name="Porciones">
            <label for ="Sabores_tortas">Sabores_tortas<label>
            <input id="Sabores_tortas" type="text" name="Sabores_tortas">
            <label for ="Sabores_relleno">Sabores_relleno<label>
            <input id="Sabores_relleno"type="text" name="Sabores_relleno">
            <label for ="Sabores_crema">Sabores_cremas<label>
            <input id="Sabores_crema" type="text" name="Sabores_crema">
            <label for ="Precios">Precios<label>
            <input id="Precios" type="text" name="Precios">
            <input type="submit" value="Guardar">
    </form>
</body>
</html>