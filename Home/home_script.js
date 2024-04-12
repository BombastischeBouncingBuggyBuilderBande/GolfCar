import("../funktionen.js");

let bt = document.getElementById("home-1-button");
let quote = document.getElementById("quote")
let wavep = document.getElementById("wave_CenterPixel");
let container = document.getElementById("firstview");
let home_ic;

toggleFadeIn(quote);
toggleFadeIn(bt);

function show_more() {
    home_ic = document.getElementById("home_informationsContainer");

    document.getElementById("wave_holder").style.display = "flex";
    wavep.classList.add("wave");
    toggleFadeOut(quote);
    toggleFadeOut(bt);
    setTimeout(function () {
        home_ic.style.display = "grid";
        toggleFadeIn(home_ic);
        toggleFadeOut(wavep);
        quote.style.display = "none";
        bt.style.display = "none";
        wavep.style.display = "none"
        container.style.display = "none";
    }, 1000);
}
function change_home_info(page){
    document.getElementById("home-info-"+page).style.display = "block";
    document.getElementById("home-BottomButton-"+page).classList.add('underlined');
    document.getElementById("home_pageHolder").value = page;
    if(page !== 1){
        document.getElementById("home-info-"+1).style.display = "none";
        document.getElementById("home-BottomButton-"+1).classList.remove('underlined');
    }
    if(page !== 2){
        document.getElementById("home-info-"+2).style.display = "none";
        document.getElementById("home-BottomButton-"+2).classList.remove('underlined');
    }
    if(page !== 3){
        document.getElementById("home-info-"+3).style.display = "none";
        document.getElementById("home-BottomButton-"+3).classList.remove('underlined');
    }
}
function change_home_info_sideButton(pre_next){
    let current_page = parseInt(document.getElementById("home_pageHolder").value);
    if(pre_next === "next" && current_page !== 3){
        change_home_info(current_page+1);
    }if(pre_next !== "next" && current_page !== 1){
        change_home_info(current_page-1);
    }
}
// Scroll event listeners --------------------------------------------------------------------------------------------\
/*
// Für Maus und Touchpad
let lastEventTime = 0;
const eventThreshold = 300; // Millisekunden

// Für Maus und Touchpad
document.addEventListener('wheel', function(event) {
    if(window.innerWidth < 600) {
        let currentPage = document.getElementById("home_pageHolder").value;
        const now = Date.now();
        if (now - lastEventTime < eventThreshold) return; // Ignoriere Events, die zu schnell aufeinanderfolgen
        lastEventTime = now;

        if (document.getElementById("home-display").style.display === "flex" &&
            document.getElementById("home_informationsContainer").style.display === "grid") {
            if (event.deltaY < 0) {
                if (parseInt(currentPage) === 3) {
                    currentPage = 0;
                }
                console.log('Scrolling up ' + currentPage);
                change_home_info(parseInt(currentPage) + 1);
            } else if (event.deltaY > 0) {
                if (parseInt(currentPage) === 1) {
                    currentPage = 4;
                }
                console.log('Scrolling down ' + currentPage);
                change_home_info(parseInt(currentPage) - 1);
            }
        }
    }
});

// Für Touch-Geräte
let startY;
document.addEventListener('touchstart', function(event) {
    let currentPage = document.getElementById("home_pageHolder").value;
    startY = event.touches[0].clientY;
}, false);
document.addEventListener('touchend', function(event) {
    let currentPage = document.getElementById("home_pageHolder").value;
    var touchY = event.touches[0].clientY;
    if (startY > touchY) {
        if (parseInt(currentPage) === 1) {
            currentPage = 4;
        }
        console.log('Scrolling down ' + currentPage);
        change_home_info(parseInt(currentPage) - 1);
    } else if (startY < touchY) {
        if (parseInt(currentPage) === 3) {
            currentPage = 0;
        }
        console.log('Scrolling up ' + currentPage);
        change_home_info(parseInt(currentPage) + 1);
    }
    // Aktualisieren des Startpunkts für den Fall, dass das Scrollen fortgesetzt wird
    startY = touchY;
}, false);
*/
