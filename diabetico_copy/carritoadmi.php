<?php 
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$carrito = $_SESSION['carrito'];

$host = 'sql311.infinityfree.com';
$username = 'if0_37008929';
$password = 'Diabetic0G';
$dbname = 'if0_37008929_diabetico_goloso';

$productos = [];
$total = 0;

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!empty($carrito)) {
        $ids = implode(',', array_fill(0, count($carrito), '?'));
        $stmt = $conexion->prepare("SELECT id, nombre, imagen_url, precio_5, precio_10, precio_15, precio_20 FROM productos WHERE id IN ($ids)");
        $stmt->execute(array_keys($carrito));
        $productosEnCarrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($productosEnCarrito as $producto) {
            $producto_id = $producto['id'];
            $porciones = $carrito[$producto_id]['porciones'] ?? 10;
            $cantidad = $carrito[$producto_id]['cantidad'] ?? 1;

            switch ($porciones) {
                case 5:
                    $precio = $producto['precio_5'];
                    break;
                case 10:
                    $precio = $producto['precio_10'];
                    break;
                case 15:
                    $precio = $producto['precio_15'];
                    break;
                case 20:
                    $precio = $producto['precio_20'];
                    break;
                default:
                    $precio = $producto['precio_10'];
            }

            $sabor_relleno_id = $carrito[$producto_id]['sabor_relleno'];
            $sabor_crema_id = $carrito[$producto_id]['sabor_crema'];

            $stmt_sabores = $conexion->prepare("
                SELECT 
                    (SELECT nombre FROM sabores_relleno WHERE id = ?) as sabor_relleno,
                    (SELECT nombre FROM sabores_crema WHERE id = ?) as sabor_crema
            ");
            $stmt_sabores->execute([$sabor_relleno_id, $sabor_crema_id]);
            $sabores = $stmt_sabores->fetch(PDO::FETCH_ASSOC);

            $productos[$producto_id] = [
                'nombre' => $producto['nombre'],
                'imagen' => $producto['imagen_url'],
                'precio' => $precio,
                'cantidad' => $cantidad,
                'porciones' => $porciones,
                'sabor_relleno' => $sabores['sabor_relleno'],
                'sabor_crema' => $sabores['sabor_crema'],
            ];

            $total += $precio * $cantidad;
        }
    }

  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['vaciar_carrito'])) {
            $_SESSION['carrito'] = [];
            header("Location: carrito.php"); 
            exit;
        }
        if (isset($_POST['finalizar_compra'])) {
            echo "<script>enviarWhatsapp();</script>"; 
            exit;
        }
    }
} catch (PDOException $e) {
    echo "Error en la conexión o consulta: " . $e->getMessage();
    exit;
}

