<?php 
include("navadmin.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Messages</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    body {
           background-color : rgb(240, 255, 243);

        }</style>
</head>
<body class="">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestion des Messages</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-info">
                <tr>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connexion à la base de données avec PDO
                include("connexion.php");

                // Suppression d'un message
                if (isset($_GET['delete'])) {
                    $emailToDelete = $_GET['delete'];
                    $stmt = $conn->prepare("DELETE FROM message WHERE email = :email");
                    $stmt->execute(['email' => $emailToDelete]);
                }

                // Récupération des messages
                $stmt = $conn->query("SELECT * FROM message");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                    echo "<td>";
                    echo "<a href='?delete=" . urlencode($row['email']) . "' 
                          class='btn btn-danger btn-sm' 
                          onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce message ?\")'>Supprimer</a>";
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
