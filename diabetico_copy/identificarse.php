<?php 

session_start();
if ($usuarioValido) {
    $_SESSION['usuario'] = $usuario['id'];
    echo "Sesión iniciada. ID de usuario: " . $_SESSION['usuario'];
    header("Location: oficialclientes.php");
    exit();
} 

$hostDB = 'sql311.infinityfree.com';
$nombreDB = 'if0_37008929_diabetico_goloso';
$usuarioDB = 'if0_37008929';
$contrasenyaDB = 'Diabetic0G';
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;charset=utf8mb4";

$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
$password = isset($_REQUEST['contrasenya']) ? $_REQUEST['contrasenya'] : null;
$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (empty($email) || empty($password)) {
        $errores[] = 'El email y la contraseña son obligatorios.';
    }

    if (count($errores) === 0) {
        try {
            $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
            $miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            $miConsulta = $miPDO->prepare('SELECT id, rol, activo, password FROM usuarios_db WHERE email = :email');
            $miConsulta->execute(['email' => $email]);
            $resultado = $miConsulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado === false) {
                $errores[] = 'El email no está registrado.';
            } elseif ((int)$resultado['activo'] !== 1) {
                $errores[] = 'Tu cuenta aún no está activa. ¿Has revisado tu bandeja de correo?';
            } else {
                if (password_verify($password, $resultado['password'])) {
                    session_start();
                    
                    $_SESSION['usuario_id'] = $resultado['id'];
                    $_SESSION['email'] = $email;
                    $_SESSION['rol'] = $resultado['rol'];

                    // Redirigir según el rol
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
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="registro.css">
        <link rel="website icon" type="png" href="logodiabe.png">
    <script src="https://kit.fontawesome.com/89631d50fd.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

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


        .btn{
    width: 100%;
    height: 45px;
    outline: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background: #D29D2B;
    font-size: 16px;
    color: #fff;
    box-shadow: rgba(0,0,0,0.4);

}
.btn:hover{
       background: #ad8630;
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

    <!-- Mostrar errores si existen -->
    <?php if (count($errores) > 0): ?>
        <ul class="errores">
            <?php foreach ($errores as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?> 

         <div class="container">
            <div class="text-item">
                <h1>Inicia sesion</h1>
            </div>
        </div>
    <main class="login-section">
             <div class="formulario">
              <form class="form" action="" method="post">
                <div class="input-box">
                    <label>E-mail</label>
                    <input type="text" required name="email" placeholder="" value="<?php echo htmlspecialchars($email); ?>">
                </div>

            <div class="input-box">
                 <label for="">Contraseña</label>
                 <input type="password" required name="contrasenya" placeholder="">
                    <i class="bx bxs-lock"></i>
                </div>
<div class="input-box">
                    <button class="btn" type="submit">iniciar sesion</button>
                </div>
                <div>
                    <p>¿No tienes una cuenta? <a href="registro.php" class="aaa">Registrate</a></p> 
                </div>

            </form>

         
            </div>
        </div>
    </main>

</body>
</html>
