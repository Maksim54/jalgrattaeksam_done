<?php
session_start();
if (!isset($_SESSION['admin'])){
    $_SESSION['admin']=false;
}
$yhendus=new mysqli("localhost", "lagunovski", "123456", "test");