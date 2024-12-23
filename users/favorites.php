<?php
// Start the session
session_start();

// Database connection using PDO
include("connexion.php");

// Retrieve favorites from the cookie
$favorites = isset($_COOKIE['favorites']) ? json_decode($_COOKIE['favorites'], true) : [];

if (!empty($favorites)) {
    // Prepare a query to fetch the favorite cars
    $placeholders = str_repeat('?,', count($favorites) - 1) . '?';
    $stmt = $conn->prepare("SELECT * FROM voiture WHERE matricule IN ($placeholders)");
    $stmt->execute($favorites);
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $cars = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos Favoris</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
           font-family: "Poppins", sans-serif;  
        }
        body{
            background: url('Revised.png') repeat;
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        .card1{
            display: flex;
            justify-content: space-between;
            width: 80%;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px ;
            margin: 40px auto;
        }
        .vv {
            text-align: center;
        }
        .infov button {
            color: black;
            background-color: #fff;
            margin-top: 10px ;
            cursor: pointer;
            color: #fff;
            width: 50%;
            border-radius: 10px;
            height: 40px;
            margin-top: 20px;
        }
        .infov button:hover {
            transform: scale(1.1);
            transition: color 0.3s ease, transform 0.3s ease, letter-spacing 0.3s ease;
        }
        .ajout button {
            background-color: green;
        }
        .ajout2 button {
            background-color: red;
        }
        a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s ease, transform 0.3s ease, letter-spacing 0.3s ease;
        }
        a:hover {
            transition: color 0.3s ease, transform 0.3s ease, letter-spacing 0.3s ease;

        }
        img {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="vv">
        <h1>Vos Favoris</h1>
    </div>
    <?php if (empty($cars)): ?>
        <p style="text-align: center;margin:300px">Aucun favori ajouté.</p>
    <?php else: ?>
        <div class="favorites">
            <?php foreach ($cars as $car): ?>
        <div class="card1">
        <div class="infov">
            
            <h1><?php echo htmlspecialchars($car['marque']); ?></h1>
            <h1 style="color:red; "><?php echo htmlspecialchars($car['prix']); ?> Dh/Jour</h1>
            <p><?php echo htmlspecialchars($car['description']); ?></p>
            <form method="post" action="supprimer_favorite.php" style="display:inline;">
                        <input type="hidden" name="matricule" value="<?= htmlspecialchars($car['matricule']) ?>">
                        <div class="ajout2">
                        <button type="submit">Supprimer la favorite</button></div>
                    </form>
                    <div class="ajout">
                    <button><a href="ajouterreservation.php?matricule=<?= htmlspecialchars($car['matricule']) ?>">Reserver Now</a></button>
                    </div>
        </div>
    <div class="b"><img width="400px" src="<?php echo htmlspecialchars($car['image']); ?>" alt=""></div>
</div> 

            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
