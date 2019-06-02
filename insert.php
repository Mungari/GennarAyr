<?php
include('server.php');
$idP = $_POST['idPass'];
$idA = $_POST['idAddetto'];
$Prov = $_POST['prov'];
$Dest = $_POST['dest'];
$Motiv = $_POST['motViagg'];
$Inizio = $_POST['inizio'];
$Fine = $_POST['fine'];
$Dazio = $_POST['dazio'];
$TipM = $_POST['tipMerc'];
$Gate = $_POST['puntoCont'];
$Fermo = $_POST['statoFermo'];
$Funz = $_POST['idF'];

$stmt = $conn->prepare("insert into controlli (Id_PuntoControllo, Id_Funzionario, Id_Addetto, Id_Passeggero, Provenienza, Destinazione, MotivoViaggio, Inizio, Fine, Dazio, Id_Esito)
 values (:contr, :funz, :add, :pass, :prov, :dest, :mot, :inz, :fn, :daz, :esito) ");
$stmt ->bindParam(":contr", $Gate);
$stmt ->bindParam(":funz", $Funz);
$stmt ->bindParam(":add", $idA);
$stmt ->bindParam(":pass", $idP);
$stmt ->bindParam(":prov", $Prov);
$stmt ->bindParam(":dest", $Dest);
$stmt ->bindParam(":mot", $Motiv);
$stmt ->bindParam(":inz", $Inizio);
$stmt ->bindParam(":fn", $Fine);
$stmt ->bindParam(":daz", $Dazio);
$stmt ->bindParam(":esito", $Fermo);

$stmt->execute();
?>