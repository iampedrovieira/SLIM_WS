<?php

include "NotORM.php";
$user = "root";
$pass = "";
$connection = new PDO('mysql:host=localhost;dbname=db_cm;charset=utf8',$user,$pass);
$db = new NotORM($connection);

?>