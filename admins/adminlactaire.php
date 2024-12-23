<?php include("navadmin.html"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locataire Admin</title>
    <!-- Inclure Bootstrap -->
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
           background-color : rgb(240, 255, 243);
        }</style>
</head>
<body class="">
    <div class="container my-5">
        <h1 class="mb-4 text-center">Gestion des Locataires</h1>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-info">
                <tr>
                    <th>ID Locataire</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connexion.php");

                $stmt = $conn->query('SELECT * FROM locataire');
                $locataires = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($locataires as $locataire) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($locataire['num_locataire']) . "</td>";
                    echo "<td>" . htmlspecialchars($locataire['nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($locataire['prenom']) . "</td>";
                    echo "<td>" . htmlspecialchars($locataire['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($locataire['ville']) . "</td>";
                    echo "<td>" . htmlspecialchars($locataire['role']) . "</td>";
                    echo "<td>";
                    echo "<a href='modifier_locataire.php?numlocataire=" . $locataire['num_locataire'] . "' class='btn btn-success btn-sm me-2'>Modifier</a>";
                    echo "<a href='supprimer_locataire.php?numlocataire=" . $locataire['num_locataire'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce client?');\">Supprimer</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
