<?php
session_start();
include("server.php");

$password_1 = "";
$password_2 = "";
$username = "";
$email = "";
$errors = array();
$nome = "";
$cognome ="";


if(isset($_POST['reg_user'])){
//Ricevi input dalla form
$nome = $_POST['nomeF'];
$cognome = $_POST['cognomeF'];
$username = $_POST['username'];
$email = $_POST['email'];
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];


// Errori possibili:
if(empty($username)){
array_push($errors, "Il nome utente è richiesto");}
if(empty($email)){
array_push($errors, "La mail è richiesta");}
if(empty($password_1 or $password_2)){
array_push($errors, "La password è richiesta");}
if($password_1 != $password_2){
array_push($errors, "Le password non corrispondono");}


$user_controllo = $conn->prepare("SELECT * FROM `funzionari` WHERE username= :user OR email= :mail LIMIT 1"); //LIMIT 1 -> massimo 1 record
$user_controllo -> bindParam(":user", $username);
$user_controllo ->bindParam(":mail",$email);
$user_controllo -> execute();


//ricevo il contenuto della query e lo comparo
while($controllo = $user_controllo->fetch(PDO::FETCH_ASSOC)){
    if($controllo['username']=== $username){ // === controlla anche il tipo
        array_push($errors, "Username già esistente");
    }
    if($controllo['email']=== $email){ // === controlla anche il tipo
        array_push($errors, "Email già esistente");
    }
}
}

if(count($errors)==0){
$token = sha1(uniqid($username));
$_SESSION['name'] = $token;
$rege = $conn->prepare("INSERT INTO `funzionari` (username, pwd, email, token, verificato, nome, cognome) values(:user, :pass, :mail, :token, :ver, :nome, :cognome)"); 
$rege -> bindParam(":user", $username);
$rege -> bindParam(":mail",$email);
$z = sha1($password_1);
$rege -> bindParam(":pass", $z);
$rege -> bindParam(":token", $token);
$a = 0;
$rege -> bindParam(":ver", $a, PDO::PARAM_INT);
$rege -> bindParam(":nome", $nome);
$rege -> bindParam(":cognome", $cognome);
if($rege -> execute()){
mail(
$email,
'Registrazione al sito CaffeTime',
'Ciao '.$username.' Plz clicca sul link:localhost/GennarAyr/valid.php?token='.$token,
'from: localhost'
);
}
else{
echo("Ho no c'è un errorino :<");
echo("<br>");
echo($username);
echo("<br>");
echo($email);
echo("<br>");
echo($token);
echo("<br>");
echo(sha1($password_1));
}
}else{
//header('Location: http://localhost/GennarAyr/errors.php');
}


?>