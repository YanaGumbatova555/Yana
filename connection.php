<?php

$host = "sqlsrv:server = tcp:servgumb.database.windows.net,1433";
$user = "Yana";
$password = "Sobachka.1";
$db = "db1";

$connection = mysqli_connection($host, $user, $password) or die("Ошибка подключения к Серверу!");
$select_bd = mysqli_select_db($connection, $db) or die("Ошибка подключения к Базе данных!");

?>
