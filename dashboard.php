<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['id'] == $_GET['token']){
} 
?>

<!DOCTYPE html>
<html>
<head>
<style>
li{
    display:inline;
}
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/solid.css" integrity="sha384-ioUrHig76ITq4aEJ67dHzTvqjsAP/7IzgwE7lgJcg2r7BRNGYSK0LwSmROzYtgzs" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/fontawesome.css" integrity="sha384-sri+NftO+0hcisDKgr287Y/1LVnInHJ1l+XC7+FOabmTTIK0HnE2ID+xxvJ21c5J" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function () {
    //Inserisco i valori nelle select box
    $.ajax({
            type: "POST",
            url: 'selectGate.php',
            data:{},
                success: function(risposta){
                    console.log(risposta + " " + typeof(risposta));
                    var a = JSON.parse(risposta);
                    a.forEach(object => {
                        console.log(object.Id_PuntoControllo);
            $('.puntoCont').append('<option value= '+object.Id_PuntoControllo + '>' + object.PuntoControllo + " " + object.SezioneAeroporto + '</option>');
        })               
            },
            error: function(){
                alert("Chiamata fallita!");
            }
        });


        $.ajax({
            type: "POST",
            url: 'selectCategorie.php',
            data:{},
                success: function(risposta){
                    var a = JSON.parse(risposta);
                    a.forEach(object => {
            $('.tipMerc').append('<option value= '+object.Id_Categoria + '>' + object.Categoria + '</option>');
        })
            },
            error: function(){
                alert("Chiamata fallita!");
            }
        });
        $.ajax({
            type: "POST",
            url: 'selectPass.php',
            data:{},
                success: function(risposta){
                    var a = JSON.parse(risposta);
                    a.forEach(object => {
            $('.passeggero').append('<option value= '+object.Id_Passeggero + '>' + object.Cognome + " " + object.Nome + '</option>');
        })
            },
            error: function(){
                alert("Chiamata fallita!");
            }
        });
        $.ajax({
            type: "POST",
            url: 'selectFermo.php',
            data:{},
                success: function(risposta){
                    var a = JSON.parse(risposta);
                    a.forEach(object => {
            $('.statoFermo').append('<option value= '+object.Id_Esito + '>' + object.Esito + '</option>');
        })
            },
            error: function(){
        }
        });
        $.ajax({
            type: "POST",
            url: 'selectAddetti.php',
            data:{},
                success: function(risposta){
                    console.log(risposta + " " + typeof(risposta));
                    var a = JSON.parse(risposta);
                    a.forEach(object => {
            $('.idAddetto').append('<option value= '+object.Id_Addetto + '>' + object.Cognome + " " + object.Nome + '</option>');
        })
            },
            error: function(){
                alert("Chiamata fallita!");
            }
        });

    $('#vis').on('click', function(){
        $('#risposta').removeAttr('hidden');
        $('#form').prop('hidden', true);
        $('#formMod').prop('hidden', true);
        $.ajax({
            type: "POST",
            url: 'visualizza.php',
            data:{},
            success: function(risposta){
                    var a = JSON.parse(risposta);
                    $('#inseriscimi td').remove();
                    var trHTML = '';
                    a.forEach(object => {
                    trHTML += '<tr><td>' + object.MotivoViaggio + '</td><td>' + object.Provenienza + '</td><td>' + object.Destinazione + '</td><td>' + object.Inizio + '</td><td>' + object.Fine + '</td><td>' + object.dazio + '</td><td>' + object.Nome + '</td><td>' + object.cognome + '</td><td>' + object.PuntoControllo + '</td><td>' + object.SezioneAeroporto + '</td><td>' + object.Esito + '</td><td>' + object.Cognome + '</td></tr>';
        })
        $('#inseriscimi').append(trHTML);
            },
            error: function(){
                alert("Chiamata fallita!");
            }
        });
    });
    $('#add').on('click', function(){
        $('#risposta').prop('hidden', true);
        $('#form').removeAttr('hidden');
        $('#formMod').prop('hidden', true);
    });
    $('#mod').on('click', function(){
        $('#risposta').prop('hidden', true);
        $('#form').prop('hidden', true);
        $('#formMod').removeAttr('hidden');
        $.ajax({
            type: "POST",
            url: 'visualizza.php',
            data:{},
            success: function(risposta){
                    var a = JSON.parse(risposta);
                    $('#insMod td').remove();
                    var trHTML = '';
                    a.forEach(object => {
                        trHTML += '<tr><td><input type="text" name = motMod value=' + object.MotivoViaggio + '></td><td><input type="text" name = provMod value=' + object.Provenienza + '></td><td>' + object.Destinazione + '</td><td><input type="text" name = inMod value=' + object.Inizio + '></td><td><input type="text" name = finMod value=' + object.Fine + '></td><td>' + object.dazio + '</td><td>' + object.Nome + '</td><td>' + object.cognome + '</td><td>' + object.PuntoControllo + '</td><td>' + object.SezioneAeroporto + '</td><td>' + object.Esito + '</td><td>' + object.Cognome + '</td></tr>';
        })
        $('#insMod').append(trHTML);
            },
            error: function(){
                alert("Chiamata fallita!");
            }
        });
    });
});
</script>
<!-- Inserire css e ajax -->
</head>
<body>