$isLoggedIn = isset($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="website icon" type="png" href="img/logodiabe.png">
    <link rel="stylesheet" href="oficialclientes.css">
    <script src="https://kit.fontawesome.com/89631d50fd.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
    <header>
       <div class="top-bar">
            <div class="contact-info">
                 <div class="nav-img" >
               <img src="logodiabe.png" alt="">
            </div>
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com/eldiabeticogoloso?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/eldiabeticogoloso/?igsh=dnM0eWJ0NHNqcWds"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <div class="main-nav">
            <nav>
               <a href="iniciooficial.php"><i class="fa-solid fa-house"></i>         
            </nav>
            <div class="icons-container">
                <a href="perfil.php"><i class="fa-solid fa-user"></i></a>
                <a href="carritoadmi.php"><i class="fa-solid fa-cart-shopping"></i> (<?= array_sum(array_column($carrito, 'cantidad')) ?>)</a>
        </div>
    </header>
    <style>
.nav-img {
    width: 100%;
    height: auto;
    max-width: 70px;
    padding: a
  }
  
  .nav-img img {
    width: 100%;
    height: auto;
    object-fit: contain; 
  }



header .top-bar {
    background-color: #71e5f5;
    color: #000;
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 2rem;
}

header .top-bar .contact-info p {
    margin: 0;
}

header .top-bar .social-links a {
    width: 50px;
    height: 50px;
    border-radius: 10%;

    font-size: 28px;
    text-decoration: none;
    margin-left: 0.5rem;
    color: #f1f1f1;
}

header .top-bar .social-links img {
    width: 20px;
    height: 20px;
}

header .main-nav {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header .main-nav .logo {
    height: 300px; 
    width: 300px;
}

header .main-nav nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

header .main-nav nav ul li {
    margin: 0 1rem;
}

header .main-nav nav ul li a {
    color: #000;
    text-decoration: none;
    font-size: 1rem;
}

header .main-nav nav ul li.icons a {
    margin: 0 0.5rem;
}

header .main-nav nav ul li.icons img {
    width: 20px;
    height: 20px;
}

main {
    padding: 2rem;
    text-align: center;
}




main {
    padding: 2rem;
    text-align: center;
}


.main-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0;
    background-color: transparent; 
}




.nav-left, .nav-right {
    flex: 1;
}

.nav-left ul, .nav-right ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

.nav-left ul {
    justify-content: flex-start;
}

.nav-right ul {
    justify-content: flex-end;
}


.icons-container {
    flex: 1;
    display: flex;
    flex-wrap: nowraps;
    justify-content: flex-end;
}

.icons-container a {
    margin-left: 10px;
    text-decoration: none;
    color: #000303;
}
.social_icon{
    color: #f1f1f1;
    margin-bottom: 0.3rem;
}
.social_icon:hover{
    color: #4e4c4c;

}
.social_icon{
    margin-right: 15px;

}
.social_icon img{
    height: 28px;
}

        .carrito {
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            max-width: 80%;
        }

        .carrito h2 {
            text-align: center;
            color: #71e5f5;
        }

        .carrito-contenido {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .carrito-producto {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f4f4f4;
        }

        .carrito-producto img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
        }

        .carrito-detalles {
            flex: 1;
        }

        .carrito-detalles h3 {
            margin: 0;
            color: #333;
        }

        .carrito-detalles p {
            color: #000;
            font-size: 1.17em;
      }

        #comprar-todo{
        background-color: #71e5f5;
        width: 100%;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size:20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }
        #vaciar-carrito-form button {
            margin-top:20px;
            margin-bottom: 18px;
            background-color: #df1818;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        #comprar-todo:hover {
            background-color: #31b0d5;
        }
        .carrito {
    margin-top: 2rem;
    text-align: left;
}

.carrito h2 {
    margin-top: 0;
}

.footer{
    background-color:#D29D2B  ;
    display: flex;
    flex-direction: column;
}
.section_footer{
background-color: #bd9439;
padding: 50px 20px;
display: flex;
justify-content: center;
}
.pie_div{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    width: 100%;

}
.footer_titulo{
    color: black;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}
.social_icon{
    color: #fff;
    margin-bottom: 0.3rem;
}
.social_icon:hover{
    color: #4e4c4c;

}
.social_icon{
    margin-right: 15px;

}
.social_icon img{
    height: 28px;
}

.footer_copy{
    text-align: center;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 500;
    padding: 20px 0;
}
.footer_copy_links{
    color: #fff;
    font-weight:900 ;
}
.footer_copy_links:hover{
    color: #4e4c4c;
}
@media only screen and(max-width:850px) {
    .section_footer{
        width: 49%;
        margin-bottom: 1.5rem;

    }
}
@media only screen and(max-width:510px) {
    .section_footer{
        width: 100%;
        
        
    }
}

footer .top-bar .social-links a {
    width: 50px;
    height: 50px;
    border-radius: 10%;

    font-size: 28px;
    text-decoration: none;
    margin-left: 0.5rem;
    color: #f1f1f1;
}

footer.top-bar .social-links img {
    width: 20px;
    height: 20px;
}



.carrito h1 {
    text-align: center;
    color: #71e5f5;
}

#comprar-todo {
            background-color: #71e5f5;
            width: 100%;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #vaciar-carrito-form button {
            margin-top: 20px;
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #vaciar-carrito-form button:hover {
            background-color: #d32f2f;
        }

        #comprar-todo.disabled {
            display: none;
        }
