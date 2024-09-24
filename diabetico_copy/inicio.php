<?php
session_start();

$host = 'sql311.infinityfree.com';
$username = 'if0_37008929';
$password = 'Diabetic0G';
$dbname = 'if0_37008929_diabetico_goloso';

try {

    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

if (isset($_POST['inicio'])) {
   
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);

 
    $consulta = $conexion->prepare("SELECT * FROM usuarios_db WHERE email = :email LIMIT 1");
    $consulta->bindParam(':email', $email, PDO::PARAM_STR);
    $consulta->execute();

    if ($consulta->rowCount() > 0) {
        $fila = $consulta->fetch(PDO::FETCH_ASSOC);

      
        if ($fila['contraseña'] === $contraseña) {
          
            $_SESSION['email'] = $email; 
            header("Location: oficialclientes.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Email no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Inicio de sesión y registrarse</title>
</head>
<body>
<div class="login">
    <img src="torta3.jpg" alt="image" class="login__bg">

    <form method="post" class="login__form">
        <h1 class="login__title">El Diabético Goloso</h1>

        <div class="login__inputs">
            <div class="login__box">
                <input type="email" name="email" placeholder="Email" required class="login__input">
                <i class="holii"></i>
            </div>

            <div class="login__box">
                <input type="password" name="contraseña" placeholder="Contraseña" required class="login__input">
                <i class="holi2"></i>
            </div>
        </div>

        <div class="login__check">
            <div class="login__check-box">
                <input type="checkbox" class="login__check-input" id="user-check">
                <label for="user-check" class="login__check-label">Recuérdame</label>
            </div>

            <a href="#" class="login__forgot">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" name="inicio" class="login__button">Inicia Sesión</button>

        <div class="login__register">
            ¿No tienes una cuenta? <a href="registro.php">Regístrate</a>
        </div>

        <?php 
      
        if (isset($mensaje)) {
            echo "<p style='color: red; text-align: center;'>$mensaje</p>";
        }
        ?>
    </form>
</div>
</body>
</html>
