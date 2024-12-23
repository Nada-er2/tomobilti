<?php
include('connexion.php');
$stmt=$conn->prepare("delete from voiture where matricule=:matricule");
$stmt->bindParam(':matricule',$_GET['id']);
if($stmt->execute()){
    header('location:voitures.php');
}else{
    echo "<script>alert('there is somthing wrong');location='voitures.php' </script>";
}
 ?>
 