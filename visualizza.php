<?php
include('server.php');

$v = array();

$stmt = $conn->prepare("Select controlli.MotivoViaggio, controlli.Provenienza, controlli.Destinazione, controlli.Inizio, controlli.Fine, controlli.dazio, passeggeri.Nome, passeggeri.cognome, punticontrollo.PuntoControllo, punticontrollo.SezioneAeroporto,
esiti.Esito, addetti.Nome, addetti.Cognome from controlli
INNER JOIN passeggeri ON passeggeri.Id_Passeggero = controlli.Id_Passeggero
INNER JOIN punticontrollo ON punticontrollo.Id_PuntoControllo = controlli.Id_PuntoControllo 
INNER JOIN esiti ON esiti.Id_Esito = controlli.Id_Esito
INNER JOIN addetti ON addetti.Id_Addetto = controlli.Id_Addetto");
if($stmt -> execute()){

while($var = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($v, $var);
}
$str = json_encode($v);
echo $str;
}else{
    echo "\nPDO::errorInfo():\n";
    print_r($stmt->errorInfo());
}
?>