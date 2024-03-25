<link rel="stylesheet" href="Home/style_home.css">
<div id="firstview">
    <h1 id="quote" class="fade-in"> What color is your Golf-Car?</h1>
    <button class="fade-in" id="button" onclick="show_more()">▼</button>
</div>
<div id="wave_holder">
    <div id="wave_CenterPixel"></div>
</div>
<script src="../funktionen.js"></script>
<script src="Home/home_script.js"></script>
<script>
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
</script>
<div class="fade-in" id="home_informationsContainer">
    <section id="home-info-1">
        <a>asaaaaa</a>
    </section>
    <section style="display: none" id="home-info-2">
        <a>asaaffaaa</a>
    </section>
    <section style="display: none" id="home-info-3">
        <a>asaabbaaa</a>
    </section>
    <div id="buttonHolder">
        <button class="homeButtons" onclick="change_home_info(1)"></button>
        <button class="homeButtons" onclick="change_home_info(2)"></button>
        <button class="homeButtons" onclick="change_home_info(3)"></button>
    </div>
</div>