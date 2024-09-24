<?php
$host ='sql311.infinityfree.com';
$username ='if0_37008929';
$password='Diabetic0G';
$dbname='if0_37008929_diabetico_goloso';

$Codigo = isset($_REQUEST['Codigo']) ? $_REQUEST['Codigo'] : null;
$Porciones = isset($_REQUEST['Porciones']) ? $_REQUEST['Porciones'] : null;
$Sabores_tortas = isset($_REQUEST['Sabores_tortas']) ? $_REQUEST['Sabores_tortas'] : null;
$Sabores_relleno = isset($_REQUEST['Sabores_relleno']) ? $_REQUEST['Sabores_relleno'] : null;
$Sabores_crema = isset($_REQUEST['Sabores_crema']) ? $_REQUEST['Sabores_crema'] : null;
$Precios = isset($_REQUEST['Precios']) ? $_REQUEST['Precios'] : null;

try {
    $hostPDO = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $tuPDO = new PDO($hostPDO, $username, $password);
    $tuPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $actualizar = $tuPDO->prepare('UPDATE tortas SET Porciones = :Porciones, Sabores_tortas = :Sabores_tortas, Sabores_relleno = :Sabores_relleno, Sabores_crema = :Sabores_crema, Precios = :Precios WHERE Codigo = :Codigo');
        $actualizar->execute([
            'Codigo' => $Codigo,
            'Porciones' => $Porciones,
            'Sabores_tortas' => $Sabores_tortas,
            'Sabores_relleno' => $Sabores_relleno,
            'Sabores_crema' => $Sabores_crema,
            'Precios' => $Precios
        ]);
        header('Location: consulBDtorta.php');
        exit();
    } else {
        $consulta = $tuPDO->prepare('SELECT * FROM tortas WHERE Codigo = :Codigo');
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
    <title>Actualizar Tortas</title>
</head>
<body>
    <h1>Actualizar Tortas</h1>
    <form method="post">
        <label for="Codigo">Codigo</label>
        <input id="Codigo" type="text" name="Codigo" value="<?= htmlspecialchars($resultado['Codigo']) ?>" readonly>
        <label for="Porciones">Porciones</label>
        <input id="Porciones" type="text" name="Porciones" value="<?= htmlspecialchars($resultado['Porciones']) ?>">
        <label for="Sabores_tortas">Sabores tortas</label>
        <input id="Sabores_tortas" type="text" name="Sabores_tortas" value="<?= htmlspecialchars($resultado['Sabores_tortas']) ?>">
        <label for="Sabores_relleno">Sabores relleno</label>
        <input id="Sabores_relleno" type="text" name="Sabores_relleno" value="<?= htmlspecialchars($resultado['Sabores_relleno']) ?>">
        <label for="Sabores_crema">Sabores crema</label>
        <input id="Sabores_crema" type="text" name="Sabores_crema" value="<?= htmlspecialchars($resultado['Sabores_crema']) ?>">
        <label for="Precios">Precios</label>
        <input id="Precios" type="text" name="Precios" value="<?= htmlspecialchars($resultado['Precios']) ?>">
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
