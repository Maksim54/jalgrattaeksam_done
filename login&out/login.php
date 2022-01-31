<?php
require_once("../konf.php");
if(isset($_REQUEST['sub'])){
    if(trim($_REQUEST['login'])=='admin' && trim($_REQUEST['psw'])=='admin'){
        $_SESSION['admin']=true;
        $_SESSION['login']=$_REQUEST['login'];
        header("Location: ../lubadeleht.php");
        exit();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jalgrattaeksam login</title>
    <link rel="stylesheet" href="../login.css">
</head>
<body>
<header>
    <h1>Login Leht</h1>
</header>
<div class="modal">
    <form action="login.php" method="post" class="modal-content">
        <label for="login">Kasutajanimi</label>
        <input type="text" placeholder="Sisesta kasutajanimi"
               name="login" id="login" required>
        <br>
        <label for="psw">Parool</label>
        <input type="password" placeholder="Sisesta parool"
               name="psw" id="psw" required>
        <br>
        <input type="submit" name="sub" value="Logi sisse">
        <button type="button"
                onclick="window.location.href='../registreerimine.php'";
                class="cancelbtn">Cancel</button>
    </form>
</div>
</body>
</html>