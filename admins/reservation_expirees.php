<?php
include("navadmin.html");
include("connexion.php");
$stmt = $conn->query("SELECT * FROM Reservations_expirees");
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations Expirées</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
           background-color : rgb(240, 255, 243);
            }
        </style>
</head>
<body class="">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestion des Réservations Expirées</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-danger">
                <tr>
                    <th>NOM</th>
                    <th>PRÉNOM</th>
                    <th>ID Réservation</th>
                    <th>Matricule</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Prix Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['nom']) ?></td>
                        <td><?= htmlspecialchars($reservation['prenom']) ?></td>
                        <td><?= htmlspecialchars($reservation['id_reservation']) ?></td>
                        <td><?= htmlspecialchars($reservation['matricule']) ?></td>
                        <td><?= htmlspecialchars($reservation['date_debut']) ?></td>
                        <td><?= htmlspecialchars($reservation['date_fin']) ?></td>
                        <td><?= htmlspecialchars($reservation['prix_total']) ?></td>
                        <td>
                            <a href='supprimerreservation.php?idreservation_expiree=<?= htmlspecialchars($reservation["id_reservation"]) ?>' 
                               class='btn btn-danger btn-sm' 
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
