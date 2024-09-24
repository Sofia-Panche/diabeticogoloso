<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

if (!isset($_GET['id'])) {
    die("Error: ID del producto no especificado.");
}

$product_id = intval($_GET['id']);

$stmt = $conexion->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Error: Producto no encontrado.");
}

$sabores_crema = $conexion->query("SELECT id, nombre FROM sabores_crema")->fetchAll(PDO::FETCH_ASSOC);
$sabores_relleno = $conexion->query("SELECT id, nombre FROM sabores_relleno")->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$carrito = &$_SESSION['carrito'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;
    $porciones = isset($_POST['porciones']) ? intval($_POST['porciones']) : 0;
    $sabor_crema = isset($_POST['sabores_crema']) ? intval($_POST['sabores_crema']) : 0;
    $sabor_relleno = isset($_POST['sabores_relleno']) ? intval($_POST['sabores_relleno']) : 0;

    if ($cantidad > 0 && $porciones > 0) {
        if (!isset($carrito[$product_id])) {
            $carrito[$product_id] = [
                'cantidad' => 0,
                'porciones' => $porciones,
                'sabor_crema' => $sabor_crema,
                'sabor_relleno' => $sabor_relleno
            ];
        }

        $carrito[$product_id]['cantidad'] += $cantidad;
        $carrito[$product_id]['porciones'] = $porciones;
        $carrito[$product_id]['sabor_crema'] = $sabor_crema;
        $carrito[$product_id]['sabor_relleno'] = $sabor_relleno;

        $_SESSION['carrito'] = $carrito;

        header("Location: index.php?status=added");
        exit;
    } else {
        echo "Cantidad o porciones no válidas.";
    }
}

$precio = $product['precio_10'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['nombre']); ?> - Detalles del Producto</title>
    <link rel="stylesheet" href="productos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/89631d50fd.js" crossorigin="anonymous"></script>
</head>
<body>
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
               <a href="index.php"><i class="fa-solid fa-house"></i>         
        </nav>
        <div class="icons-container">
            <a href=""><i class="fa-solid fa-user"></i></a>
            <a href="" id="cart-icon"><i class="fa-solid fa-cart-shopping"></i> (<?= array_sum(array_column($carrito, 'cantidad')) ?>)</a>
        </div>
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

        .top-bar {
            background-color: #71e5f5;
            color: #000;
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 2rem;
        }

        .top-bar .social-links a {
            font-size: 28px;
            text-decoration: none;
            margin-left: 0.5rem;
            color: #f1f1f1;
        }

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .icons-container {
            display: flex;
            gap: 10px;
        }

        .icons-container a {
            color: #000;
            font-size: 20px;
        }

        /* Product Section */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            flex: 1;
            text-align: center;
        }

        .product-image img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 10px;
        }

        .product-details {
            flex: 2;
            padding: 20px;
        }

        .product-details h1 {
            font-size: 28px;
            color: #333;
        }

        .product-details p {
            font-size: 16px;
            color: #666;
        }

        /* Form Styles */
        form {
            margin-top: 20px;
        }

        form label {
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .buy-button {
            padding: 10px 20px;
            background-color: #71e5f5;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .buy-button:hover {
            background-color: #54b2ca;
        }

        /* Footer */
        footer {
            background-color: #D29D2B;
            color: white;
            padding: 20px;
        }

        footer .section_footer {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        footer .footer_titulo {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .footer_copy {
            text-align: center;
            margin-top: 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
                text-align: center;
            }

            .product-details {
                padding: 10px;
            }

            .product-image img {
                max-width: 200px;
            }
        }

        @media (max-width: 480px) {
            .product-image img {
                max-width: 150px;
            }

            .buy-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>


<div class="product-container">
    <div class="product-image">
        <img src="<?php echo htmlspecialchars($product['imagen_url']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>">
    </div>
    <div class="product-details">
        <h1><?php echo htmlspecialchars($product['nombre']); ?></h1>
        <p><?php echo htmlspecialchars($product['descripcion']); ?></p>

       <form method="POST">
            <label for="porciones">Selecciona la cantidad de porciones:</label>
            <select id="porciones" name="porciones" required>
                <option value="5" data-price="<?php echo htmlspecialchars($product['precio_5']); ?>">5 porciones</option>
                <option value="10" data-price="<?php echo htmlspecialchars($product['precio_10']); ?>">10 porciones</option>
                <option value="15" data-price="<?php echo htmlspecialchars($product['precio_15']); ?>">15 porciones</option>
                <option value="20" data-price="<?php echo htmlspecialchars($product['precio_20']); ?>">20 porciones</option>
            </select>

            <label for="cantidad">Selecciona la cantidad de productos:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" value="1" required>

            <label for="sabor_crema">Selecciona el sabor de crema:</label>
            <select id="sabor_crema" name="sabores_crema" required>
                <?php foreach ($sabores_crema as $sabor): ?>
                    <option value="<?php echo $sabor['id']; ?>"><?php echo htmlspecialchars($sabor['nombre']); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="sabor_relleno">Selecciona el sabor de relleno:</label>
            <select id="sabor_relleno" name="sabores_relleno" required>
                <?php foreach ($sabores_relleno as $sabor): ?>
                    <option value="<?php echo $sabor['id']; ?>"><?php echo htmlspecialchars($sabor['nombre']); ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="buy-button"><i class="fa-solid fa-cart-shopping"></i> Agregar al carrito</button>
        </form>


        <?php if (isset($_GET['status']) && $_GET['status'] === 'added'): ?>
            <p style="color: green;">Producto añadido al carrito correctamente.</p>
        <?php endif; ?>
    </div>
</div>

<footer class="footer">
    <section class="section_footer">
        <div>
            <h1 class="footer_titulo">Sedes</h1>
            <p><strong>Sede Villavicencio</strong><br>
                Cra 9 #37-04 <br>
                Cel: 317 853 1932 <br>
                eldiabeticogoloso01@gmail.com
            </p>
            <p><strong>Sede Bogotá</strong><br>
                Calle 127 bis#88-45 <br>
                Cel: 310 762 3278 <br>
                vanessacdiabeticog@gmail.com
            </p>
        </div>
        <div>
            <h1 class="footer_titulo">Síguenos</h1>
            <div class="social-links">
                <a href="https://www.facebook.com/eldiabeticogoloso?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/eldiabeticogoloso/?igsh=dnM0eWJ0NHNqcWds"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa
