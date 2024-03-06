<link rel="stylesheet" href="style_home.css">
    <h1 id="quote" class="fade-in"> What color is your Golf-Car?</h1>
    <button class="fade-in" id="button" onclick="show_more()">▼</button>
    <div id="wave_CenterPixel"></div>

<script src="funktionen.js"></script>
<script>
    let bt = document.getElementById("button");
    let quote = document.getElementById("quote")
    let wavep = document.getElementById("wave_CenterPixel");
    let home_ic;

    toggleFadeIn(quote);
    toggleFadeIn(bt);



    function show_more(){
        home_ic = document.getElementById("home_informationsContainer");
        wavep.classList.add("wave");
        toggleFadeOut(quote);
        toggleFadeOut(bt);
        setTimeout(function(){
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
    <!-- Abschnitt 1 -->
        <h2>Dolor Sit Amet</h2>
        <p>Dolor sit amet, consectetur adipiscing elit. <a href="https://example.com">Beispiel-Link</a>.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <br>
    <!-- Abschnitt 2 -->
    <section id="abschnitt2">
        <h2>Consectetur Adipiscing</h2>
        <p>Elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </section>
    <br>
    <!-- Abschnitt 3 -->
    <section id="abschnitt3">
        <h2>Labore et Dolore</h2>
        <p>Magna aliqua. Ut enim ad minim veniam, <a href="https://example.com">ein weiterer Link</a> quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </section>
</div>