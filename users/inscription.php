<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
           font-family: "Poppins", sans-serif;  
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('Revised.png') no-repeat;
            background-size: cover;
            background-position: center;

        }
        .nv {
            position: absolute;
            top: 0;
            width: 100%;
        }
        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255,255,255, .2) ;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px ;
            margin: auto;
            margin-top: 150px;
        }
        .wrapper h1 {
            font-size: 36px ;
            text-align: center;
        }
        .wrapper .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0 
        }
        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255,255,255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;

        }
        .input-box input::placeholder {
            color: #fff;

        }
        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }
        .wrapper .remember-forget {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin:-15px 0 15px;
        }
        .remember-forget label input {
            accent-color: #fff;
            margin-right: 3px;
        }
        .remember-forget a {
            color: #fff;
            text-decoration: none;
        }
        .remember-forget  a:hover {
            text-decoration: underline; 
            color: #00FF00; 
        }
        .wrapper .btn {
            width: 100%;
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
        .wrapper .btn:hover{
            background-color: #00FF00;
        }
        .wrapper .register-link {
            font-size: 14.5px;
            text-align : center;
            margin: 20px 0 15px;
        }
        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link p a:hover {
            text-decoration: underline;
            color: #00FF00;
        }
        

         
    </style>
</head>
<body>
<?php 

if(isset($_POST['ok'])){
   
    if(!empty(trim($_POST['nom'])) && !empty(trim($_POST['prenom'])) &&!empty(trim($_POST['email'])) 
    && !empty(trim($_POST['ville']))&& !empty(trim($_POST['password'])) ){
        include('connexion.php');
        $role='user';
        $ville=strtoupper($_POST['ville']);
        $stmt=$conn->prepare("insert into locataire(nom,prenom,email,ville,password,role)values(:nom,:prenom,:email,:ville,:password,:role)");
        $stmt->bindParam(':nom',$_POST['nom']);
        $stmt->bindParam(':prenom',$_POST['prenom']);
        $stmt->bindParam(':email',$_POST['email']);
        $stmt->bindParam(':ville',$_POST['ville']);
        $stmt->bindParam(':password',$_POST['password']);
        $stmt->bindParam(':role',$role);

        if($stmt->execute()){

            header('location:login.php');
            exit();
        }

    }
    else{
         echo "<script> alert ('please check your informations')</script> ";

    }
}
?>
<div class="nv">
<?php
    include"navbar.html";
?></div>
    <div class="wrapper">
        <form action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" >
            <h1>Inscription</h1>
            <div class="input-box">
                <input type="text" name="nom" placeholder="Name" required>
                <i class="bx bx-info-circle"></i>

            </div>
            <div class="input-box">
                <input type="text" name="prenom" placeholder="Username" required>
                <i class="bx bx-info-circle"></i>

            </div>
            <div class="input-box">
                <input type="text" name="ville" placeholder="City" required>
                <i class="bx bx-location-plus"></i>

            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email" required>
                <i class="bx bxs-envelope"></i>

            </div>
            <div class="input-box">
                <input type="password" name="password" required placeholder="Password">
                <i class="bx bx-lock-alt"></i>

            </div>

            <button type="submit" class="btn" name="ok">Sign up</button>
            <div class="register-link">
                <p>You already have an account ?
                    <a href="login.php">Login</a>
                </p>
            </div>
        </form>
    </div>
    
</body>
</html>