<?php

session_start();
// Ensuite, accédez aux variables de session.
if (!isset($_SESSION["email"])) {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            
            font-family: "Poppins", sans-serif;  

        }
        body {
            background: url('Revised.png') repeat ;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <?php 
    include"navbar2.html" ;
    include"main.php";
    include"cardtest.php";
    include"footer.html";
    ?>
</body>
</html>