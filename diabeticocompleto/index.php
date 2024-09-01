<?php
$productos = [
    ["nombre" => "Pastel de Chocolate", "descripcion" => "Delicioso pastel de chocolate con relleno de ganache.", "imagen" => "img/torta11.png"],
    ["nombre" => "Pastel de Vainilla", "descripcion" => "Clásico pastel de vainilla con crema pastelera.", "imagen" => "img/torta12.png"],
    ["nombre" => "Pastel de Fresas", "descripcion" => "Fresco pastel de fresas con crema chantilly.", "imagen" => "img/torta3.jpg"],
    ["nombre" => "Pastel de Zanahoria", "descripcion" => "Pastel saludable de zanahoria con nueces y pasas.", "imagen" => "img/torta4.jpg"],
    ["nombre" => "Pastel Red Velvet", "descripcion" => "Suave pastel red velvet con frosting de queso crema.", "imagen" => "img/torta5.jpg"],
    ["nombre" => "Pastel de Limón", "descripcion" => "Refrescante pastel de limón con relleno de lemon curd.", "imagen" => "img/torta6.jpg"],
    ["nombre" => "Pastel de Coco", "descripcion" => "Exótico pastel de coco con crema de coco.", "imagen" => "img/torta7.jpg"],
    ["nombre" => "Pastel de Chocolate", "descripcion" => "Delicioso pastel de chocolate con relleno de ganache", "imagen" => "img/torta8.jpg"],
    ["nombre" => "Pastel de Vainilla", "descripcion" => "Clásico pastel de vainilla con crema pastelera.", "imagen" => "img/torta10.jpg"],
    ["nombre" => "Pastel de Fresas", "descripcion" => "Fresco pastel de fresas con crema chantilly.", "imagen" => "img/torta14.jpg"],
    ["nombre" => "Pastel de Zanahoria", "descripcion" => "Pastel saludable de zanahoria con nueces y pasas.", "imagen" => "img/torta15.jpg"],
    ["nombre" => "Pastel Red Velvet", "descripcion" => "Suave pastel red velvet con frosting de queso crema.", "imagen" => "img/torta16.jpg"],
    ["nombre" => "Pastel de Limón", "descripcion" => "Refrescante pastel de limón con relleno de lemon curd.", "imagen" => "img/torta17.jpg"],
    ["nombre" => "Pastel de Coco", "descripcion" => "Exótico pastel de coco con crema de coco.", "imagen" => "img/torta18.jpg"]
];

$carrito = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];
    if (isset($productos[$producto_id])) {
        if (!isset($carrito[$producto_id])) {
            $carrito[$producto_id] = 0;
        }
        $carrito[$producto_id]++;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Diabético Goloso</title>
    <link rel="website icon" type="png" href="img/logodiabe.png">
    <link rel="stylesheet" href="css\oficial.css">
    <script src="https://kit.fontawesome.com/89631d50fd.js" crossorigin="anonymous"></script>

     <!-- google fonts-->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
</head>
<body>

<header>
        <title>El Diabetivo Goloso</title>
        <div class="top-bar">
            <div class="contact-info">
                <p><i class="fa-solid fa-envelope"></i> 
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com/eldiabeticogoloso?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/eldiabeticogoloso/?igsh=dnM0eWJ0NHNqcWds"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <div class="main-nav">
            <nav>
                <a class="consultas" href="BD_diabetico/consulBDtorta.php">tortas</a>
                <a class="consultas" href="BD_diabetico/consulBDmedidas.php">medidas</a>
                <a class="consultas"href="BD_diabetico/consulBDingre.php">ingredientes</a>
            </nav>
            <div class="icons-container">
                <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="#"><i class="fa-solid fa-user"></i></a>
                <a href="#"><i class="fa-solid fa-bookmark"></i></a>
                <a href="#"><i class="fa-solid fa-cart-shopping"></i> (<?= array_sum($carrito) ?>)</a>
            </div>
        </div>
    </header>
    <main>
        <section class="bienvenida">
            <div class="bienvenida-content">
                <h2>Bienvenido a El Diabético Goloso</h2>
                <h3>lo mejor sin remordimientos</h3>
            </div>
        </section>
        <main class="intento">
        <div class="coso-de-arriba"><h2>Disfruta tu torta personalizada en 3 pasos 😉</h2></div>
         <section class="coso-del-centro">
            <div class="pasos">
            <img class="gif" src="img/camara.gif" alt="">
                <h4 class="texto">1 - Busca en Google la imagen de referencia de la torta de tus sueños</h4>
            </div>
            <div class="pasos">
                <img class="gif" src="img/pastel.gif"alt="">
                <h4 class="texto">2 - Confírmanos en un mensaje fecha de entrega y cantidad de porciones de tu torta.</h4>
            </div>
            <div class="pasos">
                <img  class="gif" src="img/carrito.gif" alt="">
                <h4 class="texto" >3 - Envianos la imagen e información a nuestro WhatsApp 3107623278</h4>
                <button class="boton-wasap" type="submit"><a href="https://wa.me/message/P47BCD67AG3FC1">WhatsApp</a></button>
            </div>
</section>

    </main>

        <section class="productos">
            <?php foreach ($productos as $id => $producto): ?>
                <div class="producto">
                    <img src="<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>">
                    <h3><?= $producto['nombre'] ?></h3>
                    <p><?= $producto['descripcion'] ?></p>
                    <form action="pro" method="post">
                        <input type="hidden" name="producto_id" value="<?= $id ?>"> 
                        <button type="submit"><a href="#"><i class="fa-solid fa-cart-shopping"></a></i></button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>
        <section class="carrito">
            <?php if (empty($carrito)): ?>
                
            <?php else: ?>
                <ul>
                    <?php foreach ($carrito as $producto_id => $cantidad): ?>
                        <li><?= $productos[$producto_id]['nombre'] ?> (<?= $cantidad ?>)</li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>
    <footer class="footer">
        <section class="section_footer">
            <div class="pie_div" class="container">

                <article class="articulo">
                    <h1 class="footer_titulo">Sedes</h1>
                <p><strong>Sede Villavicencio</strong><br>
                    Cra 9 #37-04 <br>
                    Cel: 317 853 1932 <br>
                    luisardiabeticog.gmailcom
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


