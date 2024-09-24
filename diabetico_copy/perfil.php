<?php
session_start();

$host = 'sql311.infinityfree.com';
$username = 'if0_37008929';
$password = 'Diabetic0G';
$dbname = 'if0_37008929_diabetico_goloso';

$conexion = new mysqli($host, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM usuarios_db WHERE email = '$email'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    die("Error al obtener la información del usuario");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $foto = $_FILES['foto'];
    $nombre_foto = basename($foto['name']); 
    $tipo_foto = $foto['type'];
    $tamano_foto = $foto['size'];
    $tmp_foto = $foto['tmp_name'];

    if ($tipo_foto == 'image/jpeg' || $tipo_foto == 'image/png') {
        $ruta_foto = 'img/perfil/' . $nombre_foto;

        
        if (move_uploaded_file($tmp_foto, $ruta_foto)) {
            $sql = "UPDATE usuarios_db SET foto = '$ruta_foto' WHERE email = '$email'";
            $conexion->query($sql);
        } else {
            echo "Error al subir la foto";
        }
    } else {
        echo "Formato de archivo no válido";
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="./css/perfil.css">
</head>
<style>
body {
    font-family: "Nunito Sans", sans-serif;
    background-color: #f1f1f1;
}

header {
    background-color: #71e5f5;
    color: #000;
    padding: 1rem;
    text-align: center;
}

header nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-between;
}

header nav ul li {
    margin: 0 1rem;
}

header nav ul li a {
    color: #000;
    text-decoration: none;
}

main {
    padding: 2rem;
    text-align: center;
}

.perfil {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 1rem;
    width: 50%;
    margin: 0 auto;
}

.perfil img {
    width: 100%;
    max-width: 200px; 
    border-radius: 5px;
}

.perfil form {
    margin-top: 1rem;
}

.perfil form input[type="file"] {
    margin-bottom: 1rem;
}

.perfil form button[type="submit"] {
    background-color: #71e5f5;
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
}

.perfil p {
    margin: 1rem 0;
}
</style>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="perfil">
            <h2>Perfil de <?= htmlspecialchars($usuario['nombre']) ?></h2>
            <img src="<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto de perfil">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="foto" accept="image/jpeg, image/png, image/jpg">
                <button type="submit">Subir foto de perfil</button>
            </form>
            <p>Email: <?= htmlspecialchars($usuario['email']) ?></p>
        </section>
    </main>
</body>
</html>
