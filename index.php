<?php
// index.php
include 'conexion.php';

// Consultar servicios de la base de datos
$servicios = $conexion->query("SELECT * FROM Servicios");
$promociones = $conexion->query("SELECT * FROM PromocionesEspeciales");
$mejorParaTi = $conexion->query("SELECT * FROM LoMejorParaTi");
$netflixPromo = $conexion->query("SELECT * FROM InfoNetflix LIMIT 1")->fetch_assoc();
$streamingTotal = $conexion->query("SELECT * FROM StreamingTotal");
$spotifyPromo = $conexion->query("SELECT * FROM InfoSpotify LIMIT 1")->fetch_assoc();
$otrosServicios = $conexion->query("SELECT * FROM OtrosServicios");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./CSS/index.css">
    <link rel="icon" href="./RESOURSES/logoStreaming00.png" type="image/x-icon" style="height: 15px; white-space: 15px;">
    <title>PlataformasDeStreaming</title>
</head>
<body>
<!-- Seccion principal imagen Inicio --> 
    <section class="inicio">
        <div class="container">
            <div class="content">
                <h1>¡Todo tu entretenimiento en un solo lugar!</h1>
                <p>El mejor contenido, al alcance de un clic</p>
                <button>¡Contactar Ahora!</button>
            </div>
        </div>
    </section>

   <!-- Sección de servicios que se ofrecen, productos --> 
   <section class="cards">
        <?php while ($servicio = $servicios->fetch_assoc()): ?>
            <div class="card">
                <img src="<?php echo htmlspecialchars($servicio['imagen_url']); ?>" alt="<?php echo htmlspecialchars($servicio['nombre']); ?>">
                <div class="card-body">
                    <h2><?php echo number_format($servicio['precio'], 2); ?> COP</h2>
                    <p><?php echo htmlspecialchars($servicio['garantia']); ?></p>
                    <button class="contact-button" 
                            data-nombre="<?php echo htmlspecialchars($servicio['nombre']); ?>" 
                            data-precio="<?php echo number_format($servicio['precio'], 2); ?>" 
                            data-garantia="<?php echo htmlspecialchars($servicio['garantia']); ?>">Contactar</button>
                </div>
            </div>
        <?php endwhile; ?>
    </section>

<!-- Sección de información de cuentas premium -->
<section class="premium-section">
    <div class="description">
        <div class="image-container">
            <div class="popcorn-image"></div> <!-- Imagen de palomitas -->
        </div>
        <div class="text-container">
            <h2>Accede a tus plataformas favoritas como Netflix, Amazon Prime, y HBO Max con nuestras cuentas premium. Todo el contenido que amas, en un solo lugar y a precios inmejorables.</h2>
        </div>
    </div>
    <div class="benefits-container">
        <div class="benefit">
            <img src="./RESOURSES/diamante.png" alt="Acceso Premium">
            <h3>Acceso Premium</h3>
            <p>Disfruta de contenido exclusivo</p>
        </div>
        <div class="benefit">
            <img src="./RESOURSES/hucha.png" alt="Ahorro Garantizado">
            <h3>Ahorro Garantizado</h3>
            <p>Obtén precios competitivos</p>
        </div>
        <div class="benefit">
            <img src="./RESOURSES/disponible.png" alt="Disponibilidad Inmediata">
            <h3>Disponibilidad Inmediata</h3>
            <p>Accede a tus cuentas al instante</p>
        </div>
        <div class="benefit">
            <img src="./RESOURSES/apoyo.png" alt="Soporte 24/7">
            <h3>Soporte 24/7</h3>
            <p>Con atención rápida y eficaz</p>
        </div>
    </div>
</section>

<!-- Sección de promociones especiales -->
<section class="promo-section">
        <?php if ($promo = $promociones->fetch_assoc()): ?>
            <!-- Tarjeta de Promoción (lado izquierdo) -->
            <div class="promo-card">
                <div class="promo-header">
                    <h3><?php echo htmlspecialchars($promo['nombre']); ?></h3>
                    <span class="ribbon">EN OFERTA</span>
                    <p class="promo-subtitle"><?php echo htmlspecialchars($promo['garantia']); ?></p>
                </div>
                <p class="promo-price">COP <strong><?php echo number_format($promo['precio'], 2); ?></strong> Mensual</p>
                <div class="promo-logos">
                    <img src="<?php echo htmlspecialchars($promo['imagen_url']); ?>" alt="<?php echo htmlspecialchars($promo['nombre']); ?>">
                </div>
                <button class="contact-button" 
                    data-nombre="<?php echo htmlspecialchars($promo['nombre']); ?>" 
                    data-precio="<?php echo number_format($promo['precio'], 2); ?>" 
                    data-garantia="<?php echo htmlspecialchars($promo['garantia']); ?>">Contactar</button>


            </div>
        <?php endif; ?>
        
        <!-- Texto "PROMO ESPECIAL" con efecto (lado derecho) -->
        <div class="promo-text"><h1>PROMO<br>ESPECIAL</h1></div>
    </section>

<!-- banner -->
<section class="banner">
    <p>CUENTAS 100% LEGALES, 30 DÍAS GARANTIZADOS</p>
</section>

