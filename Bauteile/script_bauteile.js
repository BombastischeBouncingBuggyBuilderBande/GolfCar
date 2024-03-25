document.addEventListener('DOMContentLoaded', () => {

    const productData = [
        {
            name: "Raspberry Pi 4 Modello B (8GB)",
            price: "90,00 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            img: 'Bauteile/src/Raspberry.png',
            link: "https://shorturl.at/PUZ16"
            //https://www.amazon.it/RASPBERRY-PI-RPI4-MODBP-8GB-Raspberry-Modello/dp/B09TTKT94J/ref=sr_1_5?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=335VPT7C4UGEH&dib=eyJ2IjoiMSJ9.6L0DUDUKuOMNsAEY7aHC_S_Kln7Bzf9lXmPQyUeLEUu1Dt35l7e7m7F4oa6XpBcehB1G6gwykFsrIZS1R-Yu25PStZ16EqH4Zgs_ajwKxUYwmVj2hQwAkSy4POdaqeC9BCioyCT-AeBkIKOPxBDICFDEKOeIXzIZ_jIKksjtwNwh2LhMTAU94M6ONGwaPaQQUJ9OlZJZhLbxWm9ufvbOohJCPfDp7od8CPRHkq0X229516DazqDDy1cxiUUfbxovXD3v213Xzo2hl8DmI5Vly8A4NTcggBoDwfZpdHfjBrY.FMPWpHpbl-qsUMIlkMW7ng-yQtXeAsWwDkXI-afIpcQ&dib_tag=se&keywords=raspberry+pi+4+8gb&qid=1708894480&sprefix=raspberry+pi+4+8g%2Caps%2C124&sr=8-5
        },
        {
            name: "Ultraschall-Sensor",
            price: "11,19 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            img: 'Bauteile/src/Ultraschall.png',
            link: "https://shorturl.at/gLTV7"
            //https://www.amazon.it/AZDelivery-fotoresistenti-LDR5528-compatibili-Arduino/dp/B089YNCYG4/ref=sr_1_6?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=L0DK76OTWFPL&keywords=photoresistor&qid=1707295933&sprefix=photoresistor%2Caps%2C198&sr=8-6&th=1
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 1",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
        },
        {
            name: "Produktname 2131",
            price: "99,99 €",
            description: "Eine kurze Beschreibung des Produkts 1, wo der Nutzen beschrieben wird.",
            link: "link/to/purchase-location"
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
            const productCard = `
                <div class="product-card">
                    <img src="${product.img}" alt="${product.name}">
                    <div class="product-info">
                        <h2>${product.name}</h2>
                        <p class="price">${product.price}</p>
                        <p class="description">${product.description}</p>
                        <a href="${product.link}" target="_blank">Kaufen</a>
                    </div>
                </div>
            `;
            productContainer.innerHTML += productCard;
        });
    }

    prevBtn.addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            displayProducts();
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentPage < Math.floor(productData.length / productsPerPage)) {
            currentPage++;
            displayProducts();
        }
    });

    // Initial display of products
    displayProducts();

});