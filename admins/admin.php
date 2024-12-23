<?php
// Connexion à la base de données avec PDO
include("connexion.php");
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !=='admin') {
    header("Location: ../users/login.php");
    exit;
}

// Récupérer les données clés
try {
    $totalLocataires = $conn->query("SELECT COUNT(*) AS total FROM locataire")->fetch(PDO::FETCH_ASSOC)['total'];
    $totalVoitures = $conn->query("SELECT COUNT(*) AS total FROM voiture")->fetch(PDO::FETCH_ASSOC)['total'];
    $totalMessages = $conn->query("SELECT COUNT(*) AS total FROM message")->fetch(PDO::FETCH_ASSOC)['total'];
    $stmt = $conn->query("
        SELECT ville, COUNT(voiture.matricule) AS total
        FROM voiture
        JOIN locataire ON voiture.id_client = locataire.num_locataire
        GROUP BY ville
    ");
    $voituresParVille = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de l'exécution des requêtes : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Accueil</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 15px; margin: 10px; text-align: center;background-color:rgb(131, 225, 242) !important;font-weight: bolder; }
        .grid { display: flex; flex-wrap: wrap; justify-content: space-around; }
        table {font-weight: bolder;  width: 90%; border-collapse: collapse; margin: 20px auto; background-color:rgb(131, 225, 242) ; }
        table, th, td { border: 1px solid black; text-align: center; }
        th, td { padding: 10px; }
       .card button{
        border: 2px solid rgb(131, 225, 242) ;
        border-radius:  30px;
        background-color: white;
        transition: color 0.3s ease, transform 0.3s ease, letter-spacing 0.3s ease;
       } 
       .card button a{
        color: black;
        text-decoration: none;
        font-size: larger;
       }
       .card button:hover{
        transform: scale(1.1);
        transition: color 0.3s ease, transform 0.3s ease, letter-spacing 0.3s ease;
       }
    </style>
</head>
<body>
    <?php
    include('navadmin.html');
     ?>
    <h1 style="text-align: center;margin:40px 0">Tableau de Bord - Résumé</h1>
    <div class="grid">
        <div class="card">
            <h2>Total Locataires</h2>
            <p><?= $totalLocataires ?></p>
            <button><a href="adminlactaire.php">voir</a></button>
        </div>
        <div class="card">
            <h2>Total Voitures</h2>
            <p><?= $totalVoitures ?></p>
            <button><a href="admvoitures.php">voir</a></button>
        </div>
        <div class="card">
            <h2>Total Messages</h2>
            <p><?= $totalMessages ?></p>
            <button><a href="admmessages.php">voir</a></button>

        </div>
    </div>

    <h2 style="text-align: center;margin:40px 0">Voitures par Ville</h2>
    <table border="1px solid">
        <thead>
            <tr>
                <th>Ville</th>
                <th>Nombre de Voitures</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($voituresParVille as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ville']) ?></td>
                    <td><?= $row['total'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>