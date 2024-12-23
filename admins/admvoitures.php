<?php
include("navadmin.html");

// Connexion à la base de données avec PDO
include("connexion.php");

// Récupérer les voitures approuvées
$queryApproved = "SELECT * FROM voiture JOIN locataire ON voiture.id_client = locataire.num_locataire
         WHERE approuvees= true order by locataire.ville";
$stmtApproved = $conn->query($queryApproved);

// Récupérer les voitures non approuvées
$queryNonApproved = "SELECT * FROM voiture JOIN locataire ON voiture.id_client = locataire.num_locataire
         WHERE approuvees= false order by locataire.ville";
$stmtNonApproved = $conn->query($queryNonApproved);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Voiture</title>
    <style>
        body {
           background-color : rgb(240, 255, 243);

        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .button-group button {
            margin: 5px;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            color: white;
            border-radius: 5px;
        }
        .approve-btn {
            background-color: #28a745;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .approve-btn:hover {
            background-color: #218838;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Voitures Approuvées</h1>
    <table>
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Marque</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Description</th>
                <th>image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmtApproved->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($row['matricule']) ?></td>
                <td><?= htmlspecialchars($row['marque']) ?></td>
                <td><?= htmlspecialchars($row['ville']) ?></td>
                <td><?= htmlspecialchars($row['prix']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><img src="<?= htmlspecialchars($row['image']) ?>" style="width: 75px;heigth: 75px;" alt=""></td>
                <td class="button-group">
                    <form method="POST" action="process.php">
                        <input type="hidden" name="matricule" value="<?= htmlspecialchars($row['matricule']) ?>">
                        <button class="delete-btn" type="submit" name="delete">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h1>Voitures Non Approuvées</h1>
    <table>
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Marque</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Description</th>
                <th>image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmtNonApproved->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= htmlspecialchars($row['matricule']) ?></td>
                <td><?= htmlspecialchars($row['marque']) ?></td>
                <td><?= htmlspecialchars($row['ville']) ?></td>
                <td><?= htmlspecialchars($row['prix']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><img src="<?= htmlspecialchars($row['image']) ?>" style="width: 75px;heigth: 75px;" alt=""></td>
                <td class="button-group">
                    <form method="POST" action="process.php">
                        <input type="hidden" name="matricule" value="<?= htmlspecialchars($row['matricule']) ?>">
                        <button class="approve-btn" type="submit" name="approve">Approuver</button>
                        <button class="delete-btn" type="submit" name="delete">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
