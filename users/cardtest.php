<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des voitures</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
            body {

            margin: 0;
            padding: 0;
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }

        #c {
            text-align: center;
            color: #D3D3D3;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .slider-container {
            width: 100%;
            overflow: hidden; /* Cache tout ce qui dépasse */
            position: relative;
        }

        .ss {
            display: flex;
            animation: scroll 25s linear infinite; /* Animation continue */
        }

        .card1 {
            flex: 0 0 auto;
            width: 300px;
            margin: 20px;
            margin-bottom: 50px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease-in-out;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 10px;
            position: relative;
        }

        .card1:hover {
            transform: scale(1.05); /* Zoom léger */
        }

        .card1 .img img {
            width: 150px;
            height: 150px;
            border-radius: 5px;
        }

        .card1 h2, .card1 h3 {
            color: #D3D3D3;
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .card1 p {
            color: gray;
            font-size: 0.9rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .tt {
            background-color: #00FF00;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .card1 button:hover {
            transform: scale(1.1);
        }

        .card1 button a {
            color: black;
            text-decoration: none;
        }

        /* Animation de défilement continu */
        @keyframes scroll {
            from {
                transform: translateX(-5);
            }
            to {
                transform: translateX(-100%);
            }
        }

        /* Pause l'animation au survol */
        .slider-container:hover .ss {
            animation-play-state: paused;
        }
        .iconheart {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            transition: background-color 0.3s ease;
        }
        .iconheart:hover {
            background: #00FF00; /* Change la couleur de fond */
            box-shadow: 0 0 10px #00FF00; /* Ajoute un effet de halo lumineux */
        }
        .iconheart i {
            color: #00FF00; /* Change la couleur de l'icône */
        }
        .iconheart:hover i {
            color: black; /* L'icône devient blanche au survol */
        }

    </style>


</style>
</head>
<body>
    <h2 id="c">Liste des Voitures</h2>
    <div class="slider-container">
        <div class="ss">
            <?php
            include("connexion.php");

            // Récupérer les voitures approuvées depuis la base de données
            $query = $conn->query("SELECT matricule, marque, prix, description, image FROM voiture WHERE approuvees = true");
            $cards = $query->fetchAll(PDO::FETCH_ASSOC);

            if (empty($cards)) {
                // Afficher un message si aucune voiture n'est disponible
                echo "<p style='color: white; text-align: center; margin-top: 20px;'>Aucune voiture disponible pour le moment.</p>";
            } else {
                // Calculer le nombre minimum de cartes nécessaires pour remplir l'écran
                $screenWidth = 1920; // Largeur de l'écran en pixels
                $cardWidth = 320; // Largeur d'une carte avec marge
                $minCards = ceil($screenWidth / $cardWidth) + 1; // Cartes pour couvrir la largeur plus une marge

                // Afficher les cartes nécessaires
                $index = 0;
                while ($index < $minCards) {
                    foreach ($cards as $card) {
                        echo "
                        <div class='card1'>
                            <form method='POST' action='ajouter_favoris.php' style='display: inline;'>
                                <input type='hidden' name='matricule' value='{$card['matricule']}'>
                                <button type='submit' class='iconheart'>
                                    <i class='bx bx-heart'></i>
                                </button>
                            </form>
                            <div class='img'>
                                <img src=\"{$card['image']}\" alt='Image de la voiture'>
                            </div>
                            <h2>{$card['marque']}</h2>
                            <h3>{$card['prix']} MAD / jour</h3>
                            <p>{$card['description']}</p>
                            <button class='tt'><a href='ajouterreservation.php?matricule={$card['matricule']}'>Réserver Now</a></button>
                        </div>
                        ";
                        $index++;
                        if ($index >= $minCards) break; // Stopper après avoir rempli
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>

        
