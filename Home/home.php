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
        <h2>Schulprojekt Golfcar</h2>
        <div id="home-info-1-part1">
            <div>
                sind das Team 6B-Engineering aus der 5AT der <a target="_blank" href="https://www.fallmerayer.it/">J. PH. Fallmerayer</a>.
                Wie jedes Jahr gibt es in den fünften Klassen zum Abschluss des Jahres ein großes Projekt. <br>
                Es teilen sich die Schüler in 4-6er Gruppen und bekommen die selbe Problemstellung. Am 9. Mai wird das Projekt in der Aula der Fallmerayer sein Ende finden
                und alle Gruppen treten gegeneinander an um zu sehen wer das Projekt am besten umsetzen konnte.
            </div>
            <div>
                <img src="/resources/resources_home/picture_home_1">
            </div>
        </div>
        <div>

        </div>
    </section>
    <section style="display: none" id="home-info-2" class="home-info">
        <h2>Ziel des Projektes</h2>
        <div id="home-info-2-part1">
            <div>
            Dieses Jahr bekamen wir die Aufgabe ein Golfauto zu bauen, welches einen Golfball findet und diesen in eine Box befördert.
            Dabei soll das Auto vollkommen autonom fahren und trotz verschiedener Hindernisse, die auf dem Parkour platziert werden, sein Ziel finden.
            Es soll auch eine responsive Website gebaut werden, wo das Projekt vorgestellt wird, das ist die Website, die sie gerade sehen.
            Auf dieser Website wir auch die Kamera des Golfautos übertragen und man kann es darüber auch manuell steuern.
            </div>
            <div>
                <img src="">
            </div>
        </div>
        <h3>Fahrbahn</h3>
        <div>

        </div>
    </section>
    <section style="display: none" id="home-info-3">
        <h2></h2>
        <a>Unser Ansatz</a>
    </section>
    <div id="buttonHolder">
        <button id="home-BottomButton-1" class="homeButtons underlined" onclick="change_home_info(1)"></button>
        <button id="home-BottomButton-2" class="homeButtons" onclick="change_home_info(2)"></button>
        <button id="home-BottomButton-3" class="homeButtons" onclick="change_home_info(3)"></button>
    </div>
</div>