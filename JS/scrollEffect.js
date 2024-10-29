// Detectar cuando el elemento .promo-text está en vista
document.addEventListener("scroll", () => {
    const promoText = document.querySelector(".promo-text");
    const rect = promoText.getBoundingClientRect();

    // Verificar si el contenedor de texto está en la vista del usuario
    if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
        promoText.classList.add("in-view");
    } else {
        promoText.classList.remove("in-view");
    }
});

document.addEventListener("scroll", () => {
    const bestText = document.querySelector(".text-best");
    const rect = bestText.getBoundingClientRect();

    if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
        bestText.classList.add("in-view");
    } else {
        bestText.classList.remove("in-view");
    }
});

document.addEventListener("scroll", () => {
    const streamingText = document.querySelector(".streaming-text");
    const rect = streamingText.getBoundingClientRect();

    // Verificar si el contenedor de texto está en la vista del usuario
    if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
        streamingText.classList.add("in-view");
    } else {
        streamingText.classList.remove("in-view");
    }
});

document.addEventListener("scroll", () => {
    const streamingText = document.querySelector(".content-title");
    const rect = streamingText.getBoundingClientRect();

    // Verificar si el contenedor de texto está en la vista del usuario
    if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
        streamingText.classList.add("in-view");
    } else {
        streamingText.classList.remove("in-view");
    }
});
