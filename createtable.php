<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:servgumb.database.windows.net,1433; Database = db1", "Yana", "Sobachka.1");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "CREATE TABLE table1(
    id INT NOT NULL IDENTITY(1,1) 
    PRIMARY KEY(id),
    lastname VARCHAR(30),
    name VARCHAR(30),
    middlename VARCHAR(30),
    Email VARCHAR(30),
    login VARCHAR(30),
    password VARCHAR(30),
    password2 VARCHAR(30),

    )";
    $conn->query($sql);
    echo "<h3>Таблица создана!</h3>"; 
}
catch (PDOException $e) {
    print("Ошибка подключения к SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "Yana@servgumb", "pwd" => "Sobachka.1", "Database" => "db1", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:servgumb.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
echo "<h3>Table created.</h3>";
?>
