<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio El Diabético Goloso</title>
    <link rel="website icon" type="png" href="logodiabe.png">
    <link rel="stylesheet" href="css\1nosotros.css">

     <script src="https://kit.fontawesome.com/89631d50fd.js" crossorigin="anonymous"></script>

     <!-- google fonts-->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
</head>
<body>
   <style>

@import url('https://fonts.googleapis.com/css2?family=Playwrite+BE+VLG:wght@100..400&display=swap');
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
    font-family: "Nunito Sans", sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
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

.bienvenida {
    position: relative;           
    color: #fff;
    text-align: center;
    padding: 20px 0;
    height: 300px;
    z-index: 1;                   
}

.bienvenida::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('collagetortas.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    filter: brightness(0.5);
    z-index: -1;                  
    opacity: 0.9;                 
}

.bienvenida h2{
    color: #d3c4a4;
    justify-content: center;
    z-index: 2;                   
    animation: 2s infinite;
    text-shadow:0 0 20px #64c4d4;
    font-family: "Nunito Sans", sans-serif;
}
.bienvenida >h3 {
    font-size: 40px;
    color: #dee6e7;
    justify-content: center;
    z-index: 2;                   
    animation: 2s infinite;
    font-family: "Nunito Sans", sans-serif;
}
.bienvenida-content {
    max-width: 800px; 
    margin: 0 auto; 
}

.bienvenida h2, .bienvenida p {
    margin: 0; 
    padding: 20px; 
    
}

.bienvenida h2 {
    font-size: 40px;
    margin-top: 0;
}

