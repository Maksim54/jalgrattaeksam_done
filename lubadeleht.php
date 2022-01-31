<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["vormistamine_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET luba=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vormistamine_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi, teooriatulemus, 
	     slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;");
$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus,
    $slaalom, $ringtee, $t2nav, $luba);
$kask->execute();

function asenda($nr){
    if($nr==-1){return ".";} //tegemata
    if($nr== 1){return "korras";}
    if($nr== 2){return "ebaõnnestunud";}
    return "Tundmatu number";
}
function asendaT($nr){
    if($nr==-1){return ".";} //tegemata
    return $nr;
}
?>
<!doctype html>
<html>
<head>
    <title>Lõpetamine</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="logo">
    <img src="eksam23.png" alt="Logo">
</div>
<header>
    <h1>Jalgrattaeksam</h1>
    <h2></h2>
</header>
<div id="logo">
    <br>
    <?php
    if ($_SESSION['admin']==true){
        echo "<h3>".$_SESSION['login']." on sisse logitud</h3>";
        echo '<button><a href="login&out/logout.php">Logi välja</a></button>';
    }else{
        ?>
        <button><a href="login&out/login.php">Logi sisse</a></button>
        <?php
    }
    ?>
</div>
<br>
<div class="vertical-menu">
    <?php
    if (isset($_SESSION['login'])){
        if ($_SESSION['admin']==false){
    ?>
        <a href="registreerimine.php">Registreerimine</a>
    <?php
        }
        ?>
        <a href="teooriaeksam.php">Teooriaeksam</a>
        <a href="slaalom.php">Slaalom</a>
        <a href="ringtee.php">Ringtee</a>
        <a href="t2nav.php">Tänav</a>
        <a href="lubadeleht.php" class="active">Tulemusleht</a>
        <?php
    }else{
        ?>
        <a href="registreerimine.php">Registreerimine</a>
        <a href="lubadeleht.php" class="active">Tulemusleht</a>
        <?php
    }
    ?>
</div>
<table>
    <tr>
        <th>Eesnimi</th>
        <th>Perekonnanimi</th>
        <th>Teooriaeksam</th>
        <th>Slaalom</th>
        <th>Ringtee</th>
        <th>Tänavasõit</th>
        <th>Lubade väljastus</th>
    </tr>
    <?php
    while($kask->fetch()){
        $asendatud_teoria=asendaT($teooriatulemus);
        $asendatud_slaalom=asenda($slaalom);
        $asendatud_ringtee=asenda($ringtee);
        $asendatud_t2nav=asenda($t2nav);
        $loalahter=".";
        if($luba==1){$loalahter="Väljastatud";}
        if($luba==-1 and $t2nav==1 and $_SESSION['admin']==true){
            $loalahter="<a href='?vormistamine_id=$id'>Vormista load</a>";
        }
        echo "
		     <tr>
			   <td>$eesnimi</td>
			   <td>$perekonnanimi</td>
			   <td>$asendatud_teoria</td>
			   <td>$asendatud_slaalom</td>
			   <td>$asendatud_ringtee</td>
			   <td>$asendatud_t2nav</td>
			   <td>$loalahter</td>
			 </tr>
		   ";
    }
    ?>
</table>
</body>
</html>
