<?php

session_start();
// Ensuite, accédez aux variables de session.
if (!isset($_SESSION["email"])) {
    header("location:authentification.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
    
    font-family: "Poppins", sans-serif;  

}
       body {
    background: url('Revised.png') no-repeat;
    background-size: cover;
    background-position: center;
    
  
    margin: 0;
    padding-top: 180px; 
}

.login-container {
            width: 700px;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px ;
         
            margin: auto;
}
.login-container h2 {
    margin-bottom: 20px;
    text-align: center;
}
.login-container .form-control {
    margin-bottom: 20px;
}
.login-container .btn-primary {
    width: 100%;
    margin-bottom: 3px;
}
.form-group input:focus, 
.form-group textarea:focus {
    background: transparent; /* Pas de changement de fond */
    border: 2px solid rgba(255,255,255, .2); /* Garder la bordure inchangée */
    color: #fff; /* Couleur de l'écriture reste blanche */
    outline: none; /* Supprimer le contour supplémentaire au focus */
}

/* Styles de base pour les inputs */
.form-group input, 
.form-group textarea {
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
        input[type="number"]::-webkit-inner-spin-button, 
        input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0; /* pour casher la fleche de l'input de type number */
}
.navbar-container {
    width: 100%;
    position: absolute; 
    top: 0;
    margin-bottom: 20px;
    left: 0;
    z-index: 1000;
}

.butt button{
    background-color:#fff;
    color:black;
    width:100%;
    height:50px;
    border-radius:10px;
}
.butt button:hover{
    background-color: #00FF00;
    color: black;
}
.butt a {
    color: #fff;
    
}

.butt a:hover {
    color: #00FF00;

}

    </style>
</head>
<body>
    <div class="navbar-container">
<?php
    include("navbar2.html");
?>
    </div>
<?php
include('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marque = $_POST['marque'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $matricule=$_POST['matricule'];
    $chemin_dir = "../images/";
    $chemin_file = $chemin_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;

    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $chemin_file)) {
        $sql = "INSERT INTO voiture (matricule,marque, prix, description, id_client, image) VALUES (:matricule,:marque, :prix, :description, :id_client, :image)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_client', $_SESSION["num_locataire"]);
        $stmt->bindParam(':image', $chemin_file);

        if ($stmt->execute()) {
            $message= "Votre Voiture ajoute avec succes.";
        } else {
            echo "Erreur: " . $stmt->errorInfo()[2];
        }
    } else {
        $message ="Désolé, une erreur est survenue lors du telechargement de votre fichier.";
    }
    }

?>

    
        <form method="post" enctype="multipart/form-data" >
        
            <div class="login-container">
                <?php if (!empty($message)): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($message) ?>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="matricule" style="color:white">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" required>
                </div>
                <div class="form-group">
                    <label for="marque" style="color:white">Marque</label>
                    <input type="text" class="form-control" id="marque" name="marque" required>
                </div>
                <div class="form-group">
                    <label for="prix" style="color:white">Prix par jour</label>
                    <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
                </div>
                <div class="form-group">
                    <label for="description" style="color:white">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image" style="color:white">Image de voiture</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="butt">
                <button type="submit" >Ajouter votre Voiture</button>
                <a href="voitures.php">Liste des voiture</a>
                </div>
                
        </div>
        </form> 
</form>

</div>
   
</div>
</body>
</html>