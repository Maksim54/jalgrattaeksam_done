<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["korras_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET ringtee=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["korras_id"]);
    $kask->execute();
}
if(!empty($_REQUEST["vigane_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET ringtee=2 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vigane_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE teooriatulemus=10 AND ringtee=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Ringtee</title>
    <link rel="stylesheet" href="style.css">
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
        echo "<h3>".$_SESSION['login']." on sisse loginud</h3>";
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
        <a href="ringtee.php" class="active">Ringtee</a>
        <a href="t2nav.php"">Tänav</a>
        <a href="lubadeleht.php">Tulemusleht</a>
        <?php
    }
    ?>
</div>
<table>
    <?php
    while($kask->fetch()){
        echo "
		    <tr>
			  <td>$eesnimi</td>
			  <td>$perekonnanimi</td>
			  <td>
			    <a href='?korras_id=$id'>Korras</a>
			    <a href='?vigane_id=$id'>Ebaõnnestunud</a>
			  </td>
			</tr>
		  ";
    }
    ?>
</table>
</body>
</html>
