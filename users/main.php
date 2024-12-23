<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .tonobilti {
            filter: drop-shadow(5px 5px 10px #00FF00);
        }
        

        .container1 {
            margin-top: 50px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        
        .container1 h1 {
            color: white;
            margin-top: 20px;
            font-size: 2rem;
        }
        .container1 img{
            width: 500px;
            height: 500px;
        }

        .container1 h1 span {
            color: #00FF00;
        }

        .container2 {
            padding:15px;
            margin: auto;
            text-align: center;
            align-items: center;
            margin-top: 50px;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2)  ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 10px;
            width: fit-content;
        }

        .container2 h2 {
            color: white;
            font-size: 1.8rem;
        }

        .container2 span {
            color: #00FF00;
        }

        .container2 p {
            color:rgb(218, 218, 218);
            font-size: 1rem;
            
        }

        .container3 {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
           
           
            
        }
        .container4{
        display: flex; /* Flexbox for centering */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically if needed *//* Add space above and below */
        width: fit-content;
        margin: 10px auto;
        }

        .card {
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            text-align: center;
            width: 300px;

        }

        .card .cardicon {
            color: #00FF00;
            font-size: 50px;
            margin-bottom: 10px;
        }

        .card h6 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .card p {
            color: rgb(218, 218, 218) ;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .card button {
            background-color: #00FF00;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .card button:hover {
            transform: scale(1.1);
        }
        .card button {
          transition: color 0.3s ease, transform 0.3s ease, letter-spacing 0.3s ease;
        }

        .card button a {
            color: black;
            text-decoration: none;
        }

        @media screen and (max-width: 992px) {
            .container1 {
                flex-direction: column;
                text-align: center;
            }
           

            .container1 h1 {
                font-size: 1.5rem;
                margin-top: 20px;
            }

            .container3 {
                flex-direction: column;
                align-items: center;
            }
        }

        @media screen and (max-width: 576px) {
            .container1 h1 {
                font-size: 1.2rem;
            }
            .container1 img{
            width: 350px;
            height: 350px;
        }

            .card {
                padding: 15px;
            }

            .card p {
                font-size: 0.8rem;
            }

        }
    </style>
</head>
<body>
<main class="container1">
    <div class="firsth1">
        <h1>You <span>Ride</span> Your <span>Rules</span><br>
            Rent or Share with <span>Ease!</span>
        </h1>
    </div>
    <div>
        <img class="tonobilti" src="tomobiltipic.png" alt="Tonobilti logo">
    </div>
</main>
<div class="container2">
    <h2>You can <span>Rent</span> Your <span>Car</span></h2>
    <p>In Few Easy Steps</p>
</div>
<div class="container3">
    <div class="card">
        <div class="cardicon"><i class="fa fa-user"></i></div>
        <h6>Open an Account</h6>
        <p>Create your profile by signing up with your email or social media account. It's quick, free, and gets you started on the platform.</p>
        <button><a href="inscription.php">Register Now</a></button>
    </div>
    <div class="card">
        <div class="cardicon"><i class="fa fa-car"></i></div>
        <h6>Add Your Car</h6>
        <p>Share your car's details, including make, model, and year, and upload clear photos. A great listing attracts more renters!</p>
        <button><a  href='<?php echo isset($_SESSION["email"]) ? "ajoutervoiture1.php": "authentification.php"; ?>'>Add Your Car</a></button>
    </div>
    
</div>
<div class="container4">
<div class="card ">
    <div class="cardicon"><i class="fa fa-share"></i></div>
    <h6>Publish Your Listing</h6>
    <p>Once everything is ready, make your car visible to potential renters. It's now available for booking!</p>
    
</div>
</div>
</body>
</html>