</style>
</head>

<main>
    <div class="carrito">
        <h2>Carrito de Compras</h2>
        <?php if (empty($productos)): ?>
            <p>No hay productos en el carrito.</p>
        <?php else: ?>
            <div class="carrito-contenido">
                <?php foreach ($productos as $producto): ?>
                    <div class="carrito-producto">
                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                        <div class="carrito-detalles">
                            <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                            <p>Porciones: <?php echo htmlspecialchars($producto['porciones']); ?></p>
                            <p>Sabor Relleno: <?php echo htmlspecialchars($producto['sabor_relleno']); ?></p>
                            <p>Sabor Crema: <?php echo htmlspecialchars($producto['sabor_crema']); ?></p>
                            <p>Cantidad: <?php echo htmlspecialchars($producto['cantidad']); ?></p>
                            <p>Precio: $<?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <h3>Total: $<?php echo htmlspecialchars(number_format($total, 2)); ?></h3>
            </div>
            <form id="vaciar-carrito-form" method="POST">
                <button type="submit" name="vaciar_carrito">Vaciar Carrito</button>
            </form>
           <?php if (!empty($productos)): ?>
                <form id="comprar-form" onsubmit="enviarWhatsapp(); return false;">
                    <button id="comprar-todo" type="submit">Finalizar Compra</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>
<script>
    function enviarWhatsapp() {
        let mensaje = "Hola, me gustaría comprar los siguientes productos:\n\n";
        <?php foreach ($productos as $producto): ?>
            mensaje += "Producto: <?= htmlspecialchars($producto['nombre']); ?>\n";
            mensaje += "Cantidad: <?= htmlspecialchars($producto['cantidad']); ?>\n";
            mensaje += "Porciones: <?= htmlspecialchars($producto['porciones']); ?>\n";
            mensaje += "Precio: $<?= number_format($producto['precio'] * $producto['cantidad'], 2); ?>\n";
            mensaje += "Sabor Relleno: <?= htmlspecialchars($producto['sabor_relleno']); ?>\n";
            mensaje += "Sabor Crema: <?= htmlspecialchars($producto['sabor_crema']); ?>\n\n";
        <?php endforeach; ?>
        mensaje += "Total: $<?= number_format($total, 2); ?>\n";
        let url = "https://wa.me/3163436463?text=" + encodeURIComponent(mensaje);
        window.open(url, "_blank");


        
    }

   
</script>

<footer class="footer">
        <section class="section_footer">
            <div class="pie_div" class="container">

                <article class="articulo">
                    <h1 class="footer_titulo">Sedes</h1>
                <p><strong>Sede Villavicencio</strong><br>
                    Cra 9 #37-04 <br>
                    Cel: 317 853 1932 <br>
                    eldiabeticogoloso01@gmail.com
                </p>
                <br>
                <p><strong>Sede Bogotá</strong><br>
                    Calle 127 bis#88-45 <br>
                    Cel: 310 762 3278 <br>
                    vanessacdiabeticog@gmail.com
                    </p>
                </article>

                <article class="articulo">
                    <h1 class="footer_titulo"> Siguenos</h1>
                    <div class="top-bar">
                        <div class="contact-info">
                        <div class="social-links">
                            <a href="https://www.facebook.com/eldiabeticogoloso?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
                            <a href="https://www.instagram.com/eldiabeticogoloso/?igsh=dnM0eWJ0NHNqcWds"><i class="fa-brands fa-instagram"></i></a>

                    </div>
                </article>
            </div> 
        </section> 
            <div class="footer_copy">
                    <p class="footer_copy-text" id="copyright">
                         &COPY;
                        <samp id="año"></samp>
                        Todos los derechos resrvados. <br>Hecho por:
                        <a href="SoftCuchau.php" target="_blank" class="footer_copy_links">SoftCuchau</a>
                    </p>
            </div>
    
    </footer> 
</body>
</html>