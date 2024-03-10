    // Array mit allen Elementen der Navbar (Hauptelemente der Website)
    let background_text = ["Home", "About", "Downloads", "Live", "Diary", "Control"];

    // Deaktiviert den Text der Hinter der Navbar erscheint, wenn man darüberhovert
    function deactivate_background_text() {
        let allmenu = document.getElementsByClassName("nav-link");
        for (let i = 0; i < allmenu.length; i++) {
            allmenu[i].setAttribute('background-text', "");
        }
    }

    // Aktiviert den Text der Hinter der Navbar erscheint, wenn man darüberhovert
    function activate_background_text() {
        let allmenu = document.getElementsByClassName("nav-link");
        for (let i = 0; i < allmenu.length; i++) {
            allmenu[i].setAttribute('background-text', background_text[i]);
        }
    }

    // Deaktiviert jeden Infotext (Information die auf der linken Seite angezeigt wird), außer den der ausgewählt wird
    function deactivate_all_but(but) {
        if (document.getElementById(but).style.display === "block") {
            deactivate_split_mode();
            return 0;
        }else{
            activate_split_mode()
        }
        for (let i = 0; i < background_text.length; i++) {
            let textPart = "" + background_text[i].toLowerCase() + "-display";

            if (textPart !== but) {
                document.getElementById(background_text[i].toLowerCase() + "-display").style.display = "none";
                toggleFadeOut(document.getElementById(background_text[i].toLowerCase() + "-display"));
            } else {
                document.getElementById(background_text[i].toLowerCase() + "-display").style.display = "block";
                console.log(textPart);
                toggleFadeIn(document.getElementById(background_text[i].toLowerCase() + "-display"));
            }
        }
    }

    // Bewegt die Navbar nach links und lässt rechts davon den Infotext erscheinen
    function activate_split_mode() {
        document.getElementById("informationsContainer").style.display = "block";
        document.getElementById("mainContainer").style.gridTemplateColumns = "30vw 70vw";
        console.log("seitenverhältnis geändert");
        deactivate_background_text();

        let sponsorImg = document.getElementById("sponsorImg");
        sponsorImg.style.left = "0";
        sponsorImg.classList.add("start-animation");
        sponsorImg.classList.remove("start-animation-reverse");


    }

    // Generiert die Ursprungsform der Website, mit nur der Navbar in der Mitte
    function deactivate_split_mode() {
        console.log("deactivating split mode");
        document.getElementById("informationsContainer").style.display = "none";
        document.getElementById("mainContainer").style.gridTemplateColumns = "100vw 0"; // informationsteil der Website wird ausgeblendet
        console.log("seitenverhältnis geändert");
        deactivate_all_display();
        setTimeout(function() {
            activate_background_text();
        }, 500);

        let sponsorImg = document.getElementById("sponsorImg");
        sponsorImg.style.left = "calc(50% - (20%/2))";
        sponsorImg.classList.remove("start-animation");
        sponsorImg.classList.add("start-animation-reverse");
    }

    // Deaktiviert das Display aller Informationen
    function deactivate_all_display() {
        for (let i = 0; i < background_text.length; i++) {
            toggleFadeOut(document.getElementById((background_text[i].toLowerCase() + "-display").toString()));
            setTimeout(function() {
                document.getElementById((background_text[i].toLowerCase() + "-display").toString()).style.display = "none";
            }, 1000);
        }
    }

    function hideSponsor(){
        document.getElementById("SponsorContainer").style.display = "none";
    }