<div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <img src="res/Ayr.png" style="width:15%; height:95px"/>
            
                <?php echo ("benvenuto/a, ".$_GET['username']);?>
                
            </div>
        </nav>

        <nav id="sidebar" style="text-align:center">
        <ul class="list-unstyled components">
            <li class="active">
                <button type="button" id="vis" class="btn btn-info">
                <i class="fas fa-history"></i>
                    <span>Visualizza le segnalazioni</span>
                </a>
            </li>
            <li>
                <button type="button" id="add" class="btn btn-info">
                    <i class="fas fa-user-plus"></i>
                    <span>Aggiungi una segnalazione</span>
                </a>
            </li>
            <li>
                <button type="button" id="mod" class="btn btn-info">
                <i class="fas fa-wrench"></i>
                    <span>Modifica una segnalazione</span>
                </a>
            </li>
            <li>
                <button type="button" id="elim" class="btn btn-info">
                <i class="fas fa-user-slash"></i>
                    <span>Elimina una segnalazione</span>
                </a>
            </li>
        </ul>

    </nav>
    </div>
<div class="wrapper">
    <!-- Sidebar  -->
    

    <!-- Page Content  -->
    
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md">
            <div id="risposta" hidden= "true">
            <table id="inseriscimi">
            <tr>
            <th>
            MotivoViaggio
            </th>
            <th>
            Provenienza
            </th>
            <th>
            Destinazione
            </th>
            <th>
            Inizio
            </th>
            <th>
            Fine
            </th>
            <th>
            dazio
            </th>
            <th>
            Nome
            </th>
            <th>
            cognome
            </th>
            <th>
            PuntoControllo
            </th>
            <th>
            SezioneAeroporto
            </th>
            <th>
            Esito
            </th>
            <th>
            Cognome
            </th>
            </tr>
            </table>
            </div>
            <div id="form" hidden="true" style="text-align:center">
            <form action="insert.php" method="POST">
            Id passeggero: <br>
            <select class="passeggero" name="idPass"></select>
            <br>
            Provenienza: <br>
            <input type="text" name="prov">
            <br>
            Destinazione: <br>
            <input type="text" name="dest">
            <br>
            MotivoViaggio: <br>
            <input type="text" name="motViagg">
            <br>
            Inizio: <br>
            <input type="text" name="inizio">
            <br>
            Fine: <br>
            <input type="text" name="fine">
            <br>
            Dazio: <br>
            <input type="text" name="dazio">
            <br>
            id Funz: <br>
            <input type="text" name="idF">
            <br>
            <input type="submit" value="Inserisci">
            <br>
            <!--
                Appendo le seguenti select:
                Punti controllo
                Tipologia merci
                Stato del fermo
                Id addetto
            -->
            <select class="idAddetto" name="idAddetto"></select>
            <select class="tipMerc" name="tipMerc"></select>
            <select class="statoFermo" name="statoFermo"></select>
            <select class="puntoCont" name="puntoCont"></select>
            </form>
            </div>
            <div id="formMod" hidden="true">
            <table id="insMod">
            <tr>
            <th>
            MotivoViaggio
            </th>
            <th>
            Provenienza
            </th>
            <th>
            Destinazione
            </th>
            <th>
            Inizio
            </th>
            <th>
            Fine
            </th>
            <th>
            dazio
            </th>
            <th>
            Nome
            </th>
            <th>
            cognome
            </th>
            <th>
            PuntoControllo
            </th>
            <th>
            SezioneAeroporto
            </th>
            <th>
            Esito
            </th>
            <th>
            Cognome
            </th>
            </tr>
            </table>
            </div>
            </div>
    </div>
</div>
</div>
</body>
</html>