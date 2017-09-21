<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:gumb.database.windows.net,1433; Database = БазаДанных", "Яна", "{5556622w}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "CREATE TABLE registration_tbl(
    id INT NOT NULL IDENTITY(1,1) 
    PRIMARY KEY(id),
    name VARCHAR(30),
    email VARCHAR(30),
    date DATE)";
    $conn->query($sql);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "Яна@gumb", "pwd" => "{your_password_here}", "Database" => "БазаДанных", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:gumb.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
echo "<h3>Table created.</h3>";
?>
