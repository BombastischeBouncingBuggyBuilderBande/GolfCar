import("funktionen.js");

let bt = document.getElementById("button");
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
        home_ic.style.display = "block";
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
    if(page !== 1){
        document.getElementById("home-info-"+1).style.display = "none";
    }
    if(page !== 2){
        document.getElementById("home-info-"+2).style.display = "none";
    }
    if(page !== 3){
        document.getElementById("home-info-"+3).style.display = "none";
    }
}

