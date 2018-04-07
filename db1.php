<?php

$dsn = "sqlsrv:server = tcp:servgumb.database.windows.net,1433; Database = db1";
$login = "Yana";
$pass = "Sobachka.1";

try {
    $conn = new PDO($dsn, $login, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $ex) {
    echo 'Не связанный '.$ex->getMessage();
}
session_start(); 
 ?>
