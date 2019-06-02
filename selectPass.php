<?php
include('server.php');

$var = array();

$stmt = $conn->prepare("Select * from passeggeri");
$stmt->execute();

while($v = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($var, $v);
}
echo json_encode($var);
?>