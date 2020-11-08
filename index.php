<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style type="text/css">
        .calendar {
            text-align: center;
            border: 1px solid black;
            margin: 0;
            padding: 0;
        }

        .jour_en_lettres {
            background-color: gray;
            color: black;
            font-weight: bold;
        }

        .jour_du_mois_precedant {
            background-color: black;
            color: gray;
        }

        .jour_du_mois_suivant {
            background-color: black;
            color: gray;
        }

        .jour_du_mois_en_cours {
            background-color: yellow;
            color: blue;
        }
    </style>
</head>

<body>
    <?php
    include('calendrier.php');
    $today = time();
    showCalendar($today);
    ?>
</body>

</html>