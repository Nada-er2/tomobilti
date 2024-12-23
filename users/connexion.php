<?php
$servername="localhost:3308";
$user="root";
$pass="";
$dbname="projet_oussama";
try{
    $conn=new PDO("mysql:host=$servername;dbname=$dbname",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("conection failed".$e->getmessage());
}

?>