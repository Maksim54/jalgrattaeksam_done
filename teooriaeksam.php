<?php
require_once("konf.php");
global $yhendus;
if (isset($_REQUEST['kustuta'])){
    $kask=$yhendus->prepare("DELETE from jalgrattaeksam WHERE id=?");
    $kask->bind_param("i", $_REQUEST["id"]);
    $kask->execute();
}
if(!empty($_REQUEST["teooriatulemus"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
    $kask->bind_param("ii", $_REQUEST["teooriatulemus"], $_REQUEST["id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE teooriatulemus=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Teooriaeksam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="logo">
    <img src="eksam23.png" alt="Logo">
</div>
<header>
    <h1>Jalgrattaeksam</h1>
    <h2></h2></header>
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
        <a href="teooriaeksam.php" class="active">Teooriaeksam</a>
        <a href="slaalom.php">Slaalom</a>
        <a href="ringtee.php">Ringtee</a>
        <a href="t2nav.php">Tänav</a>
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
			  <td><form action=''>
			         <input type='hidden' name='id' value='$id' />
					 <input type='number' name='teooriatulemus' max='10' min='0'/>
					 <input type='submit' value='Sisesta tulemus' />
			      </form>
			  </td>
			  
			</tr>
		  ";
    }
    ?>
</table>
</body>
</html>
