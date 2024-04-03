<link rel="stylesheet" href="Home/style_home.css">
<div id="firstview">
    <h1 id="quote" class="fade-in"> What color is your Golf-Car?</h1>
    <button class="fade-in" id="home-1-button" onclick="show_more()">▼</button>
</div>
<div id="wave_holder">
    <div id="wave_CenterPixel"></div>
</div>
<script src="../funktionen.js"></script>
<script src="Home/home_script.js"></script>
<script src="home_script.js"></script> <!-- damit lokal die Klassen gefunden werden, beim öffnen mit Localhost wird alles über Index.php geladen, sprich der Pfad ist ein anderer -->
<div class="fade-in" id="home_informationsContainer">
    <input style="display: none" id="home_pageHolder" value=1>
    <button class="home-side-Button" id="home-right-button" onclick="change_home_info_sideButton('next')">></button>
    <button class="home-side-Button" id="home-left-button" onclick="change_home_info_sideButton('prev')"><</button>
    <section id="home-info-1" class="home-info">
        <h2>Allgemeine Informationen</h2>
        <a>Unser Ziel ist klar: ein selbstfahrendes Auto zu entwickeln, das Golfbälle aufspürt und einsammelt. <br>
            Dieses Fahrzeug soll selbstständig navigieren, Hindernisse erkennen und den kürzesten Weg zum Ziel finden. <br>
            Die Herausforderung liegt darin, präzise Sensoren und intelligente Algorithmen zu kombinieren, <br>
            um diese Aufgaben unter verschiedenen Bedingungen zuverlässig zu <erfüllen class=""></erfüllen>
        </a>
    </section>
    <section style="display: none" id="home-info-2" class="home-info">
        <a>Wir haben ein Miniatur-Golfcar entworfen, das mit einem einfachen, aber cleveren Mechanismus ausgestattet ist: <br>
            Einem Greifarm, der Golfbälle aufspürt, aufnimmt und sie zielgenau in einen Karton befördert. <br>
            Dieses kleine Fahrzeug kann sowohl automatisch als auch manuell über eine einfache Websteuerung gefahren werden,<br>
            was es zu einem vielseitigen Tool auf dem Miniatur-Golfplatz macht.<br>
        </a>
    </section>
    <section style="display: none" id="home-info-3">
        <a>asaabbaaa</a>
    </section>
    <div id="buttonHolder">
        <button id="home-BottomButton-1" class="homeButtons underlined" onclick="change_home_info(1)"></button>
        <button id="home-BottomButton-2" class="homeButtons" onclick="change_home_info(2)"></button>
        <button id="home-BottomButton-3" class="homeButtons" onclick="change_home_info(3)"></button>
    </div>
</div>