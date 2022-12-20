<?php
require_once 'header.php';
require_once 'connect.php';

if(!empty($_SESSION['login'])){
    $idEvent = $_GET['id'];
    $sql = "SELECT * 
            FROM reservations 
            INNER JOIN utilisateurs
            ON utilisateurs.id = reservations.id_utilisateur WHERE reservations.id = $idEvent";

    $sql_ex = $conn->prepare($sql);
    $sql_ex->execute();
    $results = $sql_ex->fetch(PDO::FETCH_ASSOC);

    $login = $results['login'];
    $titre = $results['titre'];
    $debut = $results['debut'];
    $fin = $results['fin'];
    $description = $results['description'];

    $jour = date('d/m/Y', strtotime($debut));
    $hdebut = date('H:i', strtotime($debut));
    $hfin = date('H:i', strtotime($fin));
}else{
    echo "<p class='error'>Connectez-vous pour lire les informations</p>";
    die();
}


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/reservation.css">
    <title>Réservations</title>
</head>
<body>

<section class="container_formulaire">
    <h1> Informations sur la réservation </h1>
    <section id="formulaire">
        <form>
            <fieldset>
                <label>Réservation faite par : <?= $login ?></label> <br>
                <label>Titre de la réservation: <?= $titre ?></label> <br>
                <label>Jour de la réservation: <?= $jour ?></label> <br>
                <label>Heure de début : <?= $hdebut ?></label> <br>
                <label>Heure de fin : <?= $hfin ?></label> <br>
                <label>Description  : <?= $description ?></label> <br>

            </fieldset>
        </form>
    </section>
</section>


</body>
</html>
