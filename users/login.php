<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
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
            margin: 30px 0 ;
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
            color: black;
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
    session_start();  
  
    include('connexion.php');
   
    if(isset($_POST['ok'])){
    $stmt=$conn->prepare("select num_locataire, email,password,role from locataire where email=:email");
    $stmt->bindParam(':email',$_POST['email']);
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $v=true;
    foreach($rows as $row){
        if($row['email']==$_POST['email'] && $row['password']==$_POST['password']){
            if($row['role']=="user"){
            $_SESSION['email']=$_POST['email'];
            $_SESSION['num_locataire']=$row['num_locataire'];
            header('location:accueil2.php');
        }else{
            $_SESSION['role']=$row['role'];
            header('location:../admins/admin.php');   
            }
           
        }
    }
echo "<script> alert (' your informations are not correct')</script> ";

}
?>
<div class="nv">
<?php
    include"navbar.html";
?></div>
    <div class="wrapper">
        <form method="post" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email" required>
                <i class="bx bx-user"></i>

            </div>
            <div class="input-box">
                <input type="password" name="password" required placeholder="Password">
                <i class="bx bx-lock-alt"></i>

            </div>

            <div class="remember-forget">
                <label ><input type="checkbox">Remember Me</label>
                <a href="#" >Forget password?</a>
            </div>
            <button type="submit" class="btn" name="ok">Login</button>
            <div class="register-link">
                <p>Don't Have an account ?
                    <a href="inscription.php">Register</a>
                </p>
            </div>
        </form>
    </div>
    
</body>
</html>
<?php
//fin 