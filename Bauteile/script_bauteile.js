document.addEventListener('DOMContentLoaded', () => {

    const productData = [
        {
            name: "Raspberry Pi 4",
            price: "90,00 €",
            description: "Der Raspberry Pi fungiert als zentrale Steuereinheit.",
            img: 'Bauteile/src/Raspberry.png',
            link: "https://amzn.eu/d/3wYcVzR"
        },
        {
            name: "Ultraschall-Sensoren",
            price: "11,19 €",
            description: "Der Ultraschallsensor ermöglicht dem Fahrzeug die Erkennung von Hindernissen im Spielfeld.",
            img: 'Bauteile/src/Ultraschall.png',
            link: "https://amzn.eu/d/9WexASp"
        },
        {
            name: "Fotowiderstände",
            price: "5,99 €",
            description: "Der Fotoresistor erkennt ob es dunkel ist, dann wird der Nachtmodus aktiviert",
            img: 'Bauteile/src/Fotoresistor.png',
            link: "https://amzn.eu/d/cGOM9i2"
        },
        {
            name: "Motoren - Reifen",
            price: "11,99 €",
            description: "Die Motoren sorgen für die Fortbewegung des Fahrzeugs.",
            img: 'Bauteile/src/Motor.png',
            link: "https://amzn.eu/d/hxOoEGC"
        },
        {
            name: "9V Batterieclip",
            price: "6,99 €",
            description: "Die 9V-Batteriehalterung ermöglicht die Verwendung von 9V-Batterien.",
            img: 'Bauteile/src/Batterieclip.png',
            link: "https://amzn.eu/d/iSDs2j1"
        },
        {
            name: "9V Batterien",
            price: "9,99 €",
            description: "Die Batterien versorgen die Motoren mit Strom",
            img: 'Bauteile/src/Batterie.png',
            link: "https://amzn.eu/d/1RhHeWc"
        },
        {
            name: "Kabel Einpolig",
            price: "9,99 €",
            description: "Verbinden kleinere Distanzen auf den Steckbrett",
            img: 'Bauteile/src/Kabel.png',
            link: "https://amzn.eu/d/1RhHeWc"
        },
        {
            name: "Ansteuerung Motor",
            price: "10,59 €",
            description: "H-Bridge die die Motoren mit Strom von den Batterien versorgt",
            img: 'Bauteile/src/AnsteuerungMotor.png',
            link: "https://amzn.eu/d/1RhHeWc"
        },
        {
            name: "Encoder",
            price: "9,49 €",
            description: "Kontrolliert die zurückgelegte Distanz jedes Reifens",
            img: 'Bauteile/src/Encoder.png',
            link: "https://amzn.eu/d/bsT8Z4n"
        },
        {
            name: "Jumper Wire",
            price: "10,00 €",
            description: "Verbinden größere Distanzen auf den Steckbrett",
            img: 'Bauteile/src/JumperWire.png',
            link: "https://amzn.eu/d/bsT8Z4n"
        },
        {
            name: "Steckbrett",
            price: "6,99 €",
            description: "Einfache Verbindung von Komponenten",
            img: 'Bauteile/src/Steckbrett.png',
            link: "https://amzn.eu/d/h4YKr6N"
        },
        {
            name: "Kamera",
            price: "44,99 €",
            description: "Zum erkennen des Balles",
            img: 'Bauteile/src/Kamera.png',
            link: "https://amzn.eu/d/8qxDuHg"
        },
        // Add more products here as needed
    ];

    const productContainer = document.getElementById('product-scroll-container');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    const productsPerPage = 6; // Number of products to display per page
    let currentPage = 0;

    function displayProducts() {
        productContainer.innerHTML = '';
        const startIndex = currentPage * productsPerPage;
        const endIndex = startIndex + productsPerPage;
        const productsToDisplay = productData.slice(startIndex, endIndex);

        productsToDisplay.forEach(product => {
            const productCard = document.createElement('div');
            productCard.classList.add('product-card');
            productCard.innerHTML = `
                <img src="${product.img}" alt="${product.name}">
                <div class="product-info">
                    <h2>${product.name}</h2>
                    <p class="price">${product.price}</p>
                    <p class="description">${product.description}</p>
                    <a href="${product.link}" target="_blank">Kaufen</a>
                </div>
            `;
            productCard.addEventListener('click', () => {
                window.open(product.link, '_blank');
            });
            productContainer.appendChild(productCard);
        });
    }

    prevBtn.style.visibility = "hidden";

    prevBtn.addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            displayProducts();
        }

        prevBtn.style.visibility = "hidden";
        nextBtn.style.visibility = "visible";
    });

    nextBtn.addEventListener('click', () => {
        if (currentPage < Math.floor(productData.length / productsPerPage)) {
            currentPage++;
            displayProducts();
        }

        nextBtn.style.visibility = "hidden";
        prevBtn.style.visibility = "visible";

    });

    // Initial display of products
    displayProducts();

});