<?php
        include('connexion.php');
            
        // Vérification si l'utilisateur est connecté
        session_start();
        if (!isset($_SESSION['email'])) {
            header("Location: authentification.php");
            exit();
        }
        
        // Récupérer les détails de l'utilisateur
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM locataire WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            echo "locataire non trouvé.";
            exit();
        }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
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
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
}
   
        .container {
            padding: 50px;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            padding: 30px; 
            width: 100px;
            height: 400px;
            margin-top: 80px;
            color: white;
            align-items: center;
            text-align: center;
        }
        .container img{
            border-radius: 50%;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .container button:hover{
            background-color: black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: white;
        }
        .container .btn {
            width: 15%;
            height: 45px;
            background-color: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0,0,0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }
        .container .btn:hover{
            background-color: #00FF00;
            color: black;
            transform: scale(1.1);
        }
        .container .btn {
          transition: color 0.3s ease, transform 0.3s ease, letter-spacing 0.3s ease;
        }

    </style>
</head>
<body>
    <?php include("navbar2.html") ?>
    <div class="container">
        <img src="voiturier.jpg" alt="profile" width="80px">
        <div class="profile-header">
            <h2><?php echo htmlspecialchars($user['nom'] ) ; echo ' ';echo htmlspecialchars($user['prenom']); ?></h2>
        </div>
        <p><?php echo htmlspecialchars( $user['email']); ?></p>
        <a href="modifier.php?code=<?= htmlspecialchars($user['num_locataire']); ?>">
        <button  class="btn" name="" >Modifier</button>
        </a>

    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>