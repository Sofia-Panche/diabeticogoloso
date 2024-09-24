<?php
        $host ='sql311.infinityfree.com';
        $username ='if0_37008929';
        $password='Diabetic0G';
        $dbname='if0_37008929_diabetico_goloso';

$Codigo = isset($_REQUEST['Codigo']) ? $_REQUEST['Codigo'] : null;
$Porciones = isset($_REQUEST['Porciones']) ? $_REQUEST['Porciones'] : null;
$Ingredientes = isset($_REQUEST['Ingredientes']) ? $_REQUEST['Ingredientes'] : null;
$Cantidades = isset($_REQUEST['Cantidades']) ? $_REQUEST['Cantidades'] : null;

try {
    $hostPDO = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $tuPDO = new PDO($hostPDO, $username, $password);
    $tuPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $actualizar = $tuPDO->prepare('UPDATE medidas SET Porciones = :Porciones, Ingredientes = :Ingredientes, Cantidades = :Cantidades WHERE Codigo = :Codigo');
        $actualizar->execute([
            'Codigo' => $Codigo,
            'Porciones' => $Porciones,
            'Ingredientes' => $Ingredientes,
            'Cantidades' => $Cantidades
        ]);
        header('Location: consulBDmedidas.php');
        exit();
    } else {
        $consulta = $tuPDO->prepare('SELECT * FROM medidas WHERE Codigo = :Codigo');
        $consulta->execute(['Codigo' => $Codigo]);
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Actualizar Medidas</title>
</head>
<body>
    <h1>Actualizar Medidas</h1>
    <form method="post">
        <label for="Codigo">Codigo</label>
        <input id="Codigo" type="text" name="Codigo" value="<?= htmlspecialchars($resultado['Codigo']) ?>" readonly>
        <label for="Porciones">Porciones</label>
        <input id="Porciones" type="text" name="Porciones" value="<?= htmlspecialchars($resultado['Porciones']) ?>">
        <label for="Ingredientes">Ingredientes</label>
        <input id="Ingredientes" type="text" name="Ingredientes" value="<?= htmlspecialchars($resultado['Ingredientes']) ?>">
        <label for="Cantidades">Cantidades</label>
        <input id="Cantidades" type="text" name="Cantidades" value="<?= htmlspecialchars($resultado['Cantidades']) ?>">
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
