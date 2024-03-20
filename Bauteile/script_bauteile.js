document.addEventListener('DOMContentLoaded', () => {
    const scrollContainer = document.querySelector('.product-scroll-container');
    console.log("loaded");


    scrollContainer.addEventListener('scroll', () => {
        console.log("scroll!!!");
        // Bestimme, ob der Benutzer das Ende des Containers erreicht hat
        const maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;
        if (scrollContainer.scrollLeft >= maxScrollLeft) {
            // Funktion, die neue Produkte einblendet
            revealProducts();
        }
    });
});

function revealProducts() {
    console.log("scroll!!!");
    // Finde alle versteckten Produktkarten und blende die nächsten ein
    const hiddenProducts = document.querySelectorAll('.product-card.hidden');
    for (let i = 0; i < 2 && i < hiddenProducts.length; i++) { // Beispiel: 2 Produkte bei jedem Scroll-Event einblenden
        hiddenProducts[i].classList.remove('hidden');
    }
}
