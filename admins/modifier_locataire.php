<?php
include("navadmin.html");
include("connexion.php");

if (isset($_GET['numlocataire'])) {
    $num_locataire = $_GET['numlocataire'];

    // Récupérer les informations actuelles du locataire
    $stmt = $conn->prepare("SELECT * FROM locataire WHERE num_locataire = :num_locataire");
    $stmt->bindParam(':num_locataire', $num_locataire, PDO::PARAM_INT);
    $stmt->execute();
    $locataire = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$locataire) {
        echo "Locataire non trouvé.";
        exit;
    }

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ok'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $ville = $_POST['ville'];
        $role = $_POST['role'];

        // Mettre à jour les informations du locataire
        $updateStmt = $conn->prepare("
            UPDATE locataire 
            SET nom = :nom, prenom = :prenom, email = :email, ville = :ville, role = :role 
            WHERE num_locataire = :num_locataire
        ");
        $updateStmt->bindParam(':nom', $nom);
        $updateStmt->bindParam(':prenom', $prenom);
        $updateStmt->bindParam(':email', $email);
        $updateStmt->bindParam(':ville', $ville);
        $updateStmt->bindParam(':role', $role);
        $updateStmt->bindParam(':num_locataire', $num_locataire, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            echo "Locataire mis à jour avec succès.";
            header("Location: adminlactaire.php");
            exit;
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    }
} else {
    echo "Aucun locataire spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Locataire</title>
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
           background-color : rgb(240, 255, 243);

        }</style>
</head>
<body class="">
    <div class="container my-5">
        <h1 class="text-center mb-4">Modifier Locataire</h1>
        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control" value="<?= htmlspecialchars($locataire['nom']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="<?= htmlspecialchars($locataire['prenom']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email :</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($locataire['email']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="ville" class="form-label">Ville :</label>
                <input type="text" id="ville" name="ville" class="form-control" value="<?= htmlspecialchars($locataire['ville']) ?>" required>
            </div>
            <div class="col-md-12">
                <label for="role" class="form-label">Rôle :</label>
                <input type="text" id="role" name="role" class="form-control" value="<?= htmlspecialchars($locataire['role']) ?>" required>
            </div>
            <div class="col-12">
                <button type="submit" name="ok" class="btn btn-info w-100">Modifier</button>
            </div>
        </form>
    </div>

    <!-- Inclure Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
