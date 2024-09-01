<?php
session_start(); 


$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
$carritoCount = array_sum($carrito);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Diabético Goloso - Producto</title>
    <link rel="stylesheet" href="css\styles1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="contact-info">
                <p><i class="fa-solid fa-envelope"></i> <a href="mailto:contacto@eldiabetico.com">luisardiabeticog@gmail.com</a></p>
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com/eldiabeticogoloso?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/eldiabeticogoloso/?igsh=dnM0eWJ0NHNqcWds"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>
        <div class="main-nav">
            <nav class="nav-left">
                <ul>
                    <li><a href="1nosotros.php">Sobre nosotros</a></li>
                </ul>
            </nav>
            <div class="icons-container">
                <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="#"><i class="fa-solid fa-user"></i></a>
                <a href="#"><i class="fa-solid fa-bookmark"></i></a>
            </div>
        </div>
    </header>

    <main class="product-page">
        <div class="product-container">
            <div class="product-image">
                <img src="img/torta3.jpg" alt="Pastel de Chocolate">
            </div>
            <div class="product-details">
                <h1>Pastel de Chocolate</h1>
                <p class="price">$25.900 - $426.500</p>
                <p>Solicitar con 4 días de anterioridad y comunicarse primero con un asesor vía Whatsapp para indicar el valor correcto del pastel.</p>
                <form action="carrito.php" method="post">
                    <label for="porciones">Porciones</label>
                    <select id="porciones" name="porciones">
                        <option value="">Elige una</option>
                        <option value="10">10 Porciones</option>
                        <option value="20">20 Porciones</option>
                        <option value="30">30 Porciones</option>
                    </select>
                    <label for="figura">Figura</label>
                    <input type="text" id="figura" name="figura" placeholder="Describe la figura">
                    <button type="submit" class="btn-add-to-cart">Agregar al Carrito</button>
                </form>
                <div class="contact-whatsapp">
                    <a href="https://wa.me/message/P47BCD67AG3FC1" target="_blank"><i class="fa-brands fa-whatsapp"></i> Contactar por Whatsapp</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 El Diabético Goloso. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
