<?php
include('connexion.php');
session_start();
$code = $_SESSION['num_locataire'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $ville = $_POST['ville'];
    $email = $_POST['email'];
    $password = $_POST["password"];// Hash du mot de passe;

    // Mise à jour des informations dans la base de données
    $sql = "UPDATE locataire SET nom = :nom, prenom = :prenom, ville = :ville, email = :email, password = :password WHERE num_locataire = :num_locataire";
    $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':num_locataire', $code);
    $message = "Les informations du locataire ont été mises à jour avec succès.";
    if ($stmt->execute()) {
      $message = "Les informations du locataire ont été mises à jour avec succès.";
    } else {
        echo "Erreur: " . $stmt->errorInfo()[2];
    }
} else {
    // Vérification du paramètre code dans l'URL
    if (isset($_GET['code']) && is_numeric($_GET['code'])) {
        $id = intval($_GET['code']); // Conversion en entier pour éviter les injections SQL
    } else {
        die("Erreur : Aucun code utilisateur spécifié ou code invalide.");
    }

    // Récupération des informations du locataire
    $sql = "SELECT * FROM locataire WHERE num_locataire = :num_locataire";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':num_locataire' => $code]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si aucun utilisateur n'est trouvé
    if (!$utilisateur) {
        die("Erreur : Aucun locataire trouvé pour l'identifiant $code.");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Locataire</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    text-decoration: none;
    
}
.butt a:hover {
    color: #00FF00;
    border-bottom: 2px solid  #00FF00;
}
    </style>
</head>
<body>
    <?php
        include "navbar2.html";
    ?>
    <div class="login-container">
        <h2>Modifier vos informations </h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($utilisateur['nom'] ?? " "); ?>" required>

                <label for="prenom">Prénom :</label>
                <input type="text" class="form-control" name="prenom" value="<?= htmlspecialchars($utilisateur['prenom'] ?? " "); ?>" required>

                <label for="email">Email :</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($utilisateur['email'] ?? " "); ?>" required>

                <label for="ville">Ville :</label>
                <input type="text" class="form-control" name="ville" value="<?= htmlspecialchars($utilisateur['ville'] ?? " "); ?>" required>

                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" name="password" style="color : #fff" placeholder="Entrez un nouveau mot de passe" required>

                <input type="hidden" name="num_locataire" value="<?= htmlspecialchars($utilisateur['num_locataire']); ?>">

                <input type="submit" value="Enregistrer">
                <div class="butt">
                <a href="profile.php">Retour au Profile</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
