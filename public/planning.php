<?php
require_once 'header.php';
require '../src/Date/Week.php';
include 'connect.php';


$start = new DateTime('last monday');
$convertStart = $start->format('d-m-Y');
$end  = new DateTime('next monday');
$convertEnd = $end->format('d-m-Y');
$interval = new DateInterval("P1D");
$period = new DatePeriod($start, $interval, $end);


foreach ($period as $date){
    $arrayDate[] = [$date->format('d-m-Y')];
}

$sql = $conn->prepare("SELECT * 
        FROM utilisateurs
        INNER JOIN reservations
        ON utilisateurs.id = reservations.id_utilisateur");

$sql->execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);

print_r($results);


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/css/planning.css">


    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>

<div class="container_planning">
    <table>

    <?php

    ?>
    <?php for($i=7; $i < 20; $i++) : ?> <!-- tant que $i est inférieur à 20, on boucle. on met une balise <tr> -->
                <tr>
                    <?php if($i == 7) : ?>
                    <td class="td_vide"><?= " " ?></td>
                    <?php else : ?>
                        <td> <?= $i . "h"?>
                    <?php endif;?>
            <?php for($j = 0; $j < 7; $j++) : ?> <!-- si $j est inférieur à 7 on incrémente -->
                <?php if($i == 7) : ?> <!-- si $i égal à 7 alors on arrive en fin de première ligne et on veut afficher le jour la date du jour -->
                <td id="head"><?= displayDays($j) . ' ' . $arrayDate[$j][0]?></td>
                <?php else : ?> <!-- sinon on lance une nouvelle condition -->
                    <?php if($j > 4) : ?> <!-- si j est supérieur à 4 donc si on dépasse vendredi, alors on affiche l'indisponibilité -->
                        <td class="indisponible"><?= "indisponible" ?></td>
                    <?php else : ?> <!-- sinon c'est disponible et on affiche l'heure et le jour -->
                        <td class="disponible"><?= $i . ":00" . " " . displayDays($j) ?></td>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endfor; ?>
                </tr>
    <?php endfor; ?>

    </table>
</div>
</body>
</html>
