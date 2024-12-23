<?php
include('connexion.php');
$stmt=$conn->prepare("delete from locataire where num_locataire=:numlocataire");
$stmt->bindParam(':numlocataire',$_GET['numlocataire']);
if($stmt->execute()){
    header('location:adminlactaire.php');
}else{
    echo "<script>alert('there is somthing wrong');location='voitures.php' </script>";
}
 ?>