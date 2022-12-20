<?php
require_once 'header.php';
require_once 'connect.php';

$currentDate = date('Y-m-d');

if(!empty($_SESSION['login'])) {
    echo "<h3>Bonjour {$_SESSION['login']} </h3>";

    if (isset($_POST['submit']) && !empty($_POST['title']) && !empty($_POST['description'])){

        $id_user = $_SESSION['id'];
        $titre = $_POST['title'];
        $debut = $_POST['debut'];
        $fin = $_POST['fin'];
        $dateDebut = $_POST['date'] . " " . "0" . $debut . ":" . "00" . ":" . "00";
        $dateFin = $_POST['date'] . " " . "0" . $fin . ":" . "00" . ":" . "00";
        $description = $_POST['description'];
        $id_utilisateur = $_SESSION['id'];


        $sql = "INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES(:titre,:description, :debut, :fin, :id_utilisateur)";
        $sql_insert = $conn->prepare($sql);
        $sql_insert->bindParam(':titre', $titre);
        $sql_insert->bindParam(':description', $description);
        $sql_insert->bindParam(':debut', $dateDebut);
        $sql_insert->bindParam(':fin', $dateFin);
        $sql_insert->bindParam(':id_utilisateur', $id_utilisateur);
        $sql_insert->execute();

        echo "<p class='valid'>Réservation réussie </p>";
    }
    }else{
    echo "<p class='error'>Connectez-vous pour réserver un créneau</p>";
}




?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/form-resa.css">
    <title>Formulaire de réservation</title>
</head>
<body>

<section>
    <h1>Formulaire de réservation</h1>
</section>

<section>
    <form method="post">
        <label for="title">Titre:</label><br>
        <input type="text" id="title" name="title" placeholder="votre titre" required><br>

        <label for="debut">Heure de début:</label><br>
        <select id='debut' name='debut'>
            <?php for($i=8; $i < 19; $i++) :?>
                <?= "<option value='$i'>$i h</option>"?>
                <br>
            <?php endfor;?>
        </select>

        <label for="fin">Heure de fin:</label><br>
        <select id="fin" name="fin">
            <?php for($k=9; $k < 20; $k++) :?>
                <?= "<option value='$k'>$k h</option>"?>
            <?php endfor;?>
        </select><br>

        <label for="date">Date: </label><br>
        <input id="date" type="date" name="date" min="<?php echo $currentDate ?>"><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="5" cols="33" placeholder="votre description" required></textarea><br>

        <button type="submit" name="submit">Réserver</button>
    </form>
</section>
</body>
</html>

