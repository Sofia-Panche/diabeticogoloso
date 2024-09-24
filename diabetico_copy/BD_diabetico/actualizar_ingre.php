<?php
$host ='sql311.infinityfree.com';
$username ='if0_37008929';
$password='Diabetic0G';
$dbname='if0_37008929_diabetico_goloso';

$Codigo = isset($_REQUEST['Codigo']) ? $_REQUEST['Codigo'] : null;
$Ingredientes = isset($_REQUEST['Ingredientes']) ? $_REQUEST['Ingredientes'] : null;
$Medidas = isset($_REQUEST['Medidas']) ? $_REQUEST['Medidas'] : null;
$Precios = isset($_REQUEST['Precios']) ? $_REQUEST['Precios'] : null;

try {
    $hostPDO = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $tuPDO = new PDO($hostPDO, $username, $password);
    $tuPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $actualizar = $tuPDO->prepare('UPDATE ingredientes SET Ingredientes = :Ingredientes, Medidas = :Medidas, Precios = :Precios WHERE Codigo = :Codigo');
        $actualizar->execute([
            'Codigo' => $Codigo,
            'Ingredientes' => $Ingredientes,
            'Medidas' => $Medidas,
            'Precios' => $Precios
        ]);
        header('Location: consulBDingre.php');
        exit();
    } else {
        $consulta = $tuPDO->prepare('SELECT * FROM ingredientes WHERE Codigo = :Codigo');
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
    <title>Actualizar Ingredientes</title>
</head>
<body>
    <h1>Actualizar Ingredientes</h1>
    <form method="post">
        <label for="Codigo">Codigo</label>
        <input id="Codigo" type="text" name="Codigo" value="<?= htmlspecialchars($resultado['Codigo']) ?>" readonly>
        <label for="Ingredientes">Ingredientes</label>
        <input id="Ingredientes" type="text" name="Ingredientes" value="<?= htmlspecialchars($resultado['Ingredientes']) ?>">
        <label for="Medidas">Medidas</label>
        <input id="Medidas" type="text" name="Medidas" value="<?= htmlspecialchars($resultado['Medidas']) ?>">
        <label for="Precios">Precios</label>
        <input id="Precios" type="text" name="Precios" value="<?= htmlspecialchars($resultado['Precios']) ?>">
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
