<?php
include('connexion.php');

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: authentification.php");
    exit();
}

$sql = "SELECT * FROM voiture where id_client=:num_locataire";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':num_locataire' => $_SESSION["num_locataire"]

]);

$stmt->execute();
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Ordinateurs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        * {
            margin: 0;
            padding: 0;
            color: white;
            font-family: "Poppins", sans-serif;  
        }
        body {
            background: url('Revised.png') no-repeat;
            background-size: cover;
            background-position: center;
           
            
            margin: 0;
            padding-top: 180px; 
        }
        .container {
            width: 700px;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px ;
            align-items: center;
            
        }
        .dd {
         width: 100%;
         position: absolute; 
         top: 0;
         margin-bottom: 20px;
         left: 0;
         z-index: 1000;
}
.container h1,table{
    text-align: center;
   
}
.container table td{
    vertical-align: middle;
}
.container img {
    width: 100px;
    border-radius: 15%;
    border: none;
}
.lien a {
    color: #fff;
    border-style: none;
   
    
}
.lien a:hover {
    color: #00FF00;
    
}

    </style>
</head>
<body>
    <div class="dd">
<?php
    include("navbar2.html");
?>
</div>
    <div class="container ">
        <h1>Liste des Voitures</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>matricule</th>
                    <th>Marque</th>
                    <th>Prix</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>approuvée</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($voitures as $voiture): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($voiture['matricule']); ?></td>
                        <td><?php echo htmlspecialchars($voiture['marque']); ?></td>
                        <td><?php echo htmlspecialchars($voiture['prix']); ?></td>
                        <td><?php echo htmlspecialchars($voiture['description']); ?></td>
                        <td><img src="<?php echo $voiture['image']; ?>" class="img-thumbnail" alt="Image de <?php echo htmlspecialchars($voiture['marque']); ?>"></td>
                        <td><?php echo  $voiture['approuvees'] ?  "enregestrer" : "pas enregestrer"; ?>  </td>
                        
                        <td>
                            <a href="modifiervoiture.php?id=<?php echo htmlspecialchars($voiture['matricule']); ?>" class="btn btn-success">Modifier</a>
                            <a href="supprimervoiture.php?id=<?php echo htmlspecialchars($voiture['matricule']); ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture ?');" >Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="lien">
        <a href="ajoutervoiture1.php" >Ajouter une Voiture</a>
        </div>
    </div>
</body>
</html>
