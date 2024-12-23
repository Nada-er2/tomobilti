<?php
session_start();
include("connexion.php");
if(isset($_GET['idreservation']) and !empty($_GET['idreservation'])){
$idreservation=$_GET['idreservation'];
$stmt=$conn->prepare("delete from reservations where id_reservation=:id_reservation");
$stmt->bindParam(":id_reservation",$idreservation);
if($stmt->execute()){
    header("location: reservation.php");
}
}
if(isset($_GET['idreservation_expiree']) and !empty($_GET['idreservation_expiree'])){
    $idreservation_expiree=$_GET['idreservation_expiree'];
    $stmt=$conn->prepare("delete from reservations_expirees where id_reservation=:id_reservation_expiree");
    $stmt->bindParam(":id_reservation_expiree",$idreservation_expiree);
    if($stmt->execute()){
        header("location: reservation_expiree.php");
    }  
}
 ?>