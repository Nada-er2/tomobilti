<?php
include('connexion.php'); // Assurez-vous que ce fichier initialise correctement $pdo

session_start();
if (!isset($_SESSION["num_locataire"])) {
    header("location:login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Sécuriser l'entrée utilisateur
} else {
    die("Aucun code voiture spécifié.");
}

// Récupérer les informations de la voiture
$sql = "SELECT * FROM voiture WHERE matricule = :matricule";
$stmt = $conn->prepare($sql);
$stmt->execute([':matricule' => $id]);
$voiture = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$voiture) {
    die("Voiture non trouvée.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['ok']) {
    $matricule=$_POST['matricule'];
    $marque = $_POST['marque'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = '../images/' . basename($image);

    // Validation de l'image
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_extensions)) {
        $message = "Type de fichier non autorisé. Veuillez télécharger une image (jpg, jpeg, png, gif).";
    } elseif (move_uploaded_file($image_tmp, $image_path)) {
        // Mettre à jour les informations de la voiture
        $sql = "UPDATE voiture SET  marque = :marque, prix = :prix, description = :description, image = :image WHERE matricule = :matricule";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image_path);


        if ($stmt->execute()) {
            $message = "Les informations de la voiture ont été mises à jour avec succès.";
        } else {
            $message = "Erreur lors de la mise à jour des informations.";
        }
    } else {
        $message = "Erreur lors du téléchargement de l'image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Voiture</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        * {
            font-family: "Poppins", sans-serif;  
        }
        body {
            font-family: "Poppins" ,sans-serif;
            background: url('Revised.png') repeat ;
            background-size: cover;
            background-position: center;
            
            
        }
        .login-container {
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 20px;
            color: white;
            padding: 30px; 
            width: 700px;
            margin: auto;
            margin-top: 50px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
        }
        .login-container .form-control {
            margin-bottom: 20px;
        }
        .login-container input[type="submit"] {
            background-color: #fff;
            color: black;
            width: 100%;
            height: 50px;
            border-radius: 10px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 5px;
        }
        .login-container input[type="submit"]:hover {
            background-color: #00FF00;
            color: black;
        }
        .form-group .form-control:focus {
    background: transparent; /* Pas de changement de fond */
    border: 2px solid rgba(255,255,255, .2); /* Garder la bordure inchangée */
    color: #fff; /* Couleur de l'écriture reste blanche */
    outline: none; /* Supprimer le contour supplémentaire au focus */
}

/* Styles de base pour les inputs */
.form-group .form-control {
    width: 100%;
    height: 100%;
    background: transparent;
    outline: none;
    border: 2px solid rgba(255,255,255, .2);
    border-radius: 40px;
    font-size: 16px;
    color: #fff;
    padding: 20px 45px 20px 20px;
}
.form-control::placeholder { 
    color: #fff;
}
.butt a {
    color: #fff;
    margin-top: 20px;
    
}
.butt a:hover {
    color: #00FF00;

}
    </style>
</head>
<body>
    <?php
        include "navbar2.html";
    ?>
    <div class="login-container">
        <h2>Modifier les informations du voiture</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
           
                <label for="matricule">Matricule</label>
                <input type="text" class="form-control" id="matricule" name="matricule" value="<?php echo htmlspecialchars($voiture['matricule']); ?>" readonly>
            
                <label for="nom">Marque </label>
                <input type="text" class="form-control" name="marque" value="<?php echo htmlspecialchars($voiture['marque']); ?>" required>

                <label for="prenom">Prix </label>
                <input type="text" class="form-control" name="prix" value="<?php echo htmlspecialchars($voiture['prix']); ?>" required>

                <label for="email">Description </label>
                <textarea type="email" class="form-control" name="description"  required><?php echo htmlspecialchars($voiture['description']); ?></textarea>

                <label for="image">Image </label>
                <input type="file" class="form-control" name="image" required>
            
                <input type="submit" value="Modifier" name="ok">
                <div class="butt">
                <a href="voitures.php">Liste Voitures</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
