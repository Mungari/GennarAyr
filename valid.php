<?php
session_start();
include("server.php");
if($_SESSION['name'] === $_GET['token']){
$rege = $conn->prepare("UPDATE `funzionari` SET verificato = 1 WHERE token= :token");
$rege->bindParam(":token", $_GET['token']);
$rege->execute();
header("register.php");
}
?>