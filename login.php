<?php
session_start();
$errors = array();
include("server.php");
$username = "";
$password = "";

if(isset($_POST["log_user"])){
	$username = $_POST['username'];
    $password = $_POST['password'];
}

if(empty($username)){
array_push($errors, "Il nome utente utente è richiesto");}
if(empty($password)){
array_push($errors, "La password è richiesta");
}

if(count($errors) == 0){
$stam = $conn -> prepare("Select username, pwd from funzionari WHERE username = :user AND pwd = :pass");
$stam -> bindParam(":user", $username);
$z = sha1($password);
$stam -> bindParam(":pass", $z);

if($stam->execute()){
$token = sha1(uniqid($username));
$_SESSION['id'] = $token;
header('Location:http://localhost/GennarAyr/dashboard.php?token='.$token."&username=".$username);
}else{
array_push($errors, "login fallito, controlla l'username e la password");
//header('Location: http://localhost/GennarAyr/errors.php');
}
}else{
//header('Location: http://localhost/GennarAyr/errors.php');
}

?>