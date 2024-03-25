<link rel="stylesheet" href="Home/style_home.css">
<div id="firstview">
    <h1 id="quote" class="fade-in"> What color is your Golf-Car?</h1>
    <button class="fade-in" id="button" onclick="show_more()">▼</button>
</div>
<div id="wave_holder">
    <div id="wave_CenterPixel"></div>
</div>
<script src="../funktionen.js"></script>
<script src="/Home/home_script.js"></script>
<script>
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
</script>
<div class="fade-in" id="home_informationsContainer">
    <section id="home-info-1">

    </section>
    <section id="home-info-2">

    </section>
    <section id="home-info-3">

    </section>
    <div>
        <button onclick="change_home_info()"></button>
        <button></button>
        <button></button>
    </div>
</div>