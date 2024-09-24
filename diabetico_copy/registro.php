<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//======================================================================
// PROCESAR FORMULARIO 
//======================================================================

/**
 * Funciones para validar
 */
function validar_requerido(string $texto): bool {
    return !(trim($texto) == '');
}

function validar_email(string $texto): bool {
    return filter_var($texto, FILTER_VALIDATE_EMAIL);
}

//-----------------------------------------------------
// Variables
//-----------------------------------------------------
$errores = [];
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : ''; 
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

$rol = 1; // Rol predeterminado para cliente
if ($email === 'luisardiabeticog@gmail.com' || $email === 'vanessacdiabeticog@gmail.com') {
    $rol = 2; // Rol administrador
}

// Comprobamos si llegan los datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //-----------------------------------------------------
    // Validaciones
    //-----------------------------------------------------
    if (!validar_requerido($nombre)) {
        $errores[] = 'El campo Nombre es obligatorio.';
    }

    if (!validar_requerido($email)) {
        $errores[] = 'El campo Email es obligatorio.';
    }

    if (!validar_email($email)) {
        $errores[] = 'El Email no tiene un formato válido.';
    }

    if (!validar_requerido($password)) {
        $errores[] = 'El campo Contraseña es obligatorio.';
    }

    //-----------------------------------------------------
    // Verificar si el email ya está registrado
    //-----------------------------------------------------
    if (count($errores) === 0) {
        try {
            // Conexión a la base de datos
            $hostDB = 'sql311.infinityfree.com';
            $nombreDB = 'if0_37008929_diabetico_goloso';
            $usuarioDB = 'if0_37008929';
            $contrasenyaDB = 'Diabetic0G';
            $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;charset=utf8mb4";
            
            $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
            $miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verificar si el email ya está registrado
            $miConsulta = $miPDO->prepare('SELECT COUNT(*) as length FROM usuarios_db WHERE email = :email');
            $miConsulta->execute(['email' => $email]);
            $resultado = $miConsulta->fetch();

            if ((int)$resultado['length'] > 0) {
                $errores[] = 'La dirección de email ya está registrada.';
            }
        } catch (PDOException $e) {
            $errores[] = 'Error en la conexión a la base de datos: ' . $e->getMessage();
        }
    }

    //-----------------------------------------------------
    // Crear cuenta si no hay errores
    //-----------------------------------------------------
    if (count($errores) === 0) {
        try {
            // Cifrar la contraseña
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(openssl_random_pseudo_bytes(16)); 

            // Preparar el INSERT en la base de datos
            $miNuevoRegistro = $miPDO->prepare('INSERT INTO usuarios_db (email, nombre, password, activo, rol, token) 
                                                VALUES (:email, :nombre, :password, :activo, :rol, :token)');
            // Ejecuta el nuevo registro
            $miNuevoRegistro->execute([
                'email' => $email,
                'nombre' => $nombre,
                'password' => $hashPassword,
                'activo' => 0,  // Deja la cuenta inactiva para que sea activada por correo
                'rol' => $rol,
                'token' => $token
            ]);

            // Envío de Email de activación (opcional)

            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
            require 'PHPMailer/src/Exception.php';

            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor de correo
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'vanessacdiabeticog@gmail.com';
                $mail->Password = 'gggj iqga bowg frdp'; // Contraseña o contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Remitente y destinatario
                $mail->setFrom('vanessacdiabeticog@gmail.com', 'Vanessa Cendales');
                $mail->addAddress($email, 'Usuario');

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Activa tu cuenta';
                $mail->Body = "Hola!<br>Para activar tu cuenta, haz clic en el siguiente enlace:<br>
                <a href='http://eldiabeticogoloso.000.pe/verificar-cuenta.php?email=" . urlencode($email) . "&token=" . urlencode($token) . "'>Activar cuenta</a>";

                $mail->send();
                echo 'Correo de activación enviado correctamente.';
            } catch (Exception $e) {
                echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
            }

           
            header('Location: verificar-cuenta.php?registrado=1');
exit();
            exit();
        } catch (PDOException $e) {
            $errores[] = 'Error en la inserción en la base de datos: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="website icon" type="png" href="logodiabe.png">
    <title>Registro</title>
    
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {   
            background-image: url('../img/fondo.png');
          font-family: "poppins",sans-serif;
        margin: 0;
        padding: 0;
        }

        header {
            text-align: center;
            margin-top: 20px;
        }

        .login-section {
            display: flex;
            justify-content: center;
            margin-top: 5%;
            margin-right: 7%;
        }


        .login-section .form-box{
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
    
}

        .formulario {
            width:40%;
            background-color: #fff;
            background-color:rgb(255 255 255 / 21%);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .input-box {
            margin-bottom: 20px;
        }
        

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: none; /* Quita los bordes */
            border-bottom: 2px solid #555; /* Agrega una línea debajo */
            background-color: transparent; /* Sin fondo */
            outline: none; /* Quita el borde al hacer clic */
}

        input[type="text"]:focus, input[type="password"]:focus {
            -bottom: 2px solid #3498db; /* Cambia el color de la línea al hacer foco */
}

  input[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #D29D2B ;
        color: #fff;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }


        input[type="submit"]:hover {
            background-color:#ad8630;
        }

        .create-account {
            color:#000;
            text-align: center;
            margin-top: 20px;
            font-size: 20px;
        }

        .aaa {
            color: #000;
            text-decoration: none;
             font-size: 20px;
             
        }

        .aaa:hover {
            text-decoration: underline;
             
        }

        .errores {
            color: #ff6b6b;
            background-color: #ffe6e6;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Media queries para dispositivos móviles */
        @media (max-width: 768px) {
            .login-section {
                justify-content: center;
                margin-right: 0;
            }

            .formulario {
                width: 100%;
                max-width: 400px;
                margin: 0 20px;
            }
        }

.text-item {
    display: flex;
    flex-direction: column;
    align-items: center; /* Centra horizontalmente */
    justify-content: center; /* Centra verticalmente */
    text-align: center; /* Alinea el texto horizontalmente */
    height: auto; 
 }
.text-item h1 {
    color: #333;
    z-index: 2;
    animation: 2s infinite;
    text-shadow: 0 0 20px #D29D2B;
    font-family: "Nunito Sans", sans-serif;
    font-size: 50px;
    line-height: 1;
}
    </style>
</head>
<body>
<div class="item">
     
            <div class="text-item">
                <h1>Registrate</h1>
            </div>
        </div>
    <?php if (isset($errores) && count($errores) > 0): ?>
        <ul class="errores">
            <?php foreach ($errores as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <main class="login-section">
        <div class="formulario">
            <form class="form" action="" method="post">
                <div class="input-box">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
                </div>

                <div class="input-box">
                    <label>E-mail</label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </div>

                <div class="input-box">
                    <label>Contraseña</label>
                    <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                </div>

                <input type="submit" class="btn" value="registrarse">
            </form>

            <div class="create-account">
                <p>¿Ya tienes una cuenta?<a class="aaa" href="identificarse.php">Inicia sesión</a></p>
            </div>
        </div>
    </main>

</body>
</html>

