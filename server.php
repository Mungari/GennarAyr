<?php
	 $host = "mysql:host=localhost;dbname=my_caffetime";
     $username = "root";
     $pass ="";

try{
        $conn = new PDO($host, $username, $pass);
        }
catch(PDOexception $e){
        echo "Errore di connessione: ".$e->getMessage();
        }
?>