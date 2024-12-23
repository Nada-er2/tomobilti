<?php
include("connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $matricule = $_POST['matricule'];

        if (isset($_POST['approve'])) {
            // Approuver la voiture
            $query = "UPDATE voiture SET approuvees = true WHERE matricule = :matricule";
        } elseif (isset($_POST['delete'])) {
            // Supprimer la voiture
            $query = "DELETE FROM voiture WHERE matricule = :matricule";
        }

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
        $stmt->execute();

        header("Location: admvoitures.php");
    
}
?>
