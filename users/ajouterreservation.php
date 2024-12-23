<?php
session_start();
// Ensuite, accédez aux variables de session.
if (!isset($_SESSION["email"])) {
    header("location:authentification.php");
    exit;
}

include("connexion.php");
$stmt=$conn->prepare("select num_locataire, nom,prenom,ville from locataire where num_locataire=:num_locataire");
    $stmt->bindParam(':num_locataire',$_SESSION['num_locataire']);
    $stmt->execute();
    $client=$stmt->fetch(PDO::FETCH_ASSOC);

$stmt=$conn->prepare("select voiture.* , locataire.ville from voiture join locataire on locataire.num_locataire=voiture.id_client
 where matricule=:matricule");
$stmt->bindParam(':matricule',$_GET['matricule']);
$stmt->execute();
$voiture=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['ok']) ){
    $stmt=$conn->prepare("SELECT count(*) AS count 
    FROM reservations 
    WHERE matricule = :matricule 
    AND (
        (date_debut BETWEEN :date_debut AND :date_fin) 
        OR (date_fin BETWEEN :date_debut AND :date_fin) 
        OR (:date_debut BETWEEN date_debut AND date_fin) 
        OR (:date_fin BETWEEN date_debut AND date_fin)
    )");
   $stmt->bindParam(':matricule',$_GET['matricule']);
   $stmt->bindParam(':date_debut',$_POST['date_debut']);
   $stmt->bindParam(':date_fin',$_POST['date_fin']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result['count'] > 0) {
    echo "<script>alert('La voiture est déjà réservée pour les dates sélectionnées.');</script>";
} else {
    $dateDebut = new DateTime($_POST['date_debut']);
    $dateFin = new DateTime($_POST['date_fin']);
    $interval = $dateDebut->diff($dateFin);
    $days = $interval->days + 1; // Inclure le jour de départ
    $prixTotal = $days * $voiture['prix'];

    $stmt = $conn->prepare("INSERT INTO reservations (id_client, matricule, date_debut, date_fin,prix_total) VALUES ( :id_client,:matricule, :date_debut, :date_fin,:prix_total)");
    $stmt->bindParam(':matricule', $_GET['matricule']);
    $stmt->bindParam(':id_client', $client['num_locataire']);
    $stmt->bindParam(':date_debut', $_POST['date_debut']);
    $stmt->bindParam(':date_fin', $_POST['date_fin']);
    $stmt->bindParam(':prix_total', $prixTotal);

    if ($stmt->execute()) {
        echo "<script>alert('Réservation effectuée avec succès !');</script>";
    } else {
        echo "<script>alert('Une erreur est survenue lors de la réservation.');</script>";
    }
}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            box-sizing: border-box;
           font-family: "Poppins", sans-serif;  
        }
        body{
            background: url('Revised.png') no-repeat;
            background-size: cover;
            background-position: center;
            color: #fff;
            font-weight: bold;
        }
        .card1{
            display: flex;
            justify-content: space-between;
            width: 80%;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px ;
            margin: 40px auto;
        }
        form {
            background: #fff;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px ;
        }
        .infoclient {
            width: 80%;
            margin: auto;

        }
        .infoclient h1 {
            align-items: center;
            text-align: center;
        }
        .h11 {
            text-align: center;
            margin-top: 15px;
        }
        .infoclient input {
            width: 80%;
            height: 100%;
            background:rgba(34, 34, 34, 0.48);
            border: none;
            outline: none;
            border: 2px solid rgba(255,255,255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;

        }
        .infoclient input[type="submit"] {
            color: black;
            background-color: #fff;
            margin-top: 10px ;
          
            
        }
        .infoclient input[type="submit"]:hover {
            color: #fff;
            background-color: green;
            cursor: pointer;
        }
        table a {
            text-decoration: none;
            color: #fff;
            margin-top: 5px ;
            padding: 20px 45px 20px 20px;
        }
        table a:hover {
            border-bottom: 2px solid #fff;
        }
        table {
            margin: auto;
            width: 75%;
        }
       
    </style>
</head>
<body>
    <div class="h11">
<h1>info Voiture</h1></div>
<div class="card1">

        <div class="infov">
            
            <h1><?php echo htmlspecialchars($voiture['marque']); ?></h1>
            <h1 style="color:red; "><?php echo htmlspecialchars($voiture['prix']); ?> Dh/Jour</h1>
            <h2><?php echo htmlspecialchars($voiture['ville']); ?></h2>
            <p><?php echo htmlspecialchars($voiture['description']); ?></p>
        </div>
    <div class="b"><img width="400px" src="<?php echo htmlspecialchars($voiture['image']); ?>" alt=""></div>
</div>  
    <div class="infoclient">
            <h1 text-align="center">info client</h1>
            <table>
            <form action="" method="post" class="styled-form">
    <table>
        <tr>
            <td><label for="nom">Nom</label></td>
            <td><input type="text" value="<?php echo htmlspecialchars($client['nom']); ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="prenom">Prénom</label></td>
            <td><input type="text" value="<?php echo htmlspecialchars($client['prenom']); ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="ville">Ville</label></td>
            <td><input type="text" value="<?php echo htmlspecialchars($client['ville']); ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="date1">Date de début</label></td>
            <td><input type="date" name="date_debut" required></td>
        </tr>
        <tr>
            <td><label for="date2" >Date de fin</label></td>
            <td><input type="date" name="date_fin" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" name="ok" value="Réserver Now" class="submit-btn">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <a href="accueil2.php" class="link">Voir d'autres</a>
            </td>
        </tr>
    </table>
</form>

        </table>
    </div>
 
</body>
</html>