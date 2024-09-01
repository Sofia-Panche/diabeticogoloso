<?php 
$servidor="localhost";
$usuario="root";
$clave="";
$based="diabetico_goloso";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\styles.css">

    <title>Inicio de sesion y registrarse</title>
</head>
<body>
<div class="login">
    <img src="img/torta3.jpg" alt="image" class="login__bg">

    <form method="post" class="login__form">
        <h1 class="login__title">El diabetico goloso</h1>

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
                <label for="user-check" class="login__check-label">Recuerdame</label>
            </div>

            <a href="#" class="login__forgot">¿olvidaste tu contraseña?</a>
        </div>

        <button type="submit" name="inicio" class="login__button">Inicia Sesión</button>

        <div class="login__register">
            ¿No tienes una cuenta? <a href="registro.php">registrate</a>
        </div>
    </form>
</div>
</body>
</html>
<?php 
if(isset($_POST['inicio'])){
    $email=$_POST["email"];
    $contraseña=$_POST["contraseña"];
    $id= rand(1,99);
    $insertDatos="INSERT INTO diabetico_goloso VALUES('$email', '$contraseña')";
    $ejecutarIn= mysqli_query($enlace, $insertDatos);

    if(!$ejecutarIn){
        echo "Error en la linea de sql"; 
    }

}
?>