<!-- Sección para tí -->
<section class="section-best-for-you">
        <div class="text-best">
            <h1>LO MEJOR<br>PARA TÍ</h1>
        </div>
        <div class="cards-best-for-you">
            <?php while ($elemento = $mejorParaTi->fetch_assoc()): ?>
                <div class="card-best">
                    <div class="ribbon-best">POPULAR</div>
                    <img src="<?php echo htmlspecialchars($elemento['imagen_url']); ?>" alt="<?php echo htmlspecialchars($elemento['nombre']); ?>">
                    <div class="card-best-body">
                        <p>COP <strong><?php echo number_format($elemento['precio'], 2); ?></strong> Mensual</p>
                        <p class="guarantee">✔ Garantía de <?php echo htmlspecialchars($elemento['garantia']); ?></p>
                        <button class="contact-button" 
                            data-nombre="<?php echo htmlspecialchars($elemento['nombre']); ?>" 
                            data-precio="<?php echo number_format($elemento['precio'], 2); ?>" 
                            data-garantia="<?php echo htmlspecialchars($elemento['garantia']); ?>">Contactar</button>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

<!-- Sección de la promoción de Netflix -->
<section class="netflix-promo-section">
    <div class="netflix-logo-container">
        <img src="<?php echo htmlspecialchars($netflixPromo['imagen_url']); ?>" alt="Netflix Logo">
    </div>
    <div class="promo-content">
        <p class="price">$<?php echo number_format($netflixPromo['precio'], 2); ?></p>
        <p class="description0"><?php echo htmlspecialchars($netflixPromo['descripcion']); ?></p>
        <button class="promo-button" 
                data-nombre="Netflix" 
                data-precio="<?php echo number_format($netflixPromo['precio'], 2); ?>" 
                data-garantia="<?php echo htmlspecialchars($netflixPromo['descripcion']); ?>"
                data-imagen="<?php echo htmlspecialchars($netflixPromo['imagen_url']); ?>">
            <?php echo htmlspecialchars($netflixPromo['boton_texto']); ?>
</button>

    </div>
</section>

<!-- Sección de Streaming Total -->
<section class="streaming-section">
    <div class="streaming-text">
        <h1>STREAMING TOTAL</h1>
    </div>
    <div class="streaming-cards">
        <?php while ($elemento = $streamingTotal->fetch_assoc()): ?>
            <div class="card-streaming">
                <div class="card-image" style="background-color: #1e3a8a;">
                    <img src="<?php echo htmlspecialchars($elemento['imagen_url']); ?>" alt="<?php echo htmlspecialchars($elemento['nombre']); ?>">
                </div>
                <div class="card-info">
                    <p class="price">COP <?php echo number_format($elemento['precio'], 2); ?></p>
                    <p class="guarantee">✔ <?php echo htmlspecialchars($elemento['garantia']); ?></p>
                    <button class="contact-button" 
                        data-nombre="<?php echo htmlspecialchars($elemento['nombre']); ?>" 
                        data-precio="<?php echo number_format($elemento['precio'], 2); ?>" 
                        data-garantia="<?php echo htmlspecialchars($elemento['garantia']); ?>">Contactar</button>

                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<!-- Sección de la promoción de Spotify -->
<section class="spotify-promo-section-spotify">
    <div class="spotify-logo-container">
        <img src="<?php echo htmlspecialchars($spotifyPromo['imagen_url']); ?>" alt="Spotify Logo">
    </div>
    <div class="promo-content-spotify">
        <p class="price-Spotify">$<?php echo number_format($spotifyPromo['precio'], 2); ?></p>
        <p class="description1"><?php echo htmlspecialchars($spotifyPromo['descripcion']); ?></p>
        <button class="promo-button-spotify" 
                data-nombre="Spotify" 
                data-precio="<?php echo number_format($spotifyPromo['precio'], 2); ?>" 
                data-garantia="<?php echo htmlspecialchars($spotifyPromo['descripcion']); ?>"
                data-imagen="<?php echo htmlspecialchars($spotifyPromo['imagen_url']); ?>">
            <?php echo htmlspecialchars($spotifyPromo['boton_texto']); ?>
</button>

    </div>
</section>

<!-- Sección de Otros Servicios -->
<section class="content-streaming">
    <div class="content-title">
        <h1>OTROS SERVICIOS</h1>
    </div>
    <div class="content-cards">
        <?php while ($elemento = $otrosServicios->fetch_assoc()): ?>
            <div class="stream-card">
                <div class="stream-card-image" style="background-color: #1e3a8a;">
                    <img src="<?php echo htmlspecialchars($elemento['imagen_url']); ?>" alt="<?php echo htmlspecialchars($elemento['nombre']); ?>">
                </div>
                <div class="stream-card-info">
                    <p class="stream-price">COP <?php echo number_format($elemento['precio'], 2); ?></p>
                    <p class="stream-guarantee">✔ Garantía de <?php echo htmlspecialchars($elemento['garantia']); ?></p>
                    <button class="stream-contact-button">Contactar</button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<!-- boton WhatsApp -->
<a href="https://wa.me/573005633431?text=¡Hola!%20Quisiera%20más%20información." class="whatsapp-button" target="_blank">
    <img src="./RESOURSES/whatsapp.png" alt="WhatsApp"></a>
<script src="./JS/scrollEffect.js"></script>
<script src="./JS/whatsappRedirect.js"></script>


<!-- Footer -->
<footer class="site-footer">
    <div class="footer-logo">
        <img src="./RESOURSES/logoStreaming00.png" alt="Logo de la empresa">
    </div>
    <div class="footer-links">
        <a href="">Inicio</a>
    </div>
    <div class="footer-info">
        <p>&copy; 2024 Plataformas de Streaming <br> <em>Todos los derechos reservados.</em></p>
    </div>
</footer>

</body>
</html>