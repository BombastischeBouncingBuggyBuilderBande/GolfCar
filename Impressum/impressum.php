<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Impressum</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center; /* Zentriert die Inhalte horizontal */
            justify-content: center; /* Zentriert die Inhalte vertikal */
        }

        .content {
            /* Der eigentliche Inhalt beginnt im vertikalen Zentrum und expandiert von dort */
            margin-top: auto; /* Schiebt den Inhalt nach oben, startend vom Zentrum */
            margin-bottom: auto; /* Ermöglicht, dass der untere Teil des Inhalts ebenfalls zentriert erscheint */
            text-align: center; /* Zentriert den Text innerhalb des .content Divs */
            font-size: x-large;
        }

        h1, p {
            margin-top: auto;
            margin-bottom: auto;
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .content {
                width: 90%; /* Increases width on smaller screens for better readability */
                font-size: medium; /* Adjusts font size for smaller screens */
            }

            h1 {
                font-size: 1.5em; /* Larger header font size for small screens */
            }

            p {
                font-size: 1em; /* Adjusts paragraph font size for small screens */
            }
        }

        @media (max-width: 480px) {
            .content {
                width: 95%; /* Even wider on very small screens */
            }

            h1 {
                font-size: 1.3em; /* Slightly smaller header font size for very small screens */
            }

            p {
                font-size: 0.9em; /* Slightly smaller paragraph font size for very small screens */
            }
        }
    </style>
</head>
<body>
<div class="content">
    <h1>Impressum</h1>
    <br>
    <p>Angaben gemäß § 5 TMG:</p>
    <p><strong>Firmenname:</strong> 6B Engineering Unternehmergesellschaft (haftungsbeschränkt)</p>
    <p><strong>Adresse:</strong> Dantestraße 39e, 39042 Brixen, Provinz Bozen, Italien</p>
    <p><strong>Vertreten durch:</strong> Patrick Priller</p>
    <p><strong>Kontakt:</strong><br>
        Telefon: +39 345 468 6425<br>
        E-Mail: 6bengineering.fallmerayer@gmail.com</p>
    <p><strong>Registereintrag:</strong><br>
        Eintragung im Handelsregister wird noch durchgeführt.<br>
        Registergericht: Amtsgericht Bozen<br>
        Registernummer: Wird nachgereicht</p>
    <p><strong>Umsatzsteuer-ID:</strong><br>
        Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz: Wird nachgereicht</p>
    <p><strong>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:</strong><br>
        Patrick Priller, Schwesternau, 4, 39042 Brixen</p>
    <p><strong>Website:</strong> <a href="https://golfcar.space/">golfcar.space</a></p>
    <!-- Weitere relevante Informationen wie Berufsbezeichnung, zuständige Kammer, etc. können hier hinzugefügt werden -->
</div>
</body>
</html>
