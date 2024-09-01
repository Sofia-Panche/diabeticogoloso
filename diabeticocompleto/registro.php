<?php 
$servidor="localhost";
$usuario="root";
$clave="";
$based="diabetico_goloso";

$enlace=mysqli_connect($servidor, $usuario, $clave, $based);

if(!$enlace){
    echo "error en la conexion con el servidor";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\styles2.css">

    <title>Registrarse</title>
</head>
<body>
<div class="login">
    <img src="img/torta3.jpg" alt="image" class="login__bg">

    <form method="post" class="login__form" >
        <h1 class="login__title">El diabetico goloso</h1>
        <h1 class="login__title">Registro</h1>

        <div class="login__inputs">
            <div class="login__box">
                <input type="email" name="email" placeholder="Email" required class="login__input">
                <i class="holii"></i>
            </div>

            <div class="login__box">
                <input type="password" name="contraseña" placeholder="Contraseña" required class="login__input">
                <i class="holi2"></i>
            </div>
            <div class="login__box">
                <input type="number" name="numero" placeholder="Número de celular" required class="login__input">
                <i class="holi2"></i>
            </div>
        </div>

        <div class="login__check">
            <div class="login__check-box">
                <input type="checkbox" class="login__check-input" id="user-check">
                <label for="user-check" class="login__check-label">Recuerdame</label>
            </div>

        </div>

        <button type="submit" name="registrarse" value="registrarse" class="login__button">Registrate</button>

        <div class="login__register">
            ¿Tienes una cuenta? <a href="inicio.php">Inicia sesion</a>
        </div>
    </form>
</div>
</body>
</html>
<?php 
if(isset($_POST['registrarse'])){
    $email=$_POST["login__box"];
    $contraseña=$_POST["login__box"];
    $numero=$_POST["login__box"];
    $id= rand(1,99);
    $insertDatos="INSERT INTO diabetico_goloso VALUES('$email', '$contraseña', '$numero')";
    $ejecutarIn= mysqli_query($enlace, $insertDatos);

    if(!$ejecutarIn){
        echo "Error en la linea de sql"; 
    }

}
?>
