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
    </style>
</head>
<body>
<div class="content">
    <h1>Impressum</h1>
    <p>Angaben gemäß § 5 TMG:</p>
    <p><strong>Firmenname:</strong> Musterfirma GmbH</p>
    <p><strong>Adresse:</strong> Musterstraße 1, 12345 Musterstadt</p>
    <p><strong>Vertreten durch:</strong> Max Mustermann</p>
    <p><strong>Kontakt:</strong><br>
        Telefon: 01234 56789<br>
        E-Mail: info@musterfirma.de</p>
    <p><strong>Registereintrag:</strong><br>
        Eintragung im Handelsregister.<br>
        Registergericht: Amtsgericht Musterstadt<br>
        Registernummer: HRB 12345</p>
    <p><strong>Umsatzsteuer-ID:</strong><br>
        Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz: DE 123 456 789</p>
    <p><strong>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:</strong><br>
        Max Mustermann, Musterstraße 1, 12345 Musterstadt</p>
    <!-- Weitere relevante Informationen wie Berufsbezeichnung, zuständige Kammer, etc. können hier hinzugefügt werden -->
</div>
</body>
</html>
