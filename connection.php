<?php
#faz a conexão com o db
$server = "localhost";
$user = "root";
$pwd = "";
$db = "ex_optigest";

$mysqli = new mysqli($server, $user, $pwd, $db);

if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
