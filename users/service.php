<?php
    session_start();
    // Ensuite, accédez aux variables de session.
    if (!isset($_SESSION["email"])) {
        header("location:servicesanssession.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: "Poppins", sans-serif;  
            color: #fff;
        }
        body {
            background: url('Revised.png') repeat ;
            background-size: cover;
            background-position: center;
        }
        .ss {
            display: flex;
            flex-direction: column;
        }
        .section {
            display: flex;
            justify-content: space-between;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            margin: 50px;
            padding: 20px;
            align-items: center;

        }
        .section img {
            width: 700px;
            border-radius: 10px;
            border: 2px solid rgba(255,255,255, .2) ;
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        }
        .section p {
            margin:50px;
            
        }
    </style>
<body>
    <?php
        include "navbar2.html";
    ?>
    <section class="ss">
        <div class="section">
            <p>Our platform makes renting and sharing cars effortless and accessible for everyone. Start by creating 
                your free account quickly using your email or social media. Once registered, you can easily list your
                car by providing its details, including make, model, and year, and uploading clear photos to attract
                potential renters. </p>
            <img src="../images/image1.jpg" alt="image de voiture">
        </div>
        <div class="section">
            <img src="../images/image2.jpg" alt="image de voiture">
            <p>When your listing is complete, publish it to make your car available for bookings. With our streamlined 
                process, you can confidently rent or share your car while enjoying a seamless and secure experience 
                tailored to your needs. </p>
        </div>
    </section>
</body>
</html>