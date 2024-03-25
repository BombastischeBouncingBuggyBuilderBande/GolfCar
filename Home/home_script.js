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

