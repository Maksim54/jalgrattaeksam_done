<?php
require_once("konf.php");
global $yhendus;
$name="";
//if ($_SESSION['admin']==true){
//    header("Location: lubadusleht.php");
//}
if(isSet($_REQUEST["sisestusnupp"])){
    if(!empty(trim($_REQUEST["eesnimi"])) and !empty(trim($_REQUEST["perekonnanimi"])) and filter_var($_REQUEST["eesnimi"],FILTER_SANITIZE_NUMBER_INT) == false and filter_var($_REQUEST["perekonnanimi"],FILTER_SANITIZE_NUMBER_INT) == false){
        $name="<b>Viga: Nimi või perekonnanimi kast oli tühi</b>";
        $kask=$yhendus->prepare(
            "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
        $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
        $kask->execute();
        $yhendus->close();
        header("Location: lubadeleht.php");
        exit();
    }else{
        $name="<b>Viga: Nimi või perekonnanimi kast oli tühi.</b>";
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Kasutaja registreerimine</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modal.css">
</head>
<body>
<?php
if ($_SESSION['admin']==true){
    echo "<h3>".$_SESSION['login']." on sisse loginud</h3>";
    echo '<button><a href="login&out/logout.php">Logi välja</a></button>';
}else{
    ?>
    <br>
    <br>
    <br
    <button><a href="login&out/login.php"></a></button>
    <?php
}
?>
<header>
    <h1>Jalgrattaeksam</h1>
    <h2></h2>
</header>
</div>
<div id="logo">
    <button><a href="login&amp;out/login.php">Logi sisse</a></button></div>
<br>
<div class="vertical-menu">
    <?php
    if (isset($_SESSION['login'])){
        if ($_SESSION['admin']==false){
            ?>
                <br>
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
        <a href="registreerimine.php" class="active">Registreerimine</a>
        <a href="lubadeleht.php" >Tulemusleht</a>
        <?php
    }
    ?>
</div>
<form action="registreerimine.php">
<?php
if(isSet($_REQUEST["sisestusnupp"])){
    echo "<b>Viga: Nimi või perekonnanimi kast oli tühi</b>";
;
}
?>
    <br>
    <br>
    <br>
    <br>
    <dl>
        <dt>Nimi:</dt>
        <dd><input type="text" name="eesnimi" /></dd>
        <dt>Perekonnanimi:</dt>
        <dd><input type="text" name="perekonnanimi" /></dd>
        <dt><input type="submit" name="sisestusnupp" value="Registreerima" /></dt>
    </dl>
</form>
</body>
</html>

