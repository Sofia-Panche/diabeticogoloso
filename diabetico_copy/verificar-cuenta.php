<?php
//======================================================================
// PROCESAR FORMULARIO 
//======================================================================

//-----------------------------------------------------
// Variables de conexión a la base de datos
//-----------------------------------------------------
$hostDB = 'sql311.infinityfree.com';
$nombreDB = 'if0_37008929_diabetico_goloso';
$usuarioDB = 'if0_37008929';
$contrasenyaDB = 'Diabetic0G';
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;charset=utf8mb4";

//-----------------------------------------------------
// Variables recibidas del formulario
//-----------------------------------------------------
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$password = isset($_REQUEST['contrasenya']) ? $_REQUEST['contrasenya'] : null;
$errores = [];

$email = isset($_GET['email']) ? $_GET['email'] : null;
$errores = [];

if ($email) {
    try {
        // Conectar a la base de datos
        $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
        $miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar si el usuario existe y si ya está activado
        $consulta = $miPDO->prepare('SELECT id, activo FROM usuarios_db WHERE email = :email');
        $consulta->execute(['email' => $email]);
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if ($usuario['activo'] == 0) {
                // Si la cuenta no está activa, activarla (cambiar el campo "activo" a 1)
                $activarCuenta = $miPDO->prepare('UPDATE usuarios_db SET activo = 1 WHERE email = :email');
                $activarCuenta->execute(['email' => $email]);

                echo '¡Tu cuenta ha sido activada con éxito!<a href=identificarse.php><button>Entrar</button></a>';
            } else {
                echo 'Tu cuenta ya está activada.';
            }
        } else {
            $errores[] = 'El correo electrónico no está registrado.';
        }
    } catch (PDOException $e) {
        $errores[] = 'Error al conectar con la base de datos: ' . $e->getMessage();
    }
}

// Mostrar errores si los hay
if (count($errores) > 0) {
    foreach ($errores as $error) {
        echo "<p>$error</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
    if (empty($email) || empty($password)) {
        $errores[] = 'El email y la contraseña son obligatorios.';
    }

   
    if (count($errores) === 0) {
        try {
            //-----------------------------------------------------
            // Conectar con la base de datos
            //-----------------------------------------------------
            $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
            $miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //-----------------------------------------------------
            // COMPROBAR SI LA CUENTA ESTÁ ACTIVA Y EXISTE EL USUARIO
            //-----------------------------------------------------
            $miConsulta = $miPDO->prepare('SELECT rol, activo, password FROM usuarios_db WHERE email = :email');
            $miConsulta->execute(['email' => $email]);
            $resultado = $miConsulta->fetch(PDO::FETCH_ASSOC);

            
            if ($resultado === false) {
                $errores[] = 'El email no está registrado.';
            } elseif ((int)$resultado['activo'] !== 1) {
                $errores[] = 'Tu cuenta aún no está activa. ¿Has comprobado tu bandeja de correo?';
            } else {
                
                if (password_verify($password, $resultado['password'])) {
                    
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['rol'] = $resultado['rol']; 

                    
                    if ($resultado['rol'] == 1) {
                        
                        header('Location: oficialclientes.php');
                    } elseif ($resultado['rol'] == 2) {
                        
                        header('Location: iniciooficial.php');
                    }
                    exit();
                } else {
                    $errores[] = 'El email o la contraseña es incorrecta.';
                }
            }
        } catch (PDOException $e) {
            $errores[] = 'Error al conectar con la base de datos: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrar</title>
     <link rel="stylesheet" type="text/css" href="./css/registro.css">
     <style>
     *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "poppins",sans-serif;
}
body{
    height: 100vh;
    width: 100%;
    background: #f4f4f4;
  
}
.ppp{
        background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 1rem;
    padding: 1rem;
    width: 30%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: left;
}
    </style>
</head>
<body>
    

 
    <?php if (count($errores) > 0): ?>
    <ul class="errores">
        <?php foreach ($errores as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    
    <?php if (isset($_REQUEST['registrado'])): ?>
    <div class="ppp">
        <p>¡Gracias por registrarte! Revisa tu bandeja de correo para activar la cuenta.</p>
        </div>
    <?php endif; ?>

    <?php if (isset($_REQUEST['activada'])): ?>
    <div class="ppp">
        <p>¡Cuenta activada! Ya puedes iniciar sesión.</p>
          </div>
    <?php endif; ?>
</body>
</html>