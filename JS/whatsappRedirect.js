document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los botones de contacto con las clases específicas
    const contactButtons = document.querySelectorAll(".contact-button, .promo-button, .promo-button-spotify");

    contactButtons.forEach(button => {
        button.addEventListener("click", function() {
            // Captura los datos del producto desde los atributos del botón
            const nombre = this.getAttribute("data-nombre");
            const precio = this.getAttribute("data-precio");
            const garantia = this.getAttribute("data-garantia");
            const imagenUrl = this.getAttribute("data-imagen");

            // Define el mensaje de WhatsApp con los datos del producto
            let mensaje = `¡Hola! Estoy interesado en el producto "${nombre}". Precio: ${precio} COP. Garantía: ${garantia}.`;
            if (imagenUrl) {
                mensaje += ` Mira la imagen aquí: ${imagenUrl}`;
            }
            mensaje += " ¿Podrías darme más información?";

            // Redirige a WhatsApp con el mensaje
            const whatsappUrl = `https://wa.me/573005633431?text=${encodeURIComponent(mensaje)}`;
            window.open(whatsappUrl, "_blank");
        });
    });
});