.bienvenida p {
    font-size: 20px;
    margin: 1rem 0;
    color: #f1f1f1;
}
.intento {
    padding: 0%;
    margin: 0%;
    background-color: #fff;
  }
  
  .coso-de-arriba {
    padding: 0;
    margin: 0;
    padding-top: 0%;
    color: #fff;
    background-color: #D29D2B;
    font-size: 30px;
    font-family: "Nunito Sans", sans-serif;
  }
  
  .pasos > h4 {
    font-family: "Nunito Sans", sans-serif;
    width: 70%;
    margin: 0 auto;
  }
  
  .gif {
    width: 20%;
    height: 40%;
    margin: 2% 5%;
    float: left;
  }
  
  .texto {
    font-size: 18px;
    line-height: 1.5;
    margin: 0 20px;

  }
  
  .coso-del-centro {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .boton-wasap {
    text-decoration: none;
    border: none;
    background-color: #78c4d1;
    color: #fff;
    font-family: "Nunito Sans", sans-serif;
    font-size: 20px;
    padding: 8px 10px; 
    transition: background-color 0.3s ease, transform 0.3s ease; /* Efectos de transición */
    display: inline-block;
    cursor: pointer;             /* Cambia el cursor al pasar sobre el botón */
}

.boton-wasap:hover {  
    transform: scale(1.05);
}s

.boton-wasap:active {
    transform: scale(0.95);
}

  
  /* Media query para pantalla pequeña */
  @media only screen and (max-width: 600px) {
    .coso-del-centro {
      flex-direction: column; /* Cambiamos la dirección de los elementos a columna */
    }
    .gif {
      width: 30%; 
      height: auto;
      margin: 5px 0;
    }
    .texto {
      margin: 5px 0; /* Margen entre elementos en pantalla pequeña */
    }
  }


.divglobal {
    weight:100%;
    height:auto;
    display: flex;
    flex-wrap: wrap;
    margin-top: 5%;
    margin-left: 7%;
    margin-right: 7%;

}

.divglobal >div {
    margin-bottom: 20px;
}



  .caja {
    width: 100%;
    height: auto;
    padding: 2%;
    margin-left: 5px;
    margin:5%;
    flex: 100%;
    border-radius: 10px;
    display: flex;
    flex-wrap: wrap;
    background-color:#E5DDC5;
    
}

  .caja:hover {
    width: 100%;
    height: auto;
    padding: 2%;
    margin-left: 5px;
    flex: 100%;
    margin:5%;
    border-radius: 10px;
    display: flex;
    flex-wrap: wrap;
    background-color:#E5DDC5;
    
}
.caja p {
    font-size: 25px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    width: 100%;
    height: auto;
    text-align: center;
}

.slider{
    width: 282px;
    height: auto;
    margin: auto;
    overflow: hidden;
    grid-column: 2 / 3;
    grid-row: 1/2 ;
    border-radius: 10px;
}
.slider ul{
    display: flex;
    padding: 0;
    width: 400%;
    animation: cambio 15s infinite;
    animation-timing-function: ease-in;
}
.slider li{
    width: 100%;
    list-style: none;
}
.slider img{
    width: 100%;
}
@keyframes cambio{
    0% {margin-left: 0;}
    20%{margin-left: 0;}
    25%{margin-left: -100%;}
    45%{margin-left: -100%;}
    50%{margin-left: -200%;}
    70%{margin-left: -200%;}
    75%{margin-left: -300%;}
    100%{margin-left: -300%;}
}


@media (max-width: 768px) {
    .container {
        grid-template-columns: 1fr;
    }
    .slider {
        grid-column: 1 / -1;
        margin-top: 20px;
    }
    .caja {
        flex-direction: column;
        align-items: center;
   
    }}

    .footer{
        background-color:#D29D2B ;
        display: flex;
        flex-direction: column;
    }
    .section_footer{
    background-color: #E0A75E;
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
    
   .footer{
    background-color:#D29D2B ;
    display: flex;
    flex-direction: column;
}
.section_footer{
background-color: #E0A75E;
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


   </style>
    <header>
    <title>El Diabetivo Goloso</title>
        <div class="top-bar">
            <div>

            </div>
            <div class="social-links">
                <a href="https://www.facebook.com/eldiabeticogoloso?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/eldiabeticogoloso/?igsh=dnM0eWJ0NHNqcWds"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <div class="main-nav">
            <nav>
            <a class="consultas" href="index.php">Inicio</a>
            
            </nav>
        </div>
    </header>
    <main>
        <section class="bienvenida">
            <div class="bienvenida-content">
                <h2>Bienvenido a El Diabético Goloso</h2>
            </div>
        </section>
        </main>
        <br>
   
    </main>
    
    <main class="intento">
        <div class="coso-de-arriba"><h2>Disfruta tu torta personalizada en 3 pasos 😉</h2></div>
         <section class="coso-del-centro">
            <div class="pasos">
            <img class="gif" src="img/camara.gif" alt="">
                <h4 class="texto">1 - Busca la imagen de referencia de la torta de tus sueños</h4>
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
     
    <main class="divglobal">
            <div class="caja">   
                    <h2 class="h22">¿Quienes somos?</h2>
                <p>"Somos una empresa, comprometidos con el bienestar y la vida sana de todas aquellas personas que por su salud o estilo de vida, quieren alimentarse Saludablemente, pero delicioso, sin consumir azúcar y otros alimentos que puedan subirle sus niveles de glucosa."</p>
            </div>
            <div class="caja">
                    <h2 class="h22" >Nuestra Misión</h2>

                <p> “Proveer alimentación saludable, rica y equilibrada a la comunidad diabética, brindando platos y postres de alta calidad, a precios competitivos y brindando el mejor servicio a sus clientes. El Diabético Goloso, también ofrece y difunde información sobre nutrición y salud en los diabéticos, promoviendo así la generación de conciencia entre las personas que padecen de la enfermedad y la comunidad en general. Para alcanzar estos propósitos se cuenta con una infraestructura técnica y administrativa de calidad, con un grupo humano comprometido y dispuesto a brindar sus mejores esfuerzos en un marco de excelencia, con el objetivo de satisfacer las necesidades de cada uno de nuestros clientes.”</p>
            </div>
            <div class="caja">
              <h2 class="h22">Nuestra Visión</h2>
                <p>"El Diabético Golosos será reconocida en 2030 como la empresa líder en el mercado de comida especializada para diabéticos, sobresaliendo por sus renovadas propuestas culinarias ajustadas a los requerimientos nutricionales de sus clientes y se destacará especialmente por la calidez y la eficiencia en su servicio."</p>
            </div>
         </main>
        <br>
        <div class="slider">
            <ul>
                <li><img src="img/torta4.jpg"></li>
                <li><img src="img/torta5.jpg"></li>
                <li><img src="img/torta6.jpg"></li>
                <li><img src="img/torta7.jpg"></li>
            </ul>
</div>

    <br>
    <footer class="footer">
        <section class="section_footer">
            <div class="pie_div" class="container">

                <article class="articulo">
                    <h1 class="footer_titulo">Sedes</h1>
                <p><strong>Sede Villavicencio</strong><br>
                    Cra 9 #37-04 <br>
                    Cel: 317 853 1932 <br>
                    luisardiabeticog@gmail.com
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
                            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                        </div>

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

