import("funktionen.js");

let bt = document.getElementById("button");
let quote = document.getElementById("quote")
let wavep = document.getElementById("wave_CenterPixel");
let home_ic;

toggleFadeIn(quote);
toggleFadeIn(bt);

function show_more() {
    home_ic = document.getElementById("home_informationsContainer");
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
    }, 1000);

}
function change_home_info(){

}